<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AssignmentController extends Controller
{
  // Show the assignment upload form with subjects
    public function create()
    {
        $subjects = Subject::all(); // Fetch all subjects
        return view('assignments.upload', compact('subjects'));
    }
    // Store uploaded assignments
      public function store(Request $request) {
          $request->validate([
              'subject_id' => 'required|exists:subjects,id',
              'class_level' => 'required',
              'title' => 'required',
              'description' => 'nullable',
              'file_path' => 'required|file|max:10240|mimes:pdf,doc,docx,txt,pptx,xlsx', // Max 10MB, PDF/DOC/DOCX files',
              'deadline' => 'nullable|date',
          ]);

          try {
            $filePath = $request->file('file_path')->store('assignments',config('filesystems.default'));

            Assignment::create([
                'subject_id' => $request->subject_id,
                'teacher_id' => auth()->id(),
                'class_level' => $request->class_level,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $filePath,
                'deadline' => $request->deadline,
            ]);

            return back()->with('success', 'Assignment uploaded successfully');
        } catch (\Exception $e) {
      Log::error('Error uploading assignment: ' . $e->getMessage());
      return back()->with('error', 'Failed to upload assignment. Please try again.');
    }

      // Display assignments for students to view
      public function index()
      {
        $assignments = Assignment::with('subject')->get(); // Fetch assignments with subjects
          $exams = Exam::with('subject')->get(); // Fetch assignments with subjects
          return view('grades.view', compact('assignments', 'exams'));
      }
      // student submit assignments
      public function submit(Request $request, $assignmentId)
    {
        $request->validate([
            'submission_file' => 'required|file|max:2048', // Max size: 2MB
        ]);

        // Store the submitted file
        $filePath = $request->file('submission_file')->store('submissions', 'public');

        // Create a new submission entry
        Submission::create([
            'student_id' => Auth::id(),
            'assignment_id' => $assignmentId,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Assignment submitted successfully!');
    }
}
