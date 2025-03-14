@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Assignments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>View and Submit assignments</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <h3>Assignments</h3>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Title</th>
                                  <th>Subject</th>
                                  <th>Class</th>
                                  <th>Deadline</th>
                                  <th>Download</th>
                                  <th>Submit</th>
                              </tr>
                          </thead>
                          <tbody>
                            @if($assignments->count() > 0)
                              @foreach($assignments as $assignment)
                                  <tr>
                                      <td>{{ $assignment->title }}</td>
                                      <td>{{ $assignment->subject->name }}</td>
                                      <td>Form {{ $assignment->class_level }}</td>
                                      <td>{{ $assignment->deadline }}</td>
                                      <td>
                                        <a href="{{ route('download.file', $assignment->file_path) }}" class="btn btn-sm btn-info">Download</a>
                                        <!-- <a href="{{ asset('storage/' . $assignment->file_path) }}" class="btn btn-sm btn-info" target="_blank">Download</a> -->
                                      </td>
                                      <td>
                                          <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                                              @csrf
                                              <input type="file" name="submission_file" required>
                                              <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                              @else
                              <p>no assignments available</p>
                            @endif
                          </tbody>
                      </table>

                      <h3>Exams</h3>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Title</th>
                                  <th>Subject</th>
                                  <th>Class</th>
                                  <th>Exam Date</th>
                                  <th>Download</th>
                                  <th>Submit</th>
                              </tr>
                          </thead>
                          <tbody>
                            @if(isset($exams) && $exams->count() > 0)
                              @foreach($exams as $exam)
                                  <tr>
                                      <td>{{ $exam->title }}</td>
                                      <td>{{ $exam->subject->name }}</td>
                                      <td>Form {{ $exam->class_level }}</td>
                                      <td>{{ $exam->exam_date }}</td>
                                      <td>
                                        <a href="{{ route('download.file', $exam->file_path) }}" class="btn btn-sm btn-info">Download</a>
                                        <!-- <a href="{{ asset('storage/' . $exam->file_path) }}" class="btn btn-sm btn-info" target="_blank">Download</a> -->
                                      </td>
                                      <td>
                                          <form action="{{ route('exams.submit', $exam->id) }}" method="POST" enctype="multipart/form-data">
                                              @csrf
                                              <input type="file" name="submission_file" required>
                                              <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                              @else
                              <p>no exams available</p>
                            @endif
                          </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection
