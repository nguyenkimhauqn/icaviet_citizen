<?php

namespace App\Http\Controllers;

use App\Mail\QAMessage;
use App\Models\QaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        // TODO: replace email
        Mail::to('abc@gmail.com')->send(new QAMessage($validated, $request->file('attachment')));

        return redirect()->route('qa.thankyou');
    }
}
