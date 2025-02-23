<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
  use HasFactory;
  protected $fillable = ['name'];
  public function teachers() {
      return $this->belongsToMany(User::class, 'teacher_subjects', 'subject_id', 'teacher_id');
  }
  public function students() {
      return $this->belongsToMany(User::class, 'student_subjects', 'subject_id', 'student_id');
  }
}
