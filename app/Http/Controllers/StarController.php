<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\StarredQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StarController extends Controller
{
    public function category()
    {   
        
        // Truyền dữ liệu nếu cần
        $stars = ['Sun', 'Sirius', 'Alpha Centauri', 'Betelgeuse'];

        return view('star.category', compact('stars'));
    }

    public function toggleStar(Request $request, Question $question)
    {
        $user = Auth::user();
        $existing = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed']);
        } else {
            StarredQuestion::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
