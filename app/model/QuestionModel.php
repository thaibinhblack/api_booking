<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class QuestionModel extends Model
{
    protected $table = "booking_question";
    protected $fillable = ["UUID_QUESTION", "NAME_QUESTION"];
}
