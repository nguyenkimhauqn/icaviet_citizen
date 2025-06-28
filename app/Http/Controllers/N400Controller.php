<?php

namespace App\Http\Controllers;

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

        $totalQuestions = Question::where('category_id', $id)->count();

        if ($page > $totalQuestions) {
            return view('n400.completed');
        }

        $question = Question::where('category_id', $id)
            ->with('answers')
            ->orderBy('id')
            ->skip($page - 1)
            ->take(1)
            ->first();

        return view('n400.show', [
            'category' => $category,
            'question' => $question,
            'page' => $page,
            'total' => $totalQuestions
        ]);
    }
}
