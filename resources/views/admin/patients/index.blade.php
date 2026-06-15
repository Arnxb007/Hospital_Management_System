@extends('layouts.dashboard')

@section('title', 'Patients')

@section('content')
<div class="stats-grid">

    <div class="stat-card">
        <h3>Total Patients</h3>
        <div class="stat-number">
            {{ $patients->count() }}
        </div>
    </div>

    <div class="stat-card">
        <h3>Profile Completed</h3>
        <div class="stat-number">
            {{ $patients->where('profile_completed',1)->count() }}
        </div>
    </div>

</div>
<form method="GET" action="/admin/patients" class="search-bar">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search by name, email or phone..."
    >

    <button type="submit" class="search-btn">
        Search
    </button>

    <a href="/admin/patients" class="reset-btn">
        Reset
    </a>

</form>

@if(session('success'))

<div class="success-box">
    {{ session('success') }}
</div>

@endif

<div class="dashboard-header">

    <div>
        <h1>Patient Management</h1>
        <p>Manage all registered patients.</p>
    </div>

</div>

<div class="table-card">

    <table class="modern-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @foreach($patients as $patient)

            <tr>

                <td>{{ $patient->id }}</td>

                <td>
                    {{ $patient->user->full_name }}
                </td>

                <td>
                    {{ $patient->user->email }}
                </td>

                <td>
                    {{ $patient->user->phone }}
                </td>

               <td>

                    <a class="action-view"
                    href="/admin/patients/{{ $patient->id }}">
                        View
                    </a>

                    <a class="action-edit"
                    href="/admin/patients/{{ $patient->id }}/edit">
                        Edit
                    </a>

                    <form
                        action="/admin/patients/{{ $patient->id }}"
                        method="POST"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            class="action-delete"
                            onclick="return confirm('Delete this patient?')">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection