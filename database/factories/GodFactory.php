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
            'god_name' => fake() -> name,
            'wisdom' => fake() -> randomDigit(),
            'nobility' => fake() -> randomDigit(),
            'virtue' => fake() -> randomDigit(),
            'wickedness' => fake() -> randomDigit(),
            'audacity' => fake() -> randomDigit(),
            'password' => Hash::make("p"),
            'avatar' => "MaleVillDE.jpg"
        ];
    }
}
