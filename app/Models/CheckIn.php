<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
  use HasFactory;

  protected $fillable = ['user_id','name','role', 'check_in_time', 'check_out_time'];
  // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
