<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeV4CustomContent extends Model
{
  protected $table = 'theme_v4_custom_content';
  protected $guarded = [];
  protected $casts = [
    'status' => 'boolean',
  ];
}
