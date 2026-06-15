@extends('layouts.dashboard')

@section('title','Doctor Profile')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Doctor Profile
        </h1>

        <p>
            Manage your professional information.
        </p>

    </div>

</div>
@if(session('success'))

<div
    id="success-message"
    class="success-message">

    {{ session('success') }}

</div>

<script>

setTimeout(() => {

    let msg =
        document.getElementById(
            'success-message'
        );

    if(msg)
    {
        msg.style.display =
            'none';
    }

}, 3000);

</script>

@endif

<div class="table-card">

<form
    method="POST"
    action="/doctor/profile"
    enctype="multipart/form-data">
    @csrf
    <div class="profile-photo-wrapper">

        @if($doctor->profile_photo)

            <img
                src="{{ asset('storage/'.$doctor->profile_photo) }}"
                class="profile-photo">

        @else

            <div class="profile-photo-placeholder">

                👨‍⚕️

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
</div>
    <label>
        Qualification
    </label>

    <input
        type="text"
        name="qualification"
        value="{{ $doctor->qualification }}">

    <label>
        Experience (Years)
    </label>

    <input
        type="number"
        name="experience_years"
        value="{{ $doctor->experience_years }}">

    <label>
        Consultation Fee (₹)
    </label>

    <input
        type="number"
        step="0.01"
        name="consultation_fee"
        value="{{ $doctor->consultation_fee }}">

    <label>
        About
    </label>

    <textarea
        name="about"
        rows="5">{{ $doctor->about }}</textarea>
    <label>Doctor Signature</label>

    <div class="signature-upload">

        <input
            type="file"
            id="signature"
            name="signature"
            accept="image/png,image/jpeg,image/jpg"
            hidden>

        <label
            for="signature"
            class="signature-btn">

            ✍️ Upload Signature

        </label>

        <span id="signature-name">
            No signature selected
        </span>

    </div>

    @if($doctor->signature)

        <div class="signature-preview">

            <img
                src="{{ asset('storage/'.$doctor->signature) }}"
                alt="Doctor Signature">

        </div>

    @endif
    <div
        style="margin-top:15px;">

        <label>

            <input
                type="checkbox"
                name="is_available"
                {{ $doctor->is_available ? 'checked' : '' }}>

            Available for Appointments

        </label>

    </div>

    <button
        type="submit"
        class="add-btn"
        style="margin-top:20px;">

        Save Profile

    </button>

</form>

</div>
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
document
.getElementById('signature')
?.addEventListener('change', function(){

    const file = this.files[0];

    if(file)
    {
        document.getElementById(
            'signature-name'
        ).textContent = file.name;
    }
});
</script>
@endsection