<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Subject;
use App\Models\User;

class AttendanceController extends Controller
{
  // Display attendance form for teachers
 public function create()
 {
     $subjects = Subject::all();
     $students = User::where('role', 'student')->get();
     return view('attendance.create', compact('subjects', 'students'));
 }

 // Store attendance
 public function store(Request $request)
 {
     $request->validate([
         'subject_id' => 'required|exists:subjects,id',
         'students' => 'required|array',
         'status' => 'required|array',
     ]);

     foreach ($request->students as $index => $student_id) {
         Attendance::create([
             'student_id' => $student_id,
             'subject_id' => $request->subject_id,
             'date' => now()->toDateString(),
             'status' => $request->status[$index],
         ]);
     }

     return back()->with('success', 'Attendance recorded successfully.');
   }

   // Show attendance for students
   public function index(Request $request)
   {
     $date = $request->input('date', now()->toDateString());
     $attendances = Attendance::where('student_id', auth()->id())->whereDate('date', $date)->get();
     return view('attendance.index', compact('attendances','date'));
   }
}
