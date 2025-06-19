<?php

namespace App\Http\Controllers;

use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class WhisperController extends Controller
{
    public function transcribe(Request $request)
    {
        $request->validate([
            'audio' => 'required|mimes:wav|max:10240', // max 10MB
        ]);

        // Lưu file tạm
        $audioPath = $request->file('audio')->store('whisper_temp');

        // Gửi lên OpenAI Whisper API
        $response = Http::withToken(config('services.openai.key'))
            ->attach(
                'file',
                Storage::get($audioPath),
                $request->file('audio')->getClientOriginalName()
            )
            ->post('https://api.openai.com/v1/audio/transcriptions', [
                'model' => 'whisper-1',
                'language' => 'vi',
                'response_format' => 'json',
            ]);

        // Xoá file tạm
        // Storage::delete($audioPath);

        return response()->json([
            'transcript' => $response->json('text') ?? null,
        ]);
    }
}
