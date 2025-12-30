<?php

namespace App\Models\Curriculum;

use App\Models\Curriculum\CourseEnrolment;
use App\Models\Curriculum\CourseFaq;
use App\Models\Curriculum\CourseInformation;
use App\Models\Curriculum\CourseReview;
use App\Models\Curriculum\QuizScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'thumbnail_image',
    'video_link',
    'cover_image',
    'pricing_type',
    'previous_price',
    'current_price',
    'status',
    'is_featured',
    'average_rating',
    'duration',
    'certificate_status',
    'video_watching',
    'quiz_completion',
    'certificate_title',
    'certificate_text',
    'min_quiz_score'
  ];

  public function information()
  {
    return $this->hasMany(CourseInformation::class);
  }

  public function faq()
  {
    return $this->hasMany(CourseFaq::class);
  }

  public function enrolment()
  {
    return $this->hasMany(CourseEnrolment::class, 'course_id', 'id');
  }

  public function review()
  {
    return $this->hasMany(CourseReview::class, 'course_id', 'id');
  }

  public function quizScore()
  {
    return $this->hasMany(QuizScore::class, 'course_id', 'id');
  }
}
