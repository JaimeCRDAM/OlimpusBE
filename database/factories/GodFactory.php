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
    static string $firstGod = "Hades";
    static bool $firstGodBool = true;
    public function definition()
    {

        return [
            'god_name' => GodFactory::$firstGodBool ? $this -> kakak() : fake() -> name(),
            'wisdom' => fake() -> randomDigit(),
            'nobility' => fake() -> randomDigit(),
            'virtue' => fake() -> randomDigit(),
            'wickedness' => fake() -> randomDigit(),
            'audacity' => fake() -> randomDigit(),
            'password' => Hash::make("p"),
            'avatar' => "MaleVillDE.jpg"
        ];
    }

    private function kakak(){
        GodFactory::$firstGodBool = false;
        return GodFactory::$firstGod;
    }
}
