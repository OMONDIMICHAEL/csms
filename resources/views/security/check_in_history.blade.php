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
                  <h2>Check-In/Check-Out History</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <div class="mb-3">
                      <a href="{{ route('security.export_excel', request()->query()) }}" class="btn btn-success">Export to Excel</a>
                      <a href="{{ route('security.export_pdf', request()->query()) }}" class="btn btn-danger">Export to PDF</a>
                  </div>

                  <!-- Search & Filter Form -->
                  <form method="GET" action="{{ route('security.check-in-history') }}" class="mb-4">
                      <div class="row">
                          <!-- Filter by Role -->
                          <div class="col-md-3">
                              <select name="role" class="form-control">
                                  <option value="">All Roles</option>
                                  <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
                                  <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                  <option value="parent" {{ request('role') == 'parent' ? 'selected' : '' }}>Parent</option>
                                  <option value="accountant" {{ request('role') == 'accountant' ? 'selected' : '' }}>Accountant</option>
                                  <option value="librarian" {{ request('role') == 'librarian' ? 'selected' : '' }}>Librarian</option>
                                  <option value="security" {{ request('role') == 'security' ? 'selected' : '' }}>Security</option>
                                  <option value="cook" {{ request('role') == 'cook' ? 'selected' : '' }}>Cook</option>
                              </select>
                          </div>

                          <!-- Search by Name -->
                          <div class="col-md-3">
                              <x-text-input name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}" />
                          </div>

                          <!-- Filter by Date -->
                          <div class="col-md-3">
                              <input type="date" name="date" class="form-control" value="{{ request('date') }}" />
                          </div>

                          <!-- Submit Button -->
                          <div class="col-md-3">
                              <button type="submit" class="btn btn-primary">Filter</button>
                              <a href="{{ route('security.check-in-history') }}" class="btn btn-secondary">Reset</a>
                          </div>
                      </div>
                  </form>
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Role</th>
                              <th>Check-In Time</th>
                              <th>Check-Out Time</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($checkIns as $index => $checkIn)
                              <tr>
                                  <td>{{ $index + 1 }}</td>
                                  <td>{{ $checkIn->user->name }}</td>
                                  <td>{{ ucfirst($checkIn->role) }}</td>
                                  <td>{{ $checkIn->check_in_time }}</td>
                                  <td>{{ $checkIn->check_out_time ?? 'Not Checked Out' }}</td>
                                  <td>
                                      @if($checkIn->check_out_time)
                                          <span class="badge bg-success">Checked Out</span>
                                      @else
                                          <span class="badge bg-warning">Checked In</span>
                                      @endif
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                  <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $checkIns->links() }}
                </div>
                <!-- display the line chart -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Check-in Trends</h5>
                        <div id="lineChartContainer" style="width: 100%; height: 400px;">
                            <canvas id="checkInChart"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    fetch("{{ route('security.check_in_stats') }}")
                        .then(response => response.json())
                        .then(data => {
                            let dates = data.map(item => item.date);
                            let counts = data.map(item => item.count);

                            let ctx = document.getElementById('checkInChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'line', // Line chart
                                data: {
                                    labels: dates,
                                    datasets: [{
                                        label: 'Check-Ins',
                                        data: counts,
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 2,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: { beginAtZero: true }
                                    }
                                }
                            });
                        })
                        .catch(error => console.error("Error fetching check-in data:", error));
                });
                </script>
                <!-- display the pie chart -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Check-in by Role</h5>
                        <div id="pieChartContainer" style="width: 100%; height: 400px;">
                            <canvas id="checkInByRoleChart"></canvas>
                        </div>
                    </div>
                </div>

                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    fetch("{{ route('security.check_in_by_role') }}")
                        .then(response => response.json())
                        .then(data => {
                            let roles = data.map(item => item.role);
                            let counts = data.map(item => item.count);

                            let ctx = document.getElementById('checkInByRoleChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: roles,
                                    datasets: [{
                                        label: 'Check-Ins by Role',
                                        data: counts,
                                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8e44ad', '#2ecc71']
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false
                                }
                            });
                        })
                        .catch(error => console.error("Error fetching role-based check-in data:", error));
                });
                </script>

                </div>
            </div>
        </div>
    </div>
@endsection
