@extends('layouts.dashboard')

@section('title', 'Edit Patient')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>Edit Patient</h1>
        <p>Update patient information.</p>
    </div>

</div>

<div class="table-card">

    <form method="POST"
          action="/admin/patients/{{ $patient->id }}">

        @csrf
        @method('PUT')
        <div class="info-card">

            <h3>Personal Information</h3>

            <div class="profile-grid">

                <div>
                    <label>First Name</label>
                    <input type="text"
                        name="first_name"
                        value="{{ $patient->user->first_name }}">
                </div>

                <div>
                    <label>Last Name</label>
                    <input type="text"
                        name="last_name"
                        value="{{ $patient->user->last_name }}">
                </div>

                <div>
                    <label>Username</label>
                    <input type="text"
                        name="username"
                        value="{{ $patient->user->username }}">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email"
                        name="email"
                        value="{{ $patient->user->email }}">
                </div>

                <div>
                    <label>Phone</label>
                    <input type="text"
                        name="phone"
                        value="{{ $patient->user->phone }}">
                </div>

                <div>
                    <label>Date Of Birth</label>
                    <input type="date"
                        name="date_of_birth"
                        value="{{ $patient->date_of_birth }}">
                </div>

            </div>

        </div>
    

        <div class="info-card">

            <h3>Physical Information</h3>

            <div class="profile-grid">

                <div>
                    <label>Gender</label>

                    <select name="gender">

                        <option value="male">Male</option>
                        <option value="female">Female</option>

                    </select>

                </div>

                <div>
                    <label>Blood Group</label>

                    <select name="blood_group">

                        <option>A+</option>
                        <option>B+</option>
                        <option>O+</option>
                        <option>AB+</option>
                        <option>A-</option>
                        <option>B-</option>
                        <option>O-</option>
                        <option>AB-</option>

                    </select>

                </div>

                <div>
                    <label>Height (cm)</label>

                    <input type="number"
                        name="height"
                        value="{{ $patient->height }}">
                </div>

                <div>
                    <label>Weight (kg)</label>

                    <input type="number"
                        name="weight"
                        value="{{ $patient->weight }}">
                </div>

            </div>

        </div>
        <div class="info-card">

            <h3>Medical Conditions</h3>

            <div class="condition-grid">

                <label>
                    <input type="checkbox"
                        name="has_diabetes"
                        {{ $patient->has_diabetes ? 'checked' : '' }}>
                    Diabetes
                </label>

                <label>
                    <input type="checkbox"
                        name="has_hypertension"
                        {{ $patient->has_hypertension ? 'checked' : '' }}>
                    Hypertension
                </label>

                <label>
                    <input type="checkbox"
                        name="has_asthma"
                        {{ $patient->has_asthma ? 'checked' : '' }}>
                    Asthma
                </label>

                <label>
                    <input type="checkbox"
                        name="has_heart_disease"
                        {{ $patient->has_heart_disease ? 'checked' : '' }}>
                    Heart Disease
                </label>

            </div>

        </div>
        <div class="info-card">

            <h3>Medical History</h3>
            <div class="condition-grid">

                <label>
                    <input type="checkbox"
                        name="smoker"
                        {{ $patient->smoker ? 'checked' : '' }}>
                    Smoker
                </label>

                <label>
                    <input type="checkbox"
                        name="alcohol_consumer"
                        {{ $patient->alcohol_consumer ? 'checked' : '' }}>
                    Alcohol Consumer
                </label>

            </div>
            <label>Current Medications</label>
            <textarea name="current_medications">{{ $patient->current_medications }}</textarea>

            <label>Past Surgeries</label>
            <textarea name="past_surgeries">{{ $patient->past_surgeries }}</textarea>

            <label>Allergies</label>
            <textarea name="allergies">{{ $patient->allergies }}</textarea>

            <label>Medical History</label>
            <textarea name="medical_history">{{ $patient->medical_history }}</textarea>

            <label>Family Medical History</label>
            <textarea name="family_medical_history">{{ $patient->family_medical_history }}</textarea>

            <label>Last Health Checkup</label>
            <input type="date"
                name="last_health_checkup"
                value="{{ $patient->last_health_checkup }}">

            <label>Additional Notes</label>
            <textarea name="additional_notes">{{ $patient->additional_notes }}</textarea>
        <button
            type="submit"
            class="search-btn"
            style="width:250px;margin-top:20px;"
        >
            Save Patient Record
        </button>

    </form>

</div>

@endsection