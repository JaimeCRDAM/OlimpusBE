<?php

namespace Database\Seeders;

use App\Models\God;
use App\Models\Human;
use Database\Factories\GodFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Human::factory()
            ->count(25)
            ->create();
    }
}
