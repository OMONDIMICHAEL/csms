@extends('layouts.cook_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Meal Plans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>View Meal Plans</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <!-- Cook's Meal Planning Form -->
                  @if(auth()->user()->role == 'cook')
                  <form action="{{ route('meals.store') }}" method="POST">
                      @csrf
                      <input type="text" name="meal_name" placeholder="Meal Name" required>
                      <select name="meal_type" required>
                          <option value="breakfast">Breakfast</option>
                          <option value="lunch">Lunch</option>
                          <option value="dinner">Dinner</option>
                      </select>
                      <input type="date" name="date" required>
                      <button type="submit">Add Meal</button>
                  </form>
                  @endif
                  <h2>Meal Tracking</h2>

                  <table border="1">
                      <tr>
                          <th>Student</th>
                          <th>Meal</th>
                          <th>Date</th>
                          <th>Status</th>
                      </tr>
                      @foreach($trackings as $tracking)
                      <tr>
                          <td>{{ $tracking->student->name }}</td>
                          <td>{{ $tracking->mealPlan->meal_name }}</td>
                          <td>{{ $tracking->mealPlan->date }}</td>
                          <td>{{ ucfirst($tracking->status) }}</td>
                      </tr>
                      @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
