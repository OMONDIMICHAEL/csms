@extends('layouts.security_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visitors Log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Visitors</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('security.visitor.checkout') }}" method="POST">
                      @csrf
                      <x-input-label for="id_number" :value="__('Enter ID Number to Check Out:')"/>
                      <x-text-input id="id_number" name="id_number" required />
                      <button type="submit" class="btn btn-warning">Check Out</button>
                  </form>
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Phone</th>
                            <th>Purpose</th>
                            <th>Whom to See</th>
                            <th>Check-in Time</th>
                            <th>Check-out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->id_number }}</td>
                            <td>{{ $visitor->phone }}</td>
                            <td>{{ $visitor->purpose }}</td>
                            <td>{{ $visitor->whom_to_see }}</td>
                            <td>{{ $visitor->check_in_time }}</td>
                            <td>{{ $visitor->check_out_time ?? 'Still Checked In' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{ $visitors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
