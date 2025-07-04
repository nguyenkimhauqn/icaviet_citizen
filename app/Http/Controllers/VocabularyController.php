<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use App\Models\VocabularyCategory;
use App\Models\VocabularyTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class VocabularyController extends Controller
{
    public function index()
    {
        return view('vocabulary.index');
    }

    public function show(Request $request, $slug = 'general')
    {
        $topicSlug =  $slug;
        $categorySlug = $request->query('category');

        // Lấy topic theo slug
        $topic = VocabularyTopic::where('slug', $topicSlug)->firstOrFail();

        // Lấy các categories theo topic
        $categories = $topic->categories()->orderBy('id')->get();

        // Nếu chưa có category cụ thể, lấy category đầu tiên theo topic
        if (!$categorySlug && $categories->count()) {
            $category = $categories->first();
        } else {
            $category = VocabularyCategory::where('slug', $categorySlug)->firstOrFail();
        }

        // Query vocabularies theo category
        $query = Vocabulary::where('category_id', $category->id);

        // Trường hợp đặc biệt: nếu là topic "general" và category là "12 tháng"
        if ($topic->slug === 'general' && $category->slug === '12-months') {
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

        // Group theo chữ cái đầu
        $vocabulariesGroupedByLetter = $vocabularies->groupBy(function ($vocab) {
            return strtoupper(Str::substr($vocab->word, 0, 1));
        });

        // 50-states chia 2 phần
        $isSplitStates = $category->slug === '50-states';

        return view('vocabulary.show', compact(
            'vocabulariesGroupedByLetter',
            'topicSlug',
            'categories',
            'category',
            'topic',
            'isSplitStates'
        ));
    }
}
