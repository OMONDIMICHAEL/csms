<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
  public function create()
  {
      $subjects = Subject::all(); // Fetch all subjects
      return view('exams.upload', compact('subjects'));
  }
  public function store(Request $request)
  {
    $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required',
            'description' => 'nullable',
            // 'file' => 'required|file',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt,xlsx|max:10240',
            'exam_date' => 'nullable|date',
        ]);
    try{
        // $filePath = $request->file('file_path')->store('digital_books');
        // $filePath = $request->file('file') ? $request->file('file')->store('digital_books') : null;
      $file = $request->file('file_path');
      $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
      $filePath = $file->move(public_path('digital_books'), $fileName);

        Exam::create([
            'subject_id' => $request->subject_id,
            'teacher_id' => auth()->id(),
            'class_level' => $request->class_level,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'exam_date' => $request->exam_date,
        ]);

        return back()->with('success', 'Exam uploaded successfully');
      } catch (\Exception $e) {
        // Log the error
      Log::error('Error uploading exam: ' . $e->getMessage(), [
          'exception' => $e,
          'trace' => $e->getTraceAsString(),
      ]);

      // Return with an error message and details
      return back()->with('error', 'Failed to upload exam. Error: ' . $e->getMessage());
    }
  }

  // Show exams and assignments to students
    public function index()
    {
        $assignments = Assignment::with('subject')->get();
        $exams = Exam::with('subject')->get(); // Fetch all exams with subjects
        // Debug: Check if data exists
        if ($exams->isEmpty()) {
            dd("No exams found in the database.");
        }

        return view('grades.view', compact('assignments', 'exams'));
    }
}
