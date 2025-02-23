<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FeeController extends Controller
{
  // Display student fees
  public function index()
  {
      $fees = Fee::where('student_id', auth()->id())->first();
      return view('student.fees_index', compact('fees'));
  }

  // accountant sets fee structure
  public function create()
  {
    // Fetch students only
    $students = User::where('role', 'student')->get();
      return view('accountant.fees_create', compact('students'));
  }

  public function store(Request $request)
  {
      $request->validate([
          'student_id' => 'required|exists:users,id',
          'total_fee' => 'required|numeric|min:0',
      ]);
      // Ensure previous fee record is deleted before setting a new one
    Fee::where('student_id', $request->student_id)->delete();

      Fee::create([
          'student_id' => $request->student_id,
          'total_fee' => $request->total_fee,
          'amount_paid' => 0, // Default as 0
          'balance' => $request->total_fee, // Initial balance = total fee
      ]);

      return redirect()->route('accountant.fees_create')->with('success', 'Fee record created successfully.');
  }
  public function receipt($id)
  {
      $fee = Fee::findOrFail($id);
      $pdf = Pdf::loadView('student.fee_receipt', compact('fee'));
      return $pdf->download('fee_receipt.pdf');
  }
  public function show()
  {
      $showFees = Fee::where('student_id', auth()->id())->first(); // Get fee record for the student

      if (!$showFees) {
          return back()->with('error', 'No fee record found for this student.');
      }

      return view('student.fees_pay', compact('showFees')); // Make sure fees/show.blade.php exists
  }

}
