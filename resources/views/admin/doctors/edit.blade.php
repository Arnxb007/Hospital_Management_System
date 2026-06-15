@extends('layouts.dashboard')

@section('title', 'Edit Doctor')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>Edit Doctor</h1>
        <p>Update doctor information.</p>
    </div>

</div>

<div class="table-card">

    <form method="POST"
          action="/admin/doctors/{{ $doctor->id }}">

        @csrf
        @method('PUT')

        <div class="info-card">

            <h3>Personal Information</h3>

            <div class="profile-grid">

                <div>
                    <label>First Name</label>
                    <input type="text"
                           name="first_name"
                           value="{{ $doctor->user->first_name }}">
                </div>

                <div>
                    <label>Last Name</label>
                    <input type="text"
                           name="last_name"
                           value="{{ $doctor->user->last_name }}">
                </div>

                <div>
                    <label>Username</label>
                    <input type="text"
                           name="username"
                           value="{{ $doctor->user->username }}">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           value="{{ $doctor->user->email }}">
                </div>

                <div>
                    <label>Phone</label>
                    <input type="text"
                           name="phone"
                           value="{{ $doctor->user->phone }}">
                </div>

            </div>

        </div>

        <div class="info-card" style="margin-top:20px;">

            <h3>Professional Information</h3>

            <div class="profile-grid">

                <div>
                    <label>License Number</label>

                    <input type="text"
                           name="license_number"
                           value="{{ $doctor->license_number }}">
                </div>

                <div>
                    <label>Specialization</label>

                    <select name="specialization_id">

                        @foreach($specializations as $specialization)

                            <option
                                value="{{ $specialization->id }}"
                                {{ $doctor->specialization_id == $specialization->id ? 'selected' : '' }}
                            >
                                {{ $specialization->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div>
                    <label>Qualification</label>

                    <input type="text"
                           name="qualification"
                           value="{{ $doctor->qualification }}">
                </div>

                <div>
                    <label>Experience (Years)</label>

                    <input type="number"
                           name="experience_years"
                           value="{{ $doctor->experience_years }}">
                </div>

                <div>
                    <label>Consultation Fee (₹)</label>

                    <input type="number"
                           name="consultation_fee"
                           value="{{ $doctor->consultation_fee }}">
                </div>

            </div>

        </div>

        <div class="info-card" style="margin-top:20px;">

            <h3>Availability</h3>

            <div class="condition-grid">

                <label>

                    <input
                        type="checkbox"
                        name="is_available"
                        {{ $doctor->is_available ? 'checked' : '' }}
                    >

                    Available For Appointment

                </label>

            </div>

        </div>

        <button
            type="submit"
            class="search-btn"
            style="width:250px;margin-top:20px;"
        >
            Save Doctor Record
        </button>

    </form>

</div>

@endsection