<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use App\Models\StarredQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class N400Controller extends Controller
{
    // public function show($id, Request $request)
    // {
    //     $page = intval($request->query('page', 1));
    //     if ($page < 1) $page = 1;

    //     $category = Category::findOrFail($id);

    //     // Lấy tổng số câu hỏi trong category hiện tại
    //     $totalQuestions = Question::where('category_id', $id)->count();

    //     // Nếu quá số câu hỏi trong category
    //     if ($page > $totalQuestions) {
    //         return view('n400.completed');
    //     }

    //     // Lấy câu hỏi hiện tại
    //     $question = Question::where('category_id', $id)
    //         ->with('answers')
    //         ->orderBy('id')
    //         ->skip($page - 1)
    //         ->take(1)
    //         ->first();

    //     // Nếu có submit câu trả lời trước (dùng GET hoặc session), xử lý skip
    //     if ($request->has('answer_id')) {
    //         $answerId = $request->query('answer_id');
    //         $answer = Answer::find($answerId);

    //         if ($answer) {

    //             // Nếu skip_to_category là -1 → completed
    //             if ($answer->skip_to_category == -1) {
    //                 return view('n400.completed');
    //             }

    //             // Nếu enabled_category (7) thì lưu id enabled_category vào session
    //             if ($answer->enabled_category == -1) { // reset
    //                 session()->forget('enabled_category');
    //             }

    //             // Nếu có enabled_category > 0 → ghi vào session
    //             elseif ($answer->enabled_category) {
    //                 session()->put('enabled_category', $answer->enabled_category);
    //             }

    //             // Nếu có skip_to_category → chuyển category
    //             if ($answer->skip_to_category) {
    //                 $targetCategory = $answer->skip_to_category;
    //                 $targetPage = $answer->skip_to_question ?: 1;

    //                 return redirect()->route('n400.category.show', [
    //                     'id' => $targetCategory,
    //                     'page' => $targetPage
    //                 ]);
    //             }

    //             // Nếu chỉ có skip_to_question → ở lại category, chuyển câu hỏi
    //             if ($answer->skip_to_question) {
    //                 return redirect()->route('n400.category.show', [
    //                     'id' => $id,
    //                     'page' => $answer->skip_to_question
    //                 ]);
    //             }
    //         }

    //         // Nếu không có skip → tiếp tục bình thường (tăng page)
    //         return redirect()->route('n400.category.show', [
    //             'id' => $id,
    //             'page' => $page + 1
    //         ]);
    //     }

    //     return view('n400.show', [
    //         'category' => $category,
    //         'question' => $question,
    //         'page' => $page,
    //         'total' => $totalQuestions
    //     ]);
    // }

    public function show($id, Request $request)
    {
        // dd("ok");
        $user = Auth::user();
        $page = intval($request->query('page', 1));
        if ($page < 1) $page = 1;

        // Nếu đang cố vào category 7 mà không có session → skip qua category 8
        if ((int)$id === 7 && !session()->has('enabled_category')) {
            return redirect()->route('n400.category.show', [
                'id' => 8,
                'page' => 1
            ]);
        }

        $category = Category::findOrFail($id);

        // Tổng số câu hỏi trong category hiện tại
        $totalQuestions = Question::where('category_id', $id)->count();

        // Hết câu hỏi → sang category kế tiếp
        if ($page > $totalQuestions) {
            $nextCategory = Category::where('id', '>', $id)->orderBy('id')->first();

            if ($nextCategory) {
                // Nếu category tiếp theo là 7 (6b) mà không có session thì skip
                if ($nextCategory->id === 7 && !session()->has('enabled_category')) {
                    return redirect()->route('n400.category.show', [
                        'id' => 8,
                        'page' => 1
                    ]);
                }

                return redirect()->route('n400.category.show', [
                    'id' => $nextCategory->id,
                    'page' => 1
                ]);
            }

            return view('n400.completed');
        }

        // Lấy câu hỏi hiện tại
        // $question = Question::where('category_id', $id)
        //     ->with('answers')
        //     ->orderBy('id')
        //     ->skip($page - 1)
        //     ->take(1)
        //     ->first();
        $question = Question::where('category_id', $id)
            ->with('answers')
            ->where(function ($query) {
                $userId = auth()->id();
                $query->whereNull('user_id')
                    ->orWhere('user_id', $userId);
            })
            ->orderBy('id')
            ->skip($page - 1)
            ->take(1)
            ->first();

        // Nếu là câu hỏi dạng text và có giá trị gửi lên (answer_text)
        if ($question && $question->type === 'text' && $request->has('answer_text')) {
            $answerText = trim($request->query('answer_text'));
            $numericValue = is_numeric($answerText) ? intval($answerText) : null;

            // Nếu nhập 0 → xử lý skip
            if ($numericValue === 0) {
                if ($question->skip_to_category == -1) {
                    $nextCategory = Category::where('id', '>', $id)->orderBy('id')->first();

                    if ($nextCategory) {
                        if ($nextCategory->id === 7 && !session()->has('enabled_category')) {
                            return redirect()->route('n400.category.show', ['id' => 8, 'page' => 1]);
                        }

                        return redirect()->route('n400.category.show', ['id' => $nextCategory->id, 'page' => 1]);
                    }

                    return view('n400.completed');
                }

                if ($question->skip_to_category) {
                    return redirect()->route('n400.category.show', [
                        'id' => $question->skip_to_category,
                        'page' => $question->skip_to_question ?: 1
                    ]);
                }

                if ($question->skip_to_question) {
                    return redirect()->route('n400.category.show', [
                        'id' => $id,
                        'page' => $question->skip_to_question
                    ]);
                }
            }

            // Nếu nhập khác 0 → sang câu tiếp theo
            return redirect()->route('n400.category.show', [
                'id' => $id,
                'page' => $page + 1
            ]);
        }

        // Xử lý logic nếu có answer_id truyền lên (kèm logic skip)
        if ($request->has('answer_id')) {
            $answer = Answer::find($request->query('answer_id'));

            if ($answer) {
                // Nếu yêu cầu reset session
                if ($answer->enabled_category == -1) {
                    session()->forget('enabled_category');
                } elseif ($answer->enabled_category) {
                    session()->put('enabled_category', $answer->enabled_category);
                }

                // Nếu skip = -1 → chuyển đến category tiếp theo
                if ($answer->skip_to_category == -1) {
                    $nextCategory = Category::where('id', '>', $id)->orderBy('id')->first();

                    if ($nextCategory) {
                        if ($nextCategory->id === 7 && !session()->has('enabled_category')) {
                            return redirect()->route('n400.category.show', [
                                'id' => 8,
                                'page' => 1
                            ]);
                        }

                        return redirect()->route('n400.category.show', [
                            'id' => $nextCategory->id,
                            'page' => 1
                        ]);
                    }

                    return view('n400.completed');
                }

                // Nếu có skip cụ thể
                if ($answer->skip_to_category) {
                    return redirect()->route('n400.category.show', [
                        'id' => $answer->skip_to_category,
                        'page' => $answer->skip_to_question ?: 1
                    ]);
                }

                // Nếu có skip câu
                if ($answer->skip_to_question) {
                    return redirect()->route('n400.category.show', [
                        'id' => $id,
                        'page' => $answer->skip_to_question
                    ]);
                }
            }

            // Không có skip → câu tiếp theo
            return redirect()->route('n400.category.show', [
                'id' => $id,
                'page' => $page + 1
            ]);
        }

        // KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();

        return view('n400.show', [
            'category' => $category,
            'question' => $question,
            'page' => $page,
            'total' => $totalQuestions,
            'isStarred' => $isStarred,
        ]);
    }

    public function showStarred($id, Request $request)
    {
        // dd("ok");
        $user = Auth::user();
        $userId = $user->id;

        $category = Category::findOrFail($id);
        // Lấy danh sách ID các câu hỏi đã sao trong category hiện tại

        $starredQuestionIds = StarredQuestion::where('user_id', $userId)
            ->whereHas('question', function ($query) use ($id) {
                $query->where('category_id', $id);
            })
            ->pluck('question_id');

        $page = intval($request->query('page', 1));
        if ($page < 1) $page = 1;

        // Nếu đang cố vào category 7 mà không có session → skip qua category 8
        if ((int)$id === 7 && !session()->has('enabled_category')) {
            return redirect()->route('n400.category.starred', [
                'id' => 8,
                'page' => 1
            ]);
        }

        // Tổng số câu hỏi trong category hiện tại
        $totalQuestions = $starredQuestionIds->count();

        if ($starredQuestionIds->isEmpty()) {
            // Không có câu hỏi nào → quay lại trang trước và hiển thị thông báo
            return redirect()->back()->with('error', 'Không có câu hỏi gắn sao nào trong chuyên mục này.');
        }
        // Hết câu hỏi → sang category kế tiếp
        if ($page > $totalQuestions) {
            return view('n400.completed_starred');
            // Bỏ sau 
            $nextCategory = Category::where('id', '>', $id)->orderBy('id')->first();
            if ($nextCategory) {
                // dump("ok-1");

                // Nếu category tiếp theo là 7 (6b) mà không có session thì skip
                if ($nextCategory->id === 7 && !session()->has('enabled_category')) {
                    return redirect()->route('n400.category.starred', [
                        'id' => 8,
                        'page' => 1
                    ]);
                }

                // dd("ok");
                return redirect()->route('n400.category.starred', [
                    'id' => $nextCategory->id,
                    'page' => 1
                ]);
            }
            // dd("ok-2");
            return view('n400.completed_starred');
        }

        // HauNguyen edit QUERY


        $question = Question::where('category_id', $id)
            ->with('answers')
            ->where(function ($query) use ($userId) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', $userId);
            })
            ->whereIn('id', $starredQuestionIds)
            ->orderBy('id')
            ->skip($page - 1)
            ->take(1)
            ->first();

        // Nếu hết câu hỏi thì về danh mục lớn

        // HauNguyen edit QUERY

        // Nếu là câu hỏi dạng text và có giá trị gửi lên (answer_text)
        if ($question && $question->type === 'text' && $request->has('answer_text')) {
            $answerText = trim($request->query('answer_text'));
            $numericValue = is_numeric($answerText) ? intval($answerText) : null;

            // Nếu nhập 0 → xử lý skip
            if ($numericValue === 0) {
                if ($question->skip_to_category == -1) {
                    $nextCategory = Category::where('id', '>', $id)->orderBy('id')->first();

                    if ($nextCategory) {
                        if ($nextCategory->id === 7 && !session()->has('enabled_category')) {
                            return redirect()->route('n400.category.starred', ['id' => 8, 'page' => 1]);
                        }

                        return redirect()->route('n400.category.starred', ['id' => $nextCategory->id, 'page' => 1]);
                    }

                    return view('n400.completed_starred');
                }

                if ($question->skip_to_category) {
                    return redirect()->route('n400.category.starred', [
                        'id' => $question->skip_to_category,
                        'page' => $question->skip_to_question ?: 1
                    ]);
                }

                if ($question->skip_to_question) {
                    return redirect()->route('n400.category.starred', [
                        'id' => $id,
                        'page' => $question->skip_to_question
                    ]);
                }
            }

            // Nếu nhập khác 0 → sang câu tiếp theo
            return redirect()->route('n400.category.starred', [
                'id' => $id,
                'page' => $page + 1
            ]);
        }

        // Xử lý logic nếu có answer_id truyền lên (kèm logic skip)
        if ($request->has('answer_id')) {
            $answer = Answer::find($request->query('answer_id'));

            if ($answer) {
                // Nếu yêu cầu reset session
                if ($answer->enabled_category == -1) {
                    session()->forget('enabled_category');
                } elseif ($answer->enabled_category) {
                    session()->put('enabled_category', $answer->enabled_category);
                }

                // Nếu skip = -1 → chuyển đến category tiếp theo
                if ($answer->skip_to_category == -1) {
                    $nextCategory = Category::where('id', '>', $id)->orderBy('id')->first();

                    if ($nextCategory) {
                        if ($nextCategory->id === 7 && !session()->has('enabled_category')) {
                            return redirect()->route('n400.category.starred', [
                                'id' => 8,
                                'page' => 1
                            ]);
                        }

                        return redirect()->route('n400.category.starred', [
                            'id' => $nextCategory->id,
                            'page' => 1
                        ]);
                    }

                    return view('n400.completed_starred');
                }

                // Nếu có skip cụ thể
                if ($answer->skip_to_category) {
                    return redirect()->route('n400.category.starred', [
                        'id' => $answer->skip_to_category,
                        'page' => $answer->skip_to_question ?: 1
                    ]);
                }

                // Nếu có skip câu
                if ($answer->skip_to_question) {
                    return redirect()->route('n400.category.starred', [
                        'id' => $id,
                        'page' => $answer->skip_to_question
                    ]);
                }
            }

            // Không có skip → câu tiếp theo
            return redirect()->route('n400.category.starred', [
                'id' => $id,
                'page' => $page + 1
            ]);
        }

        // KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();

        return view('n400.starred', [
            'category' => $category,
            'question' => $question,
            'page' => $page,
            'total' => $totalQuestions,
            'isStarred' => $isStarred,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'default_answers' => 'required|string',
        ]);

        Question::create([
            'category_id' => $request->input('category_id'),
            'content' => $request->input('content'),
            'default_answers' => $request->input('default_answers'),
            'type' => 'text',
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Đã thêm câu hỏi mới!');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        // if ($question->user_id !== auth()->id()) {
        //     abort(403);
        // }

        $question->delete();

        return redirect()->route('n400.categories.index')->with('success', 'Đã xóa câu hỏi!');
    }
}
