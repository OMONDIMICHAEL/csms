@extends('layouts.librarian_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Librarian Communications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Librarian Communication.</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>Title</th>
                              <th>Message</th>
                              <th>Type</th>
                              <th>Scheduled At</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($communications as $communication)
                              <tr>
                                  <td><strong>{{ $communication->title }}</strong></td>
                                  <td>{{ $communication->message }}</td>
                                  <td>{{ ucfirst($communication->type) }}</td>
                                  <td>
                                      @if($communication->type == 'meeting' && $communication->scheduled_at)
                                          {{ $communication->scheduled_at }}
                                      @else
                                          N/A
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
