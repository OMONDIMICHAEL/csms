@extends('layouts.librarian_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Digital Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Digital Library</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('digital.library.upload') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                          <label>Book Title:</label>
                          <input type="text" name="title" class="form-control" required>
                      </div>

                      <div class="mb-3">
                          <label>Author (Optional):</label>
                          <input type="text" name="author" class="form-control">
                      </div>

                      <div class="mb-3">
                          <label>Category (Optional):</label>
                          <input type="text" name="category" class="form-control">
                      </div>

                      <div class="mb-3">
                          <label>Upload File (pdf,csv,txt,docx,pptx,doc,xlsx,png,jpeg,jpg):</label>
                          <input type="file" name="file" class="form-control" required>
                      </div>

                      <button type="submit" class="btn btn-success">Upload Book</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
