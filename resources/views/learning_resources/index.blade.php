@extends('layouts.student_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find Learning Resources') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Learning Materials</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <!-- Search Form -->
                  <form action="{{ route('learning_resources.index') }}" method="GET" class="mb-3">
                      <input type="text" name="search" class="form-control" placeholder="Search for learning materials..." value="{{ request('search') }}">
                      <button type="submit" class="btn btn-primary mt-2">Search</button>
                  </form>
                  <!-- Display Learning Materials -->
                  @if($resources->count() > 0)
                      <!-- <ul class="list-group"> -->
                          @foreach($resources as $resource)
                          <div class="card mb-3">
                              <div class="card-body">
                                  <h4>{{ $resource->title }}</h4>
                                  <p>{{ $resource->description }}</p>

                                  <p><strong>Subject:</strong> {{ $resource->subject->name }}</p>

                                  @if($resource->file_path)
                                      <a href="{{ route('learning_resources.download', $resource->id) }}" class="btn btn-sm btn-success">Download File</a>
                                  @endif

                                  @if($resource->external_link)
                                      <a href="{{ $resource->external_link }}" class="btn btn-sm btn-primary" target="_blank">View External Resource</a>
                                  @endif
                              </div>
                          </div>
                          @endforeach
                      <!-- </ul> -->
                  @else
                      <p>No learning materials found.</p>
                  @endif
                  <!-- @foreach($resources as $resource)
                      <div class="card mb-3">
                          <div class="card-body">
                              <h4>{{ $resource->title }}</h4>
                              <p>{{ $resource->description }}</p>

                              <p><strong>Subject:</strong> {{ $resource->subject->name }}</p>

                              @if($resource->file_path)
                                  <a href="{{ route('learning_resources.download', $resource->id) }}" class="btn btn-sm btn-success">Download File</a>
                              @endif

                              @if($resource->external_link)
                                  <a href="{{ $resource->external_link }}" class="btn btn-sm btn-primary" target="_blank">View External Resource</a>
                              @endif
                          </div>
                      </div>
                  @endforeach -->
                </div>
            </div>
        </div>
    </div>
@endsection
