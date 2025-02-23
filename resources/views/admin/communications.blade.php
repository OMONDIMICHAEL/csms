@extends('layouts.admin_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Communications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>{{__('Notices/Circular/Meeting')}}</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <!-- Create New Communication -->
                  <form action="{{ route('admin.communication.store') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <x-input-label for="title" :value="__('Title:')" />
                          <x-text-input name="title" id="title" class="form-control" required />
                      </div>
                      <div class="mb-3">
                          <x-input-label for="message" :value="__('Message:')" />
                          <textarea name="message" id="message" class="form-control" required></textarea>
                      </div>
                      <div class="mb-3">
                          <x-input-label for="type" :value="__('Type:')" />
                          <select name="type" id="type" class="form-control" required >
                              <option value="notice">Notice</option>
                              <option value="circular">Circular</option>
                              <option value="meeting">Meeting</option>
                          </select>
                      </div>
                      <div class="mb-3">
                          <x-input-label for="scheduled_at" :value="__('Scheduled Time (For Meetings Only)')" />
                          <input type="datetime-local" name="scheduled_at" class="form-control">
                      </div>
                      <button type="submit" class="btn btn-primary">Post</button>
                  </form>

                  <!-- Display Communications -->
                  <h3 class="mt-4">Recent Communications</h3>
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Title</th>
                              <th>Message</th>
                              <th>Type</th>
                              <th>Scheduled At</th>
                              <th>Posted By</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($communications as $communication)
                          <tr>
                              <td>{{ $communication->title }}</td>
                              <td>{{ Str::limit($communication->message, 50) }}</td>
                              <td>{{ ucfirst($communication->type) }}</td>
                              <td>{{ $communication->scheduled_at ?? 'N/A' }}</td>
                              <td>{{ $communication->admin->name }}</td>
                              <td>
                                  <form action="{{ route('admin.communication.delete', $communication->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                  {{ $communications->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
