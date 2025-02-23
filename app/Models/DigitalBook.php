<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalBook extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'author', 'category', 'file_path', 'file_type'];
}
