<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title>Invoice</title>

<style>

body{
    font-family: DejaVu Sans;
    color:#1f2937;
    font-size:13px;
}

.header{
    border-bottom:4px solid #0f766e;
    padding-bottom:10px;
    margin-bottom:25px;
}

.hospital{
    font-size:32px;
    font-weight:bold;
    color:#134e4a;
}

.subtitle{
    color:#6b7280;
    font-size:18px;
}

.top-right{
    float:right;
    text-align:right;
    font-size:14px;
    color:#4b5563;
}

.section-title{
    background:#e6f3f1;
    border-left:6px solid #0f766e;
    padding:12px;
    margin-top:20px;
    margin-bottom:10px;
    font-size:24px;
    font-weight:bold;
    color:#134e4a;
}

.table{
    width:100%;
    border-collapse:collapse;
    margin-bottom:20px;
}

.table td,
.table th{
    border:1px solid #d1d5db;
    padding:12px;
}

.label{
    background:#f3f4f6;
    font-weight:bold;
    width:25%;
    color:#4b5563;
}

.summary-box{
    border:1px solid #d1d5db;
    border-radius:8px;
    padding:15px;
}

.total{
    font-size:22px;
    font-weight:bold;
    color:#134e4a;
}

.paid{
    color:green;
    font-weight:bold;
}

.footer{
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    border-top:1px solid #d1d5db;
    padding-top:8px;
    text-align:center;
    color:#6b7280;
    font-size:11px;
}

.signature{
    margin-top:50px;
}

.signature-line{
    width:250px;
    border-top:1px solid #000;
    margin-top:40px;
}

</style>

</head>

<body>

<div class="header">

    <div class="top-right">

        Invoice No:
        INV-{{ str_pad($appointment->id,5,'0',STR_PAD_LEFT) }}

        <br>

        Appointment:
        AP-{{ str_pad($appointment->id,5,'0',STR_PAD_LEFT) }}

        <br>

        Generated:
        {{ now()->format('d M Y h:i A') }}

    </div>

    <div class="hospital">
        HMS Hospital
    </div>

    <div class="subtitle">
        Appointment Payment Invoice
    </div>

</div>

<div class="section-title">
    Patient Information
</div>

<table class="table">

<tr>
    <td class="label">Name</td>
    <td>{{ $appointment->patient->user->full_name }}</td>

    <td class="label">Patient ID</td>
    <td>PT-{{ str_pad($appointment->patient->id,5,'0',STR_PAD_LEFT) }}</td>
</tr>

<tr>
    <td class="label">Email</td>
    <td>{{ $appointment->patient->user->email }}</td>

    <td class="label">Phone</td>
    <td>{{ $appointment->patient->user->phone ?? 'N/A' }}</td>
</tr>

</table>

<div class="section-title">
    Doctor Information
</div>

<table class="table">

<tr>
    <td class="label">Doctor</td>
    <td>
        Dr. {{ $appointment->doctor->user->full_name }}
    </td>

    <td class="label">Specialization</td>
    <td>
        {{ $appointment->doctor->specialization->name ?? 'N/A' }}
    </td>
</tr>

<tr>
    <td class="label">Appointment Date</td>
    <td>{{ $appointment->appointment_date }}</td>

    <td class="label">Appointment Time</td>
    <td>{{ $appointment->appointment_time }}</td>
</tr>

</table>

<div class="section-title">
    Payment Summary
</div>

<table class="table">

<tr>
    <th>Description</th>
    <th>Amount</th>
</tr>

<tr>
    <td>Consultation Fee</td>
    <td>₹{{ number_format($appointment->amount_paid,2) }}</td>
</tr>

<tr>
    <td>Total Paid</td>
    <td>
        <strong>
            ₹{{ number_format($appointment->amount_paid,2) }}
        </strong>
    </td>
</tr>

</table>

<div class="section-title">
    Payment Details
</div>

<table class="table">

<tr>
    <td class="label">Payment Status</td>
    <td class="paid">
        {{ strtoupper($appointment->payment_status) }}
    </td>
</tr>

<tr>
    <td class="label">Payment ID</td>
    <td>{{ $appointment->payment_id }}</td>
</tr>

<tr>
    <td class="label">Order ID</td>
    <td>{{ $appointment->razorpay_order_id }}</td>
</tr>

<tr>
    <td class="label">Amount Paid</td>
    <td>
        ₹{{ number_format($appointment->amount_paid,2) }}
    </td>
</tr>

</table>

<div class="section-title">
    Appointment Details
</div>

<table class="table">

<tr>
    <td class="label">Status</td>
    <td>{{ ucfirst($appointment->status) }}</td>
</tr>

<tr>
    <td class="label">Reason For Visit</td>
    <td>{{ $appointment->reason }}</td>
</tr>

</table>

<div class="section-title">
    Certification
</div>

<div class="summary-box">

    This invoice certifies that payment was successfully
    received for the above consultation appointment
    through Razorpay Payment Gateway and recorded
    in the HMS Hospital Management System.

<div class="signature">

    <strong>
        Digitally Generated Invoice
    </strong>

    <br><br>

    HMS Hospital

    <br>

    Authorized Billing Department

    <br>

    {{ now()->format('d M Y h:i A') }}

</div>

</div>

<div class="footer">

    HMS Hospital Invoice |
    Confidential payment document |
    Generated {{ now()->format('d M Y h:i A') }}

</div>

</body>
</html>