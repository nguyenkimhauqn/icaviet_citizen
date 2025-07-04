<?php

namespace Database\Seeders;

use App\Models\QaCategory;
use App\Models\QaItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Điều kiện thi quốc tịch' => [
                [
                    'question' => 'Thi quốc tịch mà không biết tiếng Anh thì sao?',
                    'answer' => trim(<<<TEXT
Một trong các yêu cầu thi quốc tịch là bạn phải hiểu tiếng Anh cơ bản và có kiến thức về lịch sử, chính phủ Mỹ. Trong một số trường hợp, nếu đủ tuổi và thời gian cư trú theo quy định, bạn có thể xin thi quốc tịch bằng tiếng Việt.

Dù vậy, đã có nhiều cô chú không biết tiếng Anh nhưng vẫn vượt qua kỳ thi quốc tịch bằng tiếng Anh nhờ kiên trì luyện tập mỗi ngày.

Ngoài ra, app Luyện thi quốc tịch của ICAVIET được thiết kế mô phỏng gần với kỳ thi thật, có tiếng Việt hỗ trợ, phát âm dễ nhớ và nhiều chức năng khác giúp bạn tiến bộ từng bước.
TEXT)
                ],
                [
                    'question' => 'Thi bao nhiêu điểm mới đậu quốc tịch?',
                    'answer' => trim(<<<TEXT
Để vượt qua phần thi quốc tịch, bạn cần:
- Phần thi Civics (Công dân): trả lời đúng 6/10 câu hỏi.
- Phần thi Reading (Đọc): đọc đúng 1 câu được yêu cầu, không ngắt quãng quá lâu và viên chức hiểu được nội dung. Có 3 cơ hội để làm phần thi.
- Phần thi Writing (Viết): viết đúng 1 câu được yêu cầu và không làm sai nghĩa của câu. Có 3 cơ hội để làm phần thi.
- Phần thi Speaking (N-400): hiểu và trả lời được các câu hỏi của viên chức liên quan đến Form N-400 và điều kiện thi quốc tịch.
TEXT)
                ],
                [
                    'question' => 'Khi nào được thi quốc tịch Mỹ sau 3 năm?',
                    'answer' => trim(<<<TEXT
Khi bạn là vợ/chồng của công dân Mỹ, bạn có thể nộp đơn thi quốc tịch sau 3 năm nếu:
- Hai vợ chồng sống chung trong 3 năm trước ngày nộp đơn
- Người vợ/chồng là công dân Mỹ trong suốt 3 năm đó
- Bạn có mặt thực tế tại Mỹ ít nhất 18 tháng trong 3 năm là thường trú nhân ở Mỹ
- Bạn không rời khỏi Mỹ quá 6 tháng liên tục
- Bạn cư trú tại tiểu bang/khu vực nơi nộp đơn ít nhất 3 tháng
- Bạn có tư cách đạo đức tốt, không có án tích nghiêm trọng, khai thuế đầy đủ,...
TEXT)
                ],
                [
                    'question' => 'Khi nào được thi quốc tịch Mỹ sau 5 năm?',
                    'answer' => trim(<<<TEXT
Bạn có thể nộp đơn thi quốc tịch sau 5 năm nếu:
- Bạn có mặt thực tế tại Mỹ ít nhất 30 tháng trong 5 năm là thường trú nhân ở Mỹ
- Bạn không rời khỏi Mỹ quá 6 tháng liên tục
- Bạn cư trú tại tiểu bang/khu vực nơi nộp đơn ít nhất 3 tháng
- Bạn có tư cách đạo đức tốt, không có án tích nghiêm trọng, khai thuế đầy đủ,...
TEXT)
                ],
            ],
            'Sau khi thi quốc tịch' => [
                ['question' => 'Sau khi thi quốc tịch, bao lâu có kết quả?', 'answer' => null],
                ['question' => 'Thi quốc tịch lần đầu không đậu, bao lâu có thể thi lại?', 'answer' => null],
                ['question' => 'Thi quốc tịch lần hai không đậu, có thể thi lại không?', 'answer' => null],
                ['question' => 'Sau khi trở thành công dân Mỹ thì cần làm gì tiếp theo?', 'answer' => null],
            ],
            'Kiến thức thi quốc tịch' => [
                ['question' => 'Cách tra cứu Thượng nghị sĩ (U.S. Senators), Dân biểu của Hạ viện (U.S. Representatives) và Thống đốc (Governors)?', 'answer' => null],
                ['question' => 'Nếu ở thủ đô Washington, D.C. thì có Thượng nghị sĩ (U.S. Senators), Dân biểu của Hạ viện (U.S. Representatives) và Thống đốc (Governors) không?', 'answer' => null],
            ],
        ];

        foreach ($data as $categoryName => $items) {
            $category = QaCategory::firstOrCreate([
                'slug' => Str::slug($categoryName),
            ], [
                'name' => $categoryName,
            ]);

            foreach ($items as $item) {
                QaItem::create([
                    'category_id' => $category->id,
                    'question' => $item['question'],
                    'answer' => $item['answer'],
                ]);
            }
        }
    }
}
