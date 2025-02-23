<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communication;

class TeacherController extends Controller
{
  public function index()
  {
    return view('teacher.teacher_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('teacher.teacher_communication', compact('communications'));
  }
}
