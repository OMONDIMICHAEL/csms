@extends('layouts.teacher_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assign Grade') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Grading.</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('grades.store') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label for="student_id" class="form-label">Student</label>
                          <select name="student_id" class="form-control" required>
                              @foreach($students as $student)
                                  <option value="{{ $student->id }}">{{ $student->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="mb-3">
                          <label for="subject_id" class="form-label">Subject</label>
                          <select name="subject_id" class="form-control" required>
                              @foreach($subjects as $subject)
                                  <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="mb-3">
                          <label for="exam_id" class="form-label">Exam (Optional)</label>
                          <select name="exam_id" class="form-control">
                              <option value="">None</option>
                              @foreach($exams as $exam)
                                  <option value="{{ $exam->id }}">{{ $exam->title }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="mb-3">
                          <label for="assignment_id" class="form-label">Assignment (Optional)</label>
                          <select name="assignment_id" class="form-control">
                              <option value="">None</option>
                              @foreach($assignments as $assignment)
                                  <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="mb-3">
                          <label for="marks" class="form-label">Marks</label>
                          <input type="number" name="marks" class="form-control" min="0" max="100" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Assign Grade</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
