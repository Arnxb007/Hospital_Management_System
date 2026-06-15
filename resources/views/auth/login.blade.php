@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="login-container">

    <div class="login-card">

        <h2>Hospital Login</h2>

        <p>
            Welcome Back
        </p>

        @if(session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
    

            <div class="role-selection">

                <label>
                    <input type="radio" name="role" value="patient" checked>
                    Patient
                </label>

                <label>
                    <input type="radio" name="role" value="doctor">
                    Doctor
                </label>

                <label>
                    <input type="radio" name="role" value="admin">
                    Admin
                </label>

            </div>

            <input
                type="text"
                name="login"
                placeholder="Email or Username"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <button type="submit" class="login-btn">
                Login
            </button>

            <div class="register-section">
                <span>Don't have an account?</span>
                <a href="/register">Register Now</a>
            </div>

        </form>

    </div>

</div>

@endsection