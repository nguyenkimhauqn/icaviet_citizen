<?php

namespace Database\Seeders;

use CitizenshipQuestionsSeeder;
use Illuminate\Database\Seeder;
use League\Flysystem\ReadInterface;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(CitizenshipQuizSeeder::class);
        // $this->call(CitizenshipQuestionsSeeder::class);
        // 1. data thi công dân
        // $this->call([
        //     CitizenshipQuestionsFullSeeder::class,

        // ]);

        // 1.1 data thi công dân test 1
        $this->call([
            CivicTest1Seeder::class,

        ]);

        // 2. data kiểm tra viết
        $this->call(WritingTestSeeder::class);

        // 3. data kiểm tra đọc
        $this->call(ReadingTestSeeder::class);

        // 4.1. danh mục N400
        // $this->call(CategorySeeder::class);

        // 4.2. data N400
        // $this->call(N400Seeder::class);
    }
}
