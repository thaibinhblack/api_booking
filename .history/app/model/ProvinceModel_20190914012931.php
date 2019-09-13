<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    protected $table = "booking_province";
    protected $fillable = ["UUID_PROVINCE", "NAME_PROVICE"];
}
