@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('See your grades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Student Grades</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <div class="mb-3">
                      <a href="{{ route('grades.export.pdf', request()->query()) }}" class="btn btn-danger">Export to PDF</a>
                  </div>
                  @if($grades->count() > 0)
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Subject</th>
                                  <th>Exam/Assignment</th>
                                  <th>Marks</th>
                                  <th>Grade</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($grades as $grade)
                                  <tr>
                                      <td>{{ $grade->subject->name }}</td>
                                      <td>
                                          @if($grade->exam)
                                              Exam: {{ $grade->exam->title }}
                                          @elseif($grade->assignment)
                                              Assignment: {{ $grade->assignment->title }}
                                          @else
                                              N/A
                                          @endif
                                      </td>
                                      <td>{{ $grade->marks }}</td>
                                      <td>{{ $grade->grade }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  @else
                      <p>No grades available.</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
@endsection
