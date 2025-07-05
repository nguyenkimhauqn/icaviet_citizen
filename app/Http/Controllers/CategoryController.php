<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $enabled = session()->get('enabled_category');

        $categories = Category::withCount('questions')
            ->when($enabled != 7, function ($query) {
                $query->where('id', '!=', 7);
            })
            ->get();

        return view('n400.category', compact('categories'));
    }

    public function starred()
    {
        $enabled = session()->get('enabled_category');

        $categories = Category::withCount('questions')
            ->when($enabled != 7, function ($query) {
                $query->where('id', '!=', 7);
            })
            ->get();
        
        return view('n400.category_starred', compact('categories'));
    }


    public function show($id, $index = 0)
    {
        $category = Category::with(['questions' => function ($query) {
            $query->with(['answers' => function ($subQuery) {
                $subQuery->where('is_correct', true);
            }]);
        }])->findOrFail($id);

        $questions = $category->questions;
        $total = $questions->count();

        if ($total === 0) {
            abort(404, 'Không có câu hỏi trong chuyên mục này.');
        }

        $index = $index % $total;
        $question = $questions[$index];
        $answer = $question->answers->first()->content ?? '';
        // dd($question->user_id);
        return view('n400.show', compact('category', 'question', 'answer', 'index', 'total'));
    }

    public function prevCategory($id)
    {
        $prev = Category::where('id', '<', $id)->orderBy('id', 'desc')->first();
        return $prev
            ? redirect()->route('n400.category.show', ['id' => $prev->id, 'index' => 0])
            : redirect()->route('n400.category.show', ['id' => $id, 'index' => 0]);
    }

    public function nextCategory($id)
    {
        $next = Category::where('id', '>', $id)->orderBy('id')->first();
        return $next
            ? redirect()->route('n400.category.show', ['id' => $next->id, 'index' => 0])
            : redirect()->route('n400.category.show', ['id' => $id, 'index' => 0]);
    }

    public function updateAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|integer|exists:questions,id',
            'content' => 'required|string|max:1000',
        ]);

        $answer = Answer::where('question_id', $request->question_id)
            ->where('is_correct', true)
            ->first();

        if (!$answer) {
            return response()->json(['success' => false, 'message' => 'Answer not found'], 404);
        }

        $answer->content = $request->content;
        $answer->save();

        return response()->json(['success' => true, 'message' => 'Answer updated successfully']);
    }

    public function storeQuestion(Request $request)
    {
        // doing
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:1000',
            'answer' => 'required|string|max:1000',
        ]);

        $question = Question::create([
            'category_id' => $request->category_id,
            'topic_id' => 4, // mặc định
            'user_id' => auth()->id(),
            'content' => $request->question,
            'audio_path' => null,

        ]);

        $answer = Answer::create([
            'question_id' => $question->id,
            'content' => $request->answer,
            'is_correct' => true,
            'audio_path' => null,
        ]);

        $index = Question::where('category_id', $request->category_id)->count() - 1;

        return response()->json([
            'success' => true,
            'redirect_to' => $request->source === 'detail' ? route('n400.category.show', ['id' => $request->category_id]) : route('n400.categories.index')
        ]);
    }

    public function updateQuestion(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'content' => 'required|string|max:1000',
        ]);

        $question = Question::where('id', $request->question_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $question->content = $request->content;
        $question->save();

        return response()->json(['success' => true]);
    }

    public function deleteQuestion($id)
    {
        $question = Question::with('category')->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $categoryId = $question->category_id;
        // Xóa câu trả lời
        $question->answers()->delete();
        // Lưu lại Id câu hỏi hiện tại
        $currentId = $question->id;
        // Xóa câu trả lời
        $question->delete();

        // Tìm lại danh sách câu hỏi trong chuyên mục, sắp xếp theo thứ tự thêm vào
        $remainingQuestions = Question::where('category_id', $categoryId)
            ->orderBy('id')
            ->get();

        $redirectTo = route('n400.categories.index'); // fallback mặc định

        if ($remainingQuestions->count() > 0) {
            // tìm vị trí index cũa câu gần nhất trước đó
            $targetIndex = 0;
            foreach ($remainingQuestions as $i => $q) {
                if ($q->id > $currentId) {
                    $targetIndex = max(0, $i - 1);
                    break;
                } elseif ($i === $remainingQuestions->count() - 1) {
                    $targetIndex = $i;
                }
            }

            $redirectTo = route('n400.category.show', [
                'id' => $categoryId,
                'index' => $targetIndex,
            ]);
        }

        return response()->json([
            'success' => true,
            'redirect_to' => $redirectTo,
        ]);
    }
}
