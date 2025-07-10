<?php

namespace App\Http\Controllers;

use App\Models\UserQuestion;
use App\Models\UserQuestionComment;
use Illuminate\Http\Request;

class UserQuestionCommentController extends Controller
{
    public function store(Request $request, $id)
    {
        // xử lý lưu comment
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        // Kiểm tra nếu user vừa comment trong 30 giây trước
        $latest = UserQuestionComment::where('user_id', auth()->id())
            ->where('user_question_id', $id)
            ->latest()
            ->first();

        if ($latest && $latest->created_at->diffInSeconds(now()) < 30) {
            return back()->withErrors(['content' => 'Bạn đang gửi bình luận quá nhanh. Vui lòng thử lại sau.']);
        }

        $question = UserQuestion::findOrFail($id);

        UserQuestionComment::create([
            'user_question_id' => $question->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('sharing.show', $question->slug)->with('success', 'Bình luận đã được gửi.');
    }
}
