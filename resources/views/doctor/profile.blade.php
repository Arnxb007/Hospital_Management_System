@extends('layouts.dashboard')

@section('title','Doctor Profile')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>Doctor Profile</h1>

        <p>
            Professional information and credentials.
        </p>

    </div>

    <a
        href="/doctor/profile/edit"
        class="add-btn">

        Edit Profile

    </a>

</div>

<div class="profile-grid">

    <div class="info-card">

        @if($doctor->profile_photo)

            <img
                src="{{ asset('storage/'.$doctor->profile_photo) }}"
                class="profile-photo">

        @endif

        <h3>
            Dr. {{ $doctor->user->full_name }}
        </h3>

    </div>

    <div class="info-card">

        <h3>Qualification</h3>

        <p>
            {{ $doctor->qualification ?? 'Not Added' }}
        </p>

        <h3>Experience</h3>

        <p>
            {{ $doctor->experience_years ?? 0 }} Years
        </p>

        <h3>Consultation Fee</h3>

        <p>
            ₹{{ $doctor->consultation_fee ?? 0 }}
        </p>

    </div>

    <div class="info-card">

        <h3>About</h3>

        <p>
            {{ $doctor->about ?? 'No description added.' }}
        </p>

    </div>

    <div class="info-card">

        <h3>Availability</h3>

        <p>
            {{ $doctor->is_available ? 'Available' : 'Unavailable' }}
        </p>

    </div>

    @if($doctor->signature)

    <div class="info-card">

        <h3>Signature</h3>

        <img
            src="{{ asset('storage/'.$doctor->signature) }}"
            style="max-height:120px;">

    </div>

    @endif

</div>

@endsection