@extends('layouts.app')

@section('title', 'Medical Assessment')

@section('content')
<div class="step-header">

    <div class="step-badge">
        AI Medical Assessment
    </div>

    <h1>Patient Health Profile</h1>

</div>

<div class="interview-container">

    <div class="progress-bar">
        <div class="progress-fill" style="width:25%"></div>
    </div>

    <div class="chat-card">

        <div class="doctor-message">
            👨‍⚕️ Hello {{ Auth::user()->first_name }},
            I'm going to collect some medical information before your first consultation.
        </div>

        <div class="doctor-question">
            Let's start with your basic details.
        </div>

        <form method="POST" action="/patient/profile/step-1">

            @csrf

            <input
                type="date"
                name="date_of_birth"
                required
            >

            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <input
                type="text"
                name="blood_group"
                placeholder="Blood Group"
            >

            <input
                type="number"
                step="0.01"
                name="height"
                placeholder="Height (cm)"
            >

            <input
                type="number"
                step="0.01"
                name="weight"
                placeholder="Weight (kg)"
            >

            <button type="submit">
                Continue
            </button>

        </form>

    </div>

</div>

@endsection