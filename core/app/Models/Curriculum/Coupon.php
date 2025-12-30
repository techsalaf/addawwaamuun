<?php

namespace App\Models\Curriculum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'code',
    'type',
    'value',
    'courses',
    'start_date',
    'end_date'
  ];
}
