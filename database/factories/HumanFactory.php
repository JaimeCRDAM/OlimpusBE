<?php

namespace Database\Factories;

use App\Models\God;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $virtues = [
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5)
        ];

        $gods = DB::table("gods") -> select('wisdom', 'nobility', 'virtue', 'wickedness', 'audacity') -> get();
        $godIds = DB::table("gods") -> select('id') -> get();

        $compatibility = $gods -> map(function($item) use ($virtues) {
            $array = (array)$item;
            return array_sum(array_map(function($godVirtue, $humanVirtue){
                    return abs($godVirtue - $humanVirtue);
                },$array, $virtues)
            );
        }); // Algoritmo para el mas compatible

        $mostCompatible = array_search(min($compatibility ->all()), $compatibility ->all());  // Algoritmo para el mas compatible
        return [
            'name' => fake() -> name(),
            'email' => fake() -> email(),
            'password' => Hash::make("p"),
            'fate' => 0,
            'god_id' => $godIds -> get($mostCompatible) -> id,
            'wisdom' => fake() -> randomDigit(),
            'nobility' => fake() -> randomDigit(),
            'virtue' => fake() -> randomDigit(),
            'wickedness' => fake() -> randomDigit(),
            'audacity' => fake() -> randomDigit(),
            'alive' => true,
            'destiny' => "heaven"
        ];
    }
}
