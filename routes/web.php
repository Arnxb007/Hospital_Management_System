<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Models\Appointment;
use App\Http\Controllers\Doctor\DashboardController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\PatientController as DoctorPatientController;
use App\Http\Controllers\Doctor\MedicalRecordController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Patient\MedicalRecordController as PatientMedicalRecordController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Http\Controllers\AiChatController;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::view('/about', 'pages.about')
    ->name('about');

Route::view('/services', 'pages.services')
    ->name('services');

Route::view('/departments', 'pages.departments')
    ->name('departments');

Route::view('/contact', 'pages.contact')
    ->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'message' => ['required', 'string', 'max:1000'],
    ]);

    return back()->with('contact_success', 'Thank you. The hospital desk has received your message.');
})->name('contact.submit');

#login and register
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');
#dashboard route
Route::view('/patient/dashboard', 'patient.dashboard.dashboard');

Route::view('/doctor/dashboard', 'doctor.dashboard.dashboard');

Route::view('/admin/dashboard', 'admin.dashboard.dashboard');
#patient profile complete route
Route::get('/patient/profile/step-1', [PatientController::class, 'step1']);
Route::post('/patient/profile/step-1', [PatientController::class, 'saveStep1']);

Route::get('/patient/profile/step-2', [PatientController::class, 'step2']);
Route::post('/patient/profile/step-2', [PatientController::class, 'saveStep2']);

Route::get('/patient/profile/step-3', [PatientController::class, 'step3']);
Route::post('/patient/profile/step-3', [PatientController::class, 'saveStep3']);

Route::get('/patient/profile/step-4',
    [PatientController::class, 'step4']);

Route::post('/patient/profile/step-4',
    [PatientController::class, 'saveStep4']);

Route::get('/patient/profile/review', [PatientController::class, 'review']);
Route::post('/patient/profile/complete',
    [PatientController::class, 'completeProfile'])
    ->name('patient.complete');

#admin panel route
Route::get(
    '/admin/dashboard',
    [AdminController::class, 'dashboard']
)->name('admin.dashboard');

Route::view('/admin/doctors', 'admin.doctors.index')
    ->name('admin.doctors');

Route::view('/admin/doctors/create', 'admin.doctors.create')
    ->name('admin.doctors.create');

Route::view('/admin/patients', 'admin.patients.index')
    ->name('admin.patients');

Route::view('/admin/specializations', 'admin.specializations.index')
    ->name('admin.specializations');

#admin specilizatin
Route::get(
    '/admin/specializations',
    [SpecializationController::class,'index']
);

Route::get(
    '/admin/specializations/create',
    [SpecializationController::class,'create']
);

Route::post(
    '/admin/specializations/store',
    [SpecializationController::class,'store']
);

#specialization to doctor assign
Route::get('/admin/doctors',
    [DoctorController::class,'index']);

Route::get('/admin/doctors/create',
    [DoctorController::class,'create']);

Route::post('/admin/doctors/store',
    [DoctorController::class,'store']);

Route::get('/admin/doctors/{id}',
    [DoctorController::class,'show']);

Route::get('/admin/doctors/{id}/edit',
    [DoctorController::class,'edit']);

Route::put('/admin/doctors/{id}',
    [DoctorController::class,'update']);
Route::delete(
    '/admin/doctors/{id}',
    [DoctorController::class, 'destroy']
);

#PATitent tab in admin panel
Route::get('/admin/patients',
    [AdminPatientController::class,'index']);

Route::get('/admin/patients/{id}',
    [AdminPatientController::class,'show']);

Route::get('/admin/patients/{id}/edit',
    [AdminPatientController::class,'edit']);

Route::put('/admin/patients/{id}',
    [AdminPatientController::class,'update']);

Route::delete('/admin/patients/{id}',
    [AdminPatientController::class,'destroy']);

#appointment in patient user
Route::get(
    '/patient/appointments/create',
    [AppointmentController::class,'create']
);

Route::post(
    '/patient/appointments/payment',
    [AppointmentController::class,'payment']
)->name('patient.appointments.payment');

Route::post(
    '/patient/appointments/payment/complete',
    [AppointmentController::class,'completePayment']
)->name('patient.appointments.payment.complete');

Route::post(
    '/patient/appointments',
    [AppointmentController::class,'store']
);

Route::get(
    '/patient/appointments',
    [AppointmentController::class,'index']
);

#doctor shedule route
Route::get(
    '/admin/doctors/{doctor}/schedule',
    [DoctorScheduleController::class,'index']
);

Route::post(
    '/admin/doctors/{doctor}/schedule',
    [DoctorScheduleController::class,'store']
);

Route::get(
    '/get-doctors/{specialization}',
    function($specialization)
    {
        return \App\Models\Doctor::with('user')
            ->where(
                'specialization_id',
                $specialization
            )
            ->where(
                'is_available',
                true
            )
            ->with('specialization')
            ->get();
    }
);
Route::get(
    '/doctor-slots/{doctor}',
    [AppointmentController::class,
    'doctorSlots']
);

Route::get(
    '/admin/appointments',
    [AdminAppointmentController::class,'index']
);

Route::get(
    '/admin/appointments/{id}/confirm',
    [AdminAppointmentController::class,'confirm']
);

Route::get(
    '/admin/appointments/{id}/cancel',
    [AdminAppointmentController::class,'cancel']
);

Route::get(
    '/admin/appointments/{id}/complete',
    [AdminAppointmentController::class,'complete']
);


Route::get('/patient/dashboard', function () {

    $confirmedAppointments = Appointment::where(
        'patient_id',
        auth()->user()->patient->id
    )
    ->where(
        'status',
        'confirmed'
    )
    ->count();

    return view(
        'patient.dashboard.dashboard',
        compact('confirmedAppointments')
    );

});

Route::get(
    '/doctor/dashboard',
    [DashboardController::class,'index']
);
Route::get(
    '/doctor/appointments',
    [DoctorAppointmentController::class,'index']
);

Route::get(
    '/doctor/appointments',
    [DoctorAppointmentController::class,'index']
);
Route::get(
    '/doctor/appointments/{id}',
    [DoctorAppointmentController::class,'show']
);
Route::get(
    '/doctor/appointments/{id}/confirm',
    [DoctorAppointmentController::class,'confirm']
);

Route::get(
    '/doctor/appointments/{id}/cancel',
    [DoctorAppointmentController::class,'cancel']
);

Route::get(
    '/doctor/appointments/{id}/complete',
    [DoctorAppointmentController::class,'complete']
);
Route::get(
    '/doctor/patients',
    [DoctorPatientController::class,'index']
);
Route::get(
    '/doctor/patients/{id}',
    [DoctorPatientController::class,'show']
);
Route::post(
    '/doctor/patients/{id}/medical-record',
    [MedicalRecordController::class,'store']
);
Route::post(
    '/doctor/appointments/{id}/record',
    [MedicalRecordController::class,'store']
);
Route::get(
    '/doctor/schedule',
    [ScheduleController::class,'index']
);

Route::post(
    '/doctor/schedule',
    [ScheduleController::class,'update']
);
Route::get(
    '/medical-records/{id}/pdf',
    [MedicalRecordController::class,'downloadPdf']
);
Route::get(
    '/patient/medical-records',
    [PatientMedicalRecordController::class,'index']
);
Route::get(
    '/patient/medical-records/{id}',
    [PatientMedicalRecordController::class,'show']
);
Route::get(
    '/doctor/medical-records',
    [MedicalRecordController::class,'index']
);
Route::get(
    '/doctor/medical-records/{id}',
    [MedicalRecordController::class,'show']
);
Route::get(
    '/doctor/medical-records/{id}/edit',
    [MedicalRecordController::class,'edit']
);

Route::put(
    '/doctor/medical-records/{id}',
    [MedicalRecordController::class,'update']
);
Route::post(
    '/doctor/medical-records/{id}/upload',
    [MedicalRecordController::class,'uploadFile']
);
Route::get(
    '/doctor/profile',
    [DashboardController::class,'profile']
);

Route::post(
    '/doctor/profile',
    [DashboardController::class,'updateProfile']
);
Route::get(
    '/patient/profile',
    [PatientController::class,'profile']
);

Route::post(
    '/patient/profile',
    [PatientController::class,'updateProfile']
);
Route::get(
    '/notifications',
    [NotificationController::class,'index']
);
Route::post(
    '/notifications/{id}/read',
    [NotificationController::class,'markAsRead']
);
Route::get(
    '/patient/appointments/{id}/invoice',
    [AppointmentController::class,'invoice']
);
Route::get(
    '/doctor/profile/edit',
    [DashboardController::class,'editProfile']
);

Route::post(
    '/doctor/profile/edit',
    [DashboardController::class,'updateProfile']
);
Route::get(
    '/notifications/{id}',
    [NotificationController::class,'open']
);
Route::post(
    '/ai-chat',
    [AiChatController::class, 'chat']
)->middleware('auth');

Route::get('/test-ai', function () {

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
        'Content-Type' => 'application/json'
    ])->post(
        'https://api.groq.com/openai/v1/chat/completions',
        [
            'model' => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'What is fever?'
                ]
            ]
        ]
    );

    dd($response->json());
});