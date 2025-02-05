@extends('layouts.auth')

@section('content')
<h2>Login</h2>

@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="user_name" class="form-label">Username</label>
        <input type="text" name="user_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="user_pass" class="form-label">Password</label>
        <input type="password" name="user_pass" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>

{{-- <div class="register-link">
    <p>Don't have an account? <a href="">Register</a></p>
</div> --}}
@endsection
