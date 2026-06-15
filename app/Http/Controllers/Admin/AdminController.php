<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialization;
use App\Models\Appointment;
use App\Models\MedicalRecord;

class AdminController extends Controller
{
   public function dashboard()
    {
        $totalDoctors =
            Doctor::count();

        $totalPatients =
            Patient::count();

        $totalAppointments =
            Appointment::count();

        $totalRecords =
            MedicalRecord::count();

        $appointmentsToday =
            Appointment::whereDate(
                'appointment_date',
                today()
            )->count();

        $pendingAppointments =
            Appointment::where(
                'status',
                'pending'
            )->count();

        $completedAppointments =
            Appointment::where(
                'status',
                'completed'
            )->count();
        $appointmentTrend = Appointment::selectRaw(
            'appointment_date as day,
            COUNT(*) as total'
        )
        ->groupBy('appointment_date')
        ->orderBy('appointment_date', 'asc')
        ->get();

$revenueTrend = Appointment::where(
    'payment_status',
    'paid'
)
->whereIn('status', [
    'confirmed',
    'completed'
])
->selectRaw(
    'appointment_date as day,
     SUM(amount_paid) as total'
)
->groupBy('appointment_date')
->orderBy('appointment_date')
->get();

        $appointmentStatus = Appointment::selectRaw(
            'status,
            COUNT(*) as total'
        )
        ->groupBy('status')
        ->get();

        return view(
            'admin.dashboard.dashboard',
            compact(
                'totalDoctors',
                'totalPatients',
                'totalAppointments',
                'totalRecords',
                'appointmentsToday',
                'pendingAppointments',
                'completedAppointments',
                'appointmentTrend',
                'revenueTrend',
                'appointmentStatus'
            )
        );
    }
}