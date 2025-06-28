<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionN400Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Part 1
        // Question::create(['category_id' => 1, 'content' => 'How are you feeling?', 'translation' => 'Bạn cảm thấy như thế nào?', 'type' => 'text']);
        // Question::create(['category_id' => 1, 'content' => 'Please stand up', 'translation' => 'Vui lòng đứng lên.', 'type' => 'text']);
        // Question::create(['category_id' => 1, 'content' => 'Please raise your right hand.', 'translation' => 'Vui lòng giơ tay phải lên', 'type' => 'text']);
        // Question::create(['category_id' => 1, 'content' => 'Do you promise to tell the truth and nothing but the truth?', 'translation' => 'Bạn có hứa sẽ nói sự thật và chỉ sự thật không?', 'type' => 'text']);
        // Question::create(['category_id' => 1, 'content' => 'You may sit down.', 'translation' => 'Bạn có thể ngồi xuống.', 'type' => 'text']);
        // Question::create(['category_id' => 1, 'content' => 'What is your immigration status?', 'translation' => 'Tình trạng di trú hiện tại của bạn là gì?', 'type' => 'text']);

        // // Part 2
        // $question1 = Question::create([
        //     'category_id' => 2,
        //     'content' => 'What is your basis for applying for naturalization?',
        //     'translation' => 'Bạn nộp đơn thi quốc tịch theo diện nào?',
        //     'type' => 'multiple_choice'
        // ]);

        // Answer::create([
        //     'question_id' => $question1->id,
        //     'content' => 'Green card for over 5 years',
        //     'is_correct' => true
        // ]);

        // Answer::create([
        //     'question_id' => $question1->id,
        //     'content' => 'Spouse of U.S. citizen for 3 years',
        //     'is_correct' => true
        // ]);

        // Answer::create([
        //     'question_id' => $question1->id,
        //     'content' => 'Other reason',
        //     'is_correct' => true
        // ]);

        // Question::create([
        //     'category_id' => 2,
        //     'content' => 'How long have you been in the United States?',
        //     'translation' => 'Bạn đã sống ở Mỹ bao lâu rồi?',
        //     'type' => 'text'
        // ]);

        // // Part 3
        // Question::create([
        //     'category_id' => 3,
        //     'content' => 'What is your full name?',
        //     'translation' => 'Tên đầy đủ của bạn là gì?',
        //     'type' => 'text'
        // ]);
        // $questionOtherNames = Question::create([
        //     'category_id' => 3,
        //     'content' => 'Have you used any other names before?',
        //     'translation' => 'Bạn có sử dụng tên khác trước đây không?',
        //     'type' => 'multiple_choice'
        // ]);
        // Answer::create([
        //     'question_id' => $questionOtherNames->id,
        //     'content' => 'Yes',
        //     'is_correct' => true
        // ]);
        // Answer::create([
        //     'question_id' => $questionOtherNames->id,
        //     'content' => 'No',
        //     'is_correct' => true,
        //     'additional_answer_placeholder' => 'Enter other names'
        // ]);

        // $questionSameName = Question::create([
        //     'category_id' => 3,
        //     'content' => 'Is the name on your green card the same as your current legal name?',
        //     'translation' => 'Tên trên thẻ xanh của bạn có giống với tên hợp pháp hiện tại không?',
        //     'type' => 'multiple_choice'
        // ]);
        // Answer::create([
        //     'question_id' => $questionSameName->id,
        //     'content' => 'Yes',
        //     'is_correct' => true
        // ]);
        // Answer::create([
        //     'question_id' => $questionSameName->id,
        //     'content' => 'No',
        //     'is_correct' => true
        // ]);
        // Question::create([
        //     'category_id' => 3,
        //     'content' => 'When did you become a lawful permanent resident?',
        //     'translation' => 'Bạn trở thành thường trú nhân hợp pháp vào ngày nào?',
        //     'type' => 'text'
        // ]);
        // Question::create([
        //     'category_id' => 3,
        //     'content' => 'What is your nationality?',
        //     'translation' => 'Quốc tịch hiện tại của bạn là gì?',
        //     'type' => 'text'
        // ]);

        // $questionSex = Question::create([
        //     'category_id' => 3,
        //     'content' => 'What is your sex?',
        //     'translation' => 'Giới tính của bạn là gì?',
        //     'type' => 'multiple_choice'
        // ]);
        // Answer::create([
        //     'question_id' => $questionSex->id,
        //     'content' => 'Male',
        //     'is_correct' => true
        // ]);
        // Answer::create([
        //     'question_id' => $questionSex->id,
        //     'content' => 'Female',
        //     'is_correct' => true
        // ]);

        // Part 4
        $questionHispanic = Question::create([
            'category_id' => 4,
            'content' => 'Are you Hispanic or Latino?',
            'translation' => 'Bạn có phải là người gốc Tây Ban Nha hoặc Mỹ Latin không?',
            'type' => 'multiple_choice'
        ]);

        Answer::create([
            'question_id' => $questionHispanic->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);

        Answer::create([
            'question_id' => $questionHispanic->id,
            'content' => 'No',
            'is_correct' => true
        ]);

        // Part 5
        Question::create([
            'category_id' => 5,
            'content' => 'Where do you currently live?',
            'translation' => 'Bạn hiện tại đang sống ở đâu?',
            'type' => 'text'
        ]);

        // Part 6a
        $questionMaritalStatus = Question::create([
            'category_id' => 6,
            'content' => 'What is your current marital status?',
            'translation' => 'Tình trạng hôn nhân hiện tại của bạn là gì?',
            'type' => 'multiple_choice'
        ]);
        foreach (
            [
                'Single, never married',
                'Married',
                'Divorced',
                'Widowed',
                'Separated',
                'Marriage annulled',
            ] as $status
        ) {
            Answer::create([
                'question_id' => $questionMaritalStatus->id,
                'content' => $status,
                'is_correct' => true
            ]);
        }

        $questionSpouseMilitary = Question::create([
            'category_id' => 6,
            'content' => 'If you are currently married, is your spouse a current member of the U.S. armed forces?',
            'translation' => 'Nếu bạn đang kết hôn, vợ/chồng bạn có đang là thành viên trong quân đội Mỹ không?',
            'type' => 'multiple_choice'
        ]);
        Answer::create([
            'question_id' => $questionSpouseMilitary->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $questionSpouseMilitary->id,
            'content' => 'No',
            'is_correct' => true
        ]);

        Question::create([
            'category_id' => 6,
            'content' => 'How many times have you been married?',
            'translation' => 'Bạn đã kết hôn mấy lần?',
            'type' => 'text'
        ]);

        // Part 6b
        Question::create(['category_id' => 7, 'content' => 'What is the name of your current spouse?', 'translation' => 'Tên người vợ/chồng hiện tại của bạn là gì?', 'type' => 'text']);

        // Part 7
        $questionChildrenCount = Question::create([
            'category_id' => 8,
            'content' => 'How many children do you have?',
            'translation' => 'Bạn có bao nhiêu người con?',
            'type' => 'multiple_choice'
        ]);

        Answer::create([
            'question_id' => $questionChildrenCount->id,
            'content' => 0,
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $questionChildrenCount->id,
            'content' => 'Số khác hoặc các trường hợp khác',
            'is_correct' => true
        ]);

        Question::create([
            'category_id' => 8,
            'content' => 'What is the name of your child?',
            'translation' => 'Tên của con bạn là gì?',
            'type' => 'text'
        ]);

        $questionChildCitizen = Question::create([
            'category_id' => 8,
            'content' => 'Is your child a U.S. citizen?',
            'translation' => 'Con của bạn có phải công dân Mỹ không?',
            'type' => 'multiple_choice'
        ]);

        Answer::create([
            'question_id' => $questionChildCitizen->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);

        Answer::create([
            'question_id' => $questionChildCitizen->id,
            'content' => 'No',
            'is_correct' => true
        ]);

        // Part 8
        $questionEmployment = Question::create([
            'category_id' => 9,
            'content' => 'Are you currently employed or attending school?',
            'translation' => 'Hiện tại bạn đang đi làm hay đi học?',
            'type' => 'multiple_choice'
        ]);
        Answer::create([
            'question_id' => $questionEmployment->id,
            'content' => 'I am currently employed',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $questionEmployment->id,
            'content' => 'I am attending school',
            'is_correct' => true
        ]);

        Question::create([
            'category_id' => 9,
            'content' => 'What is your current occupation?',
            'translation' => 'Nghề nghiệp hiện tại của bạn là gì?',
            'type' => 'text'
        ]);

        Question::create([
            'category_id' => 9,
            'content' => 'What are you studying?',
            'translation' => 'Bạn đang học gì?',
            'type' => 'text'
        ]);

        // Part 9
        Question::create(['category_id' => 10, 'content' => 'How many times have you left the United States in the past 5 years (or 3 years)?', 'translation' => 'Bạn đã rời khỏi Mỹ bao nhiêu lần trong 5 năm qua (hoặc 3 năm nếu bạn là vợ/chồng của công dân Mỹ)?', 'type' => 'text']);

        // Part 10
        Question::create(['category_id' => 11, 'content' => 'Have you EVER claimed to be a U.S. citizen (in writing or any other way)?', 'translation' => 'Bạn đã từng tự nhận mình là công dân Mỹ chưa (bằng văn bản hoặc bằng bất kỳ cách nào khác)?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is “claim”?', 'translation' => '“Tự nhận” là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Do you owe any overdue Federal, state, or local taxes?', 'translation' => 'Bạn có đang nợ thuế quá hạn ở cấp liên bang, tiểu bang hoặc địa phương không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is “owe”?', 'translation' => '“Nợ” có nghĩa là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER been a member of, or in any way associated with The Communist Party, any other totalitarian party anywhere in the world?', 'translation' => 'Bạn đã từng là thành viên hoặc có liên hệ với Đảng Cộng sản hoặc bất kỳ đảng toàn trị nào trên thế giới chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Can you explain what “Communist Party” means?', 'translation' => 'Bạn có thể giải thích “Đảng Cộng sản” là gì không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER been involved in torture?', 'translation' => 'Bạn đã từng liên quan hoặc tham gia vào hành vi tra tấn chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What does “torture” mean?', 'translation' => '“Tra tấn” nghĩa là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER served in, been a member of, assisted (helped), or participated in any military or police unit?', 'translation' => 'Bạn đã từng làm hại hay tổn thương người khác vì họ khác chủng tộc, tôn giáo, quốc tịch hoặc ý kiến chính trị chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is a “military unit”?', 'translation' => '“Đơn vị quân đội” là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER served in, been a member of, assisted, or participated in a rebel group?', 'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào nhóm nổi loạn không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER served in, been a member of, assisted, or participated in a guerrilla group?', 'translation' => 'Bạn đã từng phục vụ, là thành viên, hỗ trợ, hay tham gia vào nhóm du kích không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER recruited (asked), enlisted (signed up), conscripted (required to join), or used any person under 15 years of age to serve in or help an armed group, or attempted or worked with others to do so?', 'translation' => 'Bạn đã từng tuyển, ép buộc, rủ rê, hay sử dụng bất kỳ người nào dưới 15 tuổi để phục vụ hoặc hỗ trợ một nhóm vũ trang chưa? Hoặc bạn có từng cố gắng làm việc đó, hoặc hợp tác với người khác để làm việc đó không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is an “armed group”?', 'translation' => '“Nhóm vũ trang” là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER committed, agreed to commit, asked someone else to commit, helped commit, or tried to commit a crime or offense for which you were NOT arrested?', 'translation' => 'Bạn đã từng thực hiện, đồng ý thực hiện, xúi giục người khác thực hiện, giúp đỡ, hoặc cố gắng thực hiện một tội danh mà bạn KHÔNG bị bắt chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is “commit a crime”?', 'translation' => '“Phạm tội” là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER been arrested, cited, detained or confined by any law enforcement officer, military official (in the U.S. or elsewhere), or immigration official for any reason, or been charged with a crime or offense?', 'translation' => 'Bạn đã từng bị bắt, bị vé phạt, bị tạm giữ hoặc giam giữ bởi cảnh sát, quân đội, hoặc nhân viên di trú (ở Mỹ hoặc nước khác) vì bất kỳ lý do nào chưa, hoặc đã từng bị buộc tội vi phạm pháp luật chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is the meaning of “cited”?', 'translation' => '“Bị vé phạt” là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER helped anyone to enter, or try to enter, the United States illegally?', 'translation' => 'Bạn đã từng giúp đỡ ai đó vào hoặc cố gắng vào nước Mỹ bất hợp pháp chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Have you EVER been placed in removal, rescission, or deportation proceedings?', 'translation' => 'Bạn đã từng bị đưa vào thủ tục thu hồi tình trạng di trú hoặc thủ tục trục xuất khỏi Mỹ chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'What is “deportation proceedings”?', 'translation' => '“Thủ tục trục xuất” là gì?', 'type' => 'text']);
        Question::create(['category_id' => 11, 'content' => 'Did you register for the Selective Service?', 'translation' => 'Bạn đã đăng ký với Quân vụ chưa?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Are you currently a member of the U.S. armed forces?', 'translation' => 'Hiện tại, bạn có phải là thành viên của quân đội Mỹ không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Are you a former U.S. military service member who is currently residing outside of the U.S.?', 'translation' => 'Bạn có phải là cựu quân nhân Mỹ hiện đang sinh sống ở ngoài nước Mỹ không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Are you willing to give up any inherited titles or orders of nobility that you have in a foreign country at your naturalization ceremony?', 'translation' => 'Bạn có sẵn sàng từ bỏ bất kỳ tước vị thừa kế hoặc danh hiệu quý tộc nào mà bạn có ở quốc gia khác trong buổi lễ nhập quốc tịch không?', 'type' => 'multiple_choice']);
        Question::create(['category_id' => 11, 'content' => 'Do you support the Constitution and form of Government of the United States?', 'translation' => 'Bạn có ủng hộ Hiến pháp và hình thức chính quyền của Mỹ không?', 'type' => 'multiple_choice']);
        $yesNoQuestions = Question::where('category_id', 11)
            ->where('type', 'multiple_choice')
            ->get();
        // Gán đáp án Yes/No cho mỗi câu
        foreach ($yesNoQuestions as $question) {
            Answer::create([
                'question_id' => $question->id,
                'content' => 'Yes',
                'is_correct' => true
            ]);

            Answer::create([
                'question_id' => $question->id,
                'content' => 'No',
                'is_correct' => true
            ]);
        }

        // Part 11
        $questionIncomeBelowGuideline = Question::create([
            'category_id' => 12,
            'content' => 'Is your household income less than or equal to 400% of the Federal Poverty Guidelines?',
            'translation' => 'Bạn có thu nhập hộ gia đình bằng hoặc thấp hơn 400% Mức chuẩn nghèo liên bang không?',
            'type' => 'multiple_choice'
        ]);
        Answer::create([
            'question_id' => $questionIncomeBelowGuideline->id,
            'content' => 'Yes',
            'is_correct' => true
        ]);
        Answer::create([
            'question_id' => $questionIncomeBelowGuideline->id,
            'content' => 'No',
            'is_correct' => true
        ]);
        Question::create([
            'category_id' => 12,
            'content' => 'What is your total household income?',
            'translation' => 'Tổng thu nhập của hộ gia đình bạn là bao nhiêu?',
            'type' => 'text'
        ]);
    }
}
