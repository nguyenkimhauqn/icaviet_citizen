<?php

namespace App\Http\Controllers;

use App\Models\UserQuestion;
use App\Models\QuestionTag;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

use Illuminate\Http\Request;

class UserQuestionController extends Controller
{
    public function index(Request $request)
    {
        // sẽ xử lý hiển thị danh sách
        $query = UserQuestion::with('user', 'tags');

        // Tìm kiếm theo từ khóa
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('content', 'like', "%$search%");
            });
        }

        // Lọc theo tag
        if ($tag = $request->input('tag')) {
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('name', $tag);
            });
        }

        $questions = $query->latest()->paginate(10)->withQueryString();
        $allTags = QuestionTag::all();

        return view('sharing.index', compact('questions', 'allTags', 'search', 'tag'));
    }

    public function create()
    {
        // form tạo mới
        $tags = QuestionTag::all();
        return view('sharing.create', compact('tags'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // lưu dữ liệu
        $request->validate([
            // 'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'array',
            // 'tags.*' => 'exists:question_tags,id'
        ]);

        $question = UserQuestion::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'content' => $request->content,
        ]);

        $question->tags()->attach($request->tags);

        return redirect()->route('sharing.index')->with('success', 'Bài viết đã được đăng.');
    }

    public function show($slug)
    {
        // chi tiết bài viết
        $question = UserQuestion::with(['user', 'tags', 'comments.user'])->where('slug', $slug)->firstOrFail();
        return view('sharing.show', compact('question'));
    }
}
