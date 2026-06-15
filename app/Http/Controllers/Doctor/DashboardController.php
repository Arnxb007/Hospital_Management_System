<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController  extends Controller
{
    public function index()
    {
        $doctorId =
            Auth::user()->doctor->id;

        $todayAppointments =
            Appointment::where(
                'doctor_id',
                $doctorId
            )
            ->whereDate(
                'appointment_date',
                now()
            )
            ->where(
                'status',
                'confirmed'
            )
            ->count();

        $upcomingAppointments =
            Appointment::where(
                'doctor_id',
                $doctorId
            )
            ->whereDate(
                'appointment_date',
                '>',
                now()
            )
            ->where(
                'status',
                'confirmed'
            )
            ->count();

        $completedToday =
            Appointment::where(
                'doctor_id',
                $doctorId
            )
            ->whereDate(
                'appointment_date',
                now()
            )
            ->where(
                'status',
                'completed'
            )
            ->count();

        $doctor =
            Auth::user()->doctor;

        $todaySchedule =
            Appointment::with(
                'patient.user'
            )
            ->where(
                'doctor_id',
                $doctorId
            )
            ->whereDate(
                'appointment_date',
                now()
            )
            ->orderBy(
                'appointment_time'
            )
            ->get();

        return view(
            'doctor.dashboard.dashboard',
            compact(
                'todayAppointments',
                'upcomingAppointments',
                'completedToday',
                'doctor',
                'todaySchedule'
            )
        );
    }
    public function profile()
    {
        $doctor =
            auth()->user()->doctor;

        return view(
            'doctor.profile',
            compact('doctor')
        );
    }
    public function updateProfile(
        Request $request
    )
    {
        $doctor =
            auth()->user()->doctor;

        $doctor->qualification =
            $request->qualification;

        $doctor->experience_years =
            $request->experience_years;

        $doctor->consultation_fee =
            $request->consultation_fee;

        $doctor->about =
            $request->about;

        $doctor->is_available =
            $request->has('is_available');

        if($request->hasFile('profile_photo'))
        {
            $doctor->profile_photo =
                $request->file('profile_photo')
                ->store(
                    'doctor-profiles',
                    'public'
                );
        }
        if($request->hasFile('signature'))
            {
                $doctor->signature =
                    $request->file('signature')
                    ->store(
                        'doctor-signatures',
                        'public'
                    );
            }

        $doctor->save();
        
        return back()->with(
            'success',
            'Profile updated.'
        );
    }
    public function editProfile()
    {
        $doctor =
            auth()->user()->doctor;

        return view(
            'doctor.profile-edit',
            compact('doctor')
        );
    }
}