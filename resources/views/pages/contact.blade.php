@extends('layouts.app')

@section('title', 'Contact HMS Hospital')

@section('content')

<section class="public-page">
    @include('partials.public-nav')

    <div class="public-hero">
        <span class="hero-badge">Contact</span>
        <h1>Need care or support? Reach the hospital desk quickly.</h1>
        <p>
            Use these contact points for appointments, reports, emergency support
            and general hospital information.
        </p>
    </div>
</section>

<section class="public-section contact-grid">
    <div class="feature-list-card">
        <h3>Hospital Desk</h3>
        <p><strong>Phone:</strong> +91 98765 43210</p>
        <p><strong>Email:</strong> care@hmshospital.test</p>
        <p><strong>Address:</strong> 21 Health Avenue, Kolkata, India</p>
    </div>

    <div class="feature-list-card">
        <h3>Working Hours</h3>
        <p><strong>OPD:</strong> Monday to Saturday, 9:00 AM - 6:00 PM</p>
        <p><strong>Emergency:</strong> Open 24/7</p>
        <p><strong>Reports:</strong> 10:00 AM - 5:00 PM</p>
    </div>

    <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <h3>Quick Message</h3>

        @if(session('contact_success'))
            <div class="success-box">
                {{ session('contact_success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Your name"
            aria-label="Your name"
            required>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Email address"
            aria-label="Email address"
            required>

        <textarea
            name="message"
            placeholder="How can we help?"
            aria-label="Message"
            required>{{ old('message') }}</textarea>

        <button type="submit">Send Message</button>
    </form>
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
