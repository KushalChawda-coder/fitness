<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\PagesSections;

class PagesCms extends Model
{
    protected $table="pages_cms";
    protected $fillable = [
      'user_id',
      'name',
      'slug',
      'meta_title',
      'meta_friendly_url',
      'meta_description',
      'meta_tags',
      'redirect_at',
      'is_redirect',
      'status'
    ];

    public function getPageSection(){
        return $this->hasOne(PagesSections::class, 'page_cms_id');
    }
}
