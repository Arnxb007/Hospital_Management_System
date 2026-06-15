@extends('layouts.app')

@section('title', 'Medical History')

@section('content')
<div class="step-header">

    <div class="step-badge">
        AI Medical Assessment
    </div>

    <h1>Patient Health Profile</h1>

</div>

<div class="interview-container">

    <div class="progress-bar">
        <div class="progress-fill" style="width:75%"></div>
    </div>

    <div class="chat-card">

        <div class="doctor-message">
            👨‍⚕️ Thank you. Now I'd like to know about your previous treatments and medications.
        </div>

        <form method="POST" action="/patient/profile/step-3">

            @csrf

            <div class="doctor-question">
                Have you undergone any major surgery?
            </div>

            <textarea
                name="past_surgeries"
                placeholder="Example: Appendicitis surgery in 2021, Knee surgery in 2023, or write None"
            ></textarea>

            <div class="doctor-question">
                Are you currently taking any medications?
            </div>

            <textarea
                name="current_medications"
                placeholder="Example: Metformin, Insulin, Blood Pressure Medicines, or write None"
            ></textarea>

            <div class="doctor-question">
                When was your last health checkup?
            </div>

            <input
                type="date"
                name="last_health_checkup"
            >

            <button type="submit">
                Continue
            </button>

        </form>

    </div>

</div>

@endsection