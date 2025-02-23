@extends('layouts.teacher_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Upload assignments to students</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('assignments.upload') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                          <label for="subject_id">Subject:</label>
                          <select name="subject_id" class="form-control" required>
                              @foreach($subjects as $subject)
                                  <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="class_level">Class Level:</label>
                          <select name="class_level" class="form-control" required>
                              <option value="1">Form 1</option>
                              <option value="2">Form 2</option>
                              <option value="3">Form 3</option>
                              <option value="4">Form 4</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="title">Assignment Title:</label>
                          <input type="text" name="title" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="description">Description (Optional):</label>
                          <textarea name="description" class="form-control"></textarea>
                      </div>

                      <div class="form-group">
                          <label for="file_path">Upload File:</label>
                          <input type="file" name="file_path" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="deadline">Deadline:</label>
                          <input type="date" name="deadline" class="form-control">
                      </div>

                      <button type="submit" class="btn btn-primary">Upload</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
