<?php

namespace Database\Seeders;

use App\Models\QuestsHumans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestsHumansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestsHumans::factory()
            ->count(100)
            ->create();
    }
}
