@extends('layouts.dashboard')

@section('title', 'Doctor Schedule')

@section('content')

<h1>
    Schedule - Dr. {{ $doctor->user->full_name }}
</h1>

@if(session('success'))
<div class="success-box">
    {{ session('success') }}
</div>
@endif

<div class="table-card">

<form method="POST">

    @csrf

    <h3>Working Days</h3>

    <div class="condition-grid">

        <label>
            <input type="checkbox" name="monday"
            {{ $schedule->monday ? 'checked' : '' }}>
            Monday
        </label>

        <label>
            <input type="checkbox" name="tuesday"
            {{ $schedule->tuesday ? 'checked' : '' }}>
            Tuesday
        </label>

        <label>
            <input type="checkbox" name="wednesday"
            {{ $schedule->wednesday ? 'checked' : '' }}>
            Wednesday
        </label>

        <label>
            <input type="checkbox" name="thursday"
            {{ $schedule->thursday ? 'checked' : '' }}>
            Thursday
        </label>

        <label>
            <input type="checkbox" name="friday"
            {{ $schedule->friday ? 'checked' : '' }}>
            Friday
        </label>

        <label>
            <input type="checkbox" name="saturday"
            {{ $schedule->saturday ? 'checked' : '' }}>
            Saturday
        </label>

        <label>
            <input type="checkbox" name="sunday"
            {{ $schedule->sunday ? 'checked' : '' }}>
            Sunday
        </label>

    </div>

    <div class="profile-grid">

        <div>
            <label>Start Time</label>
            <input type="time"
                   name="start_time"
                   value="{{ $schedule->start_time }}">
        </div>

        <div>
            <label>End Time</label>
            <input type="time"
                   name="end_time"
                   value="{{ $schedule->end_time }}">
        </div>

        <div>
            <label>Slot Duration (Minutes)</label>

            <select name="slot_duration">

                <option value="15">15</option>
                <option value="30"
                {{ $schedule->slot_duration == 30 ? 'selected' : '' }}>
                30
                </option>

                <option value="45">45</option>
                <option value="60">60</option>

            </select>

        </div>

    </div>

    <button
        type="submit"
        class="search-btn"
        style="margin-top:20px;">
        Save Schedule
    </button>

</form>

</div>

@endsection