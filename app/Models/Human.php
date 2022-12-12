<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Human extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    public function gods(){
        return $this->belongsTo(God::class);
    }
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'id',
        'fate',
        'god_id',
        'alive',
        'password',
        'wisdom',
        'nobility',
        'virtue',
        'wickedness',
        'audacity',
        'destiny',
    ];

    public function toArray()
    {
        if (auth()->guard("god")-> user()) {
            $this->setAttributeVisibility();
        }

        return parent::toArray();
    }

    public function setAttributeVisibility()
    {
        $this->makeVisible(array_merge($this->fillable, $this->appends, ['id']));
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
