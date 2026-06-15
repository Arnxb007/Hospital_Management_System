@extends('layouts.dashboard')

@section('title','Appointment Details')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>Appointment Details</h1>
    </div>

</div>

<div class="profile-grid">

    <div class="info-card">

        <h3>Patient Information</h3>

        <p>
            Name:
            {{ $appointment->patient->user->full_name }}
        </p>

        <p>
            Email:
            {{ $appointment->patient->user->email }}
        </p>

        <p>
            Phone:
            {{ $appointment->patient->user->phone }}
        </p>

    </div>

    <div class="info-card">

        <h3>Appointment Information</h3>

        <p>
            Date:
            {{ $appointment->appointment_date }}
        </p>

        <p>
            Time:
            {{ $appointment->appointment_time }}
        </p>

        <p>
            Status:
            {{ ucfirst($appointment->status) }}
        </p>

        <p>
            Reason:
            {{ $appointment->reason }}
        </p>

    </div>

</div>
<div class="page-footer-actions">

    @if($appointment->status == 'pending')

        <a href="/doctor/appointments/{{ $appointment->id }}/confirm"
           class="btn-success">
            Confirm
        </a>

        <a href="/doctor/appointments/{{ $appointment->id }}/cancel"
           class="btn-danger">
            Cancel
        </a>

    @elseif($appointment->status == 'confirmed')

        <a href="/doctor/appointments/{{ $appointment->id }}/complete"
           class="btn-primary">
            Mark Completed
        </a>

    @endif
@php

$record = \App\Models\MedicalRecord::where(
    'appointment_id',
    $appointment->id
)->first();

@endphp

@if($appointment->status == 'completed')

    @if(!$record)
        <div style="width:100%; margin-top:20px;">
   
    <div class="table-card">

        <div class="table-header">
            <h2>Add Medical Record</h2>
        </div>

        <form
            method="POST"
            action="/doctor/appointments/{{ $appointment->id }}/record">

            @csrf

            <label>Diagnosis</label>

            <textarea
                name="diagnosis"
                rows="4"
                required></textarea>

            <label>Prescription</label>

            <textarea
                name="prescription"
                rows="4"></textarea>

            <label>Notes</label>

            <textarea
                name="notes"
                rows="4"></textarea>

            <button
                type="submit"
                class="search-btn">

                Save Record

            </button>

        </form>

    </div>
</div>
    @else

    <div class="success-box">

        Medical record already created for this appointment.

    </div>

    <a
        href="/doctor/medical-records/{{ $record->id }}"
        class="btn-primary">

        View Medical Record

    </a>

    @endif

@endif
</div>
@endsection
