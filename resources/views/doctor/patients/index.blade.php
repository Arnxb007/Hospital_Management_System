@extends('layouts.dashboard')

@section('title','Patients')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>My Patients</h1>
        <p>
            Patients who booked appointments with you.
        </p>
    </div>

</div>

<div class="table-card">

    <table class="modern-table">

        <thead>

            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

        @forelse($patients as $record)

            <tr>

                <td>
                    {{ $record->patient->user->full_name }}
                </td>

                <td>
                    {{ $record->patient->user->email }}
                </td>

                <td>
                    {{ $record->patient->user->phone }}
                </td>

                <td>

                    <a href="/doctor/patients/{{ $record->patient->id }}">
                        View Profile
                    </a>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4">
                    No patients found.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection