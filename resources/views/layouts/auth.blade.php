<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="TableMasters - Restaurant Table Management System">

    <title>TableMasters - Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-image: url('/assets/background-login.jpeg');
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        .login-container h2 {
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .brand-logo img {
            width: 60px;
            height: auto;
            margin-right: 10px;
        }
        .brand-name {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }
        .btn-primary {
            background: #ff6b6b;
            border: none;
        }
        .btn-primary:hover {
            background: #ff5252;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="brand-logo">
        {{-- <img src="/assets/logo.png" alt="TableMasters Logo"> --}}
        <span class="brand-name">TableMasters</span>
    </div>
    
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
