<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Quests extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $hidden = [
        "god_id",
        "destiny",
        "chance",
        "key_words",
        "virtue"
    ];
}
