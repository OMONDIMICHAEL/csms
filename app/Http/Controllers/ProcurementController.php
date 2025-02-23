<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\Budget;

class ProcurementController extends Controller
{
  public function index()
  {
      $procurements = Procurement::all();
      return view('admin.procurements_index', compact('procurements'));
  }

  public function create()
  {
      $budgets = Budget::all();
      return view('admin.procurements_create', compact('budgets'));
  }

  public function store(Request $request)
  {
      $request->validate([
          'department' => 'required',
          'item_name' => 'required',
          'quantity' => 'required|integer|min:1',
          'cost_per_unit' => 'required|numeric|min:1',
          'budget_id' => 'required|exists:budgets,id',
      ]);

      $totalCost = $request->quantity * $request->cost_per_unit;
      $budget = Budget::findOrFail($request->budget_id);

      if ($budget->remainingBudget() < $totalCost) {
          return back()->with('error', 'Insufficient budget!');
      }

      Procurement::create(array_merge($request->all(), ['total_cost' => $totalCost]));

      return redirect()->route('procurements.index')->with('success', 'Procurement request submitted!');
  }

  public function approve($id)
  {
      $procurement = Procurement::findOrFail($id);
      $budget = $procurement->budget;

      if ($budget->remainingBudget() < $procurement->total_cost) {
          return back()->with('error', 'Insufficient budget!');
      }

      $procurement->update(['status' => 'Approved']);
      $budget->update(['used_amount' => $budget->used_amount + $procurement->total_cost]);

      return back()->with('success', 'Procurement approved!');
  }

  public function reject($id)
  {
      Procurement::findOrFail($id)->update(['status' => 'Rejected']);
      return back()->with('success', 'Procurement rejected!');
  }
}
