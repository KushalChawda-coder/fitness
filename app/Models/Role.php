<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public const ROLE_ADMIN = 1;
    public const ROLE_COACH = 2;
    public const ROLE_ENDUSER = 3;

    protected $fillable = [
      'role_name',
    ];

    protected $dates = [
        'deleted_at',
    ];
}
