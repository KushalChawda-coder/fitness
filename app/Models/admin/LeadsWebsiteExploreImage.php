<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class LeadsWebsiteExploreImage extends Model
{
    protected $table="leads_website_explore_image";

    protected $fillable = [
      'lead_website_id',
      'explore_images'
    ];
}
