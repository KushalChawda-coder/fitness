<?php

namespace App\Models\admin;
use Illuminate\Database\Eloquent\Model;


class DigitalFiles extends Model
{
    protected $table="digital_files";

    protected $fillable = [
      'file_name',
      'upload_file',
      'file_size',
    ];

}
