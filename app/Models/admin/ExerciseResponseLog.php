<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ExerciseResponseLog extends Model
{
    protected $table="exercise_response_log";

    protected $fillable = [
      'exercise_id',
      'exercise_type',
      'equipments',
      'category',
      'response_reason',
      'row'
    ];

   
}

