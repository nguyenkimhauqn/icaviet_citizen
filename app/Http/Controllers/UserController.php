<?php

namespace App\Http\Controllers;

use App\Models\StarredQuestion;
use App\Models\UserAnswerQuestion;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\PracticeLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Hiển thị trang thông tin người dùng
    public function show()
    {
        $user = Auth::user(); // Lấy thông tin user đang đăng nhập
        return view('user.profile', compact('user'));
    }

    // Xử lý xóa dữ liệu đã học
    public function deleteLearnedData(Request $request)
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            // 1. Xóa Starred Questions
            StarredQuestion::where('user_id', $user->id)->delete();

            // 2. Xóa User Answered Questions
            UserAnswerQuestion::where('user_id', $user->id)->delete();

            // 3. Xóa Quiz và Quiz Questions liên quan
            $quizIds = Quiz::where('user_id', $user->id)->pluck('id');
            QuizQuestion::whereIn('quiz_id', $quizIds)->delete();
            Quiz::whereIn('id', $quizIds)->delete();

            // 4. Xóa Practice Logs
            PracticeLog::where('user_id', $user->id)->delete();
        });

        return redirect()->route('user.profile')->with('success','Đã xóa toàn bộ dữ liệu đã học');
    }
}
