<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quests extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $hidden = [
        "god_id",
    ];
}
