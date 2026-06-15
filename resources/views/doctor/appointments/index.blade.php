@extends('layouts.dashboard')

@section('title','My Appointments')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>My Appointments</h1>
        <p>
            Manage patient appointments.
        </p>
    </div>

</div>

<div class="table-card">

    <table class="modern-table">

        <thead>

            <tr>
                <th>Patient</th>
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

                    @if($appointment->status=='pending')

                        <span class="status-pending">
                            Pending
                        </span>

                    @elseif($appointment->status=='confirmed')

                        <span class="status-confirmed">
                            Confirmed
                        </span>

                    @elseif($appointment->status=='completed')

                        <span class="status-completed">
                            Completed
                        </span>

                    @else

                        <span class="status-cancelled">
                            Cancelled
                        </span>

                    @endif

                </td>

                <td>

                   <a href="/doctor/appointments/{{ $appointment->id }}">
                        View
                    </a>
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6">
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
<div class="page-footer-actions">
    <button
        type="button"
        class="btn-back"
        onclick="history.back()">
        Back
    </button>

</div>
@endsection
