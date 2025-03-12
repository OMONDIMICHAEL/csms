<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningResource;
use App\Models\Exam;
use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LearningResourceController extends Controller
{
  // Show upload form (for teachers)
  public function create()
  {
      $subjects = Subject::all();
      return view('learning_resources.create', compact('subjects'));
  }

  // Store uploaded resources
  public function store(Request $request)
  {
      $request->validate([
          'title' => 'required',
          'subject_id' => 'required|exists:subjects,id',
          'class' => 'required',
          'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,mp4|max:10240',
          'external_link' => 'nullable|url'
      ]);
      try{
      $filePath = $request->file('file') ? $request->file('file')->store('learning_resources') : null;

      LearningResource::create([
          'teacher_id' => auth()->id(),
          'subject_id' => $request->subject_id,
          'title' => $request->title,
          'description' => $request->description,
          'file_path' => $filePath,
          'external_link' => $request->external_link,
          'class_level' => $request->class,
      ]);

      return back()->with('success', 'Learning resource uploaded successfully.');
  } catch (\Exception $e) {
        // Log the error
      Log::error('Error uploading learning resource: ' . $e->getMessage(), [
          'exception' => $e,
          'trace' => $e->getTraceAsString(),
      ]);

      // Return with an error message and details
      return back()->with('error', 'Failed to upload learning resource. Error: ' . $e->getMessage());
    }
  }

  // Display available resources (for students)
  public function index(Request $request)
  {
    // Get the currently logged-in student's class level
        $studentClassLevel = Auth::user()->class;

        // Query resources that match the student's class level
        $query = LearningResource::where('class_level', $studentClassLevel);

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $resources = $query->get();

        return view('learning_resources.index', compact('resources'));
  }

  // Download file
  public function download($id)
  {
      $resource = LearningResource::findOrFail($id);
      return Storage::download($resource->file_path);
  }
  public function download_exam($id)
  {
      $assignments = Assignment::findOrFail($id);
      return Storage::download($assignments->file_path);
  }
}
