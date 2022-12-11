<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Quests;
use App\Models\QuestsHumans;
use App\Models\QuestsTypes;
use Database\Factories\QuestsTypesFactory;
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
            QuestsTypesSeeder::class,
            QuestsSeeder::class,
            QuestsHumansSeeder::class
        ]);
    }
}
