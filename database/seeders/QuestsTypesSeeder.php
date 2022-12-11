<?php

namespace Database\Seeders;

use App\Models\QuestsTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestsTypes::factory()
            ->count(4)
            ->create();
    }
}
