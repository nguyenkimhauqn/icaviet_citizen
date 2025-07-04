<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use App\Models\VocabularyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VocabularyController extends Controller
{
    public function index()
    {
        return view('vocabulary.index');
    }

    public function show(Request $request)
    {

        // Danh sách tất cả categories thuộc topic "Từ vựng chung"
        $categories = VocabularyCategory::whereHas('topic', function ($q) {
            $q->where('name', 'Từ vựng chung');
        })->orderBy('id')->get();

        $slug = $request->query('category', 'general');
        $category = VocabularyCategory::where('slug', $slug)->firstOrFail();

        $query = Vocabulary::where('category_id', $category->id);

        // Nếu là category "12 tháng" thì order theo đúng thứ tự tháng
        if ($category->slug === '12-months') {
            $monthOrder = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December',
            ];

            $query->orderByRaw("FIELD(word, '" . implode("','", $monthOrder) . "')");
        } else {
            $query->orderBy('word');
        }

        $vocabularies = $query->get();

        // Group theo ký tự đầu tiên
        $vocabulariesGroupedByLetter = $vocabularies->groupBy(function ($vocab) {
            return strtoupper(Str::substr($vocab->word, 0, 1));
        });

        return view('vocabulary.show', compact('vocabulariesGroupedByLetter', 'categories', 'category'));
    }
}
