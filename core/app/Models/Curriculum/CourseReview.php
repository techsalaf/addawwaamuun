<?php

namespace App\Models\Curriculum;

use App\Models\Curriculum\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'course_id', 'comment', 'rating'];

  public function userInfo()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function courseInfo()
  {
    return $this->belongsTo(Course::class, 'course_id', 'id');
  }
}
