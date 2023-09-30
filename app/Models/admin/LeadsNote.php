<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class LeadsNote extends Model
{
    protected $table="leads_notes";
    protected $primaryKey="id";
    protected $fillable = [
      'lead_id',
      'note',
      'tags'
    ];

}
