<?php

namespace Database\Seeders;
use App\Models\Topic;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerHint;

use Illuminate\Database\Seeder;

class CitizenshipQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // 1. Chủ đề
       $government = Topic::create(['name' => 'Government']);
        // 2. Câu hỏi
        $q1 = Question::create([
            'content' => 'What is the supreme law of the land?',
            'audio_path' => 'audio/questions/supreme-law.mp3',
            'topic_id' => $government->id,
        ]);
        // 3. Đáp án
        $a1 = Answer::create([
            'question_id' => $q1->id,
            'content' => 'The Constitution',
            'is_correct' => true,
            'audio_path' => 'audio/answers/constitution.mp3',
        ]);
        Answer::create([
            'question_id' => $q1->id,
            'content' => 'The President',
            'is_correct' => false,
        ]);
        Answer::create([
            'question_id' => $q1->id,
            'content' => 'The Congress',
            'is_correct' => false,
        ]);
        // 4. Gợi ý nếu có
        AnswerHint::create([
            'answer_id' => $a1->id,
            'content' => 'The Constitution sets up the government and protects basic rights.',
        ]);

        
    }
}
