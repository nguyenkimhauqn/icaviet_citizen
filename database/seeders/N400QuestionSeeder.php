<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionSet;
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
        $q1 = Question::create([
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
        QuestionSet::create(['set_number' => 1, 'question_id' => $q1->id,]);
        QuestionSet::create(['set_number' => 3, 'question_id' => $q1->id,]);

        // 2
        $q2 = Question::create([
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
        QuestionSet::create(['set_number' => 2, 'question_id' => $q2->id,]);

        // 3
        $q3 = Question::create([
            'category_id' => 1,
            'content' => 'Please remain standing. / Please stand up.',
            'translation' => 'Vui lòng đứng lên.',
            'type' => 'text',
            'default_answers' => 'Yes',
            'default_answers_translation' => 'Vâng',
        ]);


        // 4
        $q4 = Question::create([
            'category_id' => 1,
            'content' => 'Please raise your right hand.',
            'translation' => 'Vui lòng giơ tay phải lên.',
            'type' => 'text',
            'default_answers' => 'Yes',
            'default_answers_translation' => 'Vâng',
        ]);
        QuestionSet::create(['set_number' => 1, 'question_id' => $q4->id,]);

        // 5
        $q5 = Question::create([
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
        QuestionSet::create(['set_number' => 1,            'question_id' => $q5->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q5->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q5->id,]);

        // 6
        $q6 = Question::create([
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
        QuestionSet::create(['set_number' => 2,            'question_id' => $q6->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q6->id,]);

        // 7
        $q7 = Question::create([
            'category_id' => 1,
            'content' => 'Do you solemnly swear or affirm that the statements you’re about to make will be the truth, the whole truth and nothing but the truth?',
            'translation' => 'Bạn có cam đoan rằng những lời bạn sắp nói ra sẽ là sự thật, toàn bộ sự thật và không gì ngoài sự thật không?',
            'type' => 'text',
            'default_answers' => 'Yes, I do.',
            'default_answers_translation' => 'Có, tôi hứa',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q7->id,]);

        // 8
        $q8 = Question::create([
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
        QuestionSet::create(['set_number' => 1,            'question_id' => $q8->id,]);

        // 9
        $q9 = Question::create([
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
        $q10 = Question::create([
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
        QuestionSet::create(['set_number' => 2,            'question_id' => $q10->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q10->id,]);

        // 11
        $q11 = Question::create([
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
        QuestionSet::create(['set_number' => 3,            'question_id' => $q11->id,]);

        // 12
        $q12 = Question::create([
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
        QuestionSet::create(['set_number' => 1,            'question_id' => $q12->id,]);

        // 13
        $q13 = Question::create([
            'category_id' => 1,
            'content' => 'I’ll take your interview notice now.',
            'translation' => 'Tôi có thể xem thư hẹn phỏng vấn của bạn được không?',
            'type' => 'text',
            'default_answers' => 'Okay.',
            'tips' => json_encode([
                'suggestion' => 'Okay. (Được → và đưa giấy hẹn thi quốc tịch)'
            ]),
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q13->id,]);

        // 14
        $q14 = Question::create([
            'category_id' => 1,
            'content' => 'May I see your permanent resident card, your passport, and your driver’s license?',
            'translation' => 'Tôi có thể xem thẻ xanh, hộ chiếu và giấy phép lái xe của bạn được không?',
            'type' => 'text',
            'default_answers' => 'Okay.',
            'tips' => json_encode([
                'suggestion' => 'Okay. (Được → và đưa các giấy tờ theo yêu cầu)',
            ]),
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q14->id,]);

        // 15
        $q15 = Question::create([
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
        QuestionSet::create(['set_number' => 3,            'question_id' => $q15->id,]);
        // ----- END: PART 1 ----

        // ----- START: PART 2 ----
        // Câu 1: Multiple Choice
        $question1 = $q16 = Question::create([
            'category_id' => 2,
            'content' => 'What is your <strong>basis</strong> for applying for naturalization?',
            'translation' => 'Bạn nộp đơn thi quốc tịch theo diện nào?',
            'type' => 'multiple_choice',
            'default_answers' => 'Green card for over 5 years',
            'tips' => json_encode([
                'Basis' => 'cơ sở nộp đơn'
            ]),
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q16->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q16->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q16->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q16->id,]);

        Answer::create([
            'question_id' => $q16->id,
            'content' => 'Green card for over 5 years',
            'explanation' => 'Có thẻ xanh hơn 5 năm.',
            'is_correct' => true,
            'enabled_category' => -1,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q16->id,
            'content' => 'Spouse of U.S. citizen for 3 years',
            'explanation' => 'Kết hôn với công dân Mỹ được 3 năm.',
            'is_correct' => true,
            'enabled_category' => 7,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q16->id,
            'content' => 'Other reason',
            'explanation' => 'Lý do khác như VAWA, vợ/chồng công dân Mỹ làm việc cho tổ chức đủ điều kiện ở nước ngoài, phục vụ quân đội Mỹ trong thời chiến,...',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Lý do khác như VAWA, vợ/chồng công dân Mỹ làm việc cho tổ chức đủ điều kiện ở nước ngoài, phục vụ quân đội Mỹ trong thời chiến,...',
            'enabled_category' => -1,
        ]);


        // Câu 2
        $question2 = $q20 = Question::create([
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
        QuestionSet::create(['set_number' => 1,            'question_id' => $q20->id,]);

        // Câu 3
        $question3 = $q21 = Question::create([
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
        QuestionSet::create(['set_number' => 2,            'question_id' => $q21->id,]);

        // Câu 4
        $question4 = $q22 = Question::create([
            'category_id' => 2,
            'content' => 'Are you a <strong>legal permanent resident</strong>?',
            'translation' => 'Bạn có phải là thường trú nhân hợp pháp không?',
            'type' => 'text',
            'default_answers' => 'Yes, I am.',
            'default_answers_translation' => 'Đúng.',
            'tips' => json_encode([
                'Legal permanent resident' => 'thường trú nhân',
            ]),
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q22->id,]);

        // Câu 5: Multiple Choice (đã chỉnh sửa)
        $question5 = $q23 = Question::create([
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
        QuestionSet::create(['set_number' => 4,            'question_id' => $q23->id,]);

        Answer::create([
            'question_id' => $q23->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q23->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        // Câu 6
        $question6 = $q26 = Question::create([
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
        $question1 = $q27 = Question::create([
            'category_id' => 3,
            'content' => '<strong>What</strong> is your <strong>full name</strong>?',
            'translation' => 'Tên đầy đủ của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'VAN TAM LE',
            'tips' => '{"What": "là gì", "Full name": "tên đầy đủ"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q27->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q27->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q27->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q27->id,]);

        $question2 = $q28 = Question::create([
            'category_id' => 3,
            'content' => 'Can you <strong>spell your name</strong>?',
            'translation' => 'Bạn có thể đánh vần tên của bạn không?',
            'type' => 'text',
            'default_answers' => 'V-A-N, T-A-M, L-E',
            'tips' => '{"Spell": "đánh vần", "Your name": "tên của bạn"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q28->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q28->id,]);

        $question3 = $q29 = Question::create([
            'category_id' => 3,
            'content' => 'Have you <strong>used</strong> any <strong>other names</strong> before?',
            'translation' => 'Bạn có sử dụng tên khác trước đây không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Use": "sử dụng", "Other names": "tên khác"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q29->id,]);

        Answer::create([
            'question_id' => $q29->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q29->id,
            'content' => 'Yes',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Nhập tên khác',
        ]);


        $question4 = $q32 = Question::create([
            'category_id' => 3,
            'content' => 'Would you like to legally <strong>change your name</strong>?',
            'translation' => 'Bạn có muốn đổi tên của mình không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Change your name": "đổi tên của bạn"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q32->id,]);

        Answer::create([
            'question_id' => $q32->id,
            'content' => 'No',
            'is_correct' => true,
            'skip_to_question' => 7,
        ]);


        Answer::create([
            'question_id' => $q32->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question5 = $q35 = Question::create([
            'category_id' => 3,
            'content' => '<strong>Why</strong> do you want to <strong>change your name</strong>?',
            'translation' => 'Tại sao bạn muốn đổi tên?',
            'type' => 'text',
            'default_answers' => 'Because I want to change the order of my name.',
            'tips' => json_encode([
                "Why" => "tại sao",
                "Change your name" => "đổi tên",
                "another_answer_way" => [
                    [
                        "en" => "Because I want to change the order of my name.",
                        "vi" => "Bởi vì tôi muốn đổi lại thứ tự tên của tôi.",
                        "is_best_answer" => true,
                    ],
                    [
                        "en" => "Because I don’t like my old name.",
                        "vi" => "Bởi vì tôi không thích tên cũ nữa."
                    ]
                ]
            ]),
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q35->id,]);

        $question6 = $q36 = Question::create([
            'category_id' => 3,
            'content' => '<strong>What</strong> is the <strong>new name</strong> you would like to use?',
            'translation' => 'Bạn muốn sử dụng tên mới nào?',
            'type' => 'text',
            'default_answers' => 'TAM VAN LE',
            'tips' => '{"What": "là gì", "New name": "tên mới"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q36->id,]);

        $question7 = $q37 = Question::create([
            'category_id' => 3,
            'content' => 'Is the <strong>name</strong> on your <strong>green card</strong> the <strong>same</strong> as your current legal name?',
            'translation' => 'Tên trên thẻ xanh của bạn có giống với tên hợp pháp hiện tại không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Name": "tên", "Green card": "thẻ xanh", "Same": "giống", "suggestion": "Nếu chọn No, cung cấp thêm tên khác với trên thẻ xanh."}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q37->id,]);

        Answer::create([
            'question_id' => $q37->id,
            'content' => 'No',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Tên khác với trên thẻ xanh',
        ]);


        Answer::create([
            'question_id' => $q37->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question8 = $q40 = Question::create([
            'category_id' => 3,
            'content' => '<strong>When</strong> is <strong>your birthday</strong>?',
            'translation' => 'Sinh nhật của bạn là ngày nào?',
            'type' => 'text',
            'default_answers' => 'January 1, 1990',
            'tips' => '{"When": "khi nào", "Your birthday": "sinh nhật của bạn"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q40->id,]);

        $question9 = $q41 = Question::create([
            'category_id' => 3,
            'content' => '<strong>When</strong> did you become a <strong>lawful permanent resident</strong>?',
            'translation' => 'Bạn trở thành thường trú nhân hợp pháp vào ngày nào?',
            'type' => 'text',
            'default_answers' => 'January 1, 2020',
            'tips' => '{"When": "khi nào", "Lawful permanent resident": "thường trú nhân"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q41->id,]);

        $question10 = $q42 = Question::create([
            'category_id' => 3,
            'content' => '<strong>Where</strong> were you <strong>born</strong>?',
            'translation' => 'Bạn sinh ra ở đâu?',
            'type' => 'text',
            'default_answers' => 'Vietnam',
            'tips' => '{"Where": "ở đâu", "Were born": "được sinh ra"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q42->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q42->id,]);

        $question11 = $q43 = Question::create([
            'category_id' => 3,
            'content' => '<strong>What</strong> is your <strong>nationality</strong>?',
            'translation' => 'Quốc tịch hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Vietnam',
            'tips' => '{"What": "là gì", "Nationality": "quốc tịch"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q43->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q43->id,]);

        $question12 = $q44 = Question::create([
            'category_id' => 3,
            'content' => 'Was your <strong>father</strong> or <strong>mother</strong> a <strong>U.S. citizen</strong> before your 18th birthday?',
            'translation' => 'Ba hoặc mẹ của bạn có phải là công dân Mỹ trước khi bạn 18 tuổi không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Father": "ba", "Mother": "mẹ", "U.S. citizen": "công dân Mỹ"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q44->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q44->id,]);

        Answer::create([
            'question_id' => $q44->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q44->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question13 = $q47 = Question::create([
            'category_id' => 3,
            'content' => 'Do you have a physical or developmental <strong>disability</strong> or <strong>mental impairment</strong> that prevents you from taking the English or civics test?',
            'translation' => 'Bạn có bị khuyết tật thể chất, phát triển, hoặc suy giảm tâm thần nào khiến bạn không thể tham gia bài thi tiếng Anh hoặc bài thi công dân không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Disability": "khuyết tật", "Mental impairment": "suy giảm trí tuệ"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q47->id,]);

        Answer::create([
            'question_id' => $q47->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q47->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Chỉ chọn nếu bạn bị suy giảm trí tuệ hoặc có khuyết tật thể chất ảnh hưởng đến khả năng học và thi quốc tịch.',
        ]);


        $question14 = $q50 = Question::create([
            'category_id' => 3,
            'content' => 'Do you want us to <strong>update</strong> your immigration status with <strong>Social Security</strong> when you\'re naturalized?',
            'translation' => 'Bạn có muốn cập nhật tình trạng di trú với Cơ quan An sinh Xã hội sau khi nhập tịch không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Update": "cập nhật", "Social Security": "An sinh Xã hội"}',
        ]);


        Answer::create([
            'question_id' => $q50->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q50->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question15 = $q53 = Question::create([
            'category_id' => 3,
            'content' => 'What is your <strong>Social Security Number</strong> (SSN)?',
            'translation' => 'Số An sinh Xã hội của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'answer_note' => 'Bạn có thể tự nhớ câu trả lời mà không cần nhập',
            'tips' => '{"Social Security Number": "số An sinh Xã hội"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q53->id,]);

        $question16 = $q54 = Question::create([
            'category_id' => 3,
            'content' => 'What is your <strong>sex</strong>?',
            'translation' => 'Giới tính của bạn là gì?',
            'type' => 'multiple_choice',
            'default_answers' => 'Male',
            'tips' => '{"Your sex": "giới tính"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q54->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q54->id,]);

        Answer::create([
            'question_id' => $q54->id,
            'content' => 'Male',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q54->id,
            'content' => 'Female',
            'is_correct' => true,
            'has_audio' => true,
        ]);

        // ----- END: PART 3 ----

        // ----- START: PART 4 ----
        // 1. Are you Hispanic or Latino?
        $question1 = $q57 = Question::create([
            'category_id' => 4,
            'content' => 'Are you <strong>Hispanic</strong> or <strong>Latino</strong>?',
            'translation' => 'Bạn có phải là người gốc Tây Ban Nha hoặc Mỹ Latin không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Hispanic":"người gốc Tây Ban Nha","Latino":"người gốc Mỹ Latin"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q57->id,]);

        Answer::create([
            'question_id' => $q57->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q57->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Chỉ chọn nếu bạn là người gốc Tây Ban Nha hay Mỹ Latin.'
        ]);


        // 2. How tall are you?
        $question2 = $q60 = Question::create([
            'category_id' => 4,
            'content' => 'How <strong>tall</strong> are you?',
            'translation' => 'Bạn cao bao nhiêu?',
            'type' => 'text',
            'default_answers' => '... feet ... inches',
            'tips' => '{"Tall":"cao","Feet":"đơn vị đo chiều cao/chiều dài","Inch":"đơn vị đo chiều cao/chiều dài"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q60->id,]);

        // 3. What color are your eyes?
        $question3 = $q61 = Question::create([
            'category_id' => 4,
            'content' => 'What <strong>color</strong> are your <strong>eyes</strong>?',
            'translation' => 'Màu mắt của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Black / Brown',
            'tips' => '{"Color":"màu","Eyes":"mắt"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q61->id,]);

        // 4. What color is your hair?
        $question4 = $q62 = Question::create([
            'category_id' => 4,
            'content' => 'What <strong>color</strong> is your <strong>hair</strong>?',
            'translation' => 'Màu tóc của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Black',
            'tips' => '{"Color":"màu","Hair":"tóc"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q62->id,]);

        // 5. How much do you weigh?
        $question5 = $q63 = Question::create([
            'category_id' => 4,
            'content' => 'How much do you <strong>weigh</strong>?',
            'translation' => 'Cân nặng của bạn là bao nhiêu?',
            'type' => 'text',
            'default_answers' => '...pounds',
            'tips' => '{"Weigh":"cân nặng"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q63->id,]);

        // 6. What is your race?
        $question6 = $q64 = Question::create([
            'category_id' => 4,
            'content' => 'What is your <strong>race</strong>?',
            'translation' => 'Chủng tộc của bạn là gì?',
            'type' => 'text',
            'default_answers' => 'Asian',
            'tips' => '{"Race":"chủng tộc"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q64->id,]);
        // ----- END: PART 4 ----

        // ----- START: PART 5 ----
        $question1 = $q65 = Question::create([
            'category_id' => 5,
            'content' => '<strong>Where</strong> do you currently <strong>live</strong>?',
            'translation' => 'Bạn hiện tại đang sống ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Live": "sống"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q65->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q65->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q65->id,]);

        $question2 = $q66 = Question::create([
            'category_id' => 5,
            'content' => '<strong>How long</strong> have you <strong>lived</strong> there?',
            'translation' => 'Bạn đã sống ở đó bao lâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How long": "bao lâu", "Live": "sống"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q66->id,]);

        $question3 = $q67 = Question::create([
            'category_id' => 5,
            'content' => '<strong>Where</strong> have you <strong>lived</strong> during the last <strong>5 years</strong> (or <strong>3 years</strong>)?',
            'translation' => 'Bạn đã sống ở đâu trong suốt 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Live": "sống", "The last 5 years / 3 years": "5 năm qua / 3 năm qua"}',
        ]);

        // ----- END: PART 5 ----

        // ----- START: PART 6 ----
        $question1 = $q68 = Question::create([
            'category_id' => 6,
            'content' => 'What is your current <strong>marital status</strong>?',
            'translation' => 'Tình trạng hôn nhân hiện tại của bạn là gì?',
            'type' => 'multiple_choice',
            'default_answers' => 'Married',
            'tips' => '{"Marital status": "tình trạng hôn nhân"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q68->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q68->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q68->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q68->id,]);

        Answer::create([
            'question_id' => $q68->id,
            'content' => 'Single, never married',
            'explanation' => 'độc thân, chưa từng kết hôn',
            'is_correct' => true,
            'skip_to_category' => 8,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q68->id,
            'content' => 'Married',
            'explanation' => 'đã kết hôn',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q68->id,
            'content' => 'Divorced',
            'explanation' => 'đã ly hôn',
            'is_correct' => true,
            'skip_to_question' => 3,
        ]);


        Answer::create([
            'question_id' => $q68->id,
            'content' => 'Widowed',
            'explanation' => 'góa vợ/chồng',
            'is_correct' => true,
            'skip_to_question' => 3,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q68->id,
            'content' => 'Separated',
            'explanation' => 'ly thân',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q68->id,
            'content' => 'Marriage annulled',
            'explanation' => 'hủy hôn (hôn nhân không hợp lệ)',
            'is_correct' => true,
            'skip_to_question' => 3,
            'has_audio' => true,
        ]);


        $question2 = $q75 = Question::create([
            'category_id' => 6,
            'content' => 'If you are currently married, is your <strong>spouse</strong> a current member of the <strong>U.S. armed forces</strong>?',
            'translation' => 'Nếu bạn đang kết hôn, vợ/chồng bạn có đang là thành viên trong quân đội Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Spouse": "vợ/chồng", "U.S. armed forces": "quân đội Mỹ"}',
        ]);


        Answer::create([
            'question_id' => $q75->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q75->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question3 = $q78 = Question::create([
            'category_id' => 6,
            'content' => '<strong>How many times</strong> have you been <strong>married</strong>?',
            'translation' => 'Bạn đã kết hôn mấy lần?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How many times": "mấy lần", "Married": "kết hôn"}',
        ]);

        // ----- END: PART 6 ----

        // ----- START: PART 6b ----
        $question1 = $q79 = Question::create([
            'category_id' => 7,
            'content' => 'What is the <strong>name</strong> of your current <strong>spouse</strong>?',
            'translation' => 'Tên người vợ/chồng hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "Spouse": "vợ/chồng"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q79->id,]);

        $question2 = $q80 = Question::create([
            'category_id' => 7,
            'content' => 'What is your current <strong>spouse’s date of birth</strong>?',
            'translation' => 'Ngày sinh của người vợ/chồng hiện tại là gì?',
            'type' => 'text',
            'default_answers' => 'January 02, 1990',
            'tips' => '{"Spouse": "vợ/chồng", "Date of birth": "ngày sinh"}',
        ]);


        $question3 = $q81 = Question::create([
            'category_id' => 7,
            'content' => 'What is the <strong>date</strong> you <strong>entered into marriage</strong> with your current <strong>spouse</strong>?',
            'translation' => 'Bạn đã kết hôn với người vợ/chồng hiện tại vào ngày nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Date": "ngày", "Enter into marriage": "kết hôn", "Spouse": "vợ/chồng"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q81->id,]);

        $question4 = $q82 = Question::create([
            'category_id' => 7,
            'content' => 'Is your current <strong>spouse’s</strong> present physical <strong>address</strong> the <strong>same</strong> as your physical address?',
            'translation' => 'Vợ/chồng của bạn có đang sống cùng địa chỉ với bạn không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Spouse": "vợ/chồng", "Address": "địa chỉ đang ở hiện tại", "Same": "giống"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q82->id,]);

        Answer::create([
            'question_id' => $q82->id,
            'content' => 'No',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Cung cấp địa chỉ khác mà vợ/chồng bạn đang sống.',
        ]);


        Answer::create([
            'question_id' => $q82->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question5 = $q85 = Question::create([
            'category_id' => 7,
            'content' => '<strong>When</strong> did your current <strong>spouse</strong> become a <strong>U.S. citizen</strong>?',
            'translation' => 'Vợ/chồng bạn trở thành công dân Mỹ bằng cách nào?',
            'type' => 'multiple_choice',
            'default_answers' => 'By birth',
            'tips' => '{"When": "khi nào", "Spouse": "vợ/chồng", "U.S. citizen": "công dân Mỹ"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q85->id,]);

        Answer::create([
            'question_id' => $q85->id,
            'content' => 'By birth',
            'is_correct' => true,
            'skip_to_question' => 7,
            'has_audio' => true
        ]);


        Answer::create([
            'question_id' => $q85->id,
            'content' => 'Other',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Nhập ngày',
        ]);


        $question6 = $q88 = Question::create([
            'category_id' => 7,
            'content' => 'What is your current <strong>spouse’s alien registration number</strong>?',
            'translation' => 'Số A của vợ/chồng hiện tại là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Spouse": "vợ/chồng", "Alien registration number": "số đăng ký người nước ngoài, số A"}',
            'answer_note' => 'Bạn có thể tự ghi nhớ câu trả lời',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q88->id,]);

        $question7 = $q89 = Question::create([
            'category_id' => 7,
            'content' => '<strong>How many times</strong> has your current <strong>spouse</strong> been <strong>married</strong>?',
            'translation' => 'Vợ/chồng hiện tại của bạn đã kết hôn mấy lần?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How many times": "mấy lần", "Spouse": "vợ/chồng", "Marry": "kết hôn"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q89->id,]);

        $question8 = $q90 = Question::create([
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
        $question1 = $q91 = Question::create([
            'category_id' => 8,
            'content' => '<strong>How many children</strong> do you have?',
            'translation' => 'Bạn có bao nhiêu người con?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How many": "bao nhiêu", "Children": "những người con"}',
            'skip_to_category' => 9,
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q91->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q91->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q91->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q91->id,]);

        $question2 = $q92 = Question::create([
            'category_id' => 8,
            'content' => 'What is the <strong>name</strong> of your <strong>child</strong>?',
            'translation' => 'Tên của con bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "Child": "con"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q92->id,]);

        $question3 = $q93 = Question::create([
            'category_id' => 8,
            'content' => 'Where was your <strong>child born</strong>?',
            'translation' => 'Con của bạn được sinh ra ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Child": "con", "Born": "được sinh ra"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q93->id,]);

        $question4 = $q94 = Question::create([
            'category_id' => 8,
            'content' => 'Where does your <strong>child</strong> currently <strong>live</strong>?',
            'translation' => 'Con của bạn hiện đang sống ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Live": "sống"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q94->id,]);

        $question5 = $q95 = Question::create([
            'category_id' => 8,
            'content' => 'Is your child your <strong>biological child</strong>, <strong>stepchild</strong>, or <strong>adopted child</strong>?',
            'translation' => 'Con của bạn là con ruột, con riêng hay con nuôi?',
            'type' => 'multiple_choice',
            'default_answers' => '',
            'tips' => '{"Biological child": "con ruột", "Stepchild": "con riêng", "Adopted child": "con nuôi"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q95->id,]);

        Answer::create([
            'question_id' => $q95->id,
            'content' => 'Biological child',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q95->id,
            'content' => 'Stepchild',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q95->id,
            'content' => 'Adopted child',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        $question6 = $q99 = Question::create([
            'category_id' => 8,
            'content' => '<strong>When</strong> is your child\'s <strong>birthday</strong>?',
            'translation' => 'Sinh nhật con bạn là khi nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"When": "khi nào", "Birthday": "sinh nhật"}',
        ]);


        $question7 = $q100 = Question::create([
            'category_id' => 8,
            'content' => 'Is your <strong>child</strong> a <strong>U.S. citizen</strong>?',
            'translation' => 'Con của bạn có phải công dân Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Child": "con", "U.S. citizen": "công dân Mỹ"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q100->id,]);

        Answer::create([
            'question_id' => $q100->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q100->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question8 = $q103 = Question::create([
            'category_id' => 8,
            'content' => 'Are you providing <strong>support</strong> for your <strong>child</strong>?',
            'translation' => 'Bạn có chu cấp cho con bạn không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Support": "chu cấp, hỗ trợ", "Child": "con"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q103->id,]);

        Answer::create([
            'question_id' => $q103->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Nếu không chu cấp cho con, thường trú nhân có thể bị cho là không có tư cách đạo đức tốt.',
        ]);


        Answer::create([
            'question_id' => $q103->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // ----- END: PART 7 ----

        // ----- START: PART 8 ----
        $question1 = $q106 = Question::create([
            'category_id' => 9,
            'content' => 'Are you currently <strong>employed</strong> or <strong>attending school</strong>?',
            'translation' => 'Hiện tại bạn đang đi làm hay đi học?',
            'type' => 'multiple_choice',
            'default_answers' => 'I am currently employed',
            'tips' => '{"Employed": "đi làm", "Attending school": "đi học"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q106->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q106->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q106->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q106->id,]);

        Answer::create([
            'question_id' => $q106->id,
            'content' => 'I am currently employed',
            'explanation' => 'Tôi hiện đang đi làm',
            'is_correct' => true,
            'has_audio' => true,
        ]);


        Answer::create([
            'question_id' => $q106->id,
            'content' => 'I am attending school',
            'explanation' => 'Tôi hiện đang đi học',
            'is_correct' => true,
            'skip_to_question' => 7,
            'has_audio' => true,
        ]);


        $question2 = $q109 = Question::create([
            'category_id' => 9,
            'content' => 'What is your <strong>current occupation</strong>?',
            'translation' => 'Nghề nghiệp hiện tại của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Current": "hiện tại", "Occupation": "nghề nghiệp"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q109->id,]);

        $question3 = $q110 = Question::create([
            'category_id' => 9,
            'content' => 'What is the <strong>name</strong> of the <strong>company</strong> or <strong>business</strong> you work for?',
            'translation' => 'Công ty bạn đang làm tên gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "Company, business": "công ty, doanh nghiệp"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q110->id,]);

        $question4 = $q111 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> is your <strong>workplace</strong> located?',
            'translation' => 'Nơi làm việc của bạn ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Workplace": "nơi làm việc"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q111->id,]);

        $question5 = $q112 = Question::create([
            'category_id' => 9,
            'content' => '<strong>How long</strong> have you <strong>worked</strong> at this <strong>company</strong>?',
            'translation' => 'Bạn làm việc ở công ty này bao lâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"How long": "bao lâu", "Work": "làm việc", "Company": "công ty"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q112->id,]);

        // TODO: SKIP
        $question6 = $q113 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> have you <strong>worked</strong> in <strong>the last 5 years (or 3 years)</strong>?',
            'translation' => 'Bạn đã làm ở đâu trong 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Work": "làm việc", "The last 5 years / 3 years": "5 năm qua / 3 năm qua"}',
            'skip_to_category' => 10
        ]);


        $question7 = $q114 = Question::create([
            'category_id' => 9,
            'content' => '<strong>What</strong> are you <strong>studying</strong>?',
            'translation' => 'Bạn đang học gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"What": "là gì", "Study": "học"}',
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q114->id,]);

        $question8 = $q115 = Question::create([
            'category_id' => 9,
            'content' => 'What is the <strong>name</strong> of the <strong>school</strong>?',
            'translation' => 'Tên trường của bạn là gì?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Name": "tên", "School": "trường"}',
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q115->id,]);

        $question9 = $q116 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> is the <strong>school</strong> located at?',
            'translation' => 'Trường của bạn ở đâu?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Shool": "trường"}',
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q116->id,]);

        $question10 = $q117 = Question::create([
            'category_id' => 9,
            'content' => '<strong>When</strong> did you <strong>start school</strong>?',
            'translation' => 'Bạn bắt đầu học ở trường từ khi nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"When": "khi nào", "Start school": "bắt đầu học"}',
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q117->id,]);

        $question11 = $q118 = Question::create([
            'category_id' => 9,
            'content' => '<strong>Where</strong> have you <strong>studied</strong> in the <strong>last 5 years (or 3 years)</strong>?',
            'translation' => 'Bạn đã học ở đâu trong vòng 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => '{"Where": "ở đâu", "Study": "học", "The last 5 years / 3 years": "5 năm qua / 3 năm qua"}',
        ]);

        // ----- END: PART 8 ----

        // ----- START: PART 9 ----
        $question1 = $q119 = Question::create([
            'category_id' => 10,
            'content' => '<strong>How many times</strong> have you <strong>left</strong> the <strong>United States</strong> in the past 5 years (or 3 years)?',
            'translation' => 'Bạn đã rời khỏi Mỹ bao nhiêu lần trong 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => "{\"How many times\": \"mấy lần\", \"Leave/left\": \"rời khỏi\", \"United States\": \"Mỹ\"}",
            'skip_to_category' => 10,
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q119->id,]);

        $question2 = $q120 = Question::create([
            'category_id' => 10,
            'content' => 'Did any of your <strong>trips abroad</strong> last <strong>6 months</strong> or longer?',
            'translation' => 'Có chuyến đi ra nước ngoài nào của bạn kéo dài từ 6 tháng trở lên không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => "{\"Trip\": \"chuyến đi\", \"Abroad\": \"nước ngoài\", \"6 months\": \"từ 6 tháng\"}",
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q120->id,]);

        Answer::create([
            'question_id' => $q120->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q120->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        $question3 = $q123 = Question::create([
            'category_id' => 10,
            'content' => 'Which <strong>countries</strong> did you <strong>visit</strong>?',
            'translation' => 'Bạn đã đi đến các quốc gia nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => "{\"Countries\": \"quốc gia\", \"Visit\": \"ghé thăm, đi đến\"}",
        ]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q123->id,]);

        $question4 = $q124 = Question::create([
            'category_id' => 10,
            'content' => '<strong>When</strong> was your last trip <strong>outside the United States</strong>?',
            'translation' => 'Chuyến đi ra nước ngoài gần nhất của bạn là khi nào?',
            'type' => 'text',
            'default_answers' => '',
            'tips' => "{\"When\": \"khi nào\", \"Outside the United States\": \"ngoài nước Mỹ\"}",
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q124->id,]);

        $question5 = $q125 = Question::create([
            'category_id' => 10,
            'content' => 'Do you remember the <strong>day</strong> you <strong>returned</strong> to the <strong>United States</strong>?',
            'translation' => 'Bạn có nhớ ngày bạn quay lại Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => "{\"Day\": \"ngày\", \"Return\": \"quay lại\", \"United States\": \"Mỹ\"}",
        ]);


        Answer::create([
            'question_id' => $q125->id,
            'content' => 'No',
            'is_correct' => true,
        ]);


        Answer::create([
            'question_id' => $q125->id,
            'content' => 'Yes',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Nhập ngày quay lại Mỹ',
        ]);

        // ----- END: PART 9 ----

        // ----- START: PART 10 ----
        $this->call(N400QuestionPart10Seeder::class);
        // ----- END: PART 10 ----

        // ----- START: PART 11 ----
        $q = $q128 = Question::create([
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
        QuestionSet::create(['set_number' => 1,            'question_id' => $q128->id,]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q128->id,]);
        QuestionSet::create(['set_number' => 3,            'question_id' => $q128->id,]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q128->id,]);
        Answer::create([
            'question_id' => $q128->id,
            'content' => 'No',
            'is_correct' => true,
            'skip_to_category' => -1,
        ]);

        Answer::create([
            'question_id' => $q128->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);


        // Câu 2
        $q = $q131 = Question::create([
            'category_id' => 12,
            'content' => 'What is your total household income?',
            'translation' => 'Tổng thu nhập của hộ gia đình bạn là bao nhiêu?',
            'type' => 'text',
            'tips' => json_encode([
                'Total household income' => 'tổng thu nhập hộ gia đình',
            ]),
        ]);
        QuestionSet::create(['set_number' => 1,            'question_id' => $q131->id,]);

        // Câu 3
        $q = $q132 = Question::create([
            'category_id' => 12,
            'content' => 'How many people are in your household?',
            'translation' => 'Hộ gia đình của bạn có bao nhiêu người?',
            'type' => 'text',
            'tips' => json_encode([
                'How many people' => 'bao nhiêu người',
                'Household' => 'hộ gia đình',
            ]),
        ]);
        QuestionSet::create(['set_number' => 2,            'question_id' => $q132->id,]);

        // Câu 4
        $q = $q133 = Question::create([
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
        QuestionSet::create(['set_number' => 3,            'question_id' => $q133->id,]);

        // Câu 5
        $q = $q134 = Question::create([
            'category_id' => 12,
            'content' => 'Are you the head of household?',
            'translation' => 'Bạn có phải là chủ hộ không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Head of household' => 'chủ hộ',
            ]),
        ]);
        QuestionSet::create(['set_number' => 4,            'question_id' => $q134->id,]);
        Answer::create([
            'question_id' => $q134->id,
            'content' => 'No',
            'is_correct' => true,
        ]);

        Answer::create([
            'question_id' => $q134->id,
            'content' => 'Yes',
            'is_correct' => true,
            'skip_to_category' => -1
        ]);


        // Câu 6
        $q = $q137 = Question::create([
            'category_id' => 12,
            'content' => 'What is the name of the head of household?',
            'translation' => 'Tên của chủ hộ là gì?',
            'type' => 'text',
        ]);

        // ----- END: PART 11 ----

    }
}
