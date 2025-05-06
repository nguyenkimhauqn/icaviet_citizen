<?php

namespace Database\Seeders;

use CitizenshipQuestionsSeeder;
use Illuminate\Database\Seeder;

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
        $this->call([
            CitizenshipQuestionsFullSeeder::class,
        ]);

    }
}
