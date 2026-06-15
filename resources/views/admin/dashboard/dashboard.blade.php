@extends('layouts.dashboard')

@section('title','Admin Dashboard')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Admin Dashboard
        </h1>

        <p>
            Hospital overview and system statistics.
        </p>

    </div>

    <a href="/admin/doctors/create" class="add-btn">
        + Add Doctor
    </a>

</div>

<div class="stats-grid">

    <div class="stat-card">
        <h3>
            Total Doctors
        </h3>

        <div class="stat-number">
            {{ $totalDoctors }}
        </div>

    </div>

    <div class="stat-card">

        <h3>
            Total Patients
        </h3>

        <div class="stat-number">
            {{ $totalPatients }}
        </div>

    </div>

    <div class="stat-card">

        <h3>
            Total Appointments
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

</div>
<div class="dashboard-charts">

    <div class="chart-card">
        <h3>Appointments</h3>
        <canvas id="appointmentChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Revenue</h3>
        <canvas id="revenueChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Status</h3>
        <canvas id="statusChart"></canvas>
    </div>

</div>
<div class="table-card">

    <div class="table-header">

        <h2>
            Today's Activity
        </h2>

    </div>

    <table class="modern-table">

        <thead>

            <tr>

                <th>Activity</th>
                <th>Count</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>
                    Today's Appointments
                </td>

                <td>
                    {{ $appointmentsToday }}
                </td>

            </tr>

            <tr>

                <td>
                    Pending Appointments
                </td>

                <td>
                    {{ $pendingAppointments }}
                </td>

            </tr>

            <tr>

                <td>
                    Completed Appointments
                </td>

                <td>
                    {{ $completedAppointments }}
                </td>

            </tr>

        </tbody>

    </table>

</div>

@if(isset($recentAppointments))

<div class="table-card">

    <div class="table-header">

        <h2>
            Recent Appointments
        </h2>

    </div>

    <table class="modern-table">

        <thead>

            <tr>

                <th>Patient</th>
                <th>Doctor</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @forelse($recentAppointments as $appointment)

            <tr>

                <td>
                    {{ $appointment->patient->user->full_name }}
                </td>

                <td>
                    {{ $appointment->doctor->user->full_name }}
                </td>

                <td>

                    <span class="status-badge active-status">

                        {{ ucfirst($appointment->status) }}

                    </span>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="3">
                    No recent appointments found.
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endif
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(
document.getElementById('appointmentChart'),
{
    type:'line',

    data:{
        labels:@json(
            $appointmentTrend->pluck('day')
        ),

        datasets:[{
            label:'Appointments',

            data:@json(
                $appointmentTrend->pluck('total')
            ),

            borderWidth:3,
            tension:0.4
        }]
    }
});
</script>
<script>
new Chart(
document.getElementById('revenueChart'),
{
    type:'bar',

    data:{
        labels:@json(
            $revenueTrend->pluck('day')
        ),

        datasets:[{
            label:'Revenue',

            data:@json(
                $revenueTrend->pluck('total')
            )
        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false
    }
});
</script>
<script>
new Chart(
document.getElementById('statusChart'),
{
    type:'pie',

    data:{
        labels:@json(
            $appointmentStatus->pluck('status')
        ),

        datasets:[{
            data:@json(
                $appointmentStatus->pluck('total')
            )
        }]
    }
});
</script>

@endsection
