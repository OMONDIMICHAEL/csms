@extends('layouts.security_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visitor Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Register</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <form action="{{ route('security.visitor.checkin') }}" method="POST">
                      @csrf
                      <div class="mb-3">
                          <x-input-label for="name" :value="__('Name')" />
                          <x-text-input id="name" name="name" class="form-control" required />
                      </div>
                      <div class="mb-3">
                          <x-input-label for="id_number" :value="__('ID Number')" />
                          <x-text-input id="id_number" name="id_number" class="form-control" required />
                      </div>
                      <div class="mb-3">
                          <x-input-label for="phone" :value="__('Phone')" />
                          <x-text-input id="phone" name="phone" class="form-control" required />
                      </div>
                      <div class="mb-3">
                          <x-input-label for="purpose" :value="__('Purpose of Visit')" />
                          <x-text-input id="purpose" name="purpose" class="form-control" required />
                      </div>
                      <div class="mb-3">
                          <x-input-label for="whom_to_see" :value="('Whom to See:')" />
                          <x-text-input type="text" name="whom_to_see" class="form-control" required />
                      </div>
                      <button type="submit" class="btn btn-primary">Check In</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
