@extends('layouts.parent_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Your Student Attendance</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if($attendanceRecords->count() > 0)
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Child's Name</th>
                                  <th>Date</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($attendanceRecords as $record)
                                  <tr>
                                      <td>{{ $record->student->name }}</td>
                                      <td>{{ $record->date }}</td>
                                      <td>
                                          @if($record->status == 'present')
                                              <span class="text-success">Present</span>
                                          @else
                                              <span class="text-danger">Absent</span>
                                          @endif
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  @else
                      <p>No attendance records available for your child.</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
@endsection
