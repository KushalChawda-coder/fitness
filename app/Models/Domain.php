<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    protected $table = "domain";

    public const ACTIVE = 1;
    public const INACTIVE = 2;

    public const DOMAIN_LANDING_PAGE = 1;
    public const DOMAIN_LEAD_PAGE = 2;
    public const DOMAIN_FLYER_PAGE = 3;
    public const DOMAIN_STATIC_PAGE = 4;

    protected $fillable = [
      'coach_id',
      'domain_name',
      'status',
    ];

}
