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
        // Civics
        $civicTopic = Topic::where('slug', 'civics')->first();
        if ($civicTopic) {
            Question::where('topic_id', $civicTopic->id)
                ->update(['type' => 'multiple_choice']);
        }

        $readingTopic = Topic::where('slug', 'reading')->first();
        if ($readingTopic) {
            Question::where('topic_id', $readingTopic->id)
                ->update(['type' => 'text']);
        }

        $writingTopic = Topic::where('slug', 'writing')->first();
        if ($writingTopic) {
            Question::where('topic_id', $writingTopic->id)
                ->update(['type' => 'text']);
        }

        $n400Topic = Topic::where('slug', 'n400')->first();
        if ($n400Topic) {
            Question::where('topic_id', $n400Topic->id)
                ->update(['type' => 'multiple_choice']);
        }
    }
}
