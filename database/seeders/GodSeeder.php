<?php

namespace Database\Seeders;

use App\Http\Controllers\Api\v1\HumanController;
use App\Models\God;
use App\Models\Human;
use Database\Factories\HumanFactory;
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
