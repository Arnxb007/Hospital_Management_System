@extends('layouts.app')

@section('title', 'HMS | Future Healthcare Platform')

@section('content')

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

<section class="hero">

    @include('partials.public-nav')

    <div class="hero-content">

        <div class="hero-badge">
            Intelligent Hospital Operations
        </div>

        <h1>
            A modern command center for faster, calmer healthcare.
        </h1>

        <p>
            Coordinate doctors, patients, appointments, schedules, notifications,
            medical records and reports from one secure digital workspace.
        </p>

        <div class="hero-buttons">
            <a href="{{ $dashboardUrl ?? route('login') }}" class="btn-primary">
                {{ $dashboardUrl ? 'Open Dashboard' : 'Enter Platform' }}
            </a>

            <a href="#features" class="btn-secondary">
                Explore System
            </a>
        </div>

    </div>

</section>

<section id="features" class="features">

    <div class="feature-card">
        <h3>Live Operations</h3>
        <p>
            Track appointments, doctors, patients and hospital activity with
            focused dashboards for every role.
        </p>
    </div>

    <div class="feature-card">
        <h3>Clinical Records</h3>
        <p>
            Build clean medical histories with diagnosis notes, prescriptions,
            downloadable PDFs and secure patient access.
        </p>
    </div>

    <div class="feature-card">
        <h3>Doctor Workflow</h3>
        <p>
            Doctors can manage schedules, patient histories, completed visits
            and follow-up records from one place.
        </p>
    </div>

    <div class="feature-card">
        <h3>Patient Experience</h3>
        <p>
            Patients can book appointments, review health profiles, receive
            notifications and access their reports quickly.
        </p>
    </div>

</section>

<section class="hospital-info-band">

    <div class="hospital-info-copy">
        <span class="eyebrow">Complete HMS</span>
        <h2>Everything a connected hospital needs to run cleanly.</h2>
        <p>
            HMS combines public hospital information with role-based operations:
            admin control, doctor workflow, patient access, appointment handling,
            schedules, notifications and medical records.
        </p>
    </div>

    <div class="info-metrics">
        <div>
            <strong>24/7</strong>
            Emergency readiness
        </div>
        <div>
            <strong>12+</strong>
            Care departments
        </div>
        <div>
            <strong>3</strong>
            Secure workspaces
        </div>
    </div>

</section>
<section class="stats-section">

    <div class="stat-box">
        <h2>50+</h2>
        <p>Doctors</p>
    </div>

    <div class="stat-box">
        <h2>1000+</h2>
        <p>Patients Served</p>
    </div>

    <div class="stat-box">
        <h2>5000+</h2>
        <p>Appointments</p>
    </div>

    <div class="stat-box">
        <h2>24/7</h2>
        <p>Emergency Support</p>
    </div>

</section>
<section class="testimonials">

    <h2>Patient Feedback</h2>

    <div class="testimonial-grid">

        <div class="testimonial-card">
            <p>
                Excellent service and easy appointment booking.
            </p>

            <strong>
                — Arnab Paul
            </strong>
        </div>

        <div class="testimonial-card">
            <p>
                Doctors are professional and records are easily accessible.
            </p>

            <strong>
                — Patient
            </strong>
        </div>

        <div class="testimonial-card">
            <p>
                The online system made healthcare management simple.
            </p>

            <strong>
                — Visitor
            </strong>
        </div>

    </div>

</section>
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
@endsection
