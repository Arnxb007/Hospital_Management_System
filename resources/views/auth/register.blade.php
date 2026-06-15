@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="login-container">

    <div class="login-card">

        <h2>Create Account</h2>

        <p>
            Patient Registration
        </p>
        
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <input type="text" name="first_name" placeholder="First Name">

            <input type="text" name="last_name" placeholder="Last Name">

            <input type="text" name="username" placeholder="Username">

            <input type="email" name="email" placeholder="Email Address">

            <input type="text" name="phone" placeholder="Phone Number">

            <input type="password" name="password" placeholder="Password">

            <input type="password" name="password_confirmation" placeholder="Confirm Password">

            <button type="submit" class="login-btn">
                Register
            </button>

            <div class="register-section">
                <span>Already have an account?</span>
                <a href="/login">Login</a>
            </div>

        </form>

    </div>

</div>

@endsection