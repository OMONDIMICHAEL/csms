<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealTracking extends Model
{
  use HasFactory;

  protected $fillable = ['student_id', 'meal_plan_id', 'status', 'taken_at'];

  public function student()
  {
      return $this->belongsTo(User::class, 'student_id');
  }

  public function mealPlan()
  {
      return $this->belongsTo(MealPlan::class);
  }
}
