<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserQuestionAnwser extends Model
{
    protected $table = "booking_user_question_anwser";
    protected $fillable = ["UUID_BOOKING", "UUID_ANWSER"];
}
