<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\StarredQuestion;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class WritingController extends Controller
{
    public function show($index = 0)
    {
        // 5. Lấy data user
        $user = Auth::user();
        $starredIds = StarredQuestion::where('user_id', $user->id)->pluck('question_id');
        // 1. Lấy danh sách tất cả câu hỏi có topic_id = 2 (Writing Test)
        $questions = Question::where('topic_id', 2)->orderBy('id')->get();
        // 2. Tổng số câu
        $total = $questions->count();
        // 3. Giới hạn chỉ số index trong mảng.
        $index = max(0, min($index, $total - 1));
        // 4. Lấy ra 1 câu hỏi theo vị trí
        $question = $questions[$index];

        // 6. KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();

        // 5. Truyền dữ liệu xuống view
        return view('writing.show', [
            'question' => $question,
            'index' => $index,
            'total' => $total,
            'isStarred' => $isStarred,
            'routeName' => 'writing.show',
            'mode' => 'show',

        ]);
    }

    public function check(Request $request)
    {
        // dd("ok");
        $index = (int) $request->input('index');
        // dd($index);
        $userAnswer = $request->input('user_answer');
        // dd($userAnswer);

        // Lấy câu hỏi từ topic writing
        $question = Question::where('topic_id', 2)->orderBy('id')->skip($index)->first();

        if (!$question) {
            return redirect()->route('writing.show', ['index' => 0])
                ->with('error', 'Không tìm thấy câu hỏi');
        }

        // So sánh Chuẩn hóa chuỗi: bỏ dấu chấm câu, khoảng trắng, chữ thường
        $normalize = function ($text) {
            $text = strip_tags($text); // Loại bỏ <strong> hoặc các thẻ HTML khác
            $text = preg_replace('/[.,!?;:]/', '', $text); // Xóa dấu câu
            $text = preg_replace('/\s+/', ' ', $text); // Gom khoảng trắng
            return strtolower(trim($text)); // Về chữ thường.
        };

        $normalizedUserAnswer = $normalize($userAnswer);
        $normalizedCorrectAnswer = $normalize($question->content);

        $isCorrect = $normalizedUserAnswer === $normalizedCorrectAnswer;

        // Lưu vào session để hiển thị
        return redirect()->route('writing.show', ['index' => $index])
            ->with('result', $isCorrect)
            ->with('input_answer', $userAnswer);
    }

    public function checkAjax(Request $request)
    {
        $index = (int) $request->input('index');
        $userAnswer = $request->input('user_answer');

        $question = Question::where('topic_id', 2)->orderBy('id')->skip($index)->first();
        if (!$question) {
            return response()->json(['error' => 'Không tìm thấy câu hỏi'], 404);
        }

        $normalize = function ($text) {
            $text = strip_tags($text);
            $text = preg_replace('/[.,!?;:]/', '', $text);
            $text = preg_replace('/\s+/', ' ', $text);
            return strtolower(trim($text));
        };

        $normalizedUserAnswer = $normalize($userAnswer);
        $normalizedCorrectAnswer = $normalize($question->content);
        $isCorrect = $normalizedUserAnswer === $normalizedCorrectAnswer;

        return response()->json([
            'result' => $isCorrect,
            'input_answer' => $userAnswer,
        ]);
    }

    public function showStarred($index = 0)
    {
        $heading  = "KIỂM TRA ĐỌC GẮN DẤU SAO";
        // dd("ok");
        $user = Auth::user();

        // 1. Lấy list ID câu hỏi đã đánh dấu sao
        $starredIds = StarredQuestion::where('user_id', $user->id)->pluck('question_id');

        // 2. Lấy danh sách tất cả câu hỏi có topic_id = 2 và có ID đánh dấu sao.
        $questions = Question::where('topic_id', 2)
            ->whereIn('id', $starredIds)
            ->orderBy('id')
            ->get();

        // 3. Tổng số câu
        $total = $questions->count();
        if ($total == $index) {
            return view('star.result');
        }
        // 3. Giới hạn chỉ số index trong mảng.
        $index = max(0, min($index, $total - 1));
        // 4. Lấy ra 1 câu hỏi theo vị trí
        $question = $questions[$index];

        // 6. KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();

        // 5. Truyền dữ liệu xuống view
        return view('writing.show', [
            'question' => $question,
            'index' => $index,
            'total' => $total,
            'isStarred' => $isStarred,
            'routeName' => 'writing.starred',
            'mode' => 'showStarred',
        ]);
    }
}
