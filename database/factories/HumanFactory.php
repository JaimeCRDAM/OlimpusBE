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

    static string $firstHuman = "Jaime";
    static string $firstHumanEmail = "Jaime@email.com";
    static bool $firstHumanBool = true;
    static $godIds;
    static $gods;
    static $fetched = false;
    static $virtues = ['wisdom', 'nobility', 'virtue', 'wickedness', 'audacity'];
    public function definition()
    {
        if(!HumanFactory::$fetched){
            HumanFactory::$godIds = DB::table("gods") -> select('id') -> get();
            HumanFactory::$gods = DB::table("gods") -> select('wisdom', 'nobility', 'virtue', 'wickedness', 'audacity') -> get();
            HumanFactory::$fetched = true;
        }
        $virtues = [
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5),
            rand(1, 5)
        ];

        $gods = HumanFactory::$gods;
        $godIds = HumanFactory::$godIds;

        $compatibility = $gods -> map(function($item) use ($virtues) {
            $array = (array)$item;
            return array_sum(array_map(function($godVirtue, $humanVirtue){
                    return abs($godVirtue - $humanVirtue);
                },$array, $virtues)
            );
        }); // Algoritmo para el mas compatible

        $mostCompatible = array_search(min($compatibility ->all()), $compatibility ->all());  // Algoritmo para el mas compatible
        return [
            'name' => HumanFactory::$firstHumanBool ? $this -> Jaime() : fake() -> name(),
            'email' => HumanFactory::$firstHumanBool ? $this -> JaimeEmail() : fake() -> email(),
            'password' => Hash::make("p"),
            'fate' => 0,
            'god_id' => $godIds -> get($mostCompatible) -> id,
            'wisdom' => $virtues[0],
            'nobility' => $virtues[1],
            'virtue' => $virtues[2],
            'wickedness' => $virtues[3],
            'audacity' => $virtues[4],
            'alive' => true,
            'destiny' => "heaven"
        ];
    }

    private function Jaime(){
        return HumanFactory::$firstHuman;
    }
    private function JaimeEmail(){
        HumanFactory::$firstHumanBool = false;
        return HumanFactory::$firstHumanEmail;
    }
}
