<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
            'wisdom' => fake() -> randomDigit(),
            'nobility' => fake() -> randomDigit(),
            'virtue' => fake() -> randomDigit(),
            'wickedness' => fake() -> randomDigit(),
            'audacity' => fake() -> randomDigit(),
            'password' => fake() -> password(),
            'avatar' => Str::random(10)
        ];
    }
}
