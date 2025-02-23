<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTransaction extends Model
{
  use HasFactory;

  protected $fillable = ['student_id', 'book_id', 'issued_at', 'due_date', 'returned_at', 'status'];

  public function student()
  {
      return $this->belongsTo(User::class, 'student_id');
  }

  public function book()
  {
      return $this->belongsTo(Book::class);
  }
}
