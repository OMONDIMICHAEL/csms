@extends('layouts.admin_app')
@section('content')
      <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- {{ __("You're logged in!") }} -->
                    <div class="container mt-4">
                        <div class="row">
                          <!-- register student -->
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                  <div class="card shadow-sm">
                                      <img src="{{ asset('admin_image/school_image.jpeg') }}" class="card-img-top" alt="{{ __("school image") }}">
                                      <div class="card-body">
                                          <!-- <h5 class="card-title">{{ __("title here") }}</h5> -->
                                          <!-- <p class="card-text">{{ __("p graph") }}</p> -->
                                          <!-- <p class="text-muted">sth {{ __("pfrr") }}</p> -->
                                          <a href="{{ route('admin.register')}}" class="btn btn-primary btn-sm">Register New User!</a>
                                      </div>
                                  </div>
                              </div>
                              <!-- Performance Tracking -->
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                  <div class="card shadow-sm">
                                      <img src="{{ asset('admin_image/school_image.jpeg') }}" class="card-img-top" alt="{{ __("school image") }}">
                                      <div class="card-body">
                                          <!-- <h5 class="card-title">{{ __("title here") }}</h5> -->
                                          <!-- <p class="card-text">{{ __("p graph") }}</p> -->
                                          <!-- <p class="text-muted">PKSh {{ __("pfrr") }}</p> -->
                                          <a href="#" class="btn btn-primary btn-sm">Performance Tracking!</a>
                                      </div>
                                  </div>
                              </div>
                              <!-- send email/sms notifications -->
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                  <div class="card shadow-sm">
                                      <img src="{{ asset('admin_image/school_image.jpeg') }}" class="card-img-top" alt="{{ __("school image") }}">
                                      <div class="card-body">
                                          <!-- <h5 class="card-title">{{ __("title here") }}</h5> -->
                                          <!-- <p class="card-text">{{ __("p graph") }}</p> -->
                                          <!-- <p class="text-muted">PKSh {{ __("pfrr") }}</p> -->
                                          <a href="#" class="btn btn-primary btn-sm">Send email/sms Notifications!</a>
                                      </div>
                                  </div>
                              </div>
                              <!-- timetable management -->
                              <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                  <div class="card shadow-sm">
                                      <img src="{{ asset('admin_image/school_image.jpeg') }}" class="card-img-top" alt="{{ __("school image") }}">
                                      <div class="card-body">
                                          <!-- <h5 class="card-title">{{ __("title here") }}</h5> -->
                                          <!-- <p class="card-text">{{ __("p graph") }}</p> -->
                                          <!-- <p class="text-muted">PKSh {{ __("pfrr") }}</p> -->
                                          <a href="#" class="btn btn-primary btn-sm">Manage School Timetable!</a>
                                      </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
