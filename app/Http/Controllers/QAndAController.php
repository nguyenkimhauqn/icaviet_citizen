<?php

namespace App\Http\Controllers;

use App\Models\QaCategory;
use Illuminate\Http\Request;

class QAndAController extends Controller
{
    public function index()
    {
        $categories = QaCategory::with('items')->get();
        return view('q-and-a.index', compact('categories'));
    }
}
