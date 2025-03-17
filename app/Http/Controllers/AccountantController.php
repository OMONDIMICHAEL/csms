<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communication;

class AccountantController extends Controller
{
  public function index()
  {
      return view('accountant.accountant_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('accountant.accountant_communication', compact('communications'));
  }
}
