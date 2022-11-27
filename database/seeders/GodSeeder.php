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
            ->count(3)
            ->create();
    }
}
