<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class UpdateCivicsTopicTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topic = Topic::where('slug', 'civics')->first();

        if ($topic) {
            Question::where('topic_id', $topic->id)
                ->update(['type' => 'multiple_choice']);
        }
    }
}
