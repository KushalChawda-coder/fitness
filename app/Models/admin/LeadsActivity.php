<?php

namespace App\Models\admin;
use Illuminate\Database\Eloquent\Model;

class LeadsActivity extends Model
{
    public const ACCOUNT_CREATED = 1;
    public const CLICKED_ACCOUNT = 2;
    public const CONVERTED_ACCOUNT  = 3;
    public const DEACTIVATED_ACCOUNT = 4;
    public const REQUEST_E_BOOK = 5;
    public const LEAD_ADDED_LANDING = 6;

    protected $table="leads_activity";
    protected $fillable = [
      'lead_id',
      'status'
    ];
}
