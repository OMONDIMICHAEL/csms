<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communication;
use Illuminate\Support\Facades\Log;

class AccountantController extends Controller
{
  public function index()
  {
      return view('accountant.accountant_dashboard');
  }
  public function showCommunications()
  {
    try{
      $communications = Communication::latest()->limit(5)->get();
      
      return view('accountant.accountant_communication', compact('communications'));
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error showing communications: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString(),
        ]);

        // Return with an error message
        return back()->with('error', 'Failed to show communications. Error: ' . $e->getMessage());
    }
  }
}
