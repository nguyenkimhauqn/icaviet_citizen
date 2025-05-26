<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;

class ReadingController extends Controller
{
    public function show($index = 0)
    {
        // 1. Lấy danh sách tất cả câu hỏi có topic_id = 3 (Reading Test)
        $questions = Question::where('topic_id', 3)->orderBy('id')->get();
        // 2. Tổng số câu
        $total = $questions->count();
        // 3. Giới hạn chỉ số index trong mảng.
        $index = max(0, min($index, $total - 1));
        // 4. Lấy ra 1 câu hỏi theo vị trí
        $question = $questions[$index];
        // 5. Truyền dữ liệu xuống view
        return view('reading.show', [
            'question' => $question,
            'index' => $index,
            'total' => $total,
        ]);
    }
}
