@extends('layouts.dashboard')

@section('title', 'Patient Dashboard')

@section('content')

<div class="stats-grid">

    <div class="stat-card">
        <h3>Confirmed Appointments</h3>
        <div class="stat-number">
            {{ $confirmedAppointments }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Reports</h3>
        <div class="stat-number">0</div>
    </div>

    <div class="stat-card">
        <h3>AI Scans</h3>
        <div class="stat-number">0</div>
    </div>

</div>

@endsection