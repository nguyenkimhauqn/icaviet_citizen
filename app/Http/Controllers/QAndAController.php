<?php

namespace App\Http\Controllers;

use App\Models\QaCategory;
use Illuminate\Http\Request;

class QAndAController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'normal_question'); // mặc định là "câu hỏi thi quốc tịch"

        $isApp = $type === 'app_question';

        $categories = QaCategory::with('items')
            ->where('is_app_question', $isApp)
            ->get();

        return view('q-and-a.index', compact('categories', 'type'));
    }

    public function showForm(Request $request)
    {
        return view('q-and-a.form');
    }
}
