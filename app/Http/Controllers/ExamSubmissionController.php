<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExamSubmissionController extends Controller
{
  public function store(Request $request, $examId)
  {
      $request->validate([
          'submission_file' => 'required|file|mimes:pdf,doc,docx,txt,xlsx,jpg,jpeg,png',
      ]);

      // Store the uploaded file
      $filePath = $request->file('submission_file')->store('exam_submissions' , 'public');

      // Save the submission record
      ExamSubmission::create([
          'exam_id' => $examId,
          'student_id' => Auth::id(),
          'file_path' => $filePath,
      ]);

      return back()->with('success', 'Exam submitted successfully');
  }
}
