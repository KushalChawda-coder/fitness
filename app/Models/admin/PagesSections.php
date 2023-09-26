<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class PagesSections extends Model
{
    protected $table="pages_sections";
    protected $fillable = [
      'page_cms_id',
      'section_id',
      'page_section_data',
      'status'
    ];
}
