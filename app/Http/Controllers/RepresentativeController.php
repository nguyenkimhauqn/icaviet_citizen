<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Representative;
use Illuminate\Support\Str;
use app\Helper\RepresentativeHelper;
use App\Helpers\RepresentativeHelper as HelpersRepresentativeHelper;

class RepresentativeController extends Controller
{
    public function form()
    {
        $user = Auth::user();

        if ($user->representative) {
            $rep = $user->representative;

            return view('representative.results', [
                'zip' => $rep->zip,
                'state' => $rep->state,
                'capital' => $rep->capital,
                'representative' => $rep->representative,
                'senators' => $rep->senators,
                'governor' => $rep->governor,
            ]);
        }

        return view('representative.form');
    }

    public function getRepresentative(Request $request)
    {
        $request->validate([
            'zip' => 'required|digits:5'
        ]);

        $zip = $request->input('zip');

        // dump($zip);
        // 1. Gọi Metadapi để lấy lat/lon và tiểu bang
        $geoResponse = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => config('services.metadapi.key'),
        ])->get("https://global.metadapi.com/zipc/v1/zipcodes/{$zip}");

        // Parse JSON trước khi kiểm tra
        $geoData = $geoResponse->json();
        // dump($geoData);
        if ($geoResponse->failed() || !isset($geoData['data']['latitude']) || !isset($geoData['data']['longitude'])) {
            return back()->withErrors(['zip' => 'Mã zip không hợp lệ, vui lòng thử mã khác']);
        }
        // dd($geoData);
        $geoData = $geoResponse['data'];
        $lat = $geoData['latitude'];
        $lon = $geoData['longitude'];
        $state = $geoData['stateName'];
        $capital = HelpersRepresentativeHelper::getCapitalByState($state);


        // 2. Lấy người đại diện (Dân biểu Hạ viện)
        $repResponse = Http::get('https://app.cicerodata.com/v3.1/official', [
            'lat' => $lat,
            'lon' => $lon,
            'district_type' => 'NATIONAL_LOWER',
            'format' => 'json',
            'key' => config('services.cicero.key'),
        ]);
        $repOfficials = collect($repResponse->json()['response']['results']['officials'] ?? []);
        $representative = $repOfficials->first(function ($official) {
            return $official['office']['district']['district_type'] === 'NATIONAL_LOWER';
        });
        // 3. Lấy 2 thượng nghị sĩ (NATIONAL_UPPER)
        $senateResponse = Http::get('https://app.cicerodata.com/v3.1/official', [
            'lat' => $lat,
            'lon' => $lon,
            'district_type' => 'NATIONAL_UPPER',
            'format' => 'json',
            'key' => config('services.cicero.key'),
        ]);

        $senators = collect($senateResponse->json()['response']['results']['officials'] ?? [])
            ->filter(function ($official) {
                return $official['office']['district']['district_type'] === 'NATIONAL_UPPER';
            })->values();

        // 4. Lấy thống đốc bang (STATE_EXEC)
        $governorResponse = Http::get('https://app.cicerodata.com/v3.1/official', [
            'lat' => $lat,
            'lon' => $lon,
            'district_type' => 'STATE_EXEC',
            'format' => 'json',
            'key' => config('services.cicero.key'),
        ]);

        $governorOfficials = collect($governorResponse->json()['response']['results']['officials'] ?? []);
        $governor = $governorOfficials->first(function ($official) {
            $office = $official['office'] ?? [];
            return strtolower($office['title'] ?? '') === 'governor';
        });

        // 5. Lưu trữ vào database.
        $rep = Representative::updateOrCreate(
            ['zip' => $zip],
            [
                'state' => $state,
                'capital' => $capital,
                'representative' => $representative,
                'senators' => $senators,
                'governor' => $governor,
            ]
        );

        // 6. Gán cho user hiện tại
        $user = Auth::user();
        $user->representative_id = $rep->id;
        $user->save();

        return redirect()->route('representative.form');
    }
}
