<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this -> call([
            GodSeeder::class,
            HumanSeeder::class,
            CasualQuestSeeder::class,
            ElectionSeeder::class,
            FreeAnswerSeeder::class,
            ValuationSeeder::class,
            CasualQuestHumanSeeder::class,
            ElectionHumanSeeder::class,
            FreeAnswerHumanSeeder::class,
            ValuationHumanSeeder::class
        ]);
    }
}
