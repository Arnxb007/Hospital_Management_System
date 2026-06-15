@extends('layouts.dashboard')

@section('title', 'Patient Details')

@section('content')
<button
    type="button"
    class="back-btn"
    onclick="history.back()"
>
    ← Back
</button>
<div class="patient-header">

    <div>
        <h1>{{ $patient->user->full_name }}</h1>
        <p>Patient ID #{{ $patient->id }}</p>
    </div>

</div>

<div class="profile-grid">

    <div class="info-card">

        <h3>Personal Information</h3>

        <p><strong>First Name:</strong> {{ $patient->user->first_name }}</p>

        <p><strong>Last Name:</strong> {{ $patient->user->last_name }}</p>

        <p><strong>Username:</strong> {{ $patient->user->username }}</p>

        <p><strong>Email:</strong> {{ $patient->user->email }}</p>

        <p><strong>Phone:</strong> {{ $patient->user->phone }}</p>

        <p><strong>Date of Birth:</strong> {{ $patient->date_of_birth }}</p>

        <p><strong>Gender:</strong> {{ ucfirst($patient->gender) }}</p>

        <p><strong>Address:</strong> {{ $patient->address }}</p>

        <p><strong>Emergency Contact:</strong> {{ $patient->emergency_contact }}</p>

    </div>

    <div class="info-card">

        <h3>Physical Information</h3>

        <p><strong>Blood Group:</strong> {{ $patient->blood_group }}</p>

        <p><strong>Height:</strong> {{ $patient->height }} cm</p>

        <p><strong>Weight:</strong> {{ $patient->weight }} kg</p>

        <p><strong>Profile Completed:</strong>
            {{ $patient->profile_completed ? 'Yes' : 'No' }}
        </p>

    </div>

</div>

<div class="info-card">

    <h3>Medical Conditions</h3>

    <div class="condition-grid">

        <div>Diabetes:
            {{ $patient->has_diabetes ? 'Yes' : 'No' }}
        </div>

        <div>Hypertension:
            {{ $patient->has_hypertension ? 'Yes' : 'No' }}
        </div>

        <div>Heart Disease:
            {{ $patient->has_heart_disease ? 'Yes' : 'No' }}
        </div>

        <div>Asthma:
            {{ $patient->has_asthma ? 'Yes' : 'No' }}
        </div>

        <div>Smoker:
            {{ $patient->smoker ? 'Yes' : 'No' }}
        </div>

        <div>Alcohol Consumer:
            {{ $patient->alcohol_consumer ? 'Yes' : 'No' }}
        </div>

    </div>

</div>

<div class="info-card">

    <h3>Medical History</h3>

    <p>
        <strong>Current Medications:</strong><br>
        {{ $patient->current_medications ?: 'Not Provided' }}
    </p>

    <hr>

    <p>
        <strong>Past Surgeries:</strong><br>
        {{ $patient->past_surgeries ?: 'Not Provided' }}
    </p>

    <hr>

    <p>
        <strong>Allergies:</strong><br>
        {{ $patient->allergies ?: 'Not Provided' }}
    </p>

    <hr>

    <p>
        <strong>Medical History:</strong><br>
        {{ $patient->medical_history ?: 'Not Provided' }}
    </p>

    <hr>

    <p>
        <strong>Family Medical History:</strong><br>
        {{ $patient->family_medical_history ?: 'Not Provided' }}
    </p>

    <hr>

    <p>
        <strong>Last Health Checkup:</strong><br>
        {{ $patient->last_health_checkup ?: 'Not Provided' }}
    </p>

    <hr>

    <p>
        <strong>Additional Notes:</strong><br>
        {{ $patient->additional_notes ?: 'Not Provided' }}
    </p>

</div>

<div style="margin-top:20px;">

    <a href="/admin/patients/{{ $patient->id }}/edit"
       class="search-btn">
        Edit Patient
    </a>

</div>

@endsection