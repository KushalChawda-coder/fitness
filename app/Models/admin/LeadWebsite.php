<?php

namespace App\Models\admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Domain;

class LeadWebsite extends Model
{
    protected $table="leads_website";
    protected $fillable = [
      'lead_id',
      'domain_id',
      'brand_name',
      'brand_logo',
      'brand_bg_color',
      'customer_claim_code',
      'page_data',
      'plan_note',
      'plan_description',
      'plan_background_image',
      'class_note',
      'class_description',
      'class_background_image',
      'general_info',
      'flyer_data',
      'reason',
      'wesite_status',
      'slug',
    ];

    public function getDomain(){
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}
