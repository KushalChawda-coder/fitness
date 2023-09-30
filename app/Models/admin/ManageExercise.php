<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ManageExercise extends Model
{
    protected $table="manage_exercise";
    protected $fillable = [
      'exercise_id',
      'user_id',
      'exercise_name',
      'body_part_ids',
      'equipments_ids',
      'exercise_type_ids',
      'highlight_images',
      'benefits',
      'directions',
      'direction_videos',
      'video_link',
      'meta_title',
      'meta_friendly_url',
      'meta_description',
      'meta_tags',
      'status'
    ];
}
