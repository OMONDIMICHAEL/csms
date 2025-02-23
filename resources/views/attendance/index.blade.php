@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>View Attendance</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form method="GET" action="{{ route('attendance.index') }}">
                      <input type="date" name="date" value="{{ $date }}">
                      <button type="submit">Filter</button>
                  </form>
                  <table class="table">
                      <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>Status</th>
                      </tr>
                      @foreach($attendances as $attendance)
                      <tr>
                          <td>{{ $attendance->date }}</td>
                          <td>{{ $attendance->subject->name }}</td>
                          <td>{{ ucfirst($attendance->status) }}</td>
                      </tr>
                      @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
