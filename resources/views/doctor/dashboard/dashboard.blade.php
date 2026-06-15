@extends('layouts.dashboard')

@section('title', 'Doctor Dashboard')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>
            Welcome Dr. {{ auth()->user()->full_name }}
        </h1>

        <p>
            Manage appointments and patients.
        </p>
    </div>

</div>

<div class="stats-grid">

    <div class="stat-card">
        <h3>Today's Appointments</h3>

        <div class="stat-number">
            {{ $todayAppointments }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Upcoming</h3>

        <div class="stat-number">
            {{ $upcomingAppointments }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Completed Today</h3>

        <div class="stat-number">
            {{ $completedToday }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Status</h3>

        <div class="doctor-status">

            @if($doctor->is_available)

                <span class="status-dot active-dot"></span>
                Active

            @else

                <span class="status-dot inactive-dot"></span>
                Inactive

            @endif

        </div>
    </div>

</div>

<div class="table-card">

    <div class="table-header">
        <h2>
            Today's Schedule
        </h2>
    </div>

    <table class="modern-table">

        <thead>

            <tr>

                <th>Time</th>

                <th>Patient</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @forelse($todaySchedule as $appointment)

                <tr>

                    <td>
                        {{ $appointment->appointment_time }}
                    </td>

                    <td>
                        {{ $appointment->patient->user->full_name }}
                    </td>

                    <td>

                        @if(
                            $appointment->status
                            == 'confirmed'
                        )

                            <span class="status-confirmed">
                                Confirmed
                            </span>

                        @elseif(
                            $appointment->status
                            == 'completed'
                        )

                            <span class="status-completed">
                                Completed
                            </span>

                        @else

                            <span class="status-pending">
                                Pending
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3">
                        No appointments today.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection