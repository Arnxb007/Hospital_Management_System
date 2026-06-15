@extends('layouts.app')

@section('title', 'About HMS Hospital')

@section('content')

<section class="public-page">
    @include('partials.public-nav')

    <div class="public-hero">
        <span class="hero-badge">About HMS</span>
        <h1>Care, coordination and clinical clarity in one hospital system.</h1>
        <p>
            HMS is designed for hospitals that need fast operations without losing
            the human side of healthcare. It connects administrative teams,
            doctors and patients through a secure digital workflow.
        </p>
    </div>
</section>

<section class="public-section split-section">
    <div>
        <span class="eyebrow">Our Mission</span>
        <h2>Make every visit easier to manage and easier to understand.</h2>
        <p>
            From appointment booking to medical-record delivery, HMS keeps
            important information organized, searchable and available to the
            right person at the right time.
        </p>
    </div>

    <div class="feature-list-card">
        <h3>Hospital Values</h3>
        <ul>
            <li>Patient-first communication</li>
            <li>Secure digital records</li>
            <li>Efficient doctor workflows</li>
            <li>Clear operational visibility</li>
        </ul>
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
