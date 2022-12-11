<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class God extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    public $incrementing = false;
    public $timestamps = false;
    public $table = "gods";

    public function humans(){
        return $this->hasMany(Human::class, "blessed", "godname");
    }

    protected $hidden = [
        'password',
        'wisdom',
        'nobility',
        'virtue',
        'wickedness',
        'audacity',
        "id"
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
