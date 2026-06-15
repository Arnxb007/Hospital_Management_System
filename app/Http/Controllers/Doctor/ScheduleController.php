<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = DoctorSchedule::where(
            'doctor_id',
            Auth::user()->doctor->id
        )->first();

        return view(
            'doctor.schedule.index',
            compact('schedule')
        );
    }

    public function update(Request $request)
    {
        DoctorSchedule::updateOrCreate(

            [
                'doctor_id' =>
                Auth::user()->doctor->id
            ],

            [
                'monday' =>
                    $request->has('monday'),

                'tuesday' =>
                    $request->has('tuesday'),

                'wednesday' =>
                    $request->has('wednesday'),

                'thursday' =>
                    $request->has('thursday'),

                'friday' =>
                    $request->has('friday'),

                'saturday' =>
                    $request->has('saturday'),

                'sunday' =>
                    $request->has('sunday'),

                'start_time' =>
                    $request->start_time,

                'end_time' =>
                    $request->end_time,

                'slot_duration' =>
                    $request->slot_duration,

                'is_available' =>
                    $request->has('is_available')
            ]
        );

        return back()->with(
            'success',
            'Schedule updated successfully.'
        );
    }
}