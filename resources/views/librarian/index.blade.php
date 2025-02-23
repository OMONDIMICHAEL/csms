@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View/Issue/Track Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>View/Issue/Track Books</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif

                  <table class="table">
                      <thead>
                          <tr>
                              <th>Title</th>
                              <th>Author</th>
                              <th>ISBN</th>
                              <th>Available Copies</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($books as $book)
                              <tr>
                                  <td>{{ $book->title }}</td>
                                  <td>{{ $book->author }}</td>
                                  <td>{{ $book->isbn }}</td>
                                  <td>{{ $book->available_copies }}</td>
                                  <td>
                                      @if($book->available_copies > 0)
                                          <form action="{{ route('librarian.borrow', $book->id) }}" method="POST">
                                              @csrf
                                              <button type="submit" class="btn btn-primary btn-sm">Borrow</button>
                                          </form>
                                      @else
                                          <span class="text-danger">Not Available</span>
                                      @endif
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
