@extends('layouts.librarian_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Borrowed Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>View Borrowed Books</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <!-- Librarian's Add Book Button -->
                  @if(auth()->user()->role == 'librarian')
                      <a href="{{ route('librarian.create') }}" class="btn btn-primary mb-3">Add New Book</a>
                  @endif
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Student</th>
                              <th>Book Title</th>
                              <th>Book ISBN</th>
                              <th>Issued Date</th>
                              <th>Due Date</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($transactions as $transaction)
                              <tr>
                                  <td>{{ $transaction->student->name }}</td>
                                  <td>{{ $transaction->book->title }}</td>
                                  <td>{{ $transaction->book->isbn }}</td>
                                  <td>{{ $transaction->issued_at }}</td>
                                  <td>{{ $transaction->due_date }}</td>
                                  <td>
                                      <form action="{{ route('librarian.return', $transaction->id) }}" method="POST">
                                          @csrf
                                          <button type="submit" class="btn btn-success btn-sm">Return</button>
                                      </form>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
