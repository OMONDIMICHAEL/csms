@extends('layouts.admin_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Procurements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>New Procurement Request</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('procurements.store') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label>Department:</label>
                          <input type="text" name="department" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Item Name:</label>
                          <input type="text" name="item_name" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Quantity:</label>
                          <input type="number" name="quantity" class="form-control" min="1" required>
                      </div>

                      <div class="mb-3">
                          <label>Cost Per Unit (KSh):</label>
                          <input type="number" name="cost_per_unit" class="form-control" min="1" required>
                      </div>

                      <div class="mb-3">
                          <label>Select Budget:</label>
                          <select name="budget_id" class="form-control" required>
                              <option value="">-- Select Budget --</option>
                              @foreach($budgets as $budget)
                                  <option value="{{ $budget->id }}">{{ $budget->department }} - KSh {{ number_format($budget->remainingBudget(), 2) }} Remaining</option>
                              @endforeach
                          </select>
                      </div>

                      <button type="submit" class="btn btn-success">Submit Request</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
