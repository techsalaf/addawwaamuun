<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
  use HasFactory;

  protected $table = 'contact_infos';

  protected $fillable = [
    'language_id',
    'phone',
    'email',
    'address'
  ];

  public function language()
  {
    return $this->belongsTo(Language::class);
  }
}
