@extends('layouts.dashboard')

@section('title', 'Patient Profile')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<div class="patient-header">

    <div>

        <h1>
            {{ $patient->user->full_name }}
        </h1>

        <p>
            Patient Profile
        </p>

    </div>

</div>

<div class="profile-grid">

    <div class="info-card">

        <h3>Personal Information</h3>

        <p>
            Email:
            {{ $patient->user->email }}
        </p>

        <p>
            Phone:
            {{ $patient->user->phone }}
        </p>

        <p>
            Gender:
            {{ $patient->gender ?? 'N/A' }}
        </p>

        <p>
            Blood Group:
            {{ $patient->blood_group ?? 'N/A' }}
        </p>

    </div>

    <div class="info-card">

        <h3>Health Information</h3>

        <p>
            Diabetes:
            {{ $patient->has_diabetes ? 'Yes' : 'No' }}
        </p>

        <p>
            Asthma:
            {{ $patient->has_asthma ? 'Yes' : 'No' }}
        </p>

        <p>
            Profile Completed:
            {{ $patient->profile_completed ? 'Yes' : 'No' }}
        </p>

    </div>

</div>
<div class="stats-grid">

    <div class="stat-card">

        <h3>
            Appointments
        </h3>

        <div class="stat-number">
            {{ $totalAppointments }}
        </div>

    </div>

    <div class="stat-card">

        <h3>
            Medical Records
        </h3>

        <div class="stat-number">
            {{ $totalRecords }}
        </div>

    </div>

    <div class="stat-card">

        <h3>
            Attachments
        </h3>

        <div class="stat-number">
            {{ $totalAttachments }}
        </div>

    </div>

</div>
<div class="stat-card">

    <h3>
        Latest Visit
    </h3>

    <div style="font-size:18px;font-weight:600;">

        {{ optional($medicalRecords->first())->created_at?->format('d M Y') ?? 'N/A' }}

    </div>

</div>
<div class="table-card">

    <div class="table-header">
        <h2>Appointment History</h2>
    </div>

    <table class="modern-table">

        <thead>

            <tr>

                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Reason</th>

            </tr>

        </thead>

        <tbody>

            @forelse($appointments as $appointment)

                <tr>

                    <td>
                        {{ $appointment->appointment_date }}
                    </td>

                    <td>
                        {{ $appointment->appointment_time }}
                    </td>

                    <td>
                        {{ ucfirst($appointment->status) }}
                    </td>

                    <td>
                        {{ $appointment->reason }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">
                        No appointment history found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="table-card">

    <h2>
        Patient History Timeline
    </h2>

    @forelse($medicalRecords as $record)

        <div class="timeline-item">

            <div class="timeline-dot"></div>

            <div class="timeline-content">

                <h4>
                    {{ $record->created_at->format('d M Y') }}
                </h4>

                <p>
                    <strong>Diagnosis:</strong>
                    {{ $record->diagnosis }}
                </p>

                <p>
                    <strong>Prescription:</strong>
                    {{ Str::limit($record->prescription,100) }}
                </p>

                <a
                    href="/doctor/medical-records/{{ $record->id }}"
                    class="view-btn">

                    View Record

                </a>

            </div>

        </div>

    @empty

        <p>
            No medical history available.
        </p>

    @endforelse

</div>
<div class="page-footer-actions">

    <button
        type="button"
        class="btn-back"
        onclick="history.back()">
        ← Back
    </button>

</div>
@endsection