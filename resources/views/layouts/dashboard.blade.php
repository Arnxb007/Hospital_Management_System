<!DOCTYPE html>
<html lang="en">
    <meta
    name="csrf-token"
    content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<div id="ai-bot">
    🤖
</div>

<div id="ai-chatbox">

    <div class="ai-header">
        HMS AI Assistant
        <span id="ai-close">✕</span>
    </div>

    <div id="ai-messages">
        <div class="ai-message">
            Hello! How can I help you today?
        </div>
    </div>

<div class="ai-suggestions-wrapper">

    <div id="ai-suggestions-header">
        Suggested Questions ▼
    </div>

    <div id="ai-suggestions"></div>

</div>
<div class="ai-input-row">

    <input
        id="ai-input"
        type="text"
        placeholder="Ask about appointments or health...">

    <button id="ai-send">
        Send
    </button>

</div>

</div>

<body class="dashboard-body">

@php
    $user = auth()->user();
    $role = $user->role;
    $photo = null;

    if ($role === 'doctor' && $user->doctor) {
        $photo = $user->doctor->profile_photo;
    }

    if ($role === 'patient' && $user->patient) {
        $photo = $user->patient->profile_photo;
    }

    $profileUrl = match ($role) {
        'doctor' => '/doctor/profile',
        'patient' => '/patient/profile',
        default => '/admin/dashboard',
    };

    $navItems = match ($role) {
        'admin' => [
            ['href' => '/admin/dashboard', 'icon' => 'DB', 'label' => 'Command Center'],
            ['href' => '/admin/doctors', 'icon' => 'DR', 'label' => 'Doctors'],
            ['href' => '/admin/patients', 'icon' => 'PT', 'label' => 'Patients'],
            ['href' => '/admin/specializations', 'icon' => 'SP', 'label' => 'Specializations'],
            ['href' => '/admin/appointments', 'icon' => 'AP', 'label' => 'Appointments'],
        ],
        'doctor' => [
            ['href' => '/doctor/dashboard', 'icon' => 'OV', 'label' => 'Overview'],
            ['href' => '/doctor/appointments', 'icon' => 'AP', 'label' => 'Appointments'],
            ['href' => '/doctor/patients', 'icon' => 'PT', 'label' => 'Patients'],
            ['href' => '/doctor/medical-records', 'icon' => 'MR', 'label' => 'Medical Records'],
            ['href' => '/doctor/schedule', 'icon' => 'SC', 'label' => 'Schedule'],
            ['href' => '/doctor/profile', 'icon' => 'PF', 'label' => 'My Profile'],
        ],
        default => [
            ['href' => '/patient/dashboard', 'icon' => 'OV', 'label' => 'Overview'],
            ['href' => '/patient/appointments/create', 'icon' => 'BK', 'label' => 'Book Appointment'],
            ['href' => '/patient/appointments', 'icon' => 'AP', 'label' => 'Appointments'],
            ['href' => '/patient/medical-records', 'icon' => 'MR', 'label' => 'Medical Records'],
            ['href' => '/patient/profile', 'icon' => 'HP', 'label' => 'Health Profile'],
        ],
    };

    $unreadCount = $user
        ->notifications()
        ->where('is_read', false)
        ->count();
@endphp

<div class="dashboard-wrapper" data-dashboard-shell>

    <aside class="sidebar" data-sidebar>

        <div class="sidebar-brand">
            <a href="{{ route('home') }}" class="logo" aria-label="Open hospital home page">
                HMS
            </a>
            <span class="brand-pulse"></span>
        </div>

        <nav class="sidebar-nav" aria-label="Primary navigation">
            <ul>
                @foreach($navItems as $item)
                    <li>
                        <a
                            href="{{ $item['href'] }}"
                            class="nav-link"
                            data-nav-link>
                            <span class="nav-icon">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="sidebar-logout">
            @csrf

            <button type="submit" class="logout-btn" data-confirm="Log out of your session?">
                Logout
            </button>
        </form>

    </aside>

    <main class="dashboard-content">

        <header class="dashboard-topbar">

            <button
                type="button"
                class="sidebar-toggle"
                data-sidebar-toggle
                aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="topbar-copy">
                <span class="eyebrow">{{ ucfirst($role) }} Workspace</span>
                <h2>
                    Welcome, {{ $user->first_name }}
                </h2>
            </div>

            <div class="topbar-actions">

                <a href="/notifications" class="notification-icon" aria-label="Notifications">
                    <span class="notification-bell" aria-hidden="true"></span>

                    @if($unreadCount > 0)
                        <span class="notification-badge">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ $profileUrl }}" class="topbar-profile" aria-label="Profile">
                    @if($photo)
                        <img
                            src="{{ asset('storage/'.$photo) }}"
                            class="topbar-avatar"
                            alt="{{ $user->full_name }}">
                    @else
                        <div class="topbar-avatar-placeholder">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}
                        </div>
                    @endif
                </a>

            </div>

        </header>

        <section class="page-surface" data-page-transition>
            @yield('content')
        </section>

    </main>

</div>
<footer class="site-footer">

    <div class="footer-grid">

        <div>

            <h3>Hospital Management System</h3>

            <p>
                Providing quality healthcare services with
                modern appointment booking, medical records,
                billing, and patient management.
            </p>

        </div>

        <div>

            <h4>Quick Links</h4>

            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/services">Services</a>
            <a href="/departments">Departments</a>
            <a href="/contact">Contact</a>

        </div>

        <div>

            <h4>Hospital Services</h4>

            <p>✔ Online Appointments</p>
            <p>✔ Medical Records</p>
            <p>✔ Specialist Consultation</p>
            <p>✔ Billing & Invoices</p>

        </div>

        <div>

            <h4>Contact Us</h4>

            <p>📧 support@hospital.com</p>
            <p>📞 +91 9876543210</p>
            <p>📍 Kolkata, India</p>

            <p>
                🕒 Mon - Sat
                <br>
                9:00 AM - 8:00 PM
            </p>

        </div>

    </div>

    <div class="footer-bottom">

        © {{ date('Y') }}
        Hospital Management System.
        All Rights Reserved.

    </div>

</footer>
</body>
</html>
<script>
window.userRole = "{{ auth()->user()->role }}";
</script>