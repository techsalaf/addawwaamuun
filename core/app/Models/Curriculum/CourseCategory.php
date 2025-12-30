<?php

namespace App\Models\Curriculum;

use App\Models\Curriculum\CourseInformation;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['language_id', 'icon', 'color', 'name', 'slug', 'status', 'serial_number', 'is_featured'];

  public function categoryLang()
  {
    return $this->belongsTo(Language::class);
  }

  public function courseInfoList()
  {
    return $this->hasMany(CourseInformation::class);
  }
}
