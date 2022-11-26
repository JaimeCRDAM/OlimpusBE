<?php

namespace Database\Factories;

use App\Models\God;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Human>
 */
class HumanFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'humanid' =>  rand(1,115),
            'name' => fake() -> name(),
            'email' => fake() -> email(),
            'password' => fake() -> password(),
            'fate' => 0,
            'god_id' => God::factory(),
            'wisdom' => fake() -> randomDigit(),
            'nobility' => fake() -> randomDigit(),
            'virtue' => fake() -> randomDigit(),
            'wickedness' => fake() -> randomDigit(),
            'audacity' => fake() -> randomDigit(),
            'avatar' => Str::random(10),
            'alive' => true,
            'destiny' => "heaven"
        ];
    }
}
