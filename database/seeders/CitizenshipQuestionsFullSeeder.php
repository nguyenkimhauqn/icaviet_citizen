<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerHint;
use Illuminate\Support\Facades\Schema;

class CitizenshipQuestionsFullSeeder extends Seeder
{
    public function run()
    {
        // Tắt kiểm tra khóa ngoại tạm thời
        Schema::disableForeignKeyConstraints();
        // Xóa dữ liệu cũ
        AnswerHint::truncate();
        Answer::truncate();
        Question::truncate();
        // Bật lại kiểm tra khóa ngoại
        Schema::enableForeignKeyConstraints();
        // Nạp dữ liệu từ file
        $questions = require database_path('data/citizenship_question.php');

        foreach ($questions as $index => $data) {
            $number = sprintf('%02d', $index + 1);

            $question = Question::create([
                'content' =>  $number . ". " . $data['question'],
                'audio_path' => "civics-question-{$number}.mp3",
                'topic_id' => 1,
            ]);

            $correctAnswer = Answer::create([
                'question_id' => $question->id,
                'content' => $data['correct_answers'][0],
                'is_correct' => true,
                'audio_path' => "civics-answer-{$number}.mp3",
            ]);

            // Nếu có đáp án đúng phụ (hint)
            foreach (array_slice($data['correct_answers'], 1) as $hintContent) {
                AnswerHint::create([
                    'answer_id' => $correctAnswer->id,
                    'content' => $hintContent,
                ]);
            }

            // Các đáp án sai
            $wrongAnswers = [];
            foreach ($data['incorrect_answers'] as $wrongContent) {
                $wrongAnswers[] = new Answer([
                    'question_id' => $question->id,
                    'content' => $wrongContent,
                    'is_correct' => false,
                    'audio_path' => null,
                ]);
            }

            // Shuffle lại đáp án
            $allAnswers = collect([$correctAnswer])->merge($wrongAnswers)->shuffle();

            foreach ($allAnswers as $ans) {
                if (is_object($ans) && !$ans->exists) {
                    $ans->save();
                }
            }
        }
    }
}
