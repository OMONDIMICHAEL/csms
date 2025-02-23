@extends('layouts.cook_app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Food Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <h2>Food Stock</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if(session('warning'))
                      <div class="alert alert-warning">{{ session('warning') }}</div>
                  @endif
                  <a href="{{ route('food_stock.create') }}" class="btn btn-primary mb-3">Add Food Stock</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Threshold</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $stock)
                            <tr class="{{ $stock->isLowStock() ? 'table-danger' : '' }}">
                                <td>{{ $stock->item_name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->unit }}</td>
                                <td>{{ $stock->threshold }}</td>
                                <td>
                                    <form action="{{ route('food_stock.use', $stock->id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity_used" placeholder="Quantity Used" required>
                                        <button type="submit" class="btn btn-sm btn-warning">Use</button>
                                    </form>
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
