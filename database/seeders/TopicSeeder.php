<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('topics')->insert([
            [
                'id' => 1,
                'name' => 'Civics Test',
                'vietnamese_name' => 'Bài thi dân sự',
                'slug' => 'civics',
                'note' => 'Đúng ít nhất <span class="success">6/10 câu</span>',
                'max_attempts' => null,
                'num_order' => 1,
                'created_at' => Carbon::parse('2025-04-22 03:47:07'),
                'updated_at' => Carbon::parse('2025-07-02 04:40:35'),
            ],
            [
                'id' => 2,
                'name' => 'Writing Test',
                'vietnamese_name' => 'Bài thi viết',
                'slug' => 'writing',
                'note' => 'Viết đúng <span class="success">1 câu</span> (có 3 cơ hội)',
                'max_attempts' => 3,
                'num_order' => 3,
                'created_at' => Carbon::parse('2025-06-27 04:45:08'),
                'updated_at' => Carbon::parse('2025-07-02 04:40:35'),
            ],
            [
                'id' => 3,
                'name' => 'Reading Test',
                'vietnamese_name' => 'Bài thi đọc',
                'slug' => 'reading',
                'note' => 'Đọc đúng <span class="success">1 câu</span> (có 3 cơ hội)',
                'max_attempts' => 3,
                'num_order' => 2,
                'created_at' => Carbon::parse('2025-06-27 04:45:32'),
                'updated_at' => Carbon::parse('2025-07-02 04:40:35'),
            ],
            [
                'id' => 4,
                'name' => 'N-400',
                'vietnamese_name' => null,
                'slug' => 'n400',
                'note' => 'Câu trả lời dựa trên các thông tin bạn đã điền trên Form N-400',
                'max_attempts' => null,
                'num_order' => 4,
                'created_at' => Carbon::parse('2025-04-22 07:20:18'),
                'updated_at' => Carbon::parse('2025-07-02 04:40:35'),
            ],
            [
                'id' => 5,
                'name' => 'Government',
                'vietnamese_name' => null,
                'slug' => 'government',
                'note' => null,
                'max_attempts' => null,
                'num_order' => 5,
                'created_at' => Carbon::parse('2025-04-22 07:21:53'),
                'updated_at' => Carbon::parse('2025-07-02 04:40:35'),
            ],
        ]);
    }
}
