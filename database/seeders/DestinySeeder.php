<?php

namespace Database\Seeders;

use App\Models\Destiny;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destiny::factory()
            ->count(1)
            ->create();
    }
}
