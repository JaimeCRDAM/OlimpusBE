<?php

namespace Database\Seeders;

use App\Models\God;
use App\Models\Human;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        God::factory()
            ->count(25)
            ->has(Human::factory())
            ->create();

        God::factory()
            ->count(75)
            ->has(Human::factory())
            ->create();

        God::factory()
            ->count(50)
            ->has(Human::factory())
            ->create();
    }
}
