<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model
{
    protected $table = "booking_history";
    protected $fillable = ["UUID_USER", "UUID_HISTORY", "NAME_HISTORY", "CONTENT_HISTORY"];
}
