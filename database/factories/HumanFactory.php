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
    static $id = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $virtues = array_fill(0, 5, random_int(1, 5));

        $gods = DB::table("god") -> select('wisdom', 'nobility', 'virtue', 'wickedness', 'audacity') -> get();
        $godNames = DB::table("god") -> select('godname') -> get();

        $compatibility = $gods -> map(function($item) use ($virtues) {
            $array = (array)$item;
            return array_sum(array_map(function($godVirtue, $humanVirtue){
                    return abs($godVirtue - $humanVirtue);
                },$array, $virtues)
            );
        }); // Algoritmo para el mas compatible

        $mostCompatible = array_search(min($compatibility ->all()), $compatibility ->all());

        return [
            'humanid' => function(){return ++self::$id;},
            'name' => fake() -> name(),
            'email' => fake() -> email(),
            'password' => Hash::make("p"),
            'fate' => 0,
            'wisdom' => $virtues[0],
            'nobility' => $virtues[1],
            'virtue' => $virtues[2],
            'wickedness' => $virtues[3],
            'audacity' => $virtues[4],
            'avatar' => Str::random(10),
            'alive' => true,
            'destiny' => "heaven",
            'blessed' => $godNames ->all()[$mostCompatible] -> godname,
        ];
    }
}
