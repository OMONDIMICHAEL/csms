@extends('layouts.security_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Security Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100"><div class="container">


                  <h2>Student & Staff Check-In/Check-Out</h2>

                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif

                  <!-- Check-in Form -->
                  <form action="{{ route('security.check-in') }}" method="POST">
                      @csrf
                      <x-input-label for="role" class="mt-4" :value="__('Select Role')" />
                      <select name="role">
                          <option value="" selected>Select Role.</option>
                          <option value="accountant">Accountant</option>
                          <option value="librarian">Librarian</option>
                          <option value="teacher">Teacher</option>
                          <option value="student">Student</option>
                          <option value="parent">Parent</option>
                          <option value="security">Security</option>
                          <option value="cook">Cook</option>
                      </select>

                      <x-input-label for="id_number" class="mt-4" :value="__('Enter User ID')" />
                      <x-text-input name="id_number" required />

                      <x-primary-button class="ms-4" >{{__('Check-In')}}</x-primary-button>
                  </form>

                  <form action="{{ route('security.check-out') }}" method="POST">
                      @csrf
                      <x-input-label for="role" class="mt-8" :value="__('Select Role')" />
                      <select name="role">
                          <option value="" selected>Select Role.</option>
                          <option value="accountant">Accountant</option>
                          <option value="librarian">Librarian</option>
                          <option value="teacher">Teacher</option>
                          <option value="student">Student</option>
                          <option value="parent">Parent</option>
                          <option value="security">Security</option>
                          <option value="cook">Cook</option>
                      </select>

                      <x-input-label for="id_number" class="mt-4" :value="__('Enter User ID')" />
                      <x-text-input name="id_number" required />

                      <x-primary-button>{{__('Check-Out')}}</x-primary-button>
                  </form>

                  <!-- Check-out Form -->
                  <!-- <form action="{{ route('security.check-out') }}" method="POST">
                      @csrf
                      <x-input-label for="user_id" :value="__('Enter Student/Staff ID:')"/>
                      <x-text-input name="user_id" required/>
                      <x-primary-button class="ms-4">{{__('Check-Out')}}</x-primary-button>
                  </form> -->
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
