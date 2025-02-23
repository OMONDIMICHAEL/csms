@extends('layouts.teacher_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Learning Materials') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Upload Learning Materials</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('learning_resources.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                          <label>Title:</label>
                          <input type="text" name="title" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Subject:</label>
                          <select name="subject_id" class="form-control" required>
                              @foreach($subjects as $subject)
                                  <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="mb-3">
                        <label>Class Level:</label>
                        <select name="class" class="form-control" required>
                            <option value="" disabled selected>Select Class Level</option>
                            <option value="Form 1">Form 1</option>
                            <option value="Form 2">Form 2</option>
                            <option value="Form 3">Form 3</option>
                            <option value="Form 4">Form 4</option>
                        </select>
                    </div>

                      <div class="mb-3">
                          <label>Description:</label>
                          <textarea name="description" class="form-control"></textarea>
                      </div>

                      <div class="mb-3">
                          <label>Upload File (Optional):</label>
                          <input type="file" name="file" class="form-control">
                      </div>

                      <div class="mb-3">
                          <label>External Link (Optional):</label>
                          <input type="url" name="external_link" class="form-control">
                      </div>

                      <button type="submit" class="btn btn-primary">Upload</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
