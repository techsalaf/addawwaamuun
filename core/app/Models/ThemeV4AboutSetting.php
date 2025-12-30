<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeV4AboutSetting extends Model
{
  protected $table = 'theme_v4_about_settings';
  protected $guarded = [];
  protected $casts = [
    'status' => 'boolean',
  ];
}
