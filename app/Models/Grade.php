<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  use HasFactory;
  protected $fillable = ['student_id', 'subject_id', 'exam_id', 'assignment_id', 'marks', 'grade'];

  public function student()
  {
      return $this->belongsTo(User::class, 'student_id');
  }

  public function subject()
  {
      return $this->belongsTo(Subject::class);
  }
  public function exam()
  {
      return $this->belongsTo(Exam::class, 'exam_id');
  }

  public function assignment()
  {
      return $this->belongsTo(Assignment::class, 'assignment_id');
  }
}
