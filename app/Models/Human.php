<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Human extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'humanid';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'integer';
    public $table='human';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar'];

    protected $hidden = [
        'password',
        'fate',
        'blessed',
        'wisdom',
        'nobility',
        'virtue',
        'wickedness',
        'audacity',
        'alive',
        'destiny',
        'humanid'
    ];

    public function gods(){
        return $this->hasOne(God::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
