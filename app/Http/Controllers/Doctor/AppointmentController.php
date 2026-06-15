<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with([
            'patient.user'
        ])
        ->where(
            'doctor_id',
            Auth::user()->doctor->id
        )
            ->latest()
            ->paginate(10);

        return view(
            'doctor.appointments.index',
            compact('appointments')
        );
    }
    public function show($id)
    {
        $appointment = Appointment::with([
            'patient.user',
            'doctor.user',
            'doctor.specialization'
        ])
        ->findOrFail($id);

        return view(
            'doctor.appointments.show',
            compact('appointment')
        );
    }
    public function confirm($id)
    {
        $appointment =
            Appointment::with([
                'patient',
                'doctor.user'
            ])->findOrFail($id);

        $appointment->update([
            'status' => 'confirmed'
        ]);
        Notification::create([

            'user_id' =>
                $appointment->patient->user_id,

            'title' =>
                'Appointment Confirmed',

            'message' =>
                'Your appointment has been confirmed.',

            'link' =>
                '/patient/appointments'
        ]);
        return back();
    }
    public function cancel($id)
    {
        Appointment::findOrFail($id)
            ->update([
                'status' => 'cancelled'
            ]);

        return back();
    }

    public function complete($id)
    {
        Appointment::findOrFail($id)
            ->update([
                'status' => 'completed'
            ]);

        return back();
    }
}