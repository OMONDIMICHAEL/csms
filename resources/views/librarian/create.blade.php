@extends('layouts.librarian_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Upload Books</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('librarian.store') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <label for="title" class="form-label">Book Title</label>
                          <input type="text" class="form-control" id="title" name="title" required>
                      </div>

                      <div class="mb-3">
                          <label for="author" class="form-label">Author</label>
                          <input type="text" class="form-control" id="author" name="author" required>
                      </div>

                      <div class="mb-3">
                          <label for="isbn" class="form-label">ISBN</label>
                          <input type="text" class="form-control" id="isbn" name="isbn" required>
                      </div>

                      <div class="mb-3">
                          <label for="total_copies" class="form-label">Total Copies</label>
                          <input type="number" class="form-control" id="total_copies" name="total_copies" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Add Book</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
