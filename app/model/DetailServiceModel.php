<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DetailServiceModel extends Model
{
    protected $table = "booking_detail_service";
    protected $fillable = ["UUID_BOOKING", "UUID_SERVICE"];
}
