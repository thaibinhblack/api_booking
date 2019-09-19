<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CodeModel extends Model
{
    protected $table = "booking_code_store";
    protected $fillable = ["UUID_CODE", "UUID_STORE", "NAME_CODE", "NOTE_CODE", "SL_CODE", "SL_CODED"];
}
