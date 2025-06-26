<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerHint;

class CivicTest1Seeder extends Seeder
{
    public function run()
    {
        // Tắt kiểm tra ràng buộc khóa ngoại
        Schema::disableForeignKeyConstraints();
        // Xóa dữ liệu cũ
        AnswerHint::truncate();
        Answer::truncate();
        Question::truncate();
        // Nạp dữ liệu từ file
        Schema::enableForeignKeyConstraints();

        // Load dữ liệu từ file PHP
        $questions = require database_path('data/civictest_full100_format.php');

        foreach ($questions as $index => $data) {
            $number = sprintf('%02d', $index + 1);

            // Tạo câu hỏi
            $question = Question::create([
                'content' => $number . ". " . $data['question'],
                'translation' => $data['translation'] ?? null,
                'tips' => $data['tips'] ?? null,
                'has_guideline' => $data['has_guideline'] ?? null,
                'audio_path' => "civics-question-{$number}.mp3",
                'topic_id' => 1,
            ]);

            // Tạo đáp án đúng chính (câu đầu tiên trong mảng correct_answers)
            $correctData = $data['correct_answers'][0];
            $correctAnswer = Answer::create([
                'question_id' => $question->id,
                'content' => is_array($correctData) ? $correctData['content'] : $correctData,
                'is_correct' => true,
                'audio_path' => "civics-answer-{$number}.mp3",
                'explanation' => is_array($correctData) ? ($correctData['explanation'] ?? null) : null,
                'pronunciation' => is_array($correctData) ? ($correctData['pronunciation'] ?? null) : null,
            ]);

            // Các đáp án đúng phụ (hints)
            foreach (array_slice($data['correct_answers'], 1) as $hintContent) {
                AnswerHint::create([
                    'answer_id' => $correctAnswer->id,
                    'content' => is_array($hintContent) ? $hintContent['content'] : $hintContent,
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

            // Shuffle lại danh sách đáp án (chỉ lưu nếu chưa tồn tại)
            $allAnswers = collect([$correctAnswer])->merge($wrongAnswers)->shuffle();

            foreach ($allAnswers as $ans) {
                if (is_object($ans) && !$ans->exists) {
                    $ans->save();
                }
            }
        }
    }
}
