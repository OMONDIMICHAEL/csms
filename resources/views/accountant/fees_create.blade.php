@extends('layouts.accountant_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Fee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Add Fee</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <form action="{{ route('fees.store') }}" method="POST">
                      @csrf

                      <div class="mb-3">
                        <label for="student_id" class="form-label">Select Student</label>
                        <select name="student_id" class="form-control" required>
                            <option value="">-- Select Student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->class }})</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="mb-3">
                          <label for="total_fee" class="form-label">Total Fee (KSh):</label>
                          <input type="number" name="total_fee" id="total_fee" class="form-control" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Set Fee Structure</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
