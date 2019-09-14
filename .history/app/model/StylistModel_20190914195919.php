<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class StylistModel extends Model
{
    protected $table = "booking_stylist";
    protected $fillable = ["UUID_STYLIST", "NAME_STYLIST", "URL_STYLIST"];
}
