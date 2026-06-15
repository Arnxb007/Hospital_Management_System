<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with([
            'patient.user',
            'doctor.user',
            'doctor.specialization'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.appointments.index',
            compact('appointments')
        );
    }

    public function confirm($id)
    {
        Appointment::findOrFail($id)
            ->update([
                'status' => 'confirmed'
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