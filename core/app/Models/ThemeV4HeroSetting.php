<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeV4HeroSetting extends Model
{
  protected $table = 'theme_v4_hero_settings';
  protected $guarded = [];
  protected $casts = [
    'status' => 'boolean',
  ];
}
