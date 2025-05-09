<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WritingTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // 1. Xóa toàn bộ câu hỏi writing (topic_id = 2)
        DB::table('questions')->where('topic_id', 2)->delete();

        // 2. Tạo topic Writing test (id = 2)
        DB::table('topics')->updateOrInsert(
            ['id' => 2],
            [
                'name' => 'Writing Test',
                'created_at' =>  now(),
                'updated_at' => now(),
            ]
        );

        // 2. Danh sách 38 câu viết
        $questions = [
            'Washington is the Father of Our Country',
            'The White House is in Washington, D.C.',
            'We vote for the President in November',
            'The capital of the United States is Washington, D.C.',
            'Citizens have the right to vote',
            'The President lives in the White House',
            'The American flag is red, white, and blue',
            'We elect a President every four years',
            'The United States is a democracy',
            'Freedom of speech is a right',
            'There are fifty states in the United States',
            'The United States has a Constitution',
            'The House of Representatives has 435 members',
            'Congress meets in Washington, D.C.',
            'George Washington was the first president',
            'Abraham Lincoln was the President during the Civil War',
            'The President signs bills into law',
            'The American flag has 13 stripes',
            'The stripes represent the original 13 colonies',
            'The stars on the flag represent the states',
            'There are 100 senators in the U.S. Senate',
            'The President is the Commander in Chief of the military',
            'The Supreme Court is the highest court',
            'The President lives at the White House',
            'The White House is in the capital city',
            'We pay taxes to the government',
            'Citizens can vote',
            'We celebrate Independence Day on July 4',
            'New York City is in the state of New York',
            'The Statue of Liberty is in New York',
            'The American flag has 50 stars',
            'Each star represents a state',
            'The capital of the United States is Washington',
            'The American people elect Congress',
            'The Congress makes laws',
            'The first President was George Washington',
            'The President lives at 1600 Pennsylvania Avenue',
            'Americans vote in November'
        ];
        // 3. add to `qeustions`
        foreach ($questions as $index => $content) {
            $audioPath = "writing-" . str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.mp3';
            DB::table('questions')->insert([
                'content' => $content,
                'audio_path' => $audioPath,
                'topic_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
