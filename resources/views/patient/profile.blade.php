@extends('layouts.dashboard')

@section('title','My Profile')

@section('content')

<h1>My Health Profile</h1>

@if(session('success'))

<div class="success-message">

    {{ session('success') }}

</div>

@endif

<form
    method="POST"
    enctype="multipart/form-data">
<div class="profile-photo-wrapper">

    @if($patient->profile_photo)

        <img
            src="{{ asset('storage/'.$patient->profile_photo) }}"
            class="profile-photo">

    @else

        <div class="profile-photo-placeholder">

            👤

        </div>

    @endif

    <label
        for="profile_photo"
        class="photo-overlay">

        📷 Edit Photo

    </label>

</div>

<input
    type="file"
    id="profile_photo"
    name="profile_photo"
    accept="image/*"
    style="display:none;">
    @csrf
    <label>Date of Birth</label>
<input
    type="date"
    name="date_of_birth"
    value="{{ $patient->date_of_birth }}">

<label>Gender</label>
<select name="gender">

    <option value="male"
        {{ $patient->gender=='male'?'selected':'' }}>
        Male
    </option>

    <option value="female"
        {{ $patient->gender=='female'?'selected':'' }}>
        Female
    </option>

</select>

<label>Blood Group</label>
<input
    type="text"
    name="blood_group"
    value="{{ $patient->blood_group }}">

    <label>Allergies</label>
<textarea name="allergies">{{ $patient->allergies }}</textarea>

<label>Medical History</label>
<textarea name="medical_history">{{ $patient->medical_history }}</textarea>

<label>Current Medications</label>
<textarea name="current_medications">{{ $patient->current_medications }}</textarea>

<label>Past Surgeries</label>
<textarea name="past_surgeries">{{ $patient->past_surgeries }}</textarea>
<button
    type="submit"
    class="add-btn">

    Save Profile

</button>

</form>
<script>

document
.getElementById('profile_photo')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(!file) return;

    const reader = new FileReader();

    reader.onload = function(event){

        document
        .querySelector('.profile-photo')
        .src = event.target.result;

    };

    reader.readAsDataURL(file);

});

</script>
@endsection