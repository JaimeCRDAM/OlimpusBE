<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestsTypes>
 */
class QuestsTypesFactory extends Factory
{
    static $id = -1;
    static $names = ["Free answer", "Election", "Casual quest", "Valuation"];
    public function definition()
    {
        QuestsTypesFactory::$id++;
        return [
            'description' => QuestsTypesFactory::$names[QuestsTypesFactory::$id]
        ];
    }
}
