@extends('layouts.app')

@section('title', 'Health Conditions')

@section('content')
<div class="step-header">

    <div class="step-badge">
        AI Medical Assessment
    </div>

    <h1>Patient Health Profile</h1>

</div>

<div class="interview-container">

    <div class="progress-bar">
        <div class="progress-fill" style="width:50%"></div>
    </div>

    <div class="chat-card">

        <div class="doctor-message">
            👨‍⚕️ Thank you. Now I'd like to know about your current health conditions.
        </div>

        <form method="POST" action="/patient/profile/step-2">

            @csrf

            <div class="condition-grid">

                <label class="condition-card">
                    <input type="checkbox" name="has_diabetes">
                    <span>🩸 Diabetes</span>
                </label>

                <label class="condition-card">
                    <input type="checkbox" name="has_hypertension">
                    <span>❤️ High Blood Pressure</span>
                </label>

                <label class="condition-card">
                    <input type="checkbox" name="has_heart_disease">
                    <span>💓 Heart Disease</span>
                </label>

                <label class="condition-card">
                    <input type="checkbox" name="has_asthma">
                    <span>🫁 Asthma</span>
                </label>

            </div>

            <button type="submit">
                Continue
            </button>

        </form>

    </div>

</div>

@endsection