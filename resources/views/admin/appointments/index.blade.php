@extends('layouts.dashboard')

@section('title', 'Appointments')

@section('content')
<div class="stats-grid">

    <div class="stat-card">
        <h3>Total</h3>
        <div class="stat-number">
            {{ $appointments->count() }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Pending</h3>
        <div class="stat-number">
            {{ $appointments->where('status','pending')->count() }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Confirmed</h3>
        <div class="stat-number">
            {{ $appointments->where('status','confirmed')->count() }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Completed</h3>
        <div class="stat-number">
            {{ $appointments->where('status','completed')->count() }}
        </div>
    </div>

</div>
<div class="dashboard-header">

    <div>
        <h1>Appointment Management</h1>
        <p>Manage all patient appointments.</p>
    </div>

</div>

<div class="table-card">

    <table class="modern-table">

        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @forelse($appointments as $appointment)

            <tr>

                <td>
                    {{ $appointment->patient->user->full_name }}
                </td>

                <td>
                    Dr. {{ $appointment->doctor->user->full_name }}
                </td>

                <td>
                    {{ $appointment->appointment_date }}
                </td>

                <td>
                    {{ $appointment->appointment_time }}
                </td>

                <td>
                    ₹{{ number_format($appointment->payment_amount ?? $appointment->consultation_fee ?? 0, 2) }}
                    <br>
                    {{ ucfirst($appointment->payment_status ?? 'paid') }}
                </td>

                <td>
                    {{ ucfirst($appointment->status) }}
                </td>

                <td>

                <div class="action-buttons">

                    <a
                        href="/admin/appointments/{{ $appointment->id }}/confirm"
                        class="btn-success">
                        Confirm
                    </a>

                    <a
                        href="/admin/appointments/{{ $appointment->id }}/complete"
                        class="btn-primary">
                        Complete
                    </a>

                    <a
                        href="/admin/appointments/{{ $appointment->id }}/cancel"
                        class="btn-danger">
                        Cancel
                    </a>

                </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7">
                    No appointments found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>
    <div class="pagination-wrapper">
        {{ $appointments->links() }}
    </div>
</div>

@endsection
