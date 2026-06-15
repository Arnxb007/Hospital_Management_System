@extends('layouts.app')

@section('title', 'Complete Profile')

@section('content')

<div class="login-container">

    <div class="login-card profile-card">

        <h2>Complete Your Profile</h2>

        <p>
            Please fill your medical information
        </p>

        <form method="POST" action="/patient/complete-profile">

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

            <textarea
                name="address"
                placeholder="Address"
            ></textarea>

            <input
                type="text"
                name="emergency_contact"
                placeholder="Emergency Contact Number"
            >

            <textarea
                name="allergies"
                placeholder="Allergies"
            ></textarea>

            <textarea
                name="medical_history"
                placeholder="Medical History"
            ></textarea>

            <button type="submit">
                Save Profile
            </button>

        </form>

    </div>

</div>

@endsection