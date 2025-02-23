<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalBook;

class DigitalLibraryController extends Controller
{
  //  Upload Digital Book
  public function upload(Request $request)
  {
      $request->validate([
          'title' => 'required',
          'author' => 'nullable|string',
          'category' => 'nullable|string',
          'file' => 'required|mimes:pdf,csv,txt,docx,pptx,doc,xlsx,png,jpeg,jpg|max:20480' // Max file size 20MB
      ]);

    $filePath = $request->file('file')->move(public_path('digital_books'), $request->file('file')->getClientOriginalName());

      DigitalBook::create([
          'title' => $request->title,
          'author' => $request->author,
          'category' => $request->category,
        'file_path' => "digital_books/" . $request->file('file')->getClientOriginalName(),
          'file_type' => $request->file->getClientOriginalExtension()
      ]);

      return back()->with('success', 'Digital book uploaded successfully.');
  }

  //  View Digital Library
  public function index()
  {
      $books = DigitalBook::all();
      return view('student.digital_library_index', compact('books'));
  }
  //  Upload Digital Library
  public function createIndex()
  {
      // $books = DigitalBook::all();
      return view('librarian.digital_library_upload');
  }

  //  Download Digital Book
  public function download($id)
  {
    $book = DigitalBook::findOrFail($id);
    $filePath = public_path($book->file_path);

    if (!file_exists($filePath)) {
        abort(404, "File not found!");
    }

    return response()->download($filePath);
  }
}
