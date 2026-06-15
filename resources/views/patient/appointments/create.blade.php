@extends('layouts.dashboard')

@section('title', 'Book Appointment')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>Book Appointment</h1>
        <p>Choose a doctor and schedule your visit.</p>
    </div>

</div>
@if(session('error'))

<div class="alert-danger">
    {{ session('error') }}
</div>

@endif

@if($errors->any())

<div class="alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif
<div class="table-card">

    <form method="POST"
          action="{{ route('patient.appointments.payment') }}">

        @csrf

        <div class="profile-grid">

            <div>

                <label>Specialization</label>

                <select
                    id="specialization"
                    name="specialization_id">

                    <option value="">
                        Select Specialization
                    </option>

                    @foreach($specializations as $specialization)

                        <option
                            value="{{ $specialization->id }}">
                            {{ $specialization->name }}
                        </option>

                    @endforeach

                </select>

            </div>
            <input
                type="hidden"
                name="doctor_id"
                id="doctor_id">

            <div style="grid-column:1/-1;">

                <label>Select Doctor</label>

                <div id="doctor-cards"
                    class="doctor-cards">

                    <p>
                        Select a specialization first.
                    </p>

                </div>

            </div>
        <div style="grid-column:1/-1;">

            <label>Available Slots</label>

            <div id="slots-container">

                <p>
                    Select a specialization and doctor.
                </p>

            </div>

        </div>
            <div id="selected-slot"
                style="margin-top:15px;font-weight:600;">
            </div>
        </div>
        <input
            type="hidden"
            name="appointment_date"
            id="appointment_date">

        <input
            type="hidden"
            name="appointment_time"
            id="appointment_time">

        <label>Reason For Visit</label>

        <textarea
            name="reason"
            rows="5"
            required></textarea>

        <button
            type="submit"
            class="search-btn"
            style="margin-top:20px;">
            Continue To Payment
        </button>

    </form>

</div>
<script>

document
.getElementById('specialization')
.addEventListener(
'change',

function(){

    fetch(
        '/get-doctors/' + this.value
    )
    .then(response => response.json())
    .then(data => {

       let cards =
        document.getElementById(
            'doctor-cards'
        );

    cards.innerHTML = '';

    if(data.length === 0)
    {
        cards.innerHTML =
        `<div class="table-card">
            No available doctors in this specialization.
        </div>`;

        return;
    }

    data.forEach(item => {

        cards.innerHTML +=

        `<div
            class="doctor-card"
            onclick="selectDoctor(${item.id},this)">

<div class="doctor-avatar">

    ${item.profile_photo
        ? `<img
                src="/storage/${item.profile_photo}"
                class="doctor-image">`
        : `👨‍⚕️`
    }

</div>
            <h3>
                Dr. ${item.user.first_name}
                ${item.user.last_name}
            </h3>

            <p>
                ${item.specialization?.name ?? ''}
            </p>

            <p>
                Experience:
                ${item.experience_years ?? 0} Years
            </p>

            <p>
                Fee:
                ₹${item.consultation_fee ?? 0}
            </p>

            <p style="color:green;font-weight:600;">
                Available
            </p>
           
            <button
                type="button"
                class="select-btn">
                Select Doctor
            </button>

        </div>`;

    });

    });

});

function selectDoctor(id, card)
{
    document.getElementById(
        'doctor_id'
    ).value = id;

    document
    .querySelectorAll('.doctor-card')
    .forEach(el =>
        el.classList.remove(
            'selected-doctor'
        )
    );

    card.classList.add(
        'selected-doctor'
    );

    fetch('/doctor-slots/' + id)
    .then(response => response.json())
    .then(data => {

        let container =
            document.getElementById(
                'slots-container'
            );

        container.innerHTML = '';
        if(data.length === 0)
        {
            container.innerHTML =
            `<div class="table-card">
                No available slots for this doctor.
            </div>`;

            return;
        }
        data.forEach(slot => {

        container.innerHTML +=

        `<button
            type="button"
            class="slot-btn ${slot.booked ? 'slot-booked' : ''}"

            ${slot.booked ? 'disabled' : ''}

            onclick="
            document.getElementById('appointment_date').value='${slot.date}';
            document.getElementById('appointment_time').value='${slot.time}';

            document.querySelectorAll('.slot-btn')
            .forEach(btn => btn.classList.remove('selected-slot'));

            this.classList.add('selected-slot');

            document.getElementById('selected-slot').innerHTML=
            'Selected: ${slot.date} ${slot.time}';
            ">

            ${slot.date}<br>
            ${slot.time}

            ${slot.booked ? '<br><small>Booked</small>' : ''}

        </button>`;
    });

    });
}

</script>
@endsection
