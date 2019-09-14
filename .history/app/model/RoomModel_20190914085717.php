<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = "booking_room";
    protected $fillable = ["UUID_ROOM", "UUID_STORE", "NAME_ROOM"];
}
