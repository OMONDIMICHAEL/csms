<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
  public function index()
  {
      // Get the logged-in student's ID
      $studentId = Auth::id();

      // Retrieve all exams the student has registered for
      $exams = Exam::whereHas('subject', function ($query) use ($studentId) {
          $query->whereHas('students', function ($q) use ($studentId) {
              $q->where('student_id', $studentId);
          });
      })->get();
      // Retrieve all assignments for the student’s registered subjects
        $assignments = Assignment::whereHas('subject', function ($query) use ($studentId) {
            $query->whereHas('students', function ($q) use ($studentId) {
                $q->where('student_id', $studentId);
            });
        })->get();

        // Retrieve grades for the student
        $grades = Grade::where('student_id', $studentId)->get();

        return view('grades.view', compact('exams', 'assignments', 'grades'));
  }
  public function gradeIndex()
    {
        $grades = Grade::where('student_id', auth()->id())->get();
        return view('grades.index', compact('grades'));
    }
  public function store(Request $request)
  {
    $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_id' => 'required|exists:exams,id',
            'assignment_id' => 'nullable|exists:assignments,id',
            'marks' => 'required|integer',
        ]);

        // $grade = $request->marks >= 50 ? 'Pass' : 'Fail';
        $grade = $this->calculateGrade($request->marks);

        Grade::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'exam_id' => $request->exam_id,
            'assignment_id' => $request->assignment_id,
            'marks' => $request->marks,
            'grade' => $grade,
        ]);

        return back()->with('success', 'Grade recorded successfully');
  }
  private function calculateGrade($marks)
    {
        if ($marks >= 80) {
            return 'A';
        } elseif ($marks >= 70) {
            return 'B';
        } elseif ($marks >= 60) {
            return 'C';
        } elseif ($marks >= 50) {
            return 'D';
        } else {
            return 'E';
        }
    }
    public function create()
    {
        // Only allow teachers to access this page
        if (auth()->user()->role !== 'teacher') {
            return redirect()->route('grades.index')->with('error', 'Unauthorized access.');
        }

        $students = \App\Models\User::where('role', 'student')->get();
        $subjects = \App\Models\Subject::all();
        $exams = \App\Models\Exam::all();
        $assignments = \App\Models\Assignment::all();

        return view('grades.create', compact('students', 'subjects', 'exams', 'assignments'));
    }
    public function exportPDF()
    {
        $studentId = Auth::id(); // Get logged-in student ID

        // Fetch student grades
        $grades = Grade::where('student_id', $studentId)->with('subject', 'student')->get();

        $pdf = Pdf::loadView('grades.pdf', compact('grades'));

        return $pdf->download('student_grades.pdf');
    }
}
