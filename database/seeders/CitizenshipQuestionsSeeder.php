<?php

namespace Database\Seeders;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerHint;
use Illuminate\Database\Seeder;

class CitizenshipQuestionsSeeder extends Seeder
{
    public function run()
    {
        // Câu hỏi 1
        $q1 = Question::create(['content' => 'What is the supreme law of the land?']);
        $a1 = Answer::create(['question_id' => $q1->id, 'content' => 'The Constitution', 'is_correct' => true]);
        Answer::create(['question_id' => $q1->id, 'content' => 'The President', 'is_correct' => false]);
        Answer::create(['question_id' => $q1->id, 'content' => 'Congress', 'is_correct' => false]);

        // Câu hỏi 2
        $q2 = Question::create(['content' => 'What does the Constitution do?']);
        $a2 = Answer::create(['question_id' => $q2->id, 'content' => 'Sets up the government', 'is_correct' => true]);
        AnswerHint::create(['answer_id' => $a2->id, 'content' => 'Defines the government']);
        AnswerHint::create(['answer_id' => $a2->id, 'content' => 'Protects basic rights of Americans']);
        Answer::create(['question_id' => $q2->id, 'content' => 'Creates the military', 'is_correct' => false]);
        Answer::create(['question_id' => $q2->id, 'content' => 'Establishes foreign policy', 'is_correct' => false]);

        // Câu hỏi 3
        $q3 = Question::create(['content' => 'The idea of self-government is in the first three words of the Constitution. What are these words?']);
        $a3 = Answer::create(['question_id' => $q3->id, 'content' => 'We the People', 'is_correct' => true]);
        Answer::create(['question_id' => $q3->id, 'content' => 'In God We Trust', 'is_correct' => false]);
        Answer::create(['question_id' => $q3->id, 'content' => 'E pluribus unum', 'is_correct' => false]);

        // Câu hỏi 4
        $q4 = Question::create(['content' => 'What is an amendment?']);
        $a4 = Answer::create(['question_id' => $q4->id, 'content' => 'A change (to the Constitution)', 'is_correct' => true]);
        AnswerHint::create(['answer_id' => $a4->id, 'content' => 'An addition (to the Constitution)']);
        Answer::create(['question_id' => $q4->id, 'content' => 'A paragraph (in the Constitution)', 'is_correct' => false]);
        Answer::create(['question_id' => $q4->id, 'content' => 'A rule set by the President', 'is_correct' => false]);

        // Câu hỏi 5
        $q5 = Question::create(['content' => 'What do we call the first ten amendments to the Constitution?']);
        $a5 = Answer::create(['question_id' => $q5->id, 'content' => 'The Bill of Rights', 'is_correct' => true]);
        AnswerHint::create(['answer_id' => $a5->id, 'content' => 'The first 10 amendments']);
        Answer::create(['question_id' => $q5->id, 'content' => 'The Articles of Confederation', 'is_correct' => false]);
        Answer::create(['question_id' => $q5->id, 'content' => 'The Declaration of Independence', 'is_correct' => false]);

        // Câu hỏi 6
        $q6 = Question::create(['content' => 'What is one right or freedom from the First Amendment?']);
        $a6 = Answer::create(['question_id' => $q6->id, 'content' => 'Speech', 'is_correct' => true]);
        AnswerHint::create(['answer_id' => $a6->id, 'content' => 'Religion']);
        AnswerHint::create(['answer_id' => $a6->id, 'content' => 'Assembly']);
        AnswerHint::create(['answer_id' => $a6->id, 'content' => 'Press']);
        AnswerHint::create(['answer_id' => $a6->id, 'content' => 'Petition the government']);
        Answer::create(['question_id' => $q6->id, 'content' => 'Voting', 'is_correct' => false]);
        Answer::create(['question_id' => $q6->id, 'content' => 'Owning property', 'is_correct' => false]);

        // Câu hỏi 7
        $q7 = Question::create(['content' => 'How many amendments does the Constitution have?']);
        $a7 = Answer::create(['question_id' => $q7->id, 'content' => 'Twenty-seven (27)', 'is_correct' => true]);
        Answer::create(['question_id' => $q7->id, 'content' => 'Ten (10)', 'is_correct' => false]);
        Answer::create(['question_id' => $q7->id, 'content' => 'Thirty (30)', 'is_correct' => false]);

        // Câu hỏi 8
        $q8 = Question::create(['content' => 'What did the Declaration of Independence do?']);
        $a8 = Answer::create(['question_id' => $q8->id, 'content' => 'Declared our independence from Great Britain', 'is_correct' => true]);
        AnswerHint::create(['answer_id' => $a8->id, 'content' => 'Announced our independence']);
        AnswerHint::create(['answer_id' => $a8->id, 'content' => 'Said that the United States is free']);
        Answer::create(['question_id' => $q8->id, 'content' => 'Established the U.S. Constitution', 'is_correct' => false]);
        Answer::create(['question_id' => $q8->id, 'content' => 'Created the Bill of Rights', 'is_correct' => false]);

        // Câu hỏi 9
        $q9 = Question::create(['content' => 'What are two rights in the Declaration of Independence?']);
        $a9 = Answer::create(['question_id' => $q9->id, 'content' => 'Life', 'is_correct' => true]);
        AnswerHint::create(['answer_id' => $a9->id, 'content' => 'Liberty']);
        AnswerHint::create(['answer_id' => $a9->id, 'content' => 'Pursuit of happiness']);
        Answer::create(['question_id' => $q9->id, 'content' => 'Voting', 'is_correct' => false]);
        Answer::create(['question_id' => $q9->id, 'content' => 'Free healthcare', 'is_correct' => false]);

        // Câu hỏi 10
        $q10 = Question::create(['content' => 'What is freedom of religion?']);
        $a10 = Answer::create(['question_id' => $q10->id, 'content' => 'You can practice any religion, or not practice a religion.', 'is_correct' => true]);
        Answer::create(['question_id' => $q10->id, 'content' => 'You must follow the official state religion.', 'is_correct' => false]);
        Answer::create(['question_id' => $q10->id, 'content' => 'Everyone must practice Christianity.', 'is_correct' => false]);
    }
}
