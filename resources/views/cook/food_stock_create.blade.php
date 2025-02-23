@extends('layouts.cook_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Food Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Add Food Stock</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('food_stock.store') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label>Item Name:</label>
                          <input type="text" name="item_name" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Quantity:</label>
                          <input type="number" name="quantity" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Unit:</label>
                          <select name="unit" class="form-control" required>
                              <option value="KG">KG</option>
                              <option value="Litre">Litre</option>
                              <option value="Pack">Pack</option>
                          </select>
                      </div>

                      <div class="mb-3">
                          <label>Low Stock Alert Threshold:</label>
                          <input type="number" name="threshold" class="form-control" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Add Stock</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
