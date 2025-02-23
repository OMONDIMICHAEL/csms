<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communication;

class StudentController extends Controller
{
  public function index()
  {
    return view('student.student_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('student.student_communication', compact('communications'));
  }
}
