<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class God extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function humans(){
        return $this->hasMany(Human::class);
    }
}
