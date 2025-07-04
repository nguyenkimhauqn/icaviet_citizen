<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    public function index()
    {
        return view('vocabulary.index');
    }

    public function show()
    {
        $vocabulariesGroupedByLetter = [
            'A' => [
                (object)[
                    'word' => 'Advise',
                    'meaning' => 'khuyên',
                    'hint' => 'ợt-vai-(s)',
                    'example' => 'The Cabinet advises the President.'
                ],
                (object)[
                    'word' => 'Amendment',
                    'meaning' => 'Tu chính án, một phần sửa đổi, bổ sung',
                    'hint' => 'ờ-men-mân-(t)',
                    'example' => 'An amendment is a change.'
                ],
            ],
            'B' => [
                (object)[
                    'word' => 'Ballot',
                    'meaning' => 'Lá phiếu',
                    'hint' => null,
                    'example' => 'The voters cast their ballot.'
                ]
            ],
            'C' => [
                (object)[
                    'word' => 'Citizen',
                    'meaning' => 'Công dân',
                    'hint' => 'si-ti-zần',
                    'example' => 'Every citizen has rights.'
                ]
            ],
        ];
        return view('vocabulary.show', compact('vocabulariesGroupedByLetter'));
    }
}
