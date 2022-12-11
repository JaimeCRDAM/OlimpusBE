<?php

namespace Database\Seeders;

use App\Models\Quests;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quests::factory()
            ->count(50)
            ->create();
    }
}
