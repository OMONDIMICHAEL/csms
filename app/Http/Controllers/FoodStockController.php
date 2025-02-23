<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodStock;

class FoodStockController extends Controller
{
  // Show all food stocks
  public function index()
  {
    $lowStockItems = FoodStock::whereColumn('quantity', '<=', 'threshold')->get();
    if ($lowStockItems->count() > 0) {
        session()->flash('warning', 'Some food items are running low on stock!');
    }
    $stocks = FoodStock::all();
    return view('cook.food_stock_index', compact('stocks'));
  }

  // Show the form to add new stock
  public function create()
  {
      return view('cook.food_stock_create');
  }

  // Store a new food item
  public function store(Request $request)
  {
      $request->validate([
          'item_name' => 'required',
          'quantity' => 'required|integer|min:1',
          'unit' => 'required',
          'threshold' => 'required|integer|min:1',
      ]);

      FoodStock::create($request->all());

      return redirect()->route('food.stock.index')->with('success', 'Stock added successfully!');
  }

  // Reduce stock when a meal is prepared
  public function useStock(Request $request, $id)
  {
      $stock = FoodStock::findOrFail($id);

      $request->validate([
          'quantity_used' => 'required|integer|min:1',
      ]);

      if ($stock->quantity < $request->quantity_used) {
          return back()->with('error', 'Not enough stock available!');
      }

      $stock->quantity -= $request->quantity_used;
      $stock->save();

      return back()->with('success', 'Stock updated successfully!');
  }
}
