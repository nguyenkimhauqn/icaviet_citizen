<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class N400QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ----- START: PART 1 ----
        // 1
        Question::create([
            'category_id' => 1,
            'content' => 'How are you feeling?',
            'translation' => 'Bạn cảm thấy như thế nào?',
            'type' => 'text',
            'default_answers' => 'I’m good. Thanks.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => "I'm good. Thanks.", 'vi' => 'Tôi ổn. Cảm ơn', 'is_best_answer' => true],
                    ['en' => "I'm nervous.", 'vi' => 'Tôi đang lo lắng'],
                    ['en' => "I'm a little sick, but I'm okay.", 'vi' => 'Tôi bị bệnh một chút nhưng vẫn ổn'],
                ]
            ]),
        ]);

        // 2
        Question::create([
            'category_id' => 1,
            'content' => 'How did you come here today?',
            'translation' => 'Hôm nay bạn đến đây bằng cách nào?',
            'type' => 'text',
            'default_answers' => 'I drove.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'I drove.', 'vi' => 'Tôi tự lái xe đến', 'is_best_answer' => true],
                    ['en' => 'My friend drove me.', 'vi' => 'Bạn tôi chở đến'],
                    ['en' => 'My husband/wife drove me.', 'vi' => 'Chồng/vợ tôi chở đến'],
                ]
            ]),
        ]);

        // 3
        Question::create([
            'category_id' => 1,
            'content' => 'Please remain standing. / Please stand up.',
            'translation' => 'Vui lòng đứng lên.',
            'type' => 'text',
            'default_answers' => 'Yes',
            'default_answers_translation' => 'Vâng',
        ]);

        // 4
        Question::create([
            'category_id' => 1,
            'content' => 'Please raise your right hand.',
            'translation' => 'Vui lòng giơ tay phải lên.',
            'type' => 'text',
            'default_answers' => 'Yes',
            'default_answers_translation' => 'Vâng',
        ]);

        // 5
        Question::create([
            'category_id' => 1,
            'content' => 'Do you promise to tell the truth and nothing but the truth?',
            'translation' => 'Bạn có hứa sẽ nói sự thật và chỉ sự thật không?',
            'type' => 'text',
            'default_answers' => 'Yes, I do.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Yes, I do.', 'vi' => 'Vâng, tôi hứa', 'is_best_answer' => true],
                    ['en' => 'I promise.', 'vi' => 'Tôi hứa'],
                ]
            ]),
        ]);

        // 6
        Question::create([
            'category_id' => 1,
            'content' => 'Do you understand what an “oath” means?',
            'translation' => 'Bạn có hiểu "lời tuyên thệ" nghĩa là gì không?',
            'type' => 'text',
            'default_answers' => 'Yes. It means telling the truth.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Yes. It means telling the truth.', 'vi' => 'Có, nó nghĩa là nói sự thật', 'is_best_answer' => true],
                    ['en' => 'Yes, I understand.', 'vi' => 'Có, tôi hiểu'],
                ]
            ]),
        ]);

        // 7
        Question::create([
            'category_id' => 1,
            'content' => 'Do you solemnly swear or affirm that the statements you’re about to make will be the truth, the whole truth and nothing but the truth?',
            'translation' => 'Bạn có cam đoan rằng những lời bạn sắp nói ra sẽ là sự thật, toàn bộ sự thật và không gì ngoài sự thật không?',
            'type' => 'text',
            'default_answers' => 'Yes, I do.',
            'default_answers_translation' => 'Có, tôi hứa',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Yes, I do.', 'vi' => 'Có, tôi hứa', 'is_best_answer' => true],
                ]
            ]),
        ]);

        // 8
        Question::create([
            'category_id' => 1,
            'content' => 'You may sit down.',
            'translation' => 'Bạn có thể ngồi xuống.',
            'type' => 'text',
            'default_answers' => 'Thank you.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Thank you.', 'vi' => 'Cảm ơn', 'is_best_answer' => true],
                    ['en' => 'Okay', 'vi' => 'Được'],
                ]
            ]),
        ]);

        // 9
        Question::create([
            'category_id' => 1,
            'content' => 'Please put your purse on top of the table.',
            'translation' => 'Vui lòng đặt ví/túi xách của bạn lên bàn.',
            'type' => 'text',
            'default_answers' => 'Sure.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Sure.', 'vi' => 'Được', 'is_best_answer' => true],
                    ['en' => 'Okay.', 'vi' => 'Được'],
                ]
            ]),
        ]);

        // 10
        Question::create([
            'category_id' => 1,
            'content' => 'Why are you here today?',
            'translation' => 'Tại sao hôm nay bạn đến đây?',
            'type' => 'text',
            'default_answers' => 'For my citizenship interview.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'For my citizenship interview.', 'vi' => 'Cho buổi phỏng vấn quốc tịch', 'is_best_answer' => true],
                    ['en' => 'I’m here for my citizenship interview.', 'vi' => 'Tôi đến đây để phỏng vấn quốc tịch.'],
                    ['en' => 'To become a U.S. citizen.', 'vi' => 'Để trở thành công dân Mỹ.'],
                ]
            ]),
        ]);

        // 11
        Question::create([
            'category_id' => 1,
            'content' => 'Why do you want to become an American Citizen?',
            'translation' => 'Tại sao bạn muốn trở thành công dân Mỹ?',
            'type' => 'text',
            'default_answers' => 'I want to vote.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'I want to vote.', 'vi' => 'Tôi muốn đi bầu cử', 'is_best_answer' => true],
                    ['en' => 'I want to have full rights.', 'vi' => 'Tôi muốn có đầy đủ quyền công dân'],
                ]
            ]),
        ]);

        // 12
        Question::create([
            'category_id' => 1,
            'content' => 'What is your immigration status?',
            'translation' => 'Tình trạng di trú hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'I am a permanent resident.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'I am a permanent resident.', 'vi' => 'Tôi là thường trú nhân', 'is_best_answer' => true],
                    ['en' => 'I have a green card.', 'vi' => 'Tôi có thẻ xanh'],
                ]
            ]),
        ]);

        // 13
        Question::create([
            'category_id' => 1,
            'content' => 'I’ll take your interview notice now.',
            'translation' => 'Tôi có thể xem thư hẹn phỏng vấn của bạn được không?',
            'type' => 'text',
            'default_answers' => 'Okay.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Okay.', 'vi' => 'Được → và đưa giấy hẹn thi quốc tịch', 'is_best_answer' => true],
                ]
            ]),
        ]);

        // 14
        Question::create([
            'category_id' => 1,
            'content' => 'May I see your permanent resident card, your passport, and your driver’s license?',
            'translation' => 'Tôi có thể xem thẻ xanh, hộ chiếu và giấy phép lái xe của bạn được không?',
            'type' => 'text',
            'default_answers' => 'Okay.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Okay.', 'vi' => 'Được', 'is_best_answer' => true],
                ]
            ]),
        ]);

        // 15
        Question::create([
            'category_id' => 1,
            'content' => 'Now we will go over your application form N-400. Are you ready?',
            'translation' => 'Bây giờ tôi sẽ hỏi một số câu hỏi trong form N-400 của bạn. Bạn đã sẵn sàng chưa?',
            'type' => 'text',
            'default_answers' => 'Yes, I am.',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'Yes, I am.', 'vi' => 'Tôi sẵn sàng', 'is_best_answer' => true],
                    ['en' => 'I am ready.', 'vi' => 'Tôi sẵn sàng'],
                ]
            ]),
        ]);
        // ----- END: PART 1 ----

        // ----- START: PART 2 ----
        // Câu 1: Multiple Choice
        $question1 = Question::create([
            'category_id' => 2,
            'content' => 'What is your basis for applying for naturalization?',
            'translation' => 'Bạn nộp đơn thi quốc tịch theo diện nào?',
            'type' => 'multiple_choice',
            'default_answers' => 'Green card for over 5 years',
            'tips' => json_encode([
                'another_answer_way' => [
                    [
                        'en' => 'Green card for over 5 years.',
                        'vi' => 'Có thẻ xanh hơn 5 năm.'
                    ],
                    [
                        'en' => 'Spouse of U.S. citizen for 3 years.',
                        'vi' => 'Kết hôn với công dân Mỹ được 3 năm.'
                    ],
                    [
                        'en' => 'Other reason',
                        'vi' => 'Lý do khác như VAWA, vợ/chồng công dân Mỹ làm việc cho tổ chức đủ điều kiện ở nước ngoài, phục vụ quân đội Mỹ trong thời chiến,...'
                    ]
                ]
            ]),
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Green card for over 5 years',
            'is_correct' => true,
            'enabled_category' => -1,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Spouse of U.S. citizen for 3 years',
            'is_correct' => true,
            'enabled_category' => 7,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Other reason',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Lý do khác như VAWA, vợ/chồng công dân Mỹ làm việc cho tổ chức đủ điều kiện ở nước ngoài, phục vụ quân đội Mỹ trong thời chiến,...',
            'enabled_category' => -1,
        ]);

        // Câu 2
        $question2 = Question::create([
            'category_id' => 2,
            'content' => '<strong>How long</strong> have you been in the <strong>United States</strong>?',
            'translation' => 'Bạn đã sống ở Mỹ bao lâu rồi?',
            'type' => 'text',
            'default_answers' => '3 years / 5 years',
            'default_answers_translation' => '3 năm / 5 năm',
            'tips' => json_encode([
                'How long' => 'bao lâu',
                'United States' => 'Mỹ',
            ]),
        ]);

        // Câu 3
        $question3 = Question::create([
            'category_id' => 2,
            'content' => 'Are you over <strong>18 years old</strong>?',
            'translation' => 'Bạn có trên 18 tuổi không?',
            'type' => 'text',
            'default_answers' => 'Yes, I am.',
            'default_answers_translation' => 'Đúng',
            'tips' => json_encode([
                'Over 18 years old' => 'trên 18 tuổi',
            ]),
        ]);

        // Câu 4
        $question4 = Question::create([
            'category_id' => 2,
            'content' => 'Are you a <strong>legal permanent resident</strong>?',
            'translation' => 'Bạn có phải là thường trú nhân hợp pháp không?',
            'type' => 'text',
            'default_answers' => 'Yes, I am.',
            'tips' => json_encode([
                'Legal permanent resident' => 'thường trú nhân',
            ]),
        ]);

        // Câu 5: Multiple Choice (đã chỉnh sửa)
        $question5 = Question::create([
            'category_id' => 2,
            'content' => 'Are you <strong>married</strong> to a <strong>U.S. citizen</strong>?',
            'translation' => 'Bạn có kết hôn với công dân Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => json_encode([
                'Married' => 'kết hôn',
                'U.S. citizen' => 'công dân Mỹ',
            ]),
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6
        $question6 = Question::create([
            'category_id' => 2,
            'content' => '<strong>How long</strong> have you been a <strong>permanent resident</strong>?',
            'translation' => 'Bạn là thường trú nhân bao lâu rồi?',
            'type' => 'text',
            'default_answers' => '3 years / 5 years',
            'default_answers_translation' => '3 năm / 5 năm',
            'tips' => json_encode([
                'How long' => 'bao lâu',
                'Permanent resident' => 'thường trú nhân',
            ]),
        ]);
        // ----- END: PART 2 ----

        // ----- START: PART 3 ----
        $question1 = Question::create([
            'category_id' => 3,
            'content' => '<strong>What</strong> is your <strong>full name</strong>?',
            'translation' => 'Tên đầy đủ của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'VAN TAM LE',
            'tips' => '{"What": "là gì", "Full name": "tên đầy đủ"}',
        ]);

        $question2 = Question::create([
            'category_id' => 3,
            'content' => 'Can you <strong>spell your name</strong>?',
            'translation' => 'Bạn có thể đánh vần tên của bạn không?',
            'type' => 'text',
            'default_answers' => 'V-A-N, T-A-M, L-E',
            'tips' => '{"Spell": "đánh vần", "Your name": "tên của bạn"}',
        ]);

        $question3 = Question::create([
            'category_id' => 3,
            'content' => 'Have you <strong>used</strong> any <strong>other names</strong> before?',
            'translation' => 'Bạn có sử dụng tên khác trước đây không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Use": "sử dụng", "Other names": "tên khác"}',
        ]);

        Answer::create([
            'question_id' => $question3->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question3->id,
            'content' => 'Yes',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Nhập tên khác',
        ]);

        $question4 = Question::create([
            'category_id' => 3,
            'content' => 'Would you like to legally <strong>change your name</strong>?',
            'translation' => 'Bạn có muốn đổi tên của mình không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Change your name": "đổi tên của bạn"}',
        ]);

        Answer::create([
            'question_id' => $question4->id,
            'content' => 'No',
            'is_correct' => true,
            'skip_to_question' => 7,
        ]);

        Answer::create([
            'question_id' => $question4->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question5 = Question::create([
            'category_id' => 3,
            'content' => '<strong>Why</strong> do you want to <strong>change your name</strong>?',
            'translation' => 'Tại sao bạn muốn đổi tên?',
            'type' => 'text',
            'default_answers' => 'Because I want to change the order of my name.',
            'tips' => '{"Why": "tại sao", "Change your name": "đổi tên", "another_answer_way": [{"en": "Because I want to change the order of my name.", "vi": "Bởi vì tôi muốn đổi lại thứ tự tên của tôi."}, {"en": "Because I don’t like my old name.", "vi": "Bởi vì tôi không thích tên cũ nữa."}]}',
        ]);

        $question6 = Question::create([
            'category_id' => 3,
            'content' => '<strong>What</strong> is the <strong>new name</strong> you would like to use?',
            'translation' => 'Bạn muốn sử dụng tên mới nào?',
            'type' => 'text',
            'default_answers' => 'TAM VAN LE',
            'tips' => '{"What": "là gì", "New name": "tên mới"}',
        ]);

        $question7 = Question::create([
            'category_id' => 3,
            'content' => 'Is the <strong>name</strong> on your <strong>green card</strong> the <strong>same</strong> as your current legal name?',
            'translation' => 'Tên trên thẻ xanh của bạn có giống với tên hợp pháp hiện tại không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Name": "tên", "Green card": "thẻ xanh", "Same": "giống", "another_answer_way": [{"en": "Nếu chọn No, cung cấp thêm tên khác với trên thẻ xanh.", "vi": ""}]}',
        ]);

        Answer::create([
            'question_id' => $question7->id,
            'content' => 'No',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Tên khác với trên thẻ xanh',
        ]);

        Answer::create([
            'question_id' => $question7->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question8 = Question::create([
            'category_id' => 3,
            'content' => '<strong>When</strong> is <strong>your birthday</strong>?',
            'translation' => 'Sinh nhật của bạn là ngày nào?',
            'type' => 'text',
            'default_answers' => 'January 1, 1990',
            'tips' => '{"When": "khi nào", "Your birthday": "sinh nhật của bạn"}',
        ]);

        $question9 = Question::create([
            'category_id' => 3,
            'content' => '<strong>When</strong> did you become a <strong>lawful permanent resident</strong>?',
            'translation' => 'Bạn trở thành thường trú nhân hợp pháp vào ngày nào?',
            'type' => 'text',
            'default_answers' => 'January 1, 2020',
            'tips' => '{"When": "khi nào", "Lawful permanent resident": "thường trú nhân"}',
        ]);

        $question10 = Question::create([
            'category_id' => 3,
            'content' => '<strong>Where</strong> were you <strong>born</strong>?',
            'translation' => 'Bạn sinh ra ở đâu?',
            'type' => 'text',
            'default_answers' => 'Vietnam',
            'tips' => '{"Where": "ở đâu", "Were born": "được sinh ra"}',
        ]);

        $question11 = Question::create([
            'category_id' => 3,
            'content' => '<strong>What</strong> is your <strong>nationality</strong>?',
            'translation' => 'Quốc tịch hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Vietnam',
            'tips' => '{"What": "là gì", "Nationality": "quốc tịch"}',
        ]);

        $question12 = Question::create([
            'category_id' => 3,
            'content' => 'Was your <strong>father</strong> or <strong>mother</strong> a <strong>U.S. citizen</strong> before your 18th birthday?',
            'translation' => 'Ba hoặc mẹ của bạn có phải là công dân Mỹ trước sinh nhật 18 tuổi không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Father": "ba", "Mother": "mẹ", "U.S. citizen": "công dân Mỹ"}',
        ]);

        Answer::create([
            'question_id' => $question12->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question12->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question13 = Question::create([
            'category_id' => 3,
            'content' => 'Do you have a physical or developmental <strong>disability</strong> or <strong>mental impairment</strong> that prevents you from taking the English or civics test?',
            'translation' => 'Bạn có bị khuyết tật thể chất, phát triển, hoặc suy giảm tâm thần nào khiến bạn không thể tham gia bài thi tiếng Anh hoặc bài thi công dân không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Disability": "khuyết tật", "Mental impairment": "suy giảm trí tuệ"}',
        ]);

        Answer::create([
            'question_id' => $question13->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question13->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Chỉ chọn nếu bạn bị suy giảm trí tuệ hoặc có khuyết tật thể chất ảnh hưởng đến khả năng học và thi quốc tịch.',
        ]);

        $question14 = Question::create([
            'category_id' => 3,
            'content' => 'Do you want us to <strong>update</strong> your immigration status with <strong>Social Security</strong> when you\'re naturalized?',
            'translation' => 'Bạn có muốn cập nhật tình trạng di trú với Cơ quan An sinh Xã hội sau khi nhập tịch không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Update": "cập nhật", "Social Security": "An sinh Xã hội"}',
        ]);

        Answer::create([
            'question_id' => $question14->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question14->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question15 = Question::create([
            'category_id' => 3,
            'content' => 'What is your <strong>Social Security Number</strong> (SSN)?',
            'translation' => 'Số An sinh Xã hội của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Social Security Number": "số An sinh Xã hội"}',
        ]);

        $question16 = Question::create([
            'category_id' => 3,
            'content' => 'What is your <strong>sex</strong>?',
            'translation' => 'Giới tính của bạn là gì?',
            'type' => 'multiple_choice',
            'default_answers' => 'Male',
            'tips' => '{"Your sex": "giới tính"}',
        ]);

        Answer::create([
            'question_id' => $question16->id,
            'content' => 'Male',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question16->id,
            'content' => 'Female',
            'is_correct' => true,
        ]);
        // ----- END: PART 3 ----

        // ----- START: PART 4 ----
        // 1. Are you Hispanic or Latino?
        $question1 = Question::create([
            'category_id' => 4,
            'content' => 'Are you <strong>Hispanic</strong> or <strong>Latino</strong>?',
            'translation' => 'Bạn có phải là người gốc Tây Ban Nha hoặc Mỹ Latin không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Hispanic":"người gốc Tây Ban Nha","Latino":"người gốc Mỹ Latin"}',
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Chỉ chọn nếu bạn là người gốc Tây Ban Nha hay Mỹ Latin.'
        ]);

        // 2. How tall are you?
        $question2 = Question::create([
            'category_id' => 4,
            'content' => 'How <strong>tall</strong> are you?',
            'translation' => 'Bạn cao bao nhiêu?',
            'type' => 'text',
            'default_answers' => '... feet ... inches',
            'tips' => '{"Tall":"cao","Feet":"đơn vị đo chiều cao/chiều dài","Inch":"đơn vị đo chiều cao/chiều dài"}',
        ]);

        // 3. What color are your eyes?
        $question3 = Question::create([
            'category_id' => 4,
            'content' => 'What <strong>color</strong> are your <strong>eyes</strong>?',
            'translation' => 'Màu mắt của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Black',
            'tips' => '{"Color":"màu","Eyes":"mắt"}',
        ]);

        // 4. What color is your hair?
        $question4 = Question::create([
            'category_id' => 4,
            'content' => 'What <strong>color</strong> is your <strong>hair</strong>?',
            'translation' => 'Màu tóc của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Black',
            'tips' => '{"Color":"màu","Hair":"tóc"}',
        ]);

        // 5. How much do you weigh?
        $question5 = Question::create([
            'category_id' => 4,
            'content' => 'How much do you <strong>weigh</strong>?',
            'translation' => 'Cân nặng của bạn là bao nhiêu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Weigh":"cân nặng"}',
        ]);

        // 6. What is your race?
        $question6 = Question::create([
            'category_id' => 4,
            'content' => 'What is your <strong>race</strong>?',
            'translation' => 'Chủng tộc của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Asian',
            'tips' => '{"Race":"chủng tộc"}',
        ]);
        // ----- END: PART 4 ----

        // ----- START: PART 5 ----
        $question1 = Question::create([
            'category_id' => 5,
            'content' => '<strong>Where</strong> do you currently <strong>live</strong>?',
            'translation' => 'Bạn hiện tại đang sống ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Live": "sống"}',
        ]);

        $question2 = Question::create([
            'category_id' => 5,
            'content' => '<strong>How long</strong> have you <strong>lived</strong> there?',
            'translation' => 'Bạn đã sống ở đó bao lâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How long": "bao lâu", "Live": "sống"}',
        ]);

        $question3 = Question::create([
            'category_id' => 5,
            'content' => '<strong>Where</strong> have you <strong>lived</strong> during the last <strong>5 years</strong> (or <strong>3 years</strong>)?',
            'translation' => 'Bạn đã sống ở đâu trong suốt 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Live": "sống", "The last 5 years / 3 years": "5 năm qua / 3 năm qua"}',
        ]);
        // ----- END: PART 5 ----

        // ----- START: PART 6 ----
        $question1 = Question::create([
            'category_id' => 6,
            'content' => 'What is your current <strong>marital status</strong>?',
            'translation' => 'Tình trạng hôn nhân hiện tại của bạn là gì?',
            'type' => 'multiple_choice',
            'default_answers' => 'Single, never married',
            'tips' => '{"Marital status": "tình trạng hôn nhân"}',
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Single, never married',
            'is_correct' => true,
            'skip_to_category' => 8,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Married',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Divorced',
            'is_correct' => true,
            'skip_to_question' => 3,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Widowed',
            'is_correct' => true,
            'skip_to_question' => 3,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Separated',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'Marriage annulled',
            'is_correct' => true,
            'skip_to_question' => 3,
        ]);

        $question2 = Question::create([
            'category_id' => 6,
            'content' => 'If you are currently married, is your <strong>spouse</strong> a current member of the <strong>U.S. armed forces</strong>?',
            'translation' => 'Nếu bạn đang kết hôn, vợ/chồng bạn có đang là thành viên trong quân đội Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Spouse": "vợ/chồng", "U.S. armed forces": "quân đội Mỹ"}',
        ]);

        Answer::create([
            'question_id' => $question2->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question2->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question3 = Question::create([
            'category_id' => 6,
            'content' => '<strong>How many times</strong> have you been <strong>married</strong>?',
            'translation' => 'Bạn đã kết hôn mấy lần?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How many times": "mấy lần", "Married": "kết hôn"}',
        ]);
        // ----- END: PART 6 ----

        // ----- START: PART 6b ----
        $question1 = Question::create([
            'category_id' => 7,
            'content' => 'What is the <strong>name</strong> of your current <strong>spouse</strong>?',
            'translation' => 'Tên người vợ/chồng hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "Spouse": "vợ/chồng"}',
        ]);

        $question2 = Question::create([
            'category_id' => 7,
            'content' => 'What is your current <strong>spouse’s date of birth</strong>?',
            'translation' => 'Ngày sinh của người vợ/chồng hiện tại là gì?',
            'type' => 'text',
            'default_answers' => 'January 02, 1990',
            'tips' => '{"Spouse": "vợ/chồng", "Date of birth": "ngày sinh"}',
        ]);

        $question3 = Question::create([
            'category_id' => 7,
            'content' => 'What is the <strong>date</strong> you <strong>entered into marriage</strong> with your current <strong>spouse</strong>?',
            'translation' => 'Bạn đã kết hôn với người vợ/chồng hiện tại vào ngày nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Date": "ngày", "Enter into marriage": "kết hôn", "Spouse": "vợ/chồng"}',
        ]);

        $question4 = Question::create([
            'category_id' => 7,
            'content' => 'Is your current <strong>spouse’s</strong> present physical <strong>address</strong> the <strong>same</strong> as your physical address?',
            'translation' => 'Vợ/chồng của bạn có đang sống cùng địa chỉ với bạn không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Spouse": "vợ/chồng", "Address": "địa chỉ đang ở hiện tại", "Same": "giống"}',
        ]);

        Answer::create([
            'question_id' => $question4->id,
            'content' => 'No',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Cung cấp địa chỉ khác mà vợ/chồng bạn đang sống.',
        ]);

        Answer::create([
            'question_id' => $question4->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question5 = Question::create([
            'category_id' => 7,
            'content' => '<strong>When</strong> did your current <strong>spouse</strong> become a <strong>U.S. citizen</strong>?',
            'translation' => 'Vợ/chồng bạn trở thành công dân Mỹ bằng cách nào?',
            'type' => 'multiple_choice',
            'default_answers' => 'By birth',
            'tips' => '{"When": "khi nào", "Spouse": "vợ/chồng", "U.S. citizen": "công dân Mỹ"}',
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'By birth',
            'is_correct' => true,
            'skip_to_question' => 7,
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'Other',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Nhập ngày',
        ]);

        $question6 = Question::create([
            'category_id' => 7,
            'content' => 'What is your current <strong>spouse’s alien registration number</strong>?',
            'translation' => 'Số A của vợ/chồng hiện tại là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Spouse": "vợ/chồng", "Alien registration number": "số đăng ký người nước ngoài, số A"}',
            'answer_note' => 'Bạn có thể tự ghi nhớ câu trả lời',
        ]);

        $question7 = Question::create([
            'category_id' => 7,
            'content' => '<strong>How many times</strong> has your current <strong>spouse</strong> been <strong>married</strong>?',
            'translation' => 'Vợ/chồng hiện tại của bạn đã kết hôn mấy lần?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How many times": "mấy lần", "Spouse": "vợ/chồng", "Marry": "kết hôn"}',
        ]);

        $question8 = Question::create([
            'category_id' => 7,
            'content' => 'What is your <strong>spouse’s current job</strong>?',
            'translation' => 'Công việc hiện tại của vợ/chồng bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Current job": "công việc hiện tại", "Spouse": "vợ/chồng"}',
        ]);
        // ----- END: PART 6b ----

        // ----- START: PART 7 ----
        // TODO: SKIP
        $question1 = Question::create([
            'category_id' => 8,
            'content' => '<strong>How many children</strong> do you have?',
            'translation' => 'Bạn có bao nhiêu người con?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How many": "bao nhiêu", "Children": "những người con"}',
            'skip_to_category' => 9,
        ]);

        $question2 = Question::create([
            'category_id' => 8,
            'content' => 'What is the <strong>name</strong> of your <strong>child</strong>?',
            'translation' => 'Tên của con bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "Child": "con"}',
        ]);

        $question3 = Question::create([
            'category_id' => 8,
            'content' => 'Where was your <strong>child born</strong>?',
            'translation' => 'Con của bạn được sinh ra ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Child": "con", "Born": "được sinh ra"}',
        ]);

        $question4 = Question::create([
            'category_id' => 8,
            'content' => 'Where does your <strong>child</strong> currently <strong>live</strong>?',
            'translation' => 'Con của bạn hiện đang sống ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Live": "sống"}',
        ]);

        $question5 = Question::create([
            'category_id' => 8,
            'content' => 'Is your child your <strong>biological child</strong>, <strong>stepchild</strong>, or <strong>adopted child</strong>?',
            'translation' => 'Con của bạn là con ruột, con riêng hay con nuôi?',
            'type' => 'multiple_choice',
            'default_answers' => '',
            'tips' => '{"Biological child": "con ruột", "Stepchild": "con riêng", "Adopted child": "con nuôi"}',
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'Biological child',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'Stepchild',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'Adopted child',
            'is_correct' => true,
        ]);

        $question6 = Question::create([
            'category_id' => 8,
            'content' => '<strong>When</strong> is your child\'s <strong>birthday</strong>?',
            'translation' => 'Sinh nhật con bạn là khi nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"When": "khi nào", "Birthday": "sinh nhật"}',
        ]);

        $question7 = Question::create([
            'category_id' => 8,
            'content' => 'Is your <strong>child</strong> a <strong>U.S. citizen</strong>?',
            'translation' => 'Con của bạn có phải công dân Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Child": "con", "U.S. citizen": "công dân Mỹ"}',
        ]);

        Answer::create([
            'question_id' => $question7->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question7->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question8 = Question::create([
            'category_id' => 8,
            'content' => 'Are you providing <strong>support</strong> for your <strong>child</strong>?',
            'translation' => 'Bạn có chu cấp cho con bạn không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Support": "chu cấp, hỗ trợ", "Child": "con"}',
        ]);

        Answer::create([
            'question_id' => $question8->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Nếu không chu cấp cho con, thường trú nhân có thể bị cho là không có tư cách đạo đức tốt.',
        ]);

        Answer::create([
            'question_id' => $question8->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);
        // ----- END: PART 7 ----

        // ----- START: PART 8 ----
        $question1 = Question::create([
            'category_id' => 9,
            'content' => 'Are you currently <strong>employed</strong> or <strong>attending school</strong>?',
            'translation' => 'Hiện tại bạn đang đi làm hay đi học?',
            'type' => 'multiple_choice',
            'default_answers' => 'I am currently employed.',
            'tips' => '{"Employed": "đi làm", "Attending school": "đi học"}',
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'I am currently employed.',
            'explanation' => 'Tôi hiện đang đi làm',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question1->id,
            'content' => 'I am attending school.',
            'explanation' => 'Tôi hiện đang đi học',
            'is_correct' => true,
            'skip_to_question' => 7,
        ]);

        $question2 = Question::create([
            'category_id' => 9,
            'content' => 'What is your <strong>current occupation</strong>?',
            'translation' => 'Nghề nghiệp hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Current": "hiện tại", "Occupation": "nghề nghiệp"}',
        ]);

        $question3 = Question::create([
            'category_id' => 9,
            'content' => 'What is the <strong>name</strong> of the <strong>company</strong> or <strong>business</strong> you work for?',
            'translation' => 'Tên công ty bạn đang làm tên gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "Company, business": "công ty, doanh nghiệp"}',
        ]);

        $question4 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> is your <strong>workplace</strong> located?',
            'translation' => 'Nơi làm việc của bạn ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Workplace": "nơi làm việc"}',
        ]);

        $question5 = Question::create([
            'category_id' => 9,
            'content' => '<strong>How long</strong> have you <strong>worked</strong> at this <strong>company</strong>?',
            'translation' => 'Bạn làm việc ở công ty này bao lâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How long": "bao lâu", "Work": "làm việc", "Company": "công ty"}',
        ]);

        // TODO: SKIP
        $question6 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> have you <strong>worked</strong> in <strong>the last 5 years (or 3 years)</strong>?',
            'translation' => 'Bạn đã làm ở đâu trong 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Work": "làm việc", "The last 5 years / 3 years": "5 năm qua / 3 năm qua"}',
            'skip_to_category' => 10
        ]);

        $question7 = Question::create([
            'category_id' => 9,
            'content' => '<strong>What</strong> are you <strong>studying</strong>?',
            'translation' => 'Bạn đang học gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"What": "là gì", "Study": "học"}',
        ]);

        $question8 = Question::create([
            'category_id' => 9,
            'content' => 'What is the <strong>name</strong> of the <strong>school</strong>?',
            'translation' => 'Tên trường của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "School": "trường"}',
        ]);

        $question9 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> is the <strong>school</strong> located at?',
            'translation' => 'Trường của bạn ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Shool": "trường"}',
        ]);

        $question10 = Question::create([
            'category_id' => 9,
            'content' => '<strong>When</strong> did you <strong>start school</strong>?',
            'translation' => 'Bạn bắt đầu học ở trường từ khi nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"When": "khi nào", "Start school": "bắt đầu học"}',
        ]);

        $question11 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> have you <strong>studied</strong> in the <strong>last 5 years (or 3 years)</strong>?',
            'translation' => 'Bạn đã học ở đâu trong vòng 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Study": "học", "The last 5 years / 3 years": "5 năm qua / 3 năm qua"}',
        ]);
        // ----- END: PART 8 ----

        // ----- START: PART 9 ----
        $question1 = Question::create([
            'category_id' => 10,
            'content' => '<strong>How many times</strong> have you <strong>left</strong> the <strong>United States</strong> in the past 5 years (or 3 years)?',
            'translation' => 'Bạn đã rời khỏi Mỹ bao nhiêu lần trong 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => "{\"How many times\": \"mấy lần\", \"Leave/left\": \"rời khỏi\", \"United States\": \"Mỹ\"}",
        ]);

        $question2 = Question::create([
            'category_id' => 10,
            'content' => 'Did any of your <strong>trips abroad</strong> last <strong>6 months</strong> or longer?',
            'translation' => 'Có chuyến đi ra nước ngoài nào của bạn kéo dài từ 6 tháng trở lên không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => "{\"Trip\": \"chuyến đi\", \"Abroad\": \"nước ngoài\", \"6 months\": \"từ 6 tháng\"}",
        ]);

        Answer::create([
            'question_id' => $question2->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question2->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        $question3 = Question::create([
            'category_id' => 10,
            'content' => 'Which <strong>countries</strong> did you <strong>visit</strong>?',
            'translation' => 'Bạn đã đi đến các quốc gia nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => "{\"Countries\": \"quốc gia\", \"Visit\": \"ghé thăm, đi đến\"}",
        ]);

        $question4 = Question::create([
            'category_id' => 10,
            'content' => '<strong>When</strong> was your last trip <strong>outside the United States</strong>?',
            'translation' => 'Chuyến đi ra nước ngoài gần nhất của bạn là khi nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => "{\"When\": \"khi nào\", \"Outside the United States\": \"ngoài nước Mỹ\"}",
        ]);

        $question5 = Question::create([
            'category_id' => 10,
            'content' => 'Do you remember the <strong>day</strong> you <strong>returned</strong> to the <strong>United States</strong>?',
            'translation' => 'Bạn có nhớ ngày bạn quay lại Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => "{\"Day\": \"ngày\", \"Return\": \"quay lại\", \"United States\": \"Mỹ\"}",
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $question5->id,
            'content' => 'Yes',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Nhập ngày lại Mỹ.',
        ]);
        // ----- END: PART 9 ----

        // ----- START: PART 10 ----
        $this->call(N400QuestionPart10Seeder::class);
        // ----- END: PART 10 ----

        // ----- START: PART 11 ----
        $q = Question::create([
            'category_id' => 12,
            'content' => 'Is your household income less than or equal to 400% of the Federal Poverty Guidelines?',
            'translation' => 'Bạn có thu nhập hộ gia đình bằng hoặc thấp hơn 400% Mức chuẩn nghèo liên bang không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Household income' => 'thu nhập hộ gia đình',
                'Less than' => 'ít hơn',
                'Equal' => 'bằng',
                'Federal Poverty Guidelines' => 'Mức chuẩn nghèo liên bang',
            ]),
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'skip_to_category' => -1,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 2
        $q = Question::create([
            'category_id' => 12,
            'content' => 'What is your total household income?',
            'translation' => 'Tổng thu nhập của hộ gia đình bạn là bao nhiêu?',
            'type' => 'text',
            'tips' => json_encode([
                'Total household income' => 'tổng thu nhập hộ gia đình',
            ]),
        ]);

        // Câu 3
        $q = Question::create([
            'category_id' => 12,
            'content' => 'How many people are in your household?',
            'translation' => 'Hộ gia đình của bạn có bao nhiêu người?',
            'type' => 'text',
            'tips' => json_encode([
                'How many people' => 'bao nhiêu người',
                'Household' => 'hộ gia đình',
            ]),
        ]);

        // Câu 4
        $q = Question::create([
            'category_id' => 12,
            'content' => 'How many members of your household earn income, including yourself?',
            'translation' => 'Có bao nhiêu thành viên trong hộ gia đình bạn có thu nhập, tính cả bạn?',
            'type' => 'text',
            'tips' => json_encode([
                'How many members' => 'có bao nhiêu thành viên',
                'Earn income' => 'có thu nhập',
                'Including yourself' => 'tính cả bạn',
            ]),
        ]);

        // Câu 5
        $q = Question::create([
            'category_id' => 12,
            'content' => 'Are you the head of household?',
            'translation' => 'Bạn có phải là chủ hộ không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Head of household' => 'chủ hộ',
            ]),
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        // Câu 6
        $q = Question::create([
            'category_id' => 12,
            'content' => 'What is the name of the head of household?',
            'translation' => 'Tên của chủ hộ là gì?',
            'type' => 'text',
        ]);
        // ----- END: PART 11 ----

        Question::whereNull('topic_id')->update(['topic_id' => 4]);
    }
}
