<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Food Ordering Dashboard') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dashboard-title {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .data-card {
            background: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .data-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .data-card h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }
        .table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table-hover tbody tr:hover {
            background-color: #f9fafb;
        }
        footer {
            background-color: #343a40;
            color: #ffffff;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Logo Links to Dashboard -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">Food Ordering</a>

        <!-- Navbar Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tables.index') }}"><i class="fas fa-table"></i> Tables</a>
                </li>
            </ul>

            <!-- User Profile Section -->
            <div class="ms-3 d-flex align-items-center">
                <span class="text-white me-2">Admin</span>
                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Profile">
            </div>
        </div>
    </div>
</nav>


    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        <p>&copy; {{ date('Y') }} Food Ordering System. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
