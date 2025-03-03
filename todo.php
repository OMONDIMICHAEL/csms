<?php
// on registration form under class, make it a dropdown and values Form 1,Form 2 etc






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
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Student & Staff Check-In/Check-Out</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                </div>
            </div>
        </div>
    </div>
@endsection

 ?>admin_image,build,digital_books,storage,.htaccess,csms_logo.webp,favicon.ico,hot,index.phprobots.txt
