<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ReadingTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Xóa toàn bộ câu hỏi reading (topic_id = 3)
        DB::table('questions')->where('topic_id', 3)->delete();

        // 2. Tạo topic Reading test (id = 3)
        DB::table('topics')->updateOrInsert(
            ['id' => 3],
            [
                'name' => 'Reading Test',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $questions = [
            'Where is the White House?',
            'Who is the President now?',
            'What is the capital of the United States?',
            'When do we vote for the President?',
            'What country is north of the United States?',
            'What is the largest state?',
            'Who was the first President?',
            'What do we have to pay to the government?',
            'What is one right in the Declaration of Independence?',
            'What does the President live?',
            'What is one color of the American flag?',
            'What is the name of the national anthem?',
            'When is Independence Day?',
            'What do the stripes on the flag mean?',
            'What is the name of the country we live in?',
            'What do we call the first ten amendments to the Constitution?',
            'What do we celebrate on the fourth of July?',
            'Who lives in the White House?',
            'Who elects the President?',
            'Who was the Father of Our Country?',
            'Who can vote?',
            'What is the name of the President of the United States now?',
            'Where is the Statue of Liberty?',
            'Why do people want to come to the United States?',
            'Who signs bills to become laws?',
            'Who is in charge of the executive branch?',
            'What do we call the Constitution"s first ten amendments?',
            'What is the capital of your state?',
            'What do the stars on the flag mean?',
            'What is the name of the national holiday?',
            'Why does the flag have 13 stripes?',
            'What do we show loyalty to when we say the Pledge of Allegiance?',
            'What is the economic system of the United States?',
            'Name one branch of the government.',
            'Who makes federal laws?',
            'What does the judicial branch do?',
            'What are the two parts of the U.S. Congress?',
            'Who is one of your state\'s U.S. Senators now?',
            'What are two major political parties in the United States?',
            'Who is the Commander in Chief of the military?',
            'What is the highest court in the United States?',
            'Who vetoes bills?',
            'How many U.S. Senators are there?',
            'How many U.S. Representatives are there?',
            'What is one responsibility that is only for United States citizens?',
            'Name one right only for United States citizens.'
        ];
        // 4. Ghi vào bảng `questions`
        foreach ($questions as $index => $content) {
            $audioPath = "reading-" . str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.mp3';
            DB::table('questions')->insert([
                'content' => $content,
                'audio_path' => $audioPath,
                'topic_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
