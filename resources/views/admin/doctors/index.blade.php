@extends('layouts.dashboard')

@section('title', 'Doctor Management')

@section('content')

@if(session('success'))

<div class="success-box">
    {{ session('success') }}
</div>

@endif
<div class="dashboard-header">

    <div>
        <h1>Doctor Management</h1>
        <p>Manage doctors, specializations and hospital staff.</p>
    </div>

    <a href="/admin/doctors/create" class="add-btn">
        + Add Doctor
    </a>

</div>

<div class="stats-grid">

    <div class="stat-card">
        <h3>Total Doctors</h3>
        <div class="stat-number">
            {{ $totalDoctors ?? 0 }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Specializations</h3>
        <div class="stat-number">
            {{ $totalSpecializations ?? 0 }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Active Doctors</h3>
        <div class="stat-number">
            {{ $activeDoctors }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Inactive Doctors</h3>
        <div class="stat-number">
            {{ $inactiveDoctors }}
        </div>
    </div>

</div>

<div class="table-card">

    <div class="table-header">
        <h2>Doctors List</h2>
    </div>

    <table class="modern-table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Specialization</th>
                <th>Experience</th>
                <th>Fee</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($doctors ?? [] as $doctor)

                <tr>

                    <td>
                        {{ $doctor->user->full_name }}
                    </td>

                    <td>
                        {{ $doctor->specialization->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $doctor->experience_years ?? 0 }} Years
                    </td>

                    <td>
                        ₹{{ $doctor->consultation_fee ?? 0 }}
                    </td>

                    <td>

                        @if($doctor->is_available)

                            <span class="status-badge active-status">
                                Active
                            </span>

                        @else

                            <span class="status-badge inactive-status">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td>

                        <a
                            class="action-view"
                            href="/admin/doctors/{{ $doctor->id }}"
                        >
                            View
                        </a>

                        <a
                            class="action-edit"
                            href="/admin/doctors/{{ $doctor->id }}/edit"
                        >
                            Edit
                        </a>
                        <a
                        href="/admin/doctors/{{ $doctor->id }}/schedule"
                        class="action-view">
                        Schedule
                        </a>

                        <form
                            action="/admin/doctors/{{ $doctor->id }}"
                            method="POST"
                            style="display:inline;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="action-delete"
                                onclick="return confirm('Delete this doctor?')"
                            >
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        No doctors added yet.
                    </td>
                </tr>

            @endforelse

        </tbody>
        
    </table>

</div>

@endsection