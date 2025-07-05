<?php

namespace Database\Seeders;

use App\Models\QaCategory;
use App\Models\QaItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QaAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Thông tin về ứng dụng' => [
                [
                    'question' => '1. Ứng dụng luyện thi quốc tịch Mỹ có thu phí hay không?',
                    'answer' => trim(<<<TEXT
Không. Đây là một ứng dụng <strong>phi lợi nhuận, không thu phí, không quảng cáo, và không yêu cầu trả tiền dưới bất kỳ hình thức nào. </strong>
Đây là một dự án vì cộng đồng với mong muốn giúp đỡ người Việt, đặc biệt là những người không rành tiếng Anh, có thể tự luyện thi quốc tịch Mỹ một cách dễ hiểu, đơn giản và hiệu quả.
TEXT)
                ],
                [
                    'question' => '2. Các thông tin trên ứng dụng lấy từ đâu?',
                    'answer' => trim(<<<TEXT
Các nội dung trong ứng dụng được lấy từ các nguồn chính thức của USCIS (Sở Di trú và Nhập tịch Mỹ). Tuy nhiên, do USCIS có thể thay đổi chính sách hoặc cập nhật thông tin, ứng dụng chưa thể cập nhật ngay.
Nếu bạn phát hiện thông tin chưa chính xác hoặc cần bổ sung, vui lòng gửi email góp ý về: <a href="#">info@icaviet.com</a>. Chúng tôi luôn trân trọng phản hồi từ cộng đồng để cải thiện ứng dụng tốt hơn mỗi ngày.
TEXT)
                ],
                [
                    'question' => '3. Làm sao để học hiệu quả trên ứng dụng?',
                    'answer' => trim(<<<TEXT
                    Để học hiệu quả trên ứng dụng, bạn có thể áp dụng các cách sau:

- Luyện đều mỗi ngày 10–15 phút, thay vì học dồn một lần
- Luyện nói to thành tiếng để quen với cách phát âm và phản xạ
- Gắn sao những câu khó để ôn lại sau
- Sau mỗi phần luyện tập, ứng dụng sẽ hiển thị lại danh sách câu sai hoặc câu đã làm để bạn ôn lại
- Khi đã quen với bài thi, bạn có thể vào mục “<strong>Mock Test</strong> - Thi thử”. Phần này chỉ có tiếng Anh để luyện nghe
- Ứng dụng cũng có mục “Results - Kết quả”, lưu lại tiến độ học tập để bạn dễ dàng theo dõi và cải thiện mỗi ngày.

TEXT)
                ],
            ],
            'Tính năng trên ứng dụng' => [
                [
                    'question' => '4. Phát âm dễ nhớ là gì?',
                    'answer' => trim(<<<TEXT
Phát âm dễ nhớ là phần phiên âm tiếng Việt giúp người không biết tiếng Anh có thể đọc theo một cách gần đúng.
Tuy không chính xác 100%, nhưng sẽ hữu ích để bạn làm quen với cách phát âm ban đầu. Bạn vẫn nên nghe thêm audio và luyện nói theo phát âm của người bản xứ để cải thiện phát âm tự nhiên hơn.
TEXT)
                ],
                [
                    'question' => '5. Câu hỏi gắn sao (Starred Questions) là gì?',
                    'answer' => trim(<<<TEXT
Câu hỏi gắn sao là những câu bạn muốn lưu lại để luyện tập riêng. Khi làm bài ở các phần như Civics, Writing, Reading, Speaking & N-400, bạn có thể nhấn vào biểu tượng ngôi sao ⭐ để đánh dấu câu hỏi. Sau đó, vào mục “<strong>Starred Questions</strong> - Câu hỏi gắn sao” trong menu để ôn lại các câu đã lưu.
TEXT)
                ],
                [
                    'question' => '6. Phần thi thử (Mock Test) có giống với lúc thi thực tế không?',
                    'answer' => trim(<<<TEXT
Ứng dụng được thiết kế mô phỏng sát với thực tế, giúp bạn làm quen với dạng câu hỏi và cách thi. Tuy nhiên, trong buổi thi chính thức, bạn sẽ trả lời trực tiếp với viên chức USCIS nên ứng dụng sẽ không thể tái hiện 100% cách hỏi, ngữ điệu và tình huống thực tế.
TEXT)
                ],
                [
                    'question' => '7. Tại sao phần thi N-400 không có kết quả chấm điểm?',
                    'answer' => trim(<<<TEXT
Vì các câu hỏi trong phần này phụ thuộc vào Form N-400 của từng người, nên không có đáp án đúng - sai cố định.
Tuy nhiên, các câu hỏi được trích từ nội dung thực tế của Form N-400 để bạn làm quen với cách hỏi và luyện nghe – phản xạ trước buổi phỏng vấn.
TEXT)
                ],
                [
                    'question' => '8. Chia sẻ kinh nghiệm là gì?',
                    'answer' => trim(<<<TEXT
“Chia sẻ kinh nghiệm” là nơi người học có thể kết nối, đặt câu hỏi và chia sẻ kinh nghiệm ôn thi quốc tịch với nhau. Bạn có thể đăng câu hỏi, giao lưu với những người đang học giống mình, chia sẻ kinh nghiệm thi quốc tịch,..
TEXT)
                ],
                [
                    'question' => '9. Làm thế nào để đổi ZIP Code?',
                    'answer' => trim(<<<TEXT
Bạn có thể đổi ZIP Code bằng cách:
- Ở trang chủ, nhấn vào biểu tượng ☰ ở góc phải màn hình
- Nhấn vào mục “<strong>ZIP Code của bạn</strong>”
- Nhập ZIP Code mới. Sau đó, ứng dụng sẽ hiển thị ra danh sách Dân biểu tương ứng theo ZIP Code của bạn
- Bạn cũng có thể xem lại danh sách Dân biểu ở mục “<strong>Your Representatives</strong> - Dân biểu của bạn”
TEXT)
                ],
            ],
            'Liên hệ' => [
                [
                    'question' => '10. Tôi có thể liên hệ với ICAVIET qua đâu?',
                    'answer' => trim(<<<TEXT
Bạn có thể liên hệ với ICAVIET theo các cách sau:

📝 Bấm vào nút “Gửi phản hồi” bên dưới
📧 Gửi email đến: <a href="#">info@icaviet.com</a>
Chúng tôi luôn sẵn sàng hỗ trợ bạn trong quá trình luyện thi quốc tịch Mỹ!
TEXT)
                ]
            ]
        ];


        foreach ($data as $categoryName => $items) {
            $category = QaCategory::firstOrCreate([
                'slug' => Str::slug($categoryName),
                'is_app_question' => true,
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
