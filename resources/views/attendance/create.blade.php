@extends('layouts.teacher_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mark Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Mark Attendance</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('attendance.store') }}" method="POST">
                      @csrf
                      <label for="subject">Select Subject:</label>
                      <select name="subject_id" required>
                          @foreach($subjects as $subject)
                              <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                          @endforeach
                      </select>

                      <table class="table">
                          <tr>
                              <th>Student Name</th>
                              <th>Present</th>
                              <th>Absent</th>
                          </tr>
                          @foreach($students as $student)
                          <tr>
                              <td>{{ $student->name }}</td>
                              <td>
                                  <input type="hidden" name="students[]" value="{{ $student->id }}">
                                  <input type="radio" name="status[{{ $loop->index }}]" value="present" checked>
                              </td>
                              <td>
                                  <input type="radio" name="status[{{ $loop->index }}]" value="absent">
                              </td>
                          </tr>
                          @endforeach
                      </table>
                      <button type="submit" class="btn btn-primary">Submit Attendance</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
