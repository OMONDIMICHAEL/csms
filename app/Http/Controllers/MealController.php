<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealPlan;
use App\Models\MealTracking;
use App\Models\User;

class MealController extends Controller
{
  //  Display meal plans
  public function index()
  {
    $trackings = MealTracking::with('student', 'mealPlan')->latest()->get();
      $meals = MealPlan::orderBy('date', 'asc')->get();
      return view('cook.meals_index', compact('meals','trackings'));
  }
  //  Display meal plans
  public function takeIndex()
  {
    // $trackings = MealTracking::with('student', 'mealPlan')->latest()->get();
      $meals = MealPlan::orderBy('date', 'asc')->get();
      return view('student.meals_index', compact('meals'));
  }

  //  Create meal plan (for cook)
  public function store(Request $request)
  {
      $request->validate([
          'meal_name' => 'required|string',
          'meal_type' => 'required|in:breakfast,lunch,dinner',
          'date' => 'required|date',
      ]);

      MealPlan::create($request->all());

      return back()->with('success', 'Meal Plan Added Successfully');
  }

  //  Mark meal as taken (for students)
  public function takeMeal(Request $request, $mealPlanId)
  {
      $studentId = auth()->id();

      // Check if the student has already taken this meal
      if (MealTracking::where('student_id', $studentId)->where('meal_plan_id', $mealPlanId)->exists()) {
          return back()->with('error', 'You have already taken this meal.');
      }

      MealTracking::create([
          'student_id' => $studentId,
          'meal_plan_id' => $mealPlanId,
          'status' => 'taken',
          'taken_at' => now(),
      ]);

      return back()->with('success', 'Meal recorded successfully.');
  }

  //  Show students who have taken meals (for cook)
  // public function mealTracking()
  // {
  //     $trackings = MealTracking::with('student', 'mealPlan')->latest()->get();
  //     return view('meals.track', compact('trackings'));
  // }
}
