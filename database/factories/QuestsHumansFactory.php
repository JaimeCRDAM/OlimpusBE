<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestsHumans>
 */
class QuestsHumansFactory extends Factory
{

    static $humanId;
    static $questId;
    static $fetched = false;
    public function definition()
    {
        if(!QuestsHumansFactory::$fetched){
            QuestsHumansFactory::$humanId = DB::table("humans") -> select('id') -> get() -> all();
            QuestsHumansFactory::$questId = DB::table("quests") -> select('id') -> get() -> all();
        }
        return [
            "quest_id" => array_rand(QuestsHumansFactory::$questId)+1,
            "human_id" => array_rand(QuestsHumansFactory::$humanId)+1
        ];
    }
}
