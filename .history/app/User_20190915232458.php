<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;luminate\Foundation\Auth\User as Authent

class User extends Authenticatable
{
    protected $table = "booking_user";
    protected $fillable = ["UUID_USER" , "UUID_RULE", "UUID_COUNTRY", "USERNAME", "EMAIL", "PHONE", "GENDER", "BIRTH_DAY", "AVATAR",'PASSWORD',  "USER_TOKEN", "NOTIFY_TOKEN"];
    protected $hidden = [
        'PASSWORD',  "USER_TOKEN", "NOTIFY_TOKEN"
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
