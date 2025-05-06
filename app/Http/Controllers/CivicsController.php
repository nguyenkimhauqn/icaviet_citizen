<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\StarredQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;


class CivicsController extends Controller
{
    // Hiển thị câu hỏi thứ N trong bài viết kiểm tra (Lấy từ model và render ra view)
    public function show(Request $request)
    {
        // ✨ Lấy vị trí bắt đầu từ last_question_index trong bảng users
        $user = Auth::user();
        $startIndex = $user->last_question_index ?? 0;

        // ✨ Lấy 10 câu hỏi tiếp theo dựa trên vị trí
        $questions = Question::with(['answers', 'answers.hints'])
            ->orderBy('id')
            ->skip($startIndex)
            ->take(10)
            ->get()
            ->map(function ($question) {
                $question->setRelation('answers', $question->answers->shuffle());
                return $question;
            });
        // 🟨 TÍNH SỐ TRANG HIỆN TẠI
        $page = $request->query('page', 1);
        $question = $questions->slice($page - 1, 1)->first();
        $total = $questions->count();
        $nextPageUrl = $page < $total ? url()->current() . '?page=' . ($page + 1) : null;
        // dd($question);
        $countQuiz = Quiz::all()->count();

        if (!$question) {
            abort(404, 'Câu hỏi không tồn tại');
        }
        // ✅ Luôn kiểm tra Session trước khi sử dụng
        if (!Session::has('civics.quiz') || empty(Session::get('civics.quiz.questions'))) {
            Session::put('civics.quiz', [
                'questions' => $questions->pluck('id')->toArray(),
                'answers' => [],
            ]);
        }
        // 🟨 KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();

        // dd(session::all());
        return view('Civics.question', [
            'question' => $question, // Model Question
            'answers' => $question->answers, // Collection Answer
            'index' => 1,
            'total' => $total,
            'quizId' => $countQuiz,
            'nextPageUrl' => $nextPageUrl,
            'page' => $page,
            'isStarred' => $isStarred,
            'mode' => 'show',
        ]);
    }

    public function checkAnswer(Request $request, Question $question)
    {
        $answerId = $request->input('answer_id');
        // dd($answerId);
        $selectedAnswer = Answer::where('id', $answerId)->where('question_id', $question->id)->with('hints')->first();
        // dd($selectedAnswer);
        if (!$selectedAnswer) {
            return response()->json(['success' => false, 'message' => 'Answer not found']);
        }

        $correctAnswer = $question->answers()->where('is_correct', true)->first();
        // dd($correctAnswer);
        // ✅ Kiểm tra nếu session bị mất khi làm bài
        if (!Session::has('civics.quiz')) {
            return response()->json(['success' => false, 'message' => 'Phiên làm bài không hợp lệ. Vui lòng bắt đầu lại.']);
        }
        // ✅ Ghi lại kết quả câu trả lời vào session
        $quizSession = Session::get('civics.quiz');
        $quizSession['answers'][$question->id] = [
            'selected' => $selectedAnswer->id,
            'is_correct' => $selectedAnswer->is_correct,
        ];
        Session::put('civics.quiz', $quizSession);
        $hints = $selectedAnswer->hints->pluck('content');
        // dd($hints);
        // dd($hints);
        return response()->json([
            'success' => true,
            'is_correct' => $selectedAnswer->is_correct,
            'selected_answer_id' => $selectedAnswer->id,
            'correct_answer_id' => $correctAnswer->id,
            'hints' => $selectedAnswer->is_correct ? $selectedAnswer->hints->pluck('content') : [] // Chỉ trả về nếu câu trả lời đúng
        ]);
    }

    public function finishQuiz(Request $request)
    {
        // dd("ok");
        $quizSession = Session::get('civics.quiz');

        if (!$quizSession || empty($quizSession['answers']) || empty($quizSession['questions'])) {
            return response()->json(['success' => false, 'message' => 'Phiên làm bài không tồn tại hoặc bị lỗi. Vui lòng kiểm tra lại.']);
        }

        $questionIds = $quizSession['questions'];
        $answers = $quizSession['answers'];
        // doing

        // 🟨 TÍNH SỐ CÂU ĐÚNG
        $correctCount = collect($answers)->where('is_correct', true)->count();

        // 🟨 TẠO QUIZ TRONG DB
        $quiz = Quiz::create([
            'user_id' => Auth::id(),
            'total_questions' => count($questionIds),
            'correct_answers' => $correctCount,
            'is_completed' => true,
        ]);

        // 🟨 TẠO QUIZ_QUESTIONS CHI TIẾT
        foreach ($answers as $questionId => $data) {
            QuizQuestion::create([
                'quiz_id' => $quiz->id,
                'question_id' => $questionId,
                'user_answer_id' => $data['selected'],
                'is_correct' => $data['is_correct'],
                'question_order' => array_search($questionId, $questionIds) + 1
            ]);
        }
        // 🟨 CẬP NHẬT LAST INDEX CHO USER
        $user = Auth::user();
        $user->last_question_index += 10;
        if ($user->last_question_index >= 100) {
            $user->last_question_index = 0;
        }
        $user->save();

        // 🟨 DỌN SESSION
        Session::forget('civics.quiz');

        return response()->json([
            'success' => true,
            'quiz_id' => $quiz->id
        ]);
    }

    public function showResult(Quiz $quiz, Request $request)
    {   
        $mode = $request->query('mode','show');
        return view('civics.result', compact('quiz','mode'));
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

    public function showStarred(Request $request) {
        $user = Auth::user();
        $starredQuestions = $user->starredQuestions()->with(['answers','answers.hints'])->get();
        // dd($starredQuestions);

        $page = $request->query('page',1);
        $total = $starredQuestions->count();
        $question = $starredQuestions->slice($page-1, 1)->first();
        $nextPageUrl = $page < $total ? url()->current() . '?page=' . ($page + 1) : null;
        //doing 
        $countQuiz = Quiz::all()->count();

        if (!$question) {
            abort(404, 'Câu hỏi không tồn tại');
        }
        // ✅ Luôn kiểm tra Session trước khi sử dụng
        if (!Session::has('civics.quiz') || empty(Session::get('civics.quiz.questions'))) {
            Session::put('civics.quiz', [
                'questions' => $starredQuestions->pluck('id')->toArray(),
                'answers' => [],
            ]);
        }

        return view('Civics.question', [
            'question' => $question,
            'answers' => $question->answers,
            'index' => $page,
            'total' => $total,
            'quizId' => $countQuiz, 
            'nextPageUrl' => $nextPageUrl,
            'page' => $page,
            'isStarred' => true,
            'mode' => 'showStarred',
        ]);

    }
}
