<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'title_en' => '1. Following Instructions, Truth Oath, Small Talk',
                'title_vn' => 'Làm theo hướng dẫn, tuyên thệ, chào hỏi',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 2,
                'title_en' => '2. Information About Your Eligibility',
                'title_vn' => 'Điều kiện của bạn',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 3,
                'title_en' => '3. Information About You',
                'title_vn' => 'Thông tin của bạn',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 4,
                'title_en' => '4. Biographic Information',
                'title_vn' => 'Thông tin trắc học',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 5,
                'title_en' => '5. Information About Your Residence',
                'title_vn' => 'Thông tin nơi cư trú',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 6,
                'title_en' => '6a. Information About Your Marital History',
                'title_vn' => 'Thông tin lịch sử hôn nhân',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 7,
                'title_en' => '6b. Your Current Marriage',
                'title_vn' => 'Cuộc hôn nhân hiện tại của bạn',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 8,
                'title_en' => '7. Information About Your Children',
                'title_vn' => 'Thông tin về con của bạn',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 9,
                'title_en' => '8. Information About Your Employment and Schools You Attended',
                'title_vn' => 'Thông tin về nghề nghiệp và trường học',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 10,
                'title_en' => '9. Time Outside the United States',
                'title_vn' => 'Thời gian ở ngoài Mỹ',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 11,
                'title_en' => '10. Additional Information about You',
                'title_vn' => 'Thông tin nghề nghiệp và trường học',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
            [
                'id' => 12,
                'title_en' => '11. Request for a Fee Reduction',
                'title_vn' => 'Yêu cầu giảm phí',
                'created_at' => Carbon::parse('2025-05-16 04:23:58'),
                'updated_at' => Carbon::parse('2025-05-16 04:23:58'),
            ],
        ]);
    }
}
