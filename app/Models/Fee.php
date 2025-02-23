<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
  use HasFactory;
  protected $fillable = ['student_id', 'total_fee', 'amount_paid', 'balance'];

  public function student()
  {
      return $this->belongsTo(User::class, 'student_id');
  }
}
