<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{
    protected $table = "booking_answer";
    protected $fillable = ["UUID_QUESTION", "UUID_ANWSER", "NAME_ANWSER"];
}
