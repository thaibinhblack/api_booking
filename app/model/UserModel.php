<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "booking_user";
    protected $fillable = ["UUID_USER" , "UUID_RULE", "UUID_COUNTRY", "USERNAME", "EMAIL", "PHONE", "GENDER", "BIRTH_DAY", "AVATAR",'PASSWORD',  "USER_TOKEN", "NOTIFY_TOKEN"];
    // protected $hidden = [
    //     'PASSWORD',  "USER_TOKEN", "NOTIFY_TOKEN"
    // ];
}
