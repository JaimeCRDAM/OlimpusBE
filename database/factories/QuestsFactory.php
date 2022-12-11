<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quests>
 */
class QuestsFactory extends Factory
{
    static $godId;
    static $humanId;
    static $typeId;
    static $fetched = false;
    static $virtues = ['wisdom', 'nobility', 'virtue', 'wickedness', 'audacity'];
    public function definition()
    {
        if(!QuestsFactory::$fetched){
            QuestsFactory::$godId = DB::table("gods") -> select('id') -> get() -> all();
            QuestsFactory::$humanId = DB::table("humans") -> select('id') -> get() -> all();
            QuestsFactory::$typeId = DB::table("quests_types") -> select('id') -> get() -> all();
        }
        $random = rand(0, 3);
        if ($random == 0 ){
            $keyWords = $this->faker -> randomAscii();
            $virtue = null;
        } else{
            $keyWords = null;
            $virtue = array_rand(QuestsFactory::$virtues);
        }

        return [
            "destiny" => rand(5, 20),
            "god_id" => array_rand(QuestsFactory::$godId)+1,
            "chance" => mt_rand() / mt_getrandmax(),
            "virtue" => $virtue,
            "key_words" => $keyWords,
            "type_id" => QuestsFactory::$typeId[$random] -> id
        ];
    }
}
