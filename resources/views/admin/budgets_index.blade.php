@extends('layouts.admin_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Budget Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>School Budget</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <a href="{{ route('budgets.create') }}" class="btn btn-primary mb-3">Allocate New Budget</a>

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Department</th>
                              <th>Allocated Amount (KSh)</th>
                              <th>Used Amount (KSh)</th>
                              <th>Remaining Amount (KSh)</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($budgets as $budget)
                          <tr>
                              <td>{{ $budget->department }}</td>
                              <td>KSh {{ number_format($budget->allocated_amount, 2) }}</td>
                              <td>KSh {{ number_format($budget->used_amount, 2) }}</td>
                              <td>KSh {{ number_format($budget->remainingBudget(), 2) }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
