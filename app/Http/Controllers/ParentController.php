<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Communication;
use App\Models\User;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    public function index()
  {
    return view('parent.parent_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('parent.parent_communication', compact('communications'));
  }
  // View child's grades
    public function viewChildGrades()
    {
        $parent = Auth::user();

        // Get all children of the logged-in parent
        $children = $parent->children;

        // Fetch grades for each child
        $grades = Grade::whereIn('student_id', $children->pluck('id'))->with('subject', 'student')->get();

        return view('parent.grades', compact('grades'));
    }

    // View child's attendance
    public function viewChildAttendance()
    {
        $parent = Auth::user();

        // Get all children of the logged-in parent
        $children = $parent->children;

        // Fetch attendance records for each child
        $attendanceRecords = Attendance::whereIn('student_id', $children->pluck('id'))->with('student')->get();

        return view('parent.attendance', compact('attendanceRecords'));
    }
}
