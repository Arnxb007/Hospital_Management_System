@php
    $dashboardUrl = null;

    if (auth()->check()) {
        $dashboardUrl = match (auth()->user()->role) {
            'admin' => '/admin/dashboard',
            'doctor' => '/doctor/dashboard',
            default => '/patient/dashboard',
        };
    }
@endphp

<nav class="hero-nav public-nav">
    <a href="{{ route('home') }}" class="logo">
        HMS
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}#features">Platform</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('services') }}">Services</a>
        <a href="{{ route('departments') }}">Departments</a>
        <a href="{{ route('contact') }}">Contact</a>

        @auth
            <a href="{{ $dashboardUrl }}" class="nav-cta">Dashboard</a>
        @else
            <a href="/login" class="nav-cta">Login</a>
        @endauth
    </div>
</nav>
