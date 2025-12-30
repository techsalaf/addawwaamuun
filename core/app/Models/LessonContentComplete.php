<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonContentComplete extends Model
{
    use HasFactory;
    protected $table = 'lesson_content_complete';
    public $timestamps = false;

    protected $fillable = [
        'lesson_id',
        'user_id',
        'lesson_content_id',
        'type'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function lesson_content() {
        return $this->belongsTo('App\Models\Curriculum\LessonContent');
    }
}
