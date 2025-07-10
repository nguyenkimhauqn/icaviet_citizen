<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionSet;
use App\Models\Quiz;
use App\Models\Topic;
use App\Models\UserAnswerQuestion;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Lấy tất cả quiz đã hoàn thành của user
        $quizzes = Quiz::where('user_id', $user->id)
            ->where('is_completed', true)
            ->get();

        if ($quizzes->isEmpty()) {
            return view('result.index')->with('message', 'Bạn chưa hoàn thành bài kiểm tra nào.');
        }

        // Tính tổng
        $totalQuestions = $quizzes->sum('total_questions');
        $totalCorrect = $quizzes->sum('correct_answers');
        $totalIncorrect = $totalQuestions - $totalCorrect;
        $accuracy = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100) : 0;

        return view('result.index', compact(
            'totalQuestions',
            'totalCorrect',
            'totalIncorrect',
            'accuracy'
        ));
    }

    // public function show(Request $request)
    // {
    //     $userId = auth()->id(); // lấy user hiện tại
    //     $testTypes = Topic::take(4)->orderBy('num_order')->get();
    //     $resultsByAttempt = [];

    //     // Lấy tất cả các attempt_id của user
    //     // $attemptIds = UserAnswerQuestion::where('user_id', $userId)
    //     //     ->select('attempt_id')
    //     //     ->distinct()
    //     //     ->pluck('attempt_id');

    //     $attemptIds = UserAnswerQuestion::select('attempt_id')
    //         ->where('user_id', $userId)
    //         ->groupBy('attempt_id')
    //         ->orderByRaw('MAX(created_at) DESC')
    //         ->pluck('attempt_id');

    //     foreach ($attemptIds as $attemptId) {
    //         $results = [];

    //         foreach ($testTypes as $testType) {
    //             $slug = $testType->slug;
    //             $setNumber = request()->query('set_number', 1);

    //             if ($slug === 'n400') {
    //                 $questionIds = QuestionSet::where('set_number', $setNumber)
    //                     ->orderBy('id')
    //                     ->pluck('question_id');

    //                 $questions = Question::whereIn('id', $questionIds)
    //                     ->with('answers')
    //                     ->get();
    //             } else {
    //                 $questions = $testType->questions()->with('answers')->get();
    //                 $questionIds = $questions->pluck('id');
    //             }

    //             $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
    //                 ->whereIn('question_id', $questionIds)
    //                 ->with('answer')
    //                 ->get()
    //                 ->keyBy('question_id');

    //             $correctAnswers = $userAnswers->where('is_correct', true)->count();

    //             $isPassed = match ($slug) {
    //                 'civics' => $correctAnswers >= 6,
    //                 'reading', 'writing' => $correctAnswers >= 1,
    //                 default => null,
    //             };

    //             $details = [];

    //             foreach ($questions as $question) {
    //                 $userAnswer = $userAnswers->get($question->id);
    //                 if (!$userAnswer) continue;

    //                 $correctAnswer = $question->answers->firstWhere('is_correct', true);

    //                 $details[] = [
    //                     'question' => $question->content,
    //                     'vietnamese_question' => $question->translation,
    //                     'type' => $question->type,
    //                     'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
    //                     'correct_answer' => $correctAnswer?->content,
    //                     'vietnamese_correct_answer' => $correctAnswer?->explanation,
    //                     'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
    //                     'is_correct' => $userAnswer->is_correct,
    //                 ];

    //                 if (in_array($slug, ['reading', 'writing'])) {
    //                     break;
    //                 }
    //             }

    //             // Tính total questions:
    //             if ($slug === 'n400') {
    //                 $answeredIds = $userAnswers->keys();
    //                 $lastAnsweredId = $answeredIds->max();
    //                 $orderedQuestionIds = $questionIds->values()->toArray();
    //                 $lastIndex = array_search($lastAnsweredId, $orderedQuestionIds);
    //                 $totalQuestions = $lastIndex !== false ? $lastIndex + 1 : $userAnswers->count();
    //             } elseif ($slug === 'civics') {
    //                 $totalQuestions = $userAnswers->filter(fn($ua) => !empty($ua->answer_text) || !empty($ua->answer_id))->count();
    //             } elseif (in_array($slug, ['reading', 'writing'])) {
    //                 $totalQuestions = 3;
    //                 foreach ($questions as $question) {
    //                     $userAnswer = $userAnswers->get($question->id);
    //                     if ($userAnswer && $userAnswer->is_correct) {
    //                         $resultKey = "{$slug}_retry_result_{$question->id}";
    //                         $totalQuestions = session()->get($resultKey, 1);
    //                         break;
    //                     }
    //                 }
    //             } else {
    //                 $totalQuestions = $questions->count();
    //             }

    //             $results[] = [
    //                 'title' => $testType->name,
    //                 'vietnamese_title' => $testType->vietnamese_name,
    //                 'slug' => $slug,
    //                 'icon' => "icon/mockTests/{$slug}.svg",
    //                 'correct' => $correctAnswers,
    //                 'total' => $totalQuestions,
    //                 'is_passed' => $isPassed,
    //                 'is_complete' => $totalQuestions > 0,
    //                 'details' => $details,
    //             ];
    //         }

    //         $resultsByAttempt[] = [
    //             'attempt_id' => $attemptId,
    //             'results' => $results,
    //         ];
    //     }

    //     return view('result.show', compact('resultsByAttempt'));
    // }

    public function show(Request $request)
    {
        $userId = auth()->id();
        $testTypes = Topic::take(4)->orderBy('num_order')->get();
        $resultsByAttempt = [];

        $attemptIds = UserAnswerQuestion::select('attempt_id')
            ->where('user_id', $userId)
            ->groupBy('attempt_id')
            ->orderByRaw('MAX(created_at) DESC')
            ->pluck('attempt_id');

        foreach ($attemptIds as $attemptId) {
            $results = [];
            $isAllComplete = true;

            foreach ($testTypes as $testType) {
                $slug = $testType->slug;
                $setNumber = request()->query('set_number', 1);

                if ($slug === 'n400') {
                    $questionIds = QuestionSet::where('set_number', $setNumber)
                        ->orderBy('id')
                        ->pluck('question_id');

                    $questions = Question::whereIn('id', $questionIds)
                        ->with('answers')
                        ->get();
                } else {
                    $questions = $testType->questions()->with('answers')->get();
                    $questionIds = $questions->pluck('id');
                }

                $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
                    ->whereIn('question_id', $questionIds)
                    ->with('answer')
                    ->get()
                    ->keyBy('question_id');

                $details = [];
                $correctAnswers = 0;
                $isPassed = null;
                $isComplete = false;
                $totalQuestions = 0;

                if ($slug === 'civics') {
                    $answeredCivics = $userAnswers->filter(fn($ua) => !empty($ua->answer_text) || !empty($ua->answer_id));
                    $correctAnswers = $answeredCivics->where('is_correct', true)->count();

                    $isPassed = $correctAnswers >= 6;
                    $isComplete = $isPassed || $answeredCivics->count() >= 10;

                    if (!$isComplete) $isAllComplete = false;

                    foreach ($questions as $question) {
                        $userAnswer = $userAnswers->get($question->id);
                        if (!$userAnswer) continue;

                        $correctAnswer = $question->answers->firstWhere('is_correct', true);

                        $details[] = [
                            'question' => $question->content,
                            'vietnamese_question' => $question->translation,
                            'type' => $question->type,
                            'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
                            'correct_answer' => $correctAnswer?->content,
                            'vietnamese_correct_answer' => $correctAnswer?->explanation,
                            'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
                            'is_correct' => $userAnswer->is_correct,
                        ];
                    }

                    $totalQuestions = $answeredCivics->count();
                } elseif (in_array($slug, ['reading', 'writing'])) {
                    $userAnswer = UserAnswerQuestion::where('attempt_id', $attemptId)
                        ->whereIn('question_id', $questionIds)
                        ->with(['question.answers'])
                        ->orderByDesc('answered_at')
                        ->first();

                    if (!$userAnswer) {
                        $isAllComplete = false;
                        continue;
                    }

                    $question = $userAnswer->question;
                    $correctAnswer = $question->answers->firstWhere('is_correct', true);

                    $details[] = [
                        'question' => $question->content,
                        'vietnamese_question' => $question->translation,
                        'type' => $question->type,
                        'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
                        'correct_answer' => $correctAnswer?->content,
                        'vietnamese_correct_answer' => $correctAnswer?->explanation,
                        'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
                        'is_correct' => $userAnswer->is_correct,
                    ];

                    $correctAnswers = $userAnswer->is_correct ? 1 : 0;
                    $isPassed = $correctAnswers >= 1;
                    $totalQuestions = session()->get("{$slug}_retry_result", 3);
                    $isComplete = true;
                } else { // n400 hoặc others
                    // foreach ($questions as $question) {
                    //     $userAnswer = $userAnswers->get($question->id);
                    //     if (!$userAnswer) continue;

                    //     $correctAnswer = $question->answers->firstWhere('is_correct', true);

                    //     $details[] = [
                    //         'question' => $question->content,
                    //         'vietnamese_question' => $question->translation,
                    //         'type' => $question->type,
                    //         'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
                    //         'correct_answer' => $correctAnswer?->content,
                    //         'vietnamese_correct_answer' => $correctAnswer?->explanation,
                    //         'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
                    //         'is_correct' => $userAnswer->is_correct,
                    //     ];
                    // }

                    // $correctAnswers = $userAnswers->where('is_correct', true)->count();
                    // $totalQuestions = $questions->count();
                    // $isComplete = $userAnswers->count() >= $totalQuestions;

                    // if (!$isComplete) $isAllComplete = false;
                }

                $results[] = [
                    'title' => $testType->name,
                    'vietnamese_title' => $testType->vietnamese_name,
                    'slug' => $slug,
                    'icon' => "icon/mockTests/{$slug}.svg",
                    'correct' => $correctAnswers,
                    'total' => $totalQuestions,
                    'is_passed' => $isPassed,
                    'is_complete' => $isComplete,
                    'details' => $details,
                ];
            }

            if ($isAllComplete) {
                $resultsByAttempt[] = [
                    'attempt_id' => $attemptId,
                    'results' => $results,
                ];
            }
        }

        return view('result.show', compact('resultsByAttempt'));
    }



    public function showDetail(Request $request, $attemptId)
    {
        $userId = auth()->id();
        $setNumber = $request->query('set_number', 1);

        // Lấy topic N-400
        $testType = Topic::where('slug', 'n400')->firstOrFail();

        // Lấy danh sách câu hỏi theo set
        $questionIds = QuestionSet::where('set_number', $setNumber)
            ->orderBy('id')
            ->pluck('question_id');

        // Lấy câu hỏi có category
        $questions = Question::whereIn('id', $questionIds)
            ->with(['answers', 'category']) // cần có relation `category()`
            ->get();

        // Lấy đáp án của người dùng
        $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
            ->where('user_id', $userId)
            ->whereIn('question_id', $questionIds)
            ->with('answer')
            ->get()
            ->keyBy('question_id');

        $correctAnswers = $userAnswers->where('is_correct', true)->count();

        // Nhóm theo category
        $detailsByCategory = [];

        foreach ($questions as $question) {
            $userAnswer = $userAnswers->get($question->id);
            if (!$userAnswer) continue;

            $correctAnswer = $question->answers->firstWhere('is_correct', true);

            $detail = [
                'question' => $question->content,
                'vietnamese_question' => $question->translation,
                'type' => $question->type,
                'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
                'correct_answer' => $correctAnswer?->content,
                'vietnamese_correct_answer' => $correctAnswer?->explanation,
                'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
                'is_correct' => $userAnswer->is_correct,
            ];

            $categoryKey = $question->category?->title_en ?? 'Uncategorized';
            $categoryNameVn = $question->category?->title_vn ?? 'Chưa phân loại';

            // Gán vào group
            $detailsByCategory[$categoryKey]['category_name_vn'] = $categoryNameVn;
            $detailsByCategory[$categoryKey]['questions'][] = $detail;
        }


        // Tính số câu đã làm
        $answeredIds = $userAnswers->keys();
        $lastAnsweredId = $answeredIds->max();
        $orderedQuestionIds = $questionIds->values()->toArray();
        $lastIndex = array_search($lastAnsweredId, $orderedQuestionIds);
        $totalQuestions = $lastIndex !== false ? $lastIndex + 1 : $userAnswers->count();

        $results[] = [
            'title' => $testType->name,
            'vietnamese_title' => $testType->vietnamese_name,
            'slug' => 'n400',
            'icon' => "icon/mockTests/n400.svg",
            'correct' => $correctAnswers,
            'total' => $totalQuestions,
            'is_passed' => null,
            'is_complete' => $totalQuestions > 0,
            'details' => $detailsByCategory,
        ];

        return view('result.detail', compact('results', 'attemptId'));
    }
}
