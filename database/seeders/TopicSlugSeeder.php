<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            1 => 'civics',
            2 => 'writing',
            3 => 'reading',
            4 => 'n400',
            5 => 'government',
        ];

        foreach ($data as $id => $slug) {
            Topic::where('id', $id)->update(['slug' => $slug]);
        }
    }
}
