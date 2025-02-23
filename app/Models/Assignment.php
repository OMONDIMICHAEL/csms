<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
  use HasFactory;
  protected $fillable = ['subject_id', 'teacher_id', 'class_level', 'title', 'description', 'file_path', 'deadline'];
  public function subject() {
      return $this->belongsTo(Subject::class);
  }
  public function teacher()
  {
      return $this->belongsTo(User::class, 'teacher_id');
  }
}
