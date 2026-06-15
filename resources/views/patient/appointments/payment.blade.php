@extends('layouts.dashboard')

@section('title','Payment')

@section('content')

<div class="table-card">

    <h1>
        Appointment Payment
    </h1>

    <p>
        Consultation Fee:
        ₹{{ $doctor->consultation_fee }}
    </p>

    <button
        id="rzp-button"
        class="add-btn">

        Pay Now

    </button>

</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var options = {

    "key":
        "{{ config('razorpay.key_id') }}",

    "amount":
        "{{ $order['amount'] }}",

    "currency":
        "INR",

    "name":
        "Hospital Management System",

    "description":
        "Appointment Booking",

    "order_id":
        "{{ $order['id'] }}",

    "handler":
        function (response)
        {

            let form =
                document.createElement('form');

            form.method = 'POST';

            form.action =
                "{{ route('patient.appointments.payment.complete') }}";

            form.innerHTML =
                `
                @csrf

                <input
                    type="hidden"
                    name="payment_id"
                    value="${response.razorpay_payment_id}">

                <input
                    type="hidden"
                    name="order_id"
                    value="${response.razorpay_order_id}">

                <input
                    type="hidden"
                    name="signature"
                    value="${response.razorpay_signature}">
                `;

            document.body.appendChild(form);

            form.submit();

        }

};

var rzp1 =
    new Razorpay(options);

document
.getElementById('rzp-button')
.onclick =
function(e)
{
    rzp1.open();

    e.preventDefault();
}

</script>

@endsection