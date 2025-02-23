@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View & Download Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>View & Download Books</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <input type="text" id="searchBox" class="form-control mb-3" placeholder="Search by title or author...">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody id="bookTable">
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category }}</td>
                                    <td>
                                        <a href="{{ route('digital.library.download', $book->id) }}" class="btn btn-primary btn-sm">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script>
                    document.getElementById("searchBox").addEventListener("keyup", function() {
                        let filter = this.value.toLowerCase();
                        let rows = document.querySelectorAll("#bookTable tr");

                        rows.forEach(row => {
                            let title = row.cells[0].innerText.toLowerCase();
                            let author = row.cells[1].innerText.toLowerCase();
                            row.style.display = (title.includes(filter) || author.includes(filter)) ? "" : "none";
                        });
                    });
                </script>
                </div>
            </div>
        </div>
    </div>
@endsection
