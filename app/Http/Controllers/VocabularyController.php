<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use App\Models\VocabularyCategory;
use App\Models\VocabularyTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        $search = $request->query('search');
        // Query vocabularies theo category
        $query = Vocabulary::where('category_id', $category->id)
            ->where(function ($q) {
                $q->whereNull('user_id')
                    ->orWhere('user_id', auth()->id());
            });
        // Filter từ vựng
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('word', 'LIKE', "%{$search}%")
                    ->orWhere('meaning', 'LIKE', "%{$search}%")
                    ->orWhere('synonymous', 'LIKE', "%{$search}%")
                    ->orWhere('synonymous_translate', 'LIKE', "%{$search}%");
            });
        }

        // Trường hợp đặc biệt: nếu là topic "general" và category là "12 tháng"
        if ($topic->slug === 'general') {
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

    public function store(Request $request)
    {

        $validated = $request->validate([
            'vocab_id' => 'nullable|exists:vocabularies,id',
            'word' => 'required|string|max:255',
            'hint' => 'nullable|string',
            'synonymous' => 'nullable|string',
            'meaning' => 'nullable|string',
        ]);

        $category = VocabularyCategory::where('slug', 'define')->firstOrFail();



        if (!empty($validated['vocab_id'])) {
            // Cập nhật từ vựng
            $vocab = Vocabulary::where('id', $validated['vocab_id'])
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $vocab->update([
                'word' => $validated['word'],
                'hint' => $validated['hint'],
                'synonymous' => $validated['synonymous'],
                'meaning' => $validated['meaning'],
            ]);

            return redirect()->back()->with('success', 'Cập nhật từ vựng thành công!');
        }

        // Thêm mới từ vựng
        Vocabulary::create([
            'word' => $validated['word'],
            'hint' => $validated['hint'],
            'synonymous' => $validated['synonymous'],
            'meaning' => $validated['meaning'],
            'category_id' => $category->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Thêm từ vựng thành công!');
    }
}
