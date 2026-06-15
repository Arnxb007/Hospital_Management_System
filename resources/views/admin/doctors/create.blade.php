@extends('layouts.dashboard')

@section('title', 'Add Doctor')

@section('content')

<div class="chat-card">

    <h2>Add New Doctor</h2>
    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/admin/doctors/store">

        @csrf

        <input type="text"
               name="first_name"
               placeholder="First Name"
               required>

        <input type="text"
               name="last_name"
               placeholder="Last Name"
               required>

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <input type="text"
               name="phone"
               placeholder="Phone Number">

        <select name="specialization_id" required>

            <option value="">
                Select Specialization
            </option>

            @foreach($specializations as $specialization)

                <option value="{{ $specialization->id }}">
                    {{ $specialization->name }}
                </option>

            @endforeach

        </select>

        <input type="text"
               name="qualification"
               placeholder="Qualification">

        <input type="number"
               name="experience_years"
               placeholder="Experience (Years)">

        <input type="number"
               step="0.01"
               name="consultation_fee"
               placeholder="Consultation Fee">

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit">
            Create Doctor
        </button>

    </form>

</div>

@endsection