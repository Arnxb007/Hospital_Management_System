<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    public function index(Doctor $doctor)
    {
        $schedule = DoctorSchedule::firstOrNew([
            'doctor_id' => $doctor->id
        ]);

        return view(
            'admin.doctors.schedule',
            compact('doctor', 'schedule')
        );
    }

    public function store(Request $request, Doctor $doctor)
    {
        DoctorSchedule::updateOrCreate(

            [
                'doctor_id' => $doctor->id
            ],

            [
                'monday' => $request->has('monday'),
                'tuesday' => $request->has('tuesday'),
                'wednesday' => $request->has('wednesday'),
                'thursday' => $request->has('thursday'),
                'friday' => $request->has('friday'),
                'saturday' => $request->has('saturday'),
                'sunday' => $request->has('sunday'),

                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'slot_duration' => $request->slot_duration,
                'is_available' => true,
            ]
        );

        return back()->with(
            'success',
            'Schedule updated successfully.'
        );
    }
}