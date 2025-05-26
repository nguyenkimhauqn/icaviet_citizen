<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\StarredQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class CivicsResultController extends Controller
{
    // Trang danh sách tất cả các bài kiểm tra của user
    public function index()
    {
        $user = Auth::user();

        $quizzes = Quiz::where('user_id', $user->id)
            ->withCount([
                'quizQuestions as correct_count' => function ($q) {
                    $q->where('is_correct', true);
                },
                'quizQuestions as wrong_count' => function ($q) {
                    $q->where('is_correct', false);
                }
            ])
            ->orderByDesc('created_at')
            ->get();

        // Tính trung bình
        $average = $quizzes->avg(function ($quiz) {
            return $quiz->total_questions > 0
                ? ($quiz->correct_answers / $quiz->total_questions) * 100
                : 0;
        });

        return view('results.index', [
            'quizzes' => $quizzes,
            'average' => round($average),
            'challengeCount' => $quizzes->count()
        ]);
    }


    // Trang chi tiết 1 bài kiểm tra
    public function show(Quiz $quiz)
    {
        $quizQuestions = QuizQuestion::with([
            'question.answers',
            'userAnswer',
        ])->where('quiz_id', $quiz->id)->get();

        // Danh sách câu hỏi đã đánh dấu sao
        $starredIds = StarredQuestion::where('user_id', $quiz->user_id)->pluck('question_id')->toArray();
        
        return view('results.show', [
            'quiz' => $quiz,
            'quizQuestions' => $quizQuestions,
            'starredIds' => $starredIds
        ]);
    }
}
