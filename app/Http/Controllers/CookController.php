<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communication;

class CookController extends Controller
{
  public function index()
  {
    return view('cook.cook_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('cook.cook_communication', compact('communications'));
  }
}
