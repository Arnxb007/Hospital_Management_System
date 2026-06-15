@extends('layouts.dashboard')

@section('title', 'Schedule Management')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>Schedule Management</h1>
        <p>
            Manage your availability and appointment slots.
        </p>
    </div>

</div>

@if(session('success'))

<div class="success-box">
    {{ session('success') }}
</div>

@endif

<div class="table-card">

    <form method="POST"
          action="/doctor/schedule">

        @csrf

        <h3>Working Days</h3>

        <div class="days-grid">

            <label>
                <input type="checkbox"
                       name="monday"
                       {{ $schedule?->monday ? 'checked' : '' }}>
                Monday
            </label>

            <label>
                <input type="checkbox"
                       name="tuesday"
                       {{ $schedule?->tuesday ? 'checked' : '' }}>
                Tuesday
            </label>

            <label>
                <input type="checkbox"
                       name="wednesday"
                       {{ $schedule?->wednesday ? 'checked' : '' }}>
                Wednesday
            </label>

            <label>
                <input type="checkbox"
                       name="thursday"
                       {{ $schedule?->thursday ? 'checked' : '' }}>
                Thursday
            </label>

            <label>
                <input type="checkbox"
                       name="friday"
                       {{ $schedule?->friday ? 'checked' : '' }}>
                Friday
            </label>

            <label>
                <input type="checkbox"
                       name="saturday"
                       {{ $schedule?->saturday ? 'checked' : '' }}>
                Saturday
            </label>

            <label>
                <input type="checkbox"
                       name="sunday"
                       {{ $schedule?->sunday ? 'checked' : '' }}>
                Sunday
            </label>

        </div>

        <div class="profile-grid">

            <div>

                <label>Start Time</label>

                <input
                    type="time"
                    name="start_time"
                    value="{{ $schedule?->start_time }}">

            </div>

            <div>

                <label>End Time</label>

                <input
                    type="time"
                    name="end_time"
                    value="{{ $schedule?->end_time }}">

            </div>

            <div>

                <label>Slot Duration (Minutes)</label>

                <select name="slot_duration">

                    <option value="15"
                        {{ $schedule?->slot_duration == 15 ? 'selected' : '' }}>
                        15 Minutes
                    </option>

                    <option value="30"
                        {{ $schedule?->slot_duration == 30 ? 'selected' : '' }}>
                        30 Minutes
                    </option>

                    <option value="45"
                        {{ $schedule?->slot_duration == 45 ? 'selected' : '' }}>
                        45 Minutes
                    </option>

                    <option value="60"
                        {{ $schedule?->slot_duration == 60 ? 'selected' : '' }}>
                        60 Minutes
                    </option>

                </select>

            </div>

        </div>

        <div style="margin-top:20px;">

            <label>

                <input
                    type="checkbox"
                    name="is_available"
                    {{ $schedule?->is_available ? 'checked' : '' }}>

                Available For Appointments

            </label>

        </div>

        <button
            type="submit"
            class="search-btn"
            style="margin-top:25px;">

            Save Schedule

        </button>

    </form>

</div>

@endsection