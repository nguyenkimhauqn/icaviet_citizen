<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    public function index()
    {
        return view('study.index');
    }

    public function show($type)
    {
        $data = [
            'guild' => [
                'title' => 'Hướng dẫn thi',
                'materials' => [
                    [
                        'title' => 'Mô phỏng phần thi Đọc và Viết',
                        'subtitle' => '(Bật phụ đề dịch tiếng Việt tự động)',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtu.be/MlQo8dwr3kA?si=GBo7yXIIycsCj-Rw',
                    ],
                    [
                        'title' => 'Mô phỏng phần thi N-400',
                        'subtitle' => '(Bật phụ đề dịch tiếng Việt tự động)',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtu.be/mS8s8JFUhVw?si=FavPswl4PChTh9xY',
                    ],
                    [
                        'title' => 'Mô phỏng phần thi Civics',
                        'subtitle' => '(Bật phụ đề dịch tiếng Việt tự động)',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtu.be/cV8IcSsd3Zw?si=nmZsAsvNXf0yVLlf',
                    ],
                    [
                        'title' => 'Video hướng dẫn chung',
                        'subtitle' => '(Bật phụ đề dịch tiếng Việt tự động)',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtu.be/MHjOVa6HGHI?si=4edhubgKv4F3I-W7',
                    ],
                    [
                        'title' => 'Quy trình nhập quốc tịch Mỹ',
                        'subtitle' => '(tiếng Việt)',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtu.be/8x57Qb0Xjqg?si=M3tbm0jx0HBQ9BNX',
                    ],
                    [
                        'title' => 'Hướng dẫn sử dụng máy tính bảng khi thi quốc tịch',
                        'subtitle' => '(Bật phụ đề dịch tiếng Việt tự động)',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtu.be/mDl34qTl8jE?si=Rn24mPGPS3mvnEnF',
                    ],
                ]
            ],

            'civics' => [
                'title' => 'Tài liệu Civics (Công dân)',
                'materials' => [
                    [
                        'type' => 'video',
                        'title' => 'Luyện nghe 100 câu Civics',
                        'subtitle' => null,
                        'icon' => 'icon-video-thumbnail.svg',
                        'thumbnail' => 'public/image/study/video-thumbnail.png',
                        'link' => 'https://youtube.com/playlist?list=PLpNZsaiyFfG0mZUx6aS8Tn2pANNymRDaJ&si=YbDXtT7iXCdXzgtG',
                    ],
                    [
                        'type' => 'document',
                        'title' => '100 câu Civics',
                        'subtitle' => '(Tiếng Anh)',
                        'icon' => 'icon-civics.svg',
                        'thumbnail' => 'public/image/study/civics-thumbnail.png',
                        'link' => 'https://www.uscis.gov/sites/default/files/document/questions-and-answers/100q.pdf',
                    ],
                    [
                        'type' => 'document',
                        'title' => '100 câu Civics',
                        'subtitle' => '(Tiếng Việt)',
                        'icon' => 'icon-civics.svg',
                        'thumbnail' => 'public/image/study/civics-thumbnail.png',
                        'link' => 'https://www.uscis.gov/sites/default/files/document/guides/OoC_62_100%20Civics%20Questions%20%28Vietnamese%29_508c.pdf',
                    ],
                ]
            ],

            'reading-writing' => [
                'title' => 'Tài liệu Reading (Đọc) và Writing (Viết)',
                'materials' => [
                    [
                        'type' => 'document',
                        'title' => 'List từ vựng Đọc',
                        'subtitle' => null,
                        'icon' => 'icon-civics.svg',
                        'thumbnail' => 'public/image/study/civics-thumbnail.png',
                        'link' => 'https://www.uscis.gov/sites/default/files/document/guides/reading_vocab.pdf',
                    ],
                    [
                        'type' => 'document',
                        'title' => 'List từ vựng Viết',
                        'subtitle' => null,
                        'icon' => 'icon-civics.svg',
                        'thumbnail' => 'public/image/study/civics-thumbnail.png',
                        'link' => 'https://www.uscis.gov/sites/default/files/document/guides/writing_vocab.pdf',
                    ],
                ],
            ],
        ];

        if (!isset($data[$type])) {
            return redirect()->back()->with('error', 'Không tìm thấy dữ liệu phù hợp.');
        }

        $section = $data[$type];

        return view('study.show', compact('section'));
    }
}
