<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
        
    public function chat(Request $request)
    {
        $message = strtolower(trim($request->message));

        // BOOK APPOINTMENT
 $message = strtolower(trim($request->message));

$appointmentWords = [
    'appointment',
    'appionment',
    'appointement',
    'booking',
    'book',
    'schedule'
];

$foundAppointment = false;

foreach($appointmentWords as $word)
{
    if(str_contains($message,$word))
    {
        $foundAppointment = true;
        break;
    }
}

if($foundAppointment)
{
    return response()->json([
        'reply' => "
📅 Book Appointment

1. Open Book Appointment.
2. Select a specialization.
3. Choose a doctor.
4. Select an available slot.
5. Enter the reason for your visit.
6. Click Continue To Payment.
7. Complete the Razorpay payment.
8. View the appointment in My Appointments.
"
    ]);
}

        // INVOICE
        if(
            str_contains($message,'invoice') ||
            str_contains($message,'bill') ||
            str_contains($message,'payment receipt')
        )
        {
            return response()->json([
                'reply' => "
    🧾 Download Invoice

    1. Open My Appointments.
    2. Locate the appointment.
    3. Click Download Invoice.
    4. PDF invoice will be downloaded.
    "
            ]);
        }

        // MEDICAL RECORDS
        if(
            str_contains($message,'medical record') ||
            str_contains($message,'medical records') ||
            str_contains($message,'report')
        )
        {
            return response()->json([
                'reply' => "
    📋 Medical Records

    Patient:
    • Open Medical Records.
    • View previous records.
    • Download PDF reports.

    Doctor:
    • Complete an appointment.
    • Add diagnosis.
    • Add prescription.
    • Add notes.
    • Save medical record.
    "
            ]);
        }

        // DOCTOR PROFILE
        if(
            str_contains($message,'doctor profile') ||
            str_contains($message,'edit profile') ||
            str_contains($message,'profile')
        )
        {
            return response()->json([
                'reply' => "
    👨‍⚕️ Doctor Profile

    1. Open Profile.
    2. Click Edit Profile.
    3. Update qualification.
    4. Update experience.
    5. Update consultation fee.
    6. Upload profile photo.
    7. Upload signature.
    8. Save Profile.
    "
            ]);
        }

        // SIGNATURE
        if(
            str_contains($message,'signature')
        )
        {
            return response()->json([
                'reply' => "
    ✍ Doctor Signature

    1. Open Profile.
    2. Click Edit Profile.
    3. Upload signature image.
    4. Save Profile.

    The signature automatically appears on generated medical reports.
    "
            ]);
        }

        // SCHEDULE
        if(
            str_contains($message,'schedule')
        )
        {
            return response()->json([
                'reply' => "
    🗓 Doctor Schedule

    1. Open Schedule.
    2. Set start time.
    3. Set end time.
    4. Set slot duration.
    5. Save changes.
    "
            ]);
        }

        // NOTIFICATIONS
        if(
            str_contains($message,'notification') ||
            str_contains($message,'notifications')
        )
        {
            return response()->json([
                'reply' => "
    🔔 Notifications

    • Appointment requests generate notifications.
    • Appointment confirmations generate notifications.
    • Clicking a notification marks it as read automatically.
    "
            ]);
        }

        // PAYMENT
        if(
            str_contains($message,'payment') ||
            str_contains($message,'razorpay')
        )
        {
            return response()->json([
                'reply' => "
    💳 Appointment Payment

    1. Select doctor and slot.
    2. Click Continue To Payment.
    3. Complete Razorpay payment.
    4. Appointment is created automatically.
    5. Invoice becomes available.
    "
            ]);
        }

        // PATIENT FEATURES
        if(
            str_contains($message,'patient features')
        )
        {
            return response()->json([
                'reply' => "
    👤 Patient Features

    • Dashboard
    • Book Appointment
    • My Appointments
    • Medical Records
    • Notifications
    • Profile
    • Invoice Download
    "
            ]);
        }

        // DOCTOR FEATURES
        if(
            str_contains($message,'doctor features')
        )
        {
            return response()->json([
                'reply' => "
    👨‍⚕️ Doctor Features

    • Dashboard
    • Appointments
    • Patients
    • Medical Records
    • Schedule
    • Profile
    • Signature Upload
    "
            ]);
        }

        // ADMIN FEATURES
        if(
            str_contains($message,'admin features')
        )
        {
            return response()->json([
                'reply' => "
    ⚙ Admin Features

    • Dashboard
    • Doctors
    • Patients
    • Appointments
    • Specializations
    • Reports
    "
            ]);
        }

        // HEALTH QUESTIONS ONLY
        $healthKeywords = [
            'fever',
            'diabetes',
            'blood pressure',
            'hypertension',
            'cough',
            'cold',
            'flu',
            'headache',
            'heart',
            'health',
            'disease',
            'symptom',
            'medicine',
            'infection'
        ];

        $isHealthQuestion = false;

        foreach($healthKeywords as $keyword)
        {
            if(str_contains($message,$keyword))
            {
                $isHealthQuestion = true;
                break;
            }
        }

        if(!$isHealthQuestion)
        {
            return response()->json([
                'reply' =>
                'I can assist with Hospital Management System features and general health-related questions.'
            ]);
        }

        // GROQ FALLBACK FOR HEALTH QUESTIONS

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post(
            'https://api.groq.com/openai/v1/chat/completions',
            [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => '
    You are a health education assistant.

    Provide educational information only.

    Never diagnose.
    Never prescribe medication.
    Always recommend consulting a qualified healthcare professional for medical concerns.
    '
                    ],
                    [
                        'role' => 'user',
                        'content' => $request->message
                    ]
                ]
            ]
        );

        return response()->json([
            'reply' =>
                $response['choices'][0]['message']['content']
                ?? 'Unable to generate response.'
        ]);
    }
}