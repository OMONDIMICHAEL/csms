<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodStock extends Model
{
  use HasFactory;

  protected $fillable = ['item_name', 'quantity', 'unit', 'threshold'];

  public function isLowStock()
  {
      return $this->quantity <= $this->threshold;
  }
}
