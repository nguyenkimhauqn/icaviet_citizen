<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class N400Controller extends Controller
{
    public function show($id, Request $request)
    {
        $page = intval($request->query('page', 1));
        if ($page < 1) $page = 1;

        $category = Category::findOrFail($id);

        // Lấy tổng số câu hỏi trong category hiện tại
        $totalQuestions = Question::where('category_id', $id)->count();

        // Nếu quá số câu hỏi trong category
        if ($page > $totalQuestions) {
            return view('n400.completed');
        }

        // Lấy câu hỏi hiện tại
        $question = Question::where('category_id', $id)
            ->with('answers')
            ->orderBy('id')
            ->skip($page - 1)
            ->take(1)
            ->first();

        // Nếu có submit câu trả lời trước (dùng GET hoặc session), xử lý skip
        if ($request->has('answer_id')) {
            $answerId = $request->query('answer_id');
            $answer = Answer::find($answerId);

            if ($answer) {

                // Nếu skip_to_category là -1 → completed
                if ($answer->skip_to_category == -1) {
                    return view('n400.completed');
                }

                // Nếu enabled_category (7) thì lưu id enabled_category vào session
                if ($answer->enabled_category == -1) { // reset
                    session()->forget('enabled_category');
                }

                // Nếu có enabled_category > 0 → ghi vào session
                elseif ($answer->enabled_category) {
                    session()->put('enabled_category', $answer->enabled_category);
                }

                // Nếu có skip_to_category → chuyển category
                if ($answer->skip_to_category) {
                    $targetCategory = $answer->skip_to_category;
                    $targetPage = $answer->skip_to_question ?: 1;

                    return redirect()->route('n400.category.show', [
                        'id' => $targetCategory,
                        'page' => $targetPage
                    ]);
                }

                // Nếu chỉ có skip_to_question → ở lại category, chuyển câu hỏi
                if ($answer->skip_to_question) {
                    return redirect()->route('n400.category.show', [
                        'id' => $id,
                        'page' => $answer->skip_to_question
                    ]);
                }
            }

            // Nếu không có skip → tiếp tục bình thường (tăng page)
            return redirect()->route('n400.category.show', [
                'id' => $id,
                'page' => $page + 1
            ]);
        }

        return view('n400.show', [
            'category' => $category,
            'question' => $question,
            'page' => $page,
            'total' => $totalQuestions
        ]);
    }
}
