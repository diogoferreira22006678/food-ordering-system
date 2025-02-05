@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Dashboard Title -->
    <h1 class="dashboard-title text-center mb-4" style="font-weight: bold; font-size: 32px;">Admin Dashboard</h1>

    <!-- Statistics Section -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="data-card shadow-sm p-4 text-center rounded" 
                 style="background: linear-gradient(135deg, #ffffff, #f8f9fa); border: 1px solid #ddd;">
                <h5 style="font-size: 18px; font-weight: bold;">Total Orders</h5>
                <p style="font-size: 24px; font-weight: bold; color: #28a745;">1,234</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="data-card shadow-sm p-4 text-center rounded" 
                 style="background: linear-gradient(135deg, #ffffff, #f8f9fa); border: 1px solid #ddd;">
                <h5 style="font-size: 18px; font-weight: bold;">Total Revenue</h5>
                <p style="font-size: 24px; font-weight: bold; color: #007bff;">$12,345</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="data-card shadow-sm p-4 text-center rounded" 
                 style="background: linear-gradient(135deg, #ffffff, #f8f9fa); border: 1px solid #ddd;">
                <h5 style="font-size: 18px; font-weight: bold;">Total Customers</h5>
                <p style="font-size: 24px; font-weight: bold; color: #ffc107;">567</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders Section -->
    <div class="mb-5">
        <h4 class="mb-3" style="font-weight: bold; font-size: 20px;">Recent Orders</h4>
        <div class="table-responsive shadow-sm rounded" 
             style="background-color: #ffffff; padding: 20px; border: 1px solid #ddd;">
            <table class="table table-hover mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>#1001</td>
                        <td>John Doe</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>#1002</td>
                        <td>Jane Smith</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table Layout Preview Section -->
    <div class="mb-5">
        <h4 class="mb-4" style="font-weight: bold; font-size: 20px;">Table Layout Preview</h4>
        <div id="table-layout-preview" class="rounded shadow-lg p-4" 
             style="position: relative; border: 3px dashed #ccc; width: 100%; max-width: 1200px; height: 800px; 
                    background: linear-gradient(135deg, #ffffff, #f9f9fa); margin: 0 auto 50px;">
            @foreach($tables as $table)
                <div class="table-item shadow-lg text-center" 
                data-id="{{ $table->table_id }}"
                style="position: absolute; 
                    top: {{ $table->y_position }}px; 
                    left: {{ $table->x_position }}px; 
                    display: flex; 
                    flex-direction: column; 
                    align-items: center; 
                    justify-content: center; 
                    text-align: center;
                    font-weight: bold; 
                    transition: transform 0.2s, box-shadow 0.2s;">
            
                    <!-- Table Image -->
                    <img src="{{ asset('assets/table.png') }}" alt="Table" 
                            style="width: 100px; height: 100px; object-fit: cover;
                                border: 2px solid {{ $table->status == 'free' ? '#28a745' : '#dc3545' }};">
                    
                    <!-- Table Info -->
                    <div class="mt-2">
                        <div style="font-size: 14px; font-weight: bold;">{{ $table->table_name }}</div>
                        <div style="font-size: 12px; color: {{ $table->status == 'free' ? '#28a745' : '#dc3545' }};">
                            {{ $table->status == 'free' ? 'Available' : 'Occupied' }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable Pusher logging (only for debugging, remove in production)
    Pusher.logToConsole = true;

    // Initialize Pusher
    var pusher = new Pusher('be549f76d7c31858495d', {
        cluster: 'mt1',
        forceTLS: true
    });

    // Subscribe to the tables channel
    var channel = pusher.subscribe('tables');

    // Listen for table updates
    channel.bind('table.updated', function(data) {
        console.log("Real-time update received:", data);
        location.reload(); // Reload the page when a table is updated
    });

    channel.bind('table.deleted', function(data) {
        console.log("Real-time update received:", data);
        location.reload(); // Reload the page when a table is deleted
    });

    channel.bind('table.created', function(data) {
        console.log("Real-time update received:", data);
        location.reload(); // Reload the page when a table is created
    });
</script>

