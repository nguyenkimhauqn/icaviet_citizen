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
    public function form()
    {
        // Xóa session bài quiz nếu tồn tại
        Session::forget('civics.quiz');
        return view('civics.form');
    }

    // Hiển thị câu hỏi thứ N trong bài viết kiểm tra (Lấy từ model và render ra view)
    public function show(Request $request)
    {
        // Lấy mode từ user
        $mode = $request->query('mode', 'random10'); // mặc định là 10 câu NN.

        $heading = "KIỂM TRA CÔNG DÂN";
        // ✨ Lấy vị trí bắt đầu từ last_question_index trong bảng users
        $user = Auth::user();

        // Tạm chưa dùng
        $startIndex = $user->last_question_index ?? 0;
        // test
        $startIndex = 0;
        // Lấy data theo mode
        // #1. Khởi tạo query cơ bản
        $query = Question::with(['answers', 'answers.hints'])
            ->where('topic_id', 1);
        // #2. Xử lý theo mode & mode random
        if (!Session::has('civics.quiz') || empty(Session::get('civics.quiz.questions'))) {
            switch ($mode) {
                case 'random10':
                    $questions = $query->inRandomOrder()->take(10)->get();
                    break;

                case 'ordered':
                    $questions = $query->orderBy('id')->take(100)->get();
                    break;

                case 'random':
                    $questions = $query->inRandomOrder()->take(100)->get();
                    break;

                case 'all': // fallback mặc định
                default:
                    $questions = $query->orderBy('id')->skip($startIndex)->take(10)->get();
                    break;
            }
            // Lưu danh sách ID vào session để cố định câu hỏi cho lần truy cập sau
            Session::put('civics.quiz', [
                'questions' => $questions->pluck('id')->toArray(),
                'answers' => [],
            ]);
        } else {
            // ✅ Nếu đã có session, chỉ lấy lại các câu hỏi theo ID cũ (tránh bị random lại)
            $questionIds = Session::get('civics.quiz.questions');
            $questions = Question::with(['answers', 'answers.hints'])
                ->whereIn('id', $questionIds)
                ->get()
                ->sortBy(function ($q) use ($questionIds) {
                    return array_search($q->id, $questionIds);
                })
                ->values(); // reset index
        }


        // Shuffle đáp án cho từng câu
        $questions = $questions->map(function ($question) {
            $question->setRelation('answers', $question->answers->shuffle());
            return $question;
        });

        // Lấy representative for đáp án đúng
        $user = Auth::user()->load('representative');
        $rep = $user->representative;
        // dd($rep);
        // dump($rep->senators,$rep->representative,$rep->governor, $rep->capital);
        // dd("");
        // Old Query
        // $questions = Question::with(['answers', 'answers.hints'])
        //     ->where('topic_id', 1)
        //     ->orderBy('id')
        //     ->skip($startIndex)
        //     ->take(10)
        //     ->get()
        //     ->map(function ($question) {
        //         $question->setRelation('answers', $question->answers->shuffle());
        //         return $question;
        //     });

        // 🟨 TÍNH SỐ TRANG HIỆN TẠI
        $page = $request->query('page', 1);
        $question = $questions->slice($page - 1, 1)->first();
        $total = $questions->count();
        $nextPageUrl = $page < $total ? url()->current() . '?page=' . ($page + 1) . '&mode=' . $mode : null;
        // dd($question);
        $countQuiz = Quiz::all()->count();
        // dd($question);
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
        return view('civics.question', [
            'question' => $question, // Model Question
            'answers' => $question->answers, // Collection Answer
            'index' => 1,
            'total' => $total,
            'quizId' => $countQuiz,
            'nextPageUrl' => $nextPageUrl,
            'page' => $page,
            'isStarred' => $isStarred,
            'mode' => 'show',
            'heading' => $heading,
            'representativeData' => $rep
        ]);
    }

    public function start(Request $request)
    {
        $mode = $request->input('mode'); // e.g. random10, all, ordered, random
        return redirect()->route('civics.show', ['mode' => $mode]);
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
        // dump($quizSession);
        if (!$quizSession || empty($quizSession['answers']) || empty($quizSession['questions'])) {
            return response()->json(['success' => false, 'message' => 'Phiên làm bài không tồn tại hoặc bị lỗi. Vui lòng kiểm tra lại.']);
        }

        $questionIds = $quizSession['questions'];
        $answers = $quizSession['answers'];
        // dump($answers);

        // 🟨 TÍNH SỐ CÂU ĐÚNG
        $correctCount = collect($answers)->where('is_correct', true)->count();
        // dd($correctCount);
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

    // Wrong here
    public function showResult(Quiz $quiz, Request $request)
    {
        $mode = $request->query('mode', 'show');
        // dd($quiz->id);
        $quizQuestions = QuizQuestion::with([
            'question.answers',
            'userAnswer',
        ])
            ->where('quiz_id', $quiz->id)
            ->where('is_correct', false)
            ->get();

        // dd($quizQuestions);
        // Danh sách câu hỏi đã đánh dấu sao
        // $starredIds = StarredQuestion::where('user_id', $quiz->user_id)->pluck('question_id')->toArray();

        return view('civics.result', compact('quiz', 'mode', 'quizQuestions'));
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

    public function showStarred(Request $request)
    {
        $heading  = "KIỂM TRA GẮN DẤU SAO";
        $user = Auth::user();
        $starredQuestions = $user->starredQuestions()->with(['answers', 'answers.hints'])->get();
        // dd($starredQuestions);

        $page = $request->query('page', 1);
        $total = $starredQuestions->count();
        $question = $starredQuestions->slice($page - 1, 1)->first();
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

        return view('civics.question', [
            'question' => $question,
            'answers' => $question->answers,
            'index' => $page,
            'total' => $total,
            'quizId' => $countQuiz,
            'nextPageUrl' => $nextPageUrl,
            'page' => $page,
            'isStarred' => true,
            'mode' => 'showStarred',
            'heading' => $heading,
        ]);
    }
}
