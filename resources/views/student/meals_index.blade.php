@extends('layouts.student_app')
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
                  <!-- List of Meals -->
                  <ul>
                      @foreach($meals as $meal)
                          <li>{{ $meal->meal_name }} ({{ ucfirst($meal->meal_type) }}) - {{ $meal->date }}
                              @if(auth()->user()->role == 'student')
                                  <form action="{{ route('meals.take', $meal->id) }}" method="POST">
                                      @csrf
                                      <button type="submit">Mark as Taken</button>
                                  </form>
                              @endif
                          </li>
                      @endforeach
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
