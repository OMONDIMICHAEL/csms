@extends('layouts.admin_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Procurements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>List Procurements Requests</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <a href="{{ route('procurements.create') }}" class="btn btn-primary mb-3">New Procurement Request</a>

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Department</th>
                              <th>Item</th>
                              <th>Quantity</th>
                              <th>Cost Per Unit (KSh)</th>
                              <th>Total Cost (KSh)</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($procurements as $procurement)
                          <tr>
                              <td>{{ $procurement->department }}</td>
                              <td>{{ $procurement->item_name }}</td>
                              <td>{{ $procurement->quantity }}</td>
                              <td>KSh {{ number_format($procurement->cost_per_unit, 2) }}</td>
                              <td>KSh {{ number_format($procurement->total_cost, 2) }}</td>
                              <td><span class="badge bg-{{ $procurement->status == 'Approved' ? 'success' : ($procurement->status == 'Rejected' ? 'danger' : 'warning') }}">{{ $procurement->status }}</span></td>
                              <td>
                                  @if($procurement->status == 'Pending')
                                      <form action="{{ route('procurements.approve', $procurement->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                      </form>
                                      <form action="{{ route('procurements.reject', $procurement->id) }}" method="POST" class="d-inline">
                                          @csrf
                                          <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                      </form>
                                  @else
                                      <button class="btn btn-sm btn-secondary" disabled>Processed</button>
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
