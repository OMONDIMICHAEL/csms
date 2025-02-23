<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningResource extends Model
{
  use HasFactory;

  protected $fillable = [
      'teacher_id', 'subject_id', 'title', 'description',
      'file_path', 'external_link', 'class_level'
  ];

  public function teacher()
  {
      return $this->belongsTo(User::class, 'teacher_id');
  }

  public function subject()
  {
      return $this->belongsTo(Subject::class);
  }
}
