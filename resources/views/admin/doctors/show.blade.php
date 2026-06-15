@extends('layouts.dashboard')

@section('content')

<div class="patient-header">

    <div>
        <h1>
            Dr. {{ $doctor->user->full_name }}
        </h1>

        <p>
            License:
            {{ $doctor->license_number }}
        </p>
    </div>

</div>

<div class="profile-grid">

    <div class="info-card">

        <h3>Personal Information</h3>

        <p>Email:
            {{ $doctor->user->email }}
        </p>

        <p>Phone:
            {{ $doctor->user->phone }}
        </p>

        <p>Username:
            {{ $doctor->user->username }}
        </p>

    </div>

    <div class="info-card">

        <h3>Professional Information</h3>

        <p>
            Specialization:
            {{ $doctor->specialization->name ?? 'N/A' }}
        </p>

        <p>
            Qualification:
            {{ $doctor->qualification }}
        </p>

        <p>
            Experience:
            {{ $doctor->experience_years }}
            Years
        </p>

        <p>
            Consultation Fee:
            ₹{{ $doctor->consultation_fee }}
        </p>

    </div>

</div>
<div class="page-footer-actions">

    <button
        type="button"
        class="btn-back"
        onclick="history.back()"
    >
        ← Back
    </button>

    <a href="/admin/doctors/{{ $doctor->id }}/edit"
       class="btn-edit">
        Edit Doctor
    </a>

</div>
@endsection