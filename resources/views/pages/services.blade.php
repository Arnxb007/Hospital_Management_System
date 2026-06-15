@extends('layouts.app')

@section('title', 'Hospital Services')

@section('content')

<section class="public-page">
    @include('partials.public-nav')

    <div class="public-hero">
        <span class="hero-badge">Services</span>
        <h1>Modern care services backed by organized digital operations.</h1>
        <p>
            Patients can explore care options while hospital teams manage the
            appointment, schedule and record workflow behind the scenes.
        </p>
    </div>
</section>

<section class="features public-cards">
    <div class="feature-card">
        <h3>Outpatient Care</h3>
        <p>Book and manage consultations across departments and specialists.</p>
    </div>

    <div class="feature-card">
        <h3>Emergency Support</h3>
        <p>Fast patient handling with clear appointment and doctor visibility.</p>
    </div>

    <div class="feature-card">
        <h3>Diagnostics</h3>
        <p>Organize diagnostic findings and attach reports to patient records.</p>
    </div>

    <div class="feature-card">
        <h3>Medical Records</h3>
        <p>Generate, update and download structured medical-record PDFs.</p>
    </div>

    <div class="feature-card">
        <h3>Doctor Scheduling</h3>
        <p>Maintain weekly availability and make appointment planning cleaner.</p>
    </div>

    <div class="feature-card">
        <h3>Patient Portal</h3>
        <p>Patients can view appointments, reports, profile details and alerts.</p>
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
