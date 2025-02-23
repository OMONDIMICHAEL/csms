<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
  public function index()
  {
      $budgets = Budget::all();
      return view('admin.budgets_index', compact('budgets'));
  }

  public function create()
  {
      return view('admin.budgets_create');
  }

  public function store(Request $request)
  {
      $request->validate([
          'department' => 'required',
          'allocated_amount' => 'required|numeric|min:1',
      ]);

      Budget::create($request->all());

      return redirect()->route('budgets.index')->with('success', 'Budget allocated successfully!');
  }
}
