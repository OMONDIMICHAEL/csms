@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pay Fee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Pay Fee</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('fees.pay') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label>Phone Number:</label>
                          <input type="text" name="phone" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Amount to Pay:</label>
                          <input type="number" name="amount" class="form-control" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Pay Now</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
