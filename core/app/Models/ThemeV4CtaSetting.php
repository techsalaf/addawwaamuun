<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeV4CtaSetting extends Model
{
  protected $table = 'theme_v4_cta_settings';
  protected $guarded = [];
  protected $casts = [
    'status' => 'boolean',
  ];
}
