@extends('layouts.dashboard')

@section('title', 'My Appointments')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>My Appointments</h1>
        <p>
            View and manage your appointments.
        </p>
    </div>

    <a href="/patient/appointments/create"
       class="add-btn">
        + Book Appointment
    </a>

</div>

@if(session('success'))

<div class="success-box">
    {{ session('success') }}
</div>

@endif

<div class="table-card">

    <table class="modern-table">

        <thead>

            <tr>
                <th>Doctor</th>
                <th>Specialization</th>
                <th>Date</th>
                <th>Time</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            @forelse($appointments as $appointment)

            <tr>

                <td>
                    Dr.
                    {{ $appointment->doctor->user->full_name }}
                </td>

                <td>
                    {{ $appointment->doctor->specialization->name ?? 'N/A' }}
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
                    <span class="status-confirmed">
                        {{ ucfirst($appointment->payment_status ?? 'paid') }}
                    </span>
                </td>

                <td>

                    @if($appointment->status == 'pending')

                        <span class="status-pending">
                            Pending
                        </span>

                    @elseif($appointment->status == 'confirmed')

                        <span class="status-confirmed">
                            Confirmed
                        </span>

                    @elseif($appointment->status == 'completed')

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
                {{ $appointment->reason }}
            </td>

            <td>

                @if($appointment->payment_status == 'paid')

                <a
                    href="/patient/appointments/{{ $appointment->id }}/invoice"
                    class="action-view">

                    Invoice

                </a>

                @else

                -

                @endif

            </td>
                

            </tr>

            @empty

            <tr>

                <td colspan="8">
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
