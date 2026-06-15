@extends('layouts.app')

@section('title', 'Lifestyle Assessment')

@section('content')
<div class="step-header">

    <div class="step-badge">
        AI Medical Assessment
    </div>

    <h1>Patient Health Profile</h1>

</div>

<div class="interview-container">

    <div class="progress-bar">
        <div class="progress-fill" style="width:90%"></div>
    </div>

    <div class="chat-card">

        <div class="doctor-message">
            👨‍⚕️ Almost done. Lifestyle and family history can help us understand potential health risks.
        </div>

        <form method="POST" action="/patient/profile/step-4">

            @csrf

            <div class="doctor-question">
                Do you smoke?
            </div>

            <div class="option-group">

                <label>
                    <input type="radio" name="smoker" value="0" checked>
                    No
                </label>

                <label>
                    <input type="radio" name="smoker" value="1">
                    Yes
                </label>

            </div>

            <div class="doctor-question">
                Do you consume alcohol?
            </div>

            <div class="option-group">

                <label>
                    <input type="radio" name="alcohol_consumer" value="0" checked>
                    No
                </label>

                <label>
                    <input type="radio" name="alcohol_consumer" value="1">
                    Yes
                </label>

            </div>

            <div class="doctor-question">
                Family Medical History
            </div>

            <textarea
                name="family_medical_history"
                placeholder="Example: Father has diabetes, Mother has hypertension..."
            ></textarea>

            <div class="doctor-question">
                Anything else you want your doctor to know?
            </div>

            <textarea
                name="additional_notes"
                placeholder="Additional medical information..."
            ></textarea>

            <button type="submit">
                Review Profile
            </button>

        </form>

    </div>

</div>

@endsection