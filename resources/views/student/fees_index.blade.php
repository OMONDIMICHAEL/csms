@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Fees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Student Fees</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if ($fees)
                    <table class="table table-bordered">
                        <tr><th>Total Fee:</th><td>KSh {{ number_format($fees->total_fee, 2) }}</td></tr>
                        <tr><th>Amount Paid:</th><td>KSh {{ number_format($fees->amount_paid, 2) }}</td></tr>
                        <tr><th>Balance:</th><td>KSh {{ number_format($fees->balance, 2) }}</td></tr>
                    </table>
                  @else
                      <p>No fee record available for this student.</p>
                  @endif

                  @if($fees)
                  <a href="{{ route('fees.pay') }}" class="btn btn-success">Pay Now</a>
                  <!-- Download Receipt Button -->
                  @if($fees->amount_paid > 0)
                      <a href="{{ route('fees.receipt', $fees->id) }}" class="btn btn-primary">Download Receipt</a>
                  @endif
                  @else
                      <p>No fee record available for this student.</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
@endsection
