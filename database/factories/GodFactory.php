<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\God>
 */
class GodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'godname' => fake() -> name,
            'wisdom' => rand(1, 5),
            'nobility' => rand(1, 5),
            'virtue' => rand(1, 5),
            'wickedness' => rand(1, 5),
            'audacity' => rand(1, 5),
            'password' => Hash::make("p"),
            'avatar' => Str::random(10)
        ];
    }
}
