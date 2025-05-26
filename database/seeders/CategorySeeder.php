<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title_en' => 'Following Instructions, Truth Oath, Small Talk'],
            ['title_en' => 'Information About Your Eligibility'],
            ['title_en' => 'Information About You'],
            ['title_en' => 'Accommodations for Individuals With Disabilities and/or Impairments'],
            ['title_en' => 'Information to Contact You'],
            ['title_en' => 'Information About Your Residence'],
            ['title_en' => 'Information About Your Parents'],
            ['title_en' => 'Biographic Information'],
            ['title_en' => 'Information About Your Employment and Schools You Attended'],
            ['title_en' => 'Time Outside the United States'],
            ['title_en' => 'Information About Your Marital History'],
            ['title_en' => 'Information About Your Children'],
            ['title_en' => 'Additional Information About You'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
