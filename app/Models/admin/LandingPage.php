<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Domain;

class LandingPage extends Model
{
    protected $table = "landing_page_cms";
    public const PUBLISHED = 1;
    public const DRAFT = 2;

    public const LEAD_CAPTURE = 1;
    public const SHARE_DEGITAL_FILES = 2;


    protected $fillable = [
      'main_heading',
      'menu_text',
      'brand_name',
      'service_name',
      'app_name',
      'banner_image',
      'bar_text',
      'sub_text',
      'lead_collection',
      'lead_collection_column',
      'meta_page_title',
      'meta_friendly_url',
      'meta_description',
      'meta_tags',
      'domain_id',
      'status',
      'slug',
      'action_button_name',
      'digital_files',
      'landing_page_type',
    ];

    public function getDomain(){
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}
