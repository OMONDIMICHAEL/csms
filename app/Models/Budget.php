<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
  use HasFactory;

  protected $fillable = ['department', 'allocated_amount', 'used_amount'];

  public function procurements()
  {
      return $this->hasMany(Procurement::class);
  }

  public function remainingBudget()
  {
      return $this->allocated_amount - $this->used_amount;
  }
}
