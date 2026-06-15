@extends('layouts.app')

@section('title', 'Review Profile')

@section('content')

<div class="interview-container">

    <div class="progress-bar">
        <div class="progress-fill" style="width:100%"></div>
    </div>

    <div class="chat-card">

        <div class="step-header">

            <div class="step-badge">
                Final Review
            </div>

            <h1>Patient Health Summary</h1>

        </div>

        <div class="doctor-message">

            <div class="doctor-avatar">
                👨‍⚕️
            </div>

            <div>
                Please review your information before submitting your medical profile.
            </div>

        </div>

        <div class="summary-section">

            <h3>👤 Personal Information</h3>

            <div class="summary-grid">

                <div>
                    <strong>Name</strong><br>
                    {{ auth()->user()->full_name }}
                </div>

                <div>
                    <strong>Blood Group</strong><br>
                    {{ $patient->blood_group ?? 'Not Provided' }}
                </div>

                <div>
                    <strong>Gender</strong><br>
                    {{ ucfirst($patient->gender) }}
                </div>

                <div>
                    <strong>Height</strong><br>
                    {{ $patient->height }} cm
                </div>

                <div>
                    <strong>Weight</strong><br>
                    {{ $patient->weight }} kg
                </div>

            </div>

        </div>

        <div class="summary-section">

            <h3>🩺 Medical Conditions</h3>

            <ul>
                @if($patient->has_diabetes)
                    <li>Diabetes</li>
                @endif

                @if($patient->has_hypertension)
                    <li>Hypertension</li>
                @endif

                @if($patient->has_heart_disease)
                    <li>Heart Disease</li>
                @endif

                @if($patient->has_asthma)
                    <li>Asthma</li>
                @endif
            </ul>

        </div>

        <div class="summary-section">

            <h3>💊 Current Medications</h3>

            <p>{{ $patient->current_medications ?: 'None Reported' }}</p>

        </div>

        <div class="summary-section">

            <h3>🏥 Past Surgeries</h3>

            <p>{{ $patient->past_surgeries ?: 'None Reported' }}</p>

        </div>

        <div class="summary-section">

            <h3>🚬 Lifestyle</h3>

            <p>
                Smoking:
                {{ $patient->smoker ? 'Yes' : 'No' }}
            </p>

            <p>
                Alcohol:
                {{ $patient->alcohol_consumer ? 'Yes' : 'No' }}
            </p>

        </div>

        <div class="summary-section">

            <h3>👨‍👩‍👧 Family Medical History</h3>

            <p>{{ $patient->family_medical_history ?: 'None Reported' }}</p>

        </div>

        <form method="POST" action="{{ route('patient.complete') }}">

            @csrf

            <button type="submit">
                Complete Profile
            </button>

        </form>

    </div>

</div>

@endsection