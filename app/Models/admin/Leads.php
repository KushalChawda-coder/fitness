<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\LeadsNote;
use Illuminate\Notifications\Notifiable;

class Leads extends Model
{

    use Notifiable;

    public const HOT_LEAD = 1;
    public const NOT_GOOD_LEAD = 2;
    public const LOST_LEAD = 3;
    public const NEW_LEAD = 4;
    public const FOLLOW_UP = 5;


    protected $table="leads";
    protected $primaryKey="id";
    protected $fillable = [
      'name',
      'url',
      'company_name',
      'location',
      'address',
      'email',
      'phone',
      'profile_image',
      'here_about_us',
      'here_about_description',
      'instagram_url',
      'facebook_url',
      'other_social_link',
      'additional_info',
      'verification_code',
      'email_verified_at',
      'status',
      'digital_files',
    ];

    public function leadNotes()
    {
      return $this->hasMany(LeadsNote::class, 'lead_id');
    }

    public function leadsActivity()
    {
      return $this->hasMany(LeadsActivity::class, 'lead_id');
    }

    public function leadWebsite()
    {
      return $this->hasOne(LeadWebsite::class, 'lead_id');
    }
}
