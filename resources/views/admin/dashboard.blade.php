@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="data-card">
                    <h5>Total Orders</h5>
                    <p>1,234</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="data-card">
                    <h5>Total Revenue</h5>
                    <p>$12,345</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="data-card">
                    <h5>Total Customers</h5>
                    <p>567</p>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
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

    <!-- Table Layout Preview -->
    <h4>Table Layout Preview</h4>
    <div id="table-layout-preview" style="position: relative; border: 1px solid #ccc; width: 800px; height: 400px;">
        @foreach($tables as $table)
            <div class="table-item" style="position: absolute; 
                        top: {{ $table->y_position }}px; 
                        left: {{ $table->x_position }}px;
                        border: 1px solid #000; padding: 10px; 
                        background-color: {{ $table->status == 'free' ? '#28a745' : '#dc3545' }};">
                {{ $table->table_name }}
            </div>
        @endforeach
    </div>
@endsection
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Listen for real-time updates
    Echo.channel('tables')
        .listen('table.updated', (e) => {
            location.reload(); // Reload the page when a table is updated
        });
</script>
