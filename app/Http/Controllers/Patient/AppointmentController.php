<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorSchedule;
use Carbon\Carbon;
use App\Models\Notification;
use Razorpay\Api\Api;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Patient;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with([
            'doctor.user',
            'doctor.specialization'
        ])
        ->where(
            'patient_id',
            Auth::user()->patient->id
        )
            ->latest()
            ->paginate(10);

        return view(
            'patient.appointments.index',
            compact('appointments')
        );
    }

    public function create()
    {
        $specializations =
            \App\Models\Specialization::all();

        return view(
            'patient.appointments.create',
            compact('specializations')
        );
    }

    public function store(Request $request)
    {
         $request->validate([
        'doctor_id' => 'required',
        'appointment_date' => 'required',
        'appointment_time' => 'required',
        'reason' => 'required'
    ]);

    $existingAppointment = Appointment::where(
        'patient_id',
        Auth::user()->patient->id
    )
    ->where(
        'doctor_id',
        $request->doctor_id
    )
    ->whereIn(
        'status',
        ['pending', 'confirmed']
    )
    ->first();

    if($existingAppointment)
    {
        return back()->with(
            'error',
            'You already have an active appointment with this doctor.'
        );
    }
        $existing = Appointment::where(
            'payment_id',
            $request->payment_id
        )->first();

        if($existing)
        {
            return redirect(
                '/patient/appointments'
            );
        }
        Appointment::create([

            'patient_id' =>
                Auth::user()->patient->id,

            'doctor_id' =>
                $request->doctor_id,

            'appointment_date' =>
                $request->appointment_date,

            'appointment_time' =>
                $request->appointment_time,

            'reason' =>
                $request->reason,

            'status' => 'pending'
        ]);
        $doctor = Doctor::findOrFail(
            $request->doctor_id
        );

        Notification::create([

            'user_id' => $doctor->user_id,

            'title' => 'New Appointment Request',

            'message' => 'A patient has booked an appointment.',

            'link' => '/doctor/appointments'

        ]);


        
        return redirect(
            '/patient/appointments'
        )->with(
            'success',
            'Appointment booked successfully.'
        );
    }
    public function doctorSlots($doctorId)
    {
        $schedule = DoctorSchedule::where(
            'doctor_id',
            $doctorId
        )->first();

        if(!$schedule)
        {
            return response()->json([]);
        }

        $bookedSlots = Appointment::where(
            'doctor_id',
            $doctorId
        )
        ->whereIn(
            'status',
            [
                'pending',
                'confirmed',
                'completed'
            ]
        )
        ->get([
            'appointment_date',
            'appointment_time'
        ]);

        $slots = [];

        $start =
            Carbon::parse($schedule->start_time);

        $end =
            Carbon::parse($schedule->end_time);

        while($start < $end)
        {
            $date = now()->toDateString();

            $time = $start->format('H:i:s');
$isBooked = Appointment::where(
    'doctor_id',
    $doctorId
)
->whereDate(
    'appointment_date',
    $date
)
->whereTime(
    'appointment_time',
    $time
)
->whereIn(
    'status',
    ['pending', 'confirmed', 'completed']
)
->exists();
        
            $slots[] = [
                'date' => $date,
                'time' => $time,
                'db_time' => $start->format('H:i:s'),
                'booked' => $isBooked
            ];

            $start->addMinutes(
                $schedule->slot_duration
            );
        }
        return response()->json($slots);
    }

    public function payment(Request $request)
    {
        $request->validate([

            'doctor_id' => 'required',

            'appointment_date' => 'required',

            'appointment_time' => 'required',

            'reason' => 'required'

        ]);

        $doctor =
            Doctor::findOrFail(
                $request->doctor_id
            );

        $api = new \Razorpay\Api\Api(
            config('razorpay.key_id'),
            config('razorpay.key_secret')
        );

        $order = $api->order->create([

            'receipt' =>
                'appt_' . time(),

            'amount' =>
                $doctor->consultation_fee * 100,

            'currency' =>
                'INR'

        ]);

        session([
            'appointment_data' => [

                'doctor_id' =>
                    $request->doctor_id,

                'appointment_date' =>
                    $request->appointment_date,

                'appointment_time' =>
                    $request->appointment_time,

                'reason' =>
                    $request->reason,

                'razorpay_order_id' =>
                    $order['id'],

                'amount' =>
                    $doctor->consultation_fee

            ]
        ]);

        return view(
            'patient.appointments.payment',
            compact(
                'order',
                'doctor'
            )
        );
    }
    public function completePayment(Request $request)
    {
        $appointmentData =
            session('appointment_data');
        $alreadyBooked = Appointment::where(
            'doctor_id',
            $appointmentData['doctor_id']
        )
        ->where(
            'appointment_date',
            $appointmentData['appointment_date']
        )
        ->where(
            'appointment_time',
            $appointmentData['appointment_time']
        )
        ->whereIn(
            'status',
            ['pending', 'confirmed', 'completed']
        )
        ->exists();

        if($alreadyBooked)
        {
            return redirect(
                '/patient/appointments/create'
            )->with(
                'error',
                'This slot has already been booked.'
            );
        }


        if(!$appointmentData)
        {
            return redirect(
                '/patient/appointments/create'
            )->with(
                'error',
                'Payment session expired.'
            );
        }

        try {

            $api = new \Razorpay\Api\Api(
                config('razorpay.key_id'),
                config('razorpay.key_secret')
            );

            $api->utility
                ->verifyPaymentSignature([

                    'razorpay_order_id' =>
                        $request->order_id,

                    'razorpay_payment_id' =>
                        $request->payment_id,

                    'razorpay_signature' =>
                        $request->signature
                ]);

            $appointment =
                Appointment::create([

                    'patient_id' =>
                        Auth::user()
                        ->patient
                        ->id,

                    'doctor_id' =>
                        $appointmentData['doctor_id'],

                    'appointment_date' =>
                        $appointmentData['appointment_date'],

                    'appointment_time' =>
                        $appointmentData['appointment_time'],

                    'reason' =>
                        $appointmentData['reason'],

                    'status' =>
                        'pending',

                    'consultation_fee' =>
                        $appointmentData['amount'],

                    'payment_status' =>
                        'paid',

                    'payment_id' =>
                        $request->payment_id,

                    'razorpay_order_id' =>
                        $request->order_id,

                    'amount_paid' =>
                        $appointmentData['amount']
                ]);

            $doctor =
                Doctor::find(
                    $appointmentData['doctor_id']
                );

            Notification::create([

                'user_id' =>
                    $doctor->user_id,

                'title' =>
                    'New Paid Appointment',

                'message' =>
                    'A patient booked and paid for an appointment.',
                'link' =>
                    '/doctor/appointments'

            ]);

            session()->forget(
                'appointment_data'
            );

            return redirect(
                '/patient/appointments'
            )->with(
                'success',
                'Payment successful. Appointment booked.'
            );

        } catch (\Exception $e) {

            return redirect(
                '/patient/appointments/create'
            )->with(
                'error',
                'Payment verification failed.'
            );
        }
    }
    public function invoice($id)
    {
        $appointment = Appointment::with([
            'doctor.user',
            'doctor.specialization',
            'patient.user'
        ])->findOrFail($id);

        $pdf = Pdf::loadView(
            'patient.appointments.invoice',
            compact('appointment')
        );

        return $pdf->download(
            'invoice-'.$appointment->id.'.pdf'
        );
    }

}