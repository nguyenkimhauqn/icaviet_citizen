<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class N400QuestionPart10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $question_1 = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER claimed to be a U.S. citizen (in writing or any other way)?',
            'translation' => 'Bạn đã từng tự nhận mình là công dân Mỹ chưa (bằng văn bản hoặc bằng bất kỳ cách nào khác)?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Claim": "tự nhận, khẳng định", "U.S. citizen": "công dân Mỹ"}'
        ]);
        Answer::create([
            'question_id' => $question_1->id,
            'content' => 'No',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $question_1->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Nếu tự nhận là công dân Mỹ, thường trú nhân có thể vi phạm luật di trú.'
        ]);

        Question::create([
            'category_id' => 11,
            'content' => 'What is “claim”?',
            'translation' => '“Tự nhận” là gì?',
            'type' => 'text',
            'default_answers' => 'To say something is true',
            'default_answers_pronunciation' => 'tu say sâm-thing i-(s) tru'
        ]);

        Question::create([
            'category_id' => 11,
            'content' => 'What is “claim to be a U.S. citizen”?',
            'translation' => '“Tự nhận là công dân Mỹ” là gì?',
            'type' => 'text',
            'default_answers' => 'To state you are a U.S. citizen',
            'default_answers_pronunciation' => 'tu s-tay-(t) diu a ờ diu-ét-(s) si-ti-giần'
        ]);

        $question_4 = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER registered to vote or voted in any Federal, state, or local election in the United States?',
            'translation' => 'Bạn đã từng đăng ký để bỏ phiếu hoặc đi bỏ phiếu trong bất kỳ cuộc bầu cử Liên bang, tiểu bang, hay địa phương nào ở Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Vote": "bỏ phiếu", "Election": "bầu cử"}'
        ]);
        Answer::create([
            'question_id' => $question_4->id,
            'content' => 'No',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $question_4->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Nếu tự bỏ phiếu mà chưa được cho phép, thường trú nhân có thể vi phạm luật di trú.'
        ]);

        Question::create([
            'category_id' => 11,
            'content' => 'What does “vote” mean?',
            'translation' => '“Bỏ phiếu” có nghĩa là gì?',
            'type' => 'text',
            'default_answers' => 'To choose new leaders.',
            'default_answers_pronunciation' => 'tu chu-(s) niu li-dờ-(s)',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'To elect new leaders.', 'vi' => 'Là bầu cử lãnh đạo mới']
                ]
            ])
        ]);

        $question_6 = Question::create([
            'category_id' => 11,
            'content' => 'Do you owe any overdue Federal, state, or local taxes?',
            'translation' => 'Bạn có đang nợ thuế quá hạn ở cấp liên bang, tiểu bang hoặc địa phương không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Owe": "nợ", "Overdue": "quá hạn", "Tax": "thuế"}'
        ]);
        Answer::create([
            'question_id' => $question_6->id,
            'content' => 'No',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $question_6->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Nếu không có lý do hợp lý, thường trú nhân nợ thuế quá hạn mà chưa giải quyết có thể ảnh hưởng đến việc xin quốc tịch.'
        ]);

        Question::create([
            'category_id' => 11,
            'content' => 'What is “owe”?',
            'translation' => '“Nợ” có nghĩa là gì?',
            'type' => 'text',
            'default_answers' => 'To not pay yet.',
            'default_answers_pronunciation' => 'tu nót pay dét-(t)',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'To have a debt.', 'vi' => 'Là có nợ']
                ]
            ])
        ]);

        Question::create([
            'category_id' => 11,
            'content' => 'Do you know “owe taxes”?',
            'translation' => 'Bạn có biết “nợ thuế” là gì không?',
            'type' => 'text',
            'default_answers' => 'To not pay money to the government yet.',
            'default_answers_pronunciation' => 'tu nót pay mân-ni tu đờ gỏ-vơ-mần-(t) dét-(t)',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'To owe the government money.', 'vi' => 'Là nợ tiền chính phủ']
                ]
            ])
        ]);

        Question::create([
            'category_id' => 11,
            'content' => 'What does “overdue” mean?',
            'translation' => '“Quá hạn” là gì?',
            'type' => 'text',
            'default_answers' => 'To past a deadline.',
            'default_answers_pronunciation' => 'tu pát-s-(t) ờ đét-lai',
        ]);

        $q =  Question::create([
            'category_id' => 11,
            'content' => 'Do you always file your taxes?',
            'translation' => 'Bạn có luôn luôn khai thuế hàng năm không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Always": "luôn luôn", "File your taxes": "khai thuế"}'

        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân không khai thuế hằng năm mà không có lý do hợp lý thì có thể ảnh hưởng đến việc xin quốc tịch.'

        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 4
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Since you became a lawful permanent resident, have you called yourself a “nonresident alien” on a Federal, state, or local tax return or decided not to file a tax return because you considered yourself to be a nonresident?',
            'translation' => 'Kể từ khi bạn trở thành thường trú nhân, bạn có từng khai mình là “người không cư trú” trong hồ sơ thuế liên bang, tiểu bang, địa phương, hoặc quyết định không khai thuế vì nghĩ mình không cư trú không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Nonresident alien": "người không cư trú", "Not to file a tax return": "không khai thuế"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân tự khai là “người không cư trú” để tránh thuế thì có thể bị coi là gian lận thuế.'
        ]);

        // Câu 4.a - Giải thích
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Can you explain what “file a tax return” means?',
            'translation' => 'Bạn có thể giải thích “nộp hồ sơ khai thuế” là gì không?',
            'default_answers' => 'To send tax paperwork to the government',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu sen-(d) tát-(s) pay-pờ-quớt-(k) tu đờ gó-vơ-mần-(t)',
        ]);

        // Câu 5
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been a member of, or in any way associated with The Communist Party, any other totalitarian party anywhere in the world?',
            'translation' => 'Bạn đã từng là thành viên hoặc có liên hệ với Đảng Cộng sản hoặc bất kỳ đảng toàn trị nào trên thế giới chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Communist Party": "Đảng Cộng sản", "Totalitarian party": "đảng toàn trị"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 5.a - Giải thích
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Can you explain what “Communist Party” means?',
            'translation' => 'Bạn có thể giải thích “Đảng Cộng sản” là gì không?',
            'default_answers' => 'Like China, North Korea',
            'type' => 'text',
            'default_answers_pronunciation' => 'lai-(k) chai-nờ, no-th cờ-ri-à'
        ]);

        // Câu 5.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “totalitarian”?',
            'translation' => '“Chế độ độc tài toàn trị” là gì?',
            'default_answers' => 'The government controls everything and people have no power.',
            'type' => 'text',
            'default_answers_pronunciation' => 'đờ gó-vơ-mần-(t) cần-trô-(s) e-v-ri-thinh èn pi-pồ ha-(v) nâu pao-quờ'
        ]);

        // Câu 6
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER advocated opposition to all organized governments?',
            'translation' => 'Bạn đã từng kêu gọi chống lại tất cả các chính phủ có tổ chức chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Opposition": "chống lại", "Governments": "chính phủ"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in world communism?',
            'translation' => 'Bạn đã từng tham gia vào phong trào cộng sản quốc tế chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Communism": "Cộng sản"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in the establishment in the United States of a totalitarian dictatorship?',
            'translation' => 'Bạn đã từng tham gia việc thiết lập một chế độ độc tài toàn trị tại Hoa Kỳ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Totalitarian": "độc tài"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.c
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER supported the overthrow of the U.S. government by force or violence or other unconstitutional means?',
            'translation' => 'Bạn đã từng ủng hộ việc lật đổ chính phủ Hoa Kỳ bằng vũ lực, bạo lực, hoặc bằng các cách trái hiến pháp chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Overthrow": "lật đổ chính phủ"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.d
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “overthrow”?',
            'translation' => '“Lật đổ chính quyền” là gì?',
            'default_answers' => 'To remove a government from power',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu ri-mu-(v) a gó-vơ-mần-(t) ph-rom pao-quờ'
        ]);

        // Câu 6.e
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER supported the unlawful assaulting or killing of any officer or officers of the Government because of their official character?',
            'translation' => 'Bạn đã từng ủng hộ việc hành hung hoặc giết người làm việc cho chính phủ chỉ vì họ là nhân viên chính phủ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Assaulting": "hành hung", "Killing": "giết"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.f
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “assault”?',
            'translation' => '“Hành hung” có nghĩa là gì?',
            'default_answers' => 'To hurt someone',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu hớt-(t) sâm-quan'
        ]);

        // Câu 6.g
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in unlawful damage or destruction of property?',
            'translation' => 'Bạn đã từng tham gia phá hoại hoặc tàn phá tài sản một cách bất hợp pháp chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Damage": "phá hoại", "Destruction": "tàn phá"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.h
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER committed or supported sabotage?',
            'translation' => 'Bạn đã từng thực hiện hoặc ủng hộ hành vi phá hoại có chủ đích chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Sabotage": "phá hoại có chủ đích"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 6.i
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What does “sabotage” mean?',
            'translation' => '“Phá hoại có chủ đích” là gì?',
            'default_answers' => 'To destroy something on purpose.',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu đì-s-troi sâm-thinh on pơ-pợt-(s)'
        ]);

        // Câu 7
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER used a weapon or explosive with intent to harm another person or cause damage to property?',
            'translation' => 'Bạn đã từng sử dụng vũ khí hoặc chất nổ với mục đích làm hại người khác hoặc phá hoại tài sản chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Weapon": "vũ khí", "Explosive": "chất nổ"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 7.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is a “weapon”?',
            'translation' => '“Vũ khí” là gì?',
            'default_answers' => 'Like a knife or gun',
            'type' => 'text',
            'default_answers_pronunciation' => 'lai-(k) ờ k-nai-(ph) o gân'
        ]);

        // Câu 7.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “explosive”?',
            'translation' => '“Chất nổ” là gì?',
            'default_answers' => 'Like bomb or TNT',
            'type' => 'text',
            'default_answers_pronunciation' => 'lai-(k) bom-(b) o ti-en-ti'
        ]);

        // Câu 8
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER engaged in kidnapping, assassination, or hijacking or sabotage of an airplane, ship, vehicle, or other mode of transportation?',
            'translation' => 'Bạn đã từng tham gia bắt cóc, ám sát, cướp, phá hoại máy bay, tàu, phương tiện giao thông chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Kidnapping": "bắt cóc", "Assassination": "ám sát", "Hijacking": "cướp phương tiện"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 8.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “kidnapping”?',
            'translation' => '“Bắt cóc” là gì?',
            'default_answers' => 'To take someone away by force.',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu tay-(k) sâm-quan ờ-quay bai phót-(s)'
        ]);

        // Câu 8.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “assassination”?',
            'translation' => '“Ám sát” là gì?',
            'default_answers' => 'To kill someone important, like a president or a leader.',
            'type' => 'text',
            'default_answers_pronunciation' => 'Tu kiu sâm-quan im-pó-tần-(t), lai-(k) a p-ré-gi-đềnh-(t) o ờ li-đờ'
        ]);

        // Câu 8.c
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “hijacking”?',
            'translation' => '“Cướp phương tiện” là gì?',
            'default_answers' => 'To take control of a vehicle by force.',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu tay-(k) cân-trô-(l) ọp ờ vi-hi-cồ bai phót-(s)'
        ]);

        // Câu 9
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in torture?',
            'translation' => 'Bạn đã từng liên quan hoặc tham gia vào hành vi tra tấn chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Torture": "tra tấn"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 9.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What does “torture” mean?',
            'translation' => '“Tra tấn” nghĩa là gì?',
            'default_answers' => 'To hurt someone',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu hớt-(t) sâm-quan'
        ]);

        // Câu 9.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in genocide?',
            'translation' => 'Bạn có bao giờ từng liên quan đến tội diệt chủng không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Genocide": "diệt chủng"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 9.c
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What does “genocide” mean?',
            'translation' => '“Diệt chủng” là gì?',
            'default_answers' => 'To kill a whole race',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu kiu a hâu ray-(s)'
        ]);

        // Câu 9.d
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in killing or trying to kill any person?',
            'translation' => 'Bạn có bao giờ từng liên quan đến việc giết người hoặc cố gắng giết người không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Kill": "giết"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 9.e
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in badly hurting or trying to hurt a person on purpose?',
            'translation' => 'Bạn có bao giờ từng cố ý làm bị thương nặng hoặc cố gắng làm bị thương người khác không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Hurt": "tổn hại"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 9.f
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in forcing or trying to force someone to have any kind of sexual contact?',
            'translation' => 'Bạn có bao giờ từng ép buộc hoặc cố gắng ép buộc ai đó tiếp xúc tình dục dưới bất kỳ hình thức nào không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Sexual contact": "tiếp xúc tình dục"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 9.g
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER not let someone practice his or her religion?',
            'translation' => 'Bạn có bao giờ từng ngăn cản người khác thực hành tôn giáo của họ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Practice religion": "thực hành tôn giáo"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 9.h
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been involved in causing harm or suffering to any person because of their race, religion, national origin, membership in a particular social group, or political opinion?',
            'translation' => 'Bạn đã từng làm hại hay tổn thương người khác vì họ khác chủng tộc, tôn giáo, quốc tịch hoặc ý kiến chính trị chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Causing harm": "làm hại", "Suffering": "gây tổn thương"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 10
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted (helped), or participated in any military or police unit?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ hoặc tham gia vào quân đội hoặc đơn vị cảnh sát nào chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Military": "quân đội", "Police": "cảnh sát"}',
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thêm tên đơn vị (the name of the military unit), cấp bậc (rank), thời gian tham gia (your dates of involvement).'
        ]);

        // Câu 10.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is a “military unit”?',
            'translation' => '“Đơn vị quân đội” là gì?',
            'default_answers' => 'A group of soldiers.',
            'type' => 'text',
            'default_answers_pronunciation' => 'ờ g-rúp ọp sâu-chờ-(s)'
        ]);

        // Câu 11
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted, or participated in a paramilitary unit?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào đơn vị bán quân sự?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Paramilitary unit": "đơn vị bán quân sự"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 11.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is a “paramilitary unit”?',
            'translation' => '“Đơn vị bán quân sự” là gì?',
            'default_answers' => 'Not official army',
            'type' => 'text',
            'default_answers_pronunciation' => 'nót óp-phi-sồ a-r-mi'
        ]);

        // Câu 11.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted, or participated in a self-defense unit?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào đơn vị tự vệ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Self-defense unit": "đơn vị tự vệ"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 11.c
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted, or participated in a vigilante unit?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào đơn vị dân phòng tự phát?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Vigilante unit": "dân phòng tự phát"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 11.d (trùng nội dung 11.c)
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted, or participated in a vigilante unit?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào đơn vị dân phòng tự phát?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Vigilante unit": "dân phòng tự phát"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 11.e
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted, or participated in a rebel group?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào nhóm nổi loạn không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Rebel group": "nhóm nổi loạn"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 11.f
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in, been a member of, assisted, or participated in a guerrilla group?',
            'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào nhóm du kích không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Guerrilla group": "nhóm du kích"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 12
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER worked, volunteered, or otherwise served in a place where people were detained, for example, a prison, jail, prison camp, detention facility, or labor camp or have you EVER directed or participated in any other activity that involved detaining people?',
            'translation' => 'Bạn đã từng làm việc, tình nguyện, hoặc phục vụ tại nơi giam giữ người như nhà tù, trại giam,... hay tham gia vào các hoạt động khác liên quan đến việc giam giữ người chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => '{"Prison, jail": "trại giam, nhà tù"}'
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Nếu đã từng làm việc trong trại giam, bạn cần chứng minh mình không ngược đãi người khác hoặc vi phạm nhân quyền.'
        ]);

        // Câu 12.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “prison or jail”?',
            'translation' => '“Trại giam, nhà tù” là gì?',
            'default_answers' => 'A place where prisoners are kept.',
            'type' => 'text',
            'default_answers_pronunciation' => 'ờ p-lay-(s) que p-ri-sân-nờ-(s) a kép-(t)',
        ]);

        // Câu 12.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “detained”?',
            'translation' => '“Bị giam giữ” là gì?',
            'default_answers' => 'Kept in a place by police',
            'type' => 'text',
            'default_answers_pronunciation' => 'kép-(t) in ờ p-lay-(s) bai po-li-(s)',
            'tips' => json_encode([
                'another_answer_way' => [
                    [
                        'en' => 'Held in custody by police',
                        'vi' => 'Bị cảnh sát giữ lại trong trại giam',
                    ]
                ]
            ])
        ]);

        // Câu 13
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Were you EVER a part of any group, did you EVER help any you, unit, or organization that used a weapon against any person, or threatened to do so?',
            'translation' => 'Bạn có từng tham gia hoặc giúp đỡ bất kỳ nhóm nào đã dùng vũ khí để làm hại người khác hoặc đe dọa sẽ làm như vậy chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Weapon' => 'vũ khí'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là không có tư cách đạo đức tốt (ngoại trừ thực hiện theo lệnh của chính phủ).'
        ]);

        // Câu 14
        $q = Question::create([
            'category_id' => 11,
            'content' => 'When you were part of this group, or when you helped this group, did you ever use a weapon against another person?',
            'translation' => 'Khi bạn tham gia hoặc hỗ trợ nhóm đó, bạn có sử dụng vũ khí để làm hại ai đó không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Weapon' => 'vũ khí'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là không có tư cách đạo đức tốt (ngoại trừ thực hiện theo lệnh của chính phủ).'
        ]);

        // Câu 15
        $q = Question::create([
            'category_id' => 11,
            'content' => 'When you were part of this group, or when you helped this group, did you ever threaten another person that you would use a weapon against that person?',
            'translation' => 'Khi bạn tham gia hoặc hỗ trợ nhóm đó, bạn có đe dọa người khác rằng bạn sẽ sử dụng vũ khí để làm hại người đó không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Weapon' => 'vũ khí'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là không có tư cách đạo đức tốt (ngoại trừ thực hiện theo lệnh của chính phủ).'
        ]);

        // Câu 16
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER sold, provided, or transported weapons, or assisted any person in selling, providing, or transporting weapons, which you knew or believed would be used against another person?',
            'translation' => 'Bạn đã từng làm hoặc giúp đỡ người khác bán, cung cấp, hoặc vận chuyển vũ khí mà bạn biết rằng những vũ khí đó sẽ được dùng để làm hại người khác chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Transport' => 'vận chuyển',
                'Weapon' => 'vũ khí'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 17
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER received any weapons training, paramilitary training, or other military-type training?',
            'translation' => 'Bạn đã từng được huấn luyện sử dụng vũ khí, huấn luyện bán quân sự, hoặc bất kỳ loại huấn luyện kiểu quân sự nào chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Weapons training' => 'huấn luyện sử dụng vũ khí'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 17.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Can you explain what “weapon training” is?',
            'translation' => '“Huấn luyện sử dụng vũ khí” là gì?',
            'default_answers' => 'To learn how to use guns',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu lơn hao tu diu gân-(s)'
        ]);

        // Câu 17.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What does “military-type training” mean?',
            'translation' => '“Huấn luyện kiểu quân sự” là gì?',
            'default_answers' => 'To train like soldiers',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu tren lai-(k) sâu-chờ-(s'
        ]);

        // Câu 18
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER recruited (asked), enlisted (signed up), conscripted (required to join), or used any person under 15 years of age to serve in or help an armed group, or attempted or worked with others to do so?',
            'translation' => 'Bạn đã từng tuyển, ép buộc, rủ rê, hay sử dụng bất kỳ người nào dưới 15 tuổi để phục vụ hoặc hỗ trợ một nhóm vũ trang chưa? Hoặc bạn có từng cố gắng làm việc đó, hoặc hợp tác với người khác để làm việc đó không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Under 15' => 'dưới 15',
                'Armed group' => 'nhóm vũ trang'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 18.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is an “armed group”?',
            'translation' => '“Nhóm vũ trang” là gì?',
            'default_answers' => 'A group of people with weapons.',
            'type' => 'text',
            'default_answers_pronunciation' => 'ờ g-rúp ợp pi-pồ quít-(th) que-pần-(s)'
        ]);

        // Câu 19
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER used any person under 15 years of age to take part in hostilities or attempted or worked with others to do so? This could include participating in combat or providing services related to combat (such as serving as a messenger or transporting supplies).',
            'translation' => 'Bạn đã từng hoặc giúp người khác lợi dụng trẻ em dưới 15 tuổi để tham gia vào các hoạt động thù địch chưa? (Ví dụ như tham gia chiến đấu, làm người đưa tin, hoặc vận chuyển tiếp tế.)',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Under 15' => 'dưới 15',
                'Hostility' => 'hành động thù địch',
                'Combat' => 'chiến đấu'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 19.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “combat”?',
            'translation' => '“Chiến đấu” là gì?',
            'default_answers' => 'To fight in a war',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu phai-(t) in ờ quo-(r)'
        ]);

        // Câu 20
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER committed, agreed to commit, asked someone else to commit, helped commit, or tried to commit a crime or offense for which you were NOT arrested?',
            'translation' => 'Bạn đã từng thực hiện, đồng ý thực hiện, xúi giục người khác thực hiện, giúp đỡ, hoặc cố gắng thực hiện một tội danh mà bạn KHÔNG bị bắt chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Commit a crime' => 'phạm tội',
                'Arrested' => 'bị bắt'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Nếu từng phạm tội nhưng chưa bị bắt, thường trú nhân vẫn có thể bị xem là không có đạo đức tốt.'
        ]);

        // Câu 20.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “crime”?',
            'translation' => '“Tội phạm” là gì?',
            'default_answers' => 'The action that breaks the law',
            'type' => 'text',
            'default_answers_pronunciation' => 'đì ác-sần đát-(t) b-rây-(k) đờ lo'
        ]);

        // Câu 20.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “commit a crime”?',
            'translation' => '“Phạm tội” là gì?',
            'default_answers' => 'To do something that breaks the law',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu đu sâm-thinh đát b-ray-k-(s) đờ lo'
        ]);

        // Câu 20.c
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What does “arrested” mean?',
            'translation' => '“Bị bắt” là gì?',
            'default_answers' => 'Kept in custody by the police',
            'type' => 'text',
            'default_answers_pronunciation' => 'kép-(t) in cớt-s-tơ-đi bai đờ po-li-(s)'
        ]);

        // Câu 20.d
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “offense”?',
            'translation' => '“Hành vi phạm tội nhẹ” là gì?',
            'default_answers' => 'A minor crime',
            'type' => 'text',
            'default_answers_pronunciation' => 'ờ mai-nờ c-ram'
        ]);

        // Câu 21
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been arrested, cited, detained or confined by any law enforcement officer, military official (in the U.S. or elsewhere), or immigration official for any reason, or been charged with a crime or offense?',
            'translation' => 'Bạn đã từng bị bắt, bị vé phạt, bị tạm giữ hoặc giam giữ bởi cảnh sát, quân đội, hoặc nhân viên di trú (ở Mỹ hoặc nước khác) vì bất kỳ lý do nào chưa, hoặc đã từng bị buộc tội vi phạm pháp luật chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Arrested' => 'bị bắt',
                'Cited' => 'bị vé phạt',
                'Confined' => 'bị giam giữ, bị giới hạn trong một khu vực'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'additional_answer_placeholder' => 'Cung cấp tội danh (crime), ngày phạm tội (date of the crime), án tù (sentence)...'
        ]);

        // Câu 21.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “cited”?',
            'translation' => '“Bị vé phạt” là gì?',
            'default_answers' => 'Given a ticket by police',
            'type' => 'text',
            'default_answers_pronunciation' => 'gi-vân ờ tít-kịt bai po-li-(s)'
        ]);

        // Câu 21.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “confined”?',
            'translation' => '“Bị giam giữ/bị giới hạn trong một khu vực” là gì?',
            'default_answers' => 'Locked in a place',
            'type' => 'text',
            'default_answers_pronunciation' => 'lót-k-(t) in ờ p-lay-(s)',
            'tips' => json_encode([
                'another_answer_way' => [
                    ['en' => 'To restrict', 'vi' => 'Bị giới hạn', 'is_best_answer' => false]
                ]
            ])
        ]);

        // Câu 22
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER received a suspended sentence, been placed on probation, or been paroled?',
            'translation' => 'Bạn đã từng nhận án treo, bị quản chế, hoặc được tạm tha chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Suspended sentence' => 'án treo',
                'Probation' => 'quản chế',
                'Parole' => 'tạm tha'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Chỉ chọn Yes nếu đã từng nhận án treo, bị quản chế, hoặc được tạm tha'
        ]);

        // Câu 23
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER engaged in prostitution, attempted to procure or import prostitutes or persons for the purpose of prostitution, or received any proceeds or money from prostitution?',
            'translation' => 'Bạn đã từng hành nghề mại dâm, từng cố gắng môi giới hoặc đưa người vào Mỹ để hành nghề mại dâm, hoặc từng nhận tiền hay lợi ích từ hoạt động mại dâm chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Prostitution' => 'mại dâm'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là không có tư cách đạo đức tốt.'
        ]);

        // Câu 23.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is a “prostitute”?',
            'translation' => '“Người bán dâm” là gì?',
            'default_answers' => 'A person who has sex for money.',
            'type' => 'text',
            'default_answers_pronunciation' => 'ờ pơ-sần hu ha-(s) sét-(s) pho mân-ni'
        ]);

        // Câu 23.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is a “procure”?',
            'translation' => '“Môi giới” là gì?',
            'default_answers' => 'To find a prostitute for someone',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu phai-(d) ờ p-ró-s-ti-tiu-(t) pho sâm-quan'
        ]);

        // Câu 24
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER manufactured, cultivated, produced, distributed, dispensed, sold, or smuggled (trafficked) any controlled substances, illegal drugs, narcotics, or drug paraphernalia in violation of any law or regulation of a U.S. state, the United States, or a foreign country?',
            'translation' => 'Bạn đã từng sản xuất, trồng, chế biến, phân phối, phát tán, buôn bán, hoặc buôn lậu bất kỳ chất bị kiểm soát, ma túy, chất gây nghiện, hoặc dụng cụ dùng cho ma túy nào vi phạm luật của tiểu bang, chính phủ Mỹ, hoặc của một quốc gia khác chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Illegal drugs, narcotics' => 'chất cấm, ma túy'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là không có tư cách đạo đức tốt.'
        ]);

        // Câu 24.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “illegal drug and narcotics”?',
            'translation' => '“Chất cấm, ma túy” là gì?',
            'default_answers' => 'Like heroin',
            'type' => 'text',
            'default_answers_pronunciation' => 'lai-(k) he-râu-in'
        ]);

        // Câu 24.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “drug paraphernalia”?',
            'translation' => '“Đồ dùng ma túy” là gì?',
            'default_answers' => 'Things used for illegal drugs',
            'type' => 'text',
            'default_answers_pronunciation' => 'thinh-(s) diu-s-(d) pho ì-li-gồ d-rớt-(s)'
        ]);

        // Câu 25
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been married to more than one person at the same time?',
            'translation' => 'Bạn đã từng kết hôn với nhiều hơn một người trong cùng một lúc chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Marry' => 'kết hôn',
                'More than one person' => 'kết hôn với nhiều hơn 1 người',
                'At the same time' => 'cùng lúc'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị xem là vi phạm luật hôn nhân một vợ một chồng.'
        ]);

        // Câu 26
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER married someone in order to obtain an immigration benefit?',
            'translation' => 'Bạn đã bao giờ kết hôn với ai đó với mục đích nhận quyền lợi di trú chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Marry' => 'kết hôn',
                'Immigration benefit' => 'quyền lợi di trú'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị xem là vi phạm luật di trú.'
        ]);

        // Câu 26.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “immigration benefit”?',
            'translation' => '“Quyền lợi di trú” là gì?',
            'default_answers' => 'Like a visa, green card or citizenship',
            'type' => 'text',
            'default_answers_pronunciation' => 'lai-(k) ờ vi-sờ, g-rin ca-(d), o si-ti-giần-síp'
        ]);

        // Câu 27
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER helped anyone to enter, or try to enter, the United States illegally?',
            'translation' => 'Bạn đã từng giúp đỡ ai đó vào hoặc cố gắng vào nước Mỹ bất hợp pháp chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Enter the United States illegally' => 'vào Mỹ bất hợp pháp'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị xem là vi phạm luật di trú.']);

        // Câu 28
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER gambled illegally or received income from illegal gambling?',
            'translation' => 'Bạn đã từng đánh bạc bất hợp pháp hoặc từng nhận thu nhập từ hoạt động đánh bạc bất hợp pháp chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode(['Gamble' => 'đánh bạc'])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là không có tư cách đạo đức tốt.']);

        // Câu 28.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “gamble”?',
            'translation' => '“Đánh bạc” là gì?',
            'type' => 'text',
            'default_answers' => 'To play games for money',
            'default_answers_pronunciation' => 'tu p-lay gem-(s) pho mân-ni',
        ]);

        // Câu 29
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER failed to support your dependents (pay child support) or to pay alimony (court-ordered financial support after divorce or separation)?',
            'translation' => 'Bạn đã từng không chu cấp cho người phụ thuộc của mình (không trả tiền nuôi con), hoặc không trả tiền trợ cấp theo phán quyết của tòa sau khi ly hôn hoặc ly thân chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode(['Pay alimony' => 'trả tiền cấp dưỡng cho vợ/chồng cũ sau ly hôn'])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị xem là không có tư cách đạo đức tốt.']);

        // Câu 29.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “pay alimony”?',
            'translation' => '”Trả tiền cấp dưỡng” là gì?',
            'type' => 'text',
            'default_answers' => 'To give money to ex-spouse after divorce',
            'default_answers_pronunciation' => 'tu gi-(v) mân-ni tu ịt-s-pao-(s)',
        ]);

        // Câu 30
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER made any misrepresentation to obtain any public benefit in the United States?',
            'translation' => 'Bạn đã từng khai gian hoặc cung cấp thông tin sai sự thật để nhận bất kỳ phúc lợi công cộng nào ở Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Misrepresentation' => 'thông tin sai sự thật',
                'Public benefit' => 'phúc lợi công cộng'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị đánh giá là gian lận chính phủ để nhận phúc lợi.']);

        // 30.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “public benefit”?',
            'translation' => '“Phúc lợi công cộng” là gì?',
            'type' => 'text',
            'default_answers' => 'Government helps like money and food stamps.',
            'default_answers_pronunciation' => 'go-vơ-mân-(t) hép-(s) lai-(k) mân-ni èn phu-(d) s-tem-p-(s)',
        ]);

        // 31
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER given any U.S. Government officials any information or documentation that was false, fraudulent, or misleading?',
            'translation' => 'Bạn đã từng cung cấp cho viên chức chính phủ Mỹ bất kỳ thông tin hoặc giấy tờ nào sai sự thật, gian lận, hoặc gây hiểu lầm chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'false' => 'sai',
                'fraudulent' => 'gian lận'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // 31.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Do you know what is “false”?',
            'translation' => 'Bạn có biết “sai” là gì không?',
            'type' => 'text',
            'default_answers' => 'Not true',
            'default_answers_pronunciation' => 'nót tru',
        ]);

        // 31.b
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Do you know what is “fraudulent”?',
            'translation' => 'Bạn có biết “gian lận” là gì không?',
            'type' => 'text',
            'default_answers' => 'To lie',
            'default_answers_pronunciation' => 'tu lai',
        ]);

        // 32
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER lied to any U.S. Government officials to gain entry or admission into the United States or to gain immigration benefits while in the United States?',
            'translation' => 'Bạn đã từng nói dối với bất kỳ viên chức chính phủ nào để được vào Mỹ, hoặc để nhận quyền lợi di trú khi đang ở Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Lie' => 'nói dối',
                'Immigration benefit' => 'quyền lợi di trú'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // 33
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been placed in removal, rescission, or deportation proceedings?',
            'translation' => 'Bạn đã từng bị đưa vào thủ tục thu hồi tình trạng di trú hoặc thủ tục trục xuất khỏi Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Deportation proceedings' => 'thủ tục trục xuất'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // 33.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “deportation proceedings”?',
            'translation' => '“Thủ tục trục xuất” là gì?',
            'type' => 'text',
            'default_answers' => 'Process of sending someone out of the U.S.',
            'default_answers_pronunciation' => 'p-ró-sẹt-(s) ọp sen-đinh sâm-quan ao-(t) of đờ diu-ét-(s)',
        ]);

        // 34
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been removed or deported from the United States?',
            'translation' => 'Bạn đã từng bị trục xuất hoặc bị buộc rời khỏi Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Remove, deport' => 'trục xuất'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // 35
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you a male who lived in the United States at any time between your 18th and 26th birthdays?',
            'translation' => 'Bạn có phải là nam giới đã từng sống tại Mỹ vào bất kỳ thời điểm nào trong khoảng từ 18 đến 26 tuổi?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Male' => 'nam giới',
                '18th and 26th birthdays' => 'trong khoảng từ 18 đến 26 tuổi'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // 36
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Did you register for the Selective Service?',
            'translation' => 'Bạn đã đăng ký với Quân vụ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => json_encode(['Selective Service' => 'Quân vụ'])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true, 'warning' => 'Thường trú nhân đủ điều kiện nhưng không đăng ký Quân vụ có thể bị xem là không có tư cách đạo đức tốt.']);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // 37
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Provide information about your registration (Date Registered, Selective Service Number)',
            'translation' => 'Cung cấp thông tin về việc đăng ký Quân vụ (ngày đăng ký, số Quân vụ)',
            'type' => 'text'
        ]);

        // 38
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER left the United States to avoid being drafted in the U.S. armed forces?',
            'translation' => 'Bạn đã từng rời khỏi Mỹ để tránh bị gọi nhập ngũ vào quân đội chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Avoid' => 'tránh',
                'Be drafted in the U.S. armed forces' => 'bị gọi nhập ngũ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị xem không có tư cách đạo đức tốt.']);

        // 38.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the meaning of “drafted”?',
            'translation' => '“Gọi nhập ngũ” là gì?',
            'type' => 'text',
            'default_answers' => 'Being selected as a soldier',
            'default_answers_pronunciation' => 'bi-inh si-lét-tịt át-(s) ờ sâu-chờ'
        ]);

        // 39
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER applied for and received exemption from military service in the U.S. armed forces?',
            'translation' => 'Bạn đã từng nộp đơn và được miễn nghĩa vụ quân sự trong quân đội chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Exemption' => 'miễn trừ',
                'Military service' => 'nghĩa vụ quân sự',
                'U.S. armed forces' => 'quân đội Mỹ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 40
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER served in the U.S. armed forces?',
            'translation' => 'Bạn đã từng phục vụ trong quân đội Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Serve' => 'phục vụ',
                'U.S. armed forces' => 'quân đội Mỹ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 41
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you currently a member of the U.S. armed forces?',
            'translation' => 'Hiện tại, bạn có phải là thành viên của quân đội Mỹ không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Currently' => 'hiện tại',
                'Member' => 'thành viên',
                'U.S. armed forces' => 'quân đội Mỹ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 42
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you scheduled to deploy outside the United States, including to a vessel, within the next 3 months?',
            'translation' => 'Bạn có lịch trình được điều động ra ngoài Hoa Kỳ, bao gồm lên tàu quân sự, trong vòng 3 tháng tới không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Deploy' => 'điều động, gửi đi làm nhiệm vụ',
                'Outside the United States' => 'ngoài Mỹ',
                'Next 3 months' => '3 tháng tới'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 43
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you currently stationed outside the United States?',
            'translation' => 'Hiện tại, bạn có đang đóng quân ở ngoài nước Mỹ không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Currently' => 'hiện tại',
                'Station' => 'đóng quân',
                'Outside the United States' => 'ngoài Mỹ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 44
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you a former U.S. military service member who is currently residing outside of the U.S.?',
            'translation' => 'Bạn có phải là cựu quân nhân Mỹ hiện đang sinh sống ở ngoài nước Mỹ không?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Former U.S. military service member' => 'cựu quân nhân Mỹ',
                'Currently' => 'hiện tại',
                'Reside' => 'sinh sống',
                'Outside of the U.S.' => 'bên ngoài Mỹ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 45
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been court-martialed or have you received a discharge characterized as other than honorable, bad conduct, or dishonorable, while in the U.S. armed forces?',
            'translation' => 'Bạn đã từng bị tòa án quân sự xét xử, hoặc từng nhận quyết định xuất ngũ với hình thức không danh dự, hạnh kiểm xấu, hoặc xuất ngũ không danh dự trong thời gian phục vụ quân đội Mỹ chưa?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Discharge' => 'xuất ngũ',
                'Bad conduct' => 'hạnh kiểm xấu',
                'Dishonorable' => 'không danh dự'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER been discharged from training or service in the U.S. armed forces because you were an alien?',
            'translation' => 'Bạn đã từng bị cho xuất ngũ khỏi chương trình huấn luyện hoặc phục vụ trong quân đội Hoa Kỳ vì lý do bạn là người nước ngoài chưa?',
            'type' => 'multiple_choice',
            'tips' => json_encode([
                'Discharge' => 'xuất ngũ',
                'U.S. armed forces' => 'quân đội Mỹ',
                'Alien' => 'người nước ngoài'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);

        // Câu 47
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Have you EVER deserted from the U.S. armed forces?',
            'translation' => 'Bạn đã từng đào ngũ khỏi quân đội Mỹ chưa?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Desert' => 'đào ngũ, tự ý rời bỏ quân ngũ',
                'U.S. armed forces' => 'quân đội Mỹ'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'warning' => 'Thường trú nhân có liên quan đến các hành vi trên có thể bị xem không có tư cách đạo đức tốt.']);

        // Câu 48
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Do you now have, or did you EVER have, a hereditary title or an order of nobility in any foreign country?',
            'translation' => 'Hiện tại bạn có, hoặc trước đây bạn đã từng có, tước vị thừa kế hoặc danh hiệu quý tộc ở bất kỳ quốc gia nào khác ngoài Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Hereditary title' => 'tước vị thừa kế',
                'Order of nobility' => 'danh hiệu quý tộc'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true, 'additional_answer_placeholder' => 'Cung cấp chức vị']);

        // Câu 48.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is a “hereditary title”?',
            'translation' => '“Tước vị thừa kế” là gì?',
            'type' => 'text',
            'default_answers' => 'A royal title, like prince or princess',
            'default_answers_pronunciation' => 'ờ roi-ồ tai-tồ, lai-(k) p-rin-(s) or p-rin-sẹt-(s)'
        ]);

        // Câu 49
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you willing to give up any inherited titles or orders of nobility that you have in a foreign country at your naturalization ceremony?',
            'translation' => 'Bạn có sẵn sàng từ bỏ bất kỳ tước vị thừa kế hoặc danh hiệu quý tộc nào mà bạn có ở quốc gia khác trong buổi lễ nhập quốc tịch không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => json_encode([
                'Give up' => 'từ bỏ',
                'Order of nobility' => 'danh hiệu quý tộc'
            ])
        ]);
        Answer::create(['question_id' => $q->id, 'content' => 'Yes', 'is_correct' => true]);
        Answer::create(['question_id' => $q->id, 'content' => 'No', 'is_correct' => true, 'warning' => 'Thường trú nhân không sẵn sàng từ bỏ tước vị ở quốc gia khác có thể bị cho là không trung thành với Mỹ.']);

        // Câu 50
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Do you support the Constitution and form of Government of the United States?',
            'translation' => 'Bạn có ủng hộ Hiến pháp và hình thức chính quyền của Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => json_encode([
                'Support' => 'ủng hộ',
                'Constitution' => 'Hiến pháp'
            ]),
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân không ủng hộ Hiến pháp và chính quyền Mỹ có thể không đủ điều kiện nhập tịch.'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 51
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Do you understand the full Oath of Allegiance to the United States?',
            'translation' => 'Bạn có hiểu đầy đủ nội dung Lời tuyên thệ trung thành với Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => json_encode([
                'Understand' => 'hiểu',
                'Oath of Allegiance' => 'Lời Tuyên thệ Trung thành'
            ]),
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân cần hiểu và chấp nhận lời tuyên thệ để trở thành công dân Mỹ.'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 51.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is the “Oath of Allegiance”?',
            'translation' => '“Lời Tuyên thệ Trung thành” là gì?',
            'type' => 'text',
            'default_answers' => 'A promise to be loyal to the United states',
            'default_answers_pronunciation' => 'ờ p-ró-mịt-(s) tu bi loi-ồ tu đờ diu-nai-tịt s-tây-(s)'
        ]);

        // Câu 52
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you unable to take the Oath of Allegiance because of a physical or developmental disability or mental impairment?',
            'translation' => 'Bạn không thể thực hiện Lời Tuyên thệ Trung thành vì bị khuyết tật thể chất, khuyết tật phát triển, hoặc suy giảm năng lực tâm thần đúng không?',
            'type' => 'multiple_choice',
            'default_answers' => 'No',
            'tips' => json_encode([
                'Oath of Allegiance' => 'Lời Tuyên thệ Trung thành',
                'Physical or developmental disability' => 'khuyết tật thể chất, khuyết tật phát triển'
            ]),
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
            'warning' => 'Chỉ chọn nếu bạn có bệnh hoặc khuyết tật ảnh hưởng đến khả năng học và thi quốc tịch.'
        ]);

        // Câu 53
        $q = Question::create([
            'category_id' => 11,
            'content' => 'Are you willing to take the full Oath of Allegiance to the United States?',
            'translation' => 'Bạn có sẵn sàng thực hiện đầy đủ Lời Tuyên thệ Trung thành với Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => json_encode([
                'Willing to take' => 'sẵn sàng thực hiện',
                'Oath of Allegiance' => 'Lời Tuyên thệ Trung thành'
            ]),
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân cần sẵn sàng thực hiện lời tuyên thệ để trở thành công dân Mỹ.'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true,
        ]);

        // Câu 54
        $q = Question::create([
            'category_id' => 11,
            'content' => 'If the law requires it, are you willing to bear arms (carry weapons) on behalf of the United States?',
            'translation' => 'Nếu được yêu cầu, bạn có sẵn sàng cầm vũ khí vì nước Mỹ không?',
            'type' => 'multiple_choice',
            'default_answers' => 'Yes',
            'tips' => '{"Bear arms (carry weapons)": "cầm vũ khí", "On behalf of the United States": "vì nước Mỹ"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân cần trung thành và sẵn sàng phục vụ quốc gia khi cần thiết.'
        ]);

        // Câu 54.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What is “bear arm”?',
            'translation' => '“Cầm vũ khí” là gì?',
            'default_answers' => 'To own or use a gun',
            'type' => 'text',
            'default_answers_pronunciation' => 'tu on o diu-(s) ờ gân'
        ]);

        // Câu 55
        $q = Question::create([
            'category_id' => 11,
            'content' => 'If the law requires it, are you willing to perform noncombatant services (do something that does not include fighting in a war) in the U.S. armed forces?',
            'translation' => 'Nếu được yêu cầu, bạn có sẵn sàng thực hiện các nhiệm vụ không chiến đấu trong quân đội Mỹ không?',
            'type' => 'multiple_choice',
            'tips' => '{"Noncombatant services": "nhiệm vụ không chiến đấu", "U.S. armed forces": "quân đội Mỹ"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân cần trung thành và sẵn sàng phục vụ quốc gia khi cần thiết.'
        ]);

        // Câu 55.a
        $q = Question::create([
            'category_id' => 11,
            'content' => 'What does “noncombatant service” mean?',
            'translation' => '“Nhiệm vụ không chiến đấu” là gì?',
            'default_answers' => 'Support the army, but no fighting.',
            'type' => 'text',
            'default_answers_pronunciation' => 'sờ-pót-(t) đì a-r-mi, bớt nâu phai-đinh'
        ]);

        // Câu 56
        $q = Question::create([
            'category_id' => 11,
            'content' => 'If the law requires it, are you willing to perform work of national importance under civilian direction?',
            'translation' => 'Nếu được yêu cầu, bạn có sẵn sàng thực hiện công việc có tầm quan trọng quốc gia dưới sự chỉ đạo của cơ quan dân sự không?',
            'type' => 'multiple_choice',
            'tips' => '{"Perform work of national importance": "công việc phục vụ lợi ích quốc gia", "Under civilian direction": "dưới sự chỉ đạo của cơ quan dân sự"}'
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $q->id,
            'content' => 'No',
            'is_correct' => true,
            'warning' => 'Thường trú nhân cần trung thành và sẵn sàng phục vụ quốc gia khi cần thiết.'
        ]);
    }
}
