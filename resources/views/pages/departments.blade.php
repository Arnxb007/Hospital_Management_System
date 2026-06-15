@extends('layouts.app')

@section('title', 'Departments')

@section('content')

<section class="public-page">
    @include('partials.public-nav')

    <div class="public-hero">
        <span class="hero-badge">Departments</span>
        <h1>Specialized departments connected through one hospital platform.</h1>
        <p>
            HMS supports department discovery for patients and specialization
            management for administrators.
        </p>
    </div>
</section>

<section class="department-grid">
    @foreach([
        ['Cardiology', 'Heart care, monitoring and follow-up consultations.'],
        ['Neurology', 'Nervous system evaluation and treatment planning.'],
        ['Orthopedics', 'Bone, joint, injury and mobility care.'],
        ['Pediatrics', 'Child-focused preventive and clinical care.'],
        ['Dermatology', 'Skin, hair and allergy consultations.'],
        ['Radiology', 'Imaging workflow and diagnostic report support.'],
        ['General Medicine', 'Primary consultation and patient triage.'],
        ['Emergency Care', 'Urgent assessment and rapid care coordination.'],
    ] as [$name, $description])
        <article class="department-card">
            <span>{{ strtoupper(substr($name, 0, 2)) }}</span>
            <h3>{{ $name }}</h3>
            <p>{{ $description }}</p>
        </article>
    @endforeach
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
