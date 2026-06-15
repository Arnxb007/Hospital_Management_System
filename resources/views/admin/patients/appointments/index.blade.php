@extends('layouts.dashboard')

@section('title','Appointments')

@section('content')

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
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

@foreach($appointments as $appointment)

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
    {{ ucfirst($appointment->status) }}
</td>

<td>

    <a href="/admin/appointments/{{ $appointment->id }}/confirm">
        Confirm
    </a>

    |

    <a href="/admin/appointments/{{ $appointment->id }}/complete">
        Complete
    </a>

    |

    <a href="/admin/appointments/{{ $appointment->id }}/cancel">
        Cancel
    </a>

</td>

</tr>

@endforeach

</tbody>

</table>
    <div class="pagination-wrapper">
        {{ $appointments->links() }}
    </div>
</div>

@endsection