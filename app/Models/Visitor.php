<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
  use HasFactory;

  protected $fillable = [
      'name',
      'id_number',
      'phone',
      'purpose',
      'whom_to_see',
      'check_in_time',
      'check_out_time',
  ];
}
