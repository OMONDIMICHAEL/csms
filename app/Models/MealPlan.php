<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
  use HasFactory;

  protected $fillable = ['meal_name', 'meal_type', 'date'];

  public function trackings()
  {
      return $this->hasMany(MealTracking::class);
  }
}
