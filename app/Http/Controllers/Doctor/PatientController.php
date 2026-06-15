<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRecord;
use App\Models\MedicalRecordFile;
class PatientController extends Controller
{
    public function index()
    {
        $doctorId =
            Auth::user()->doctor->id;

        $patients = Appointment::with([
            'patient.user'
        ])
        ->where(
            'doctor_id',
            $doctorId
        )
        ->whereIn(
            'status',
            ['confirmed','completed']
        )
        ->select('patient_id')
        ->distinct()
        ->get();

        return view(
            'doctor.patients.index',
            compact('patients')
        );
    }
    public function show($id)
    {
        $patient = \App\Models\Patient::with('user')
            ->findOrFail($id);

        $appointments = \App\Models\Appointment::where(
            'patient_id',
            $patient->id
        )
            ->latest()
            ->get();
        $medicalRecords = \App\Models\MedicalRecord::where(
            'patient_id',
            $id
        )
            ->latest()
            ->get();        $totalAppointments = Appointment::where(
            'patient_id',
            $patient->id
        )->count();

        $totalRecords = MedicalRecord::where(
            'patient_id',
            $patient->id
        )->count();

        $totalAttachments = MedicalRecordFile::whereIn(
            'medical_record_id',
            MedicalRecord::where(
                'patient_id',
                $patient->id
            )->pluck('id')
        )->count();
      return view(
        'doctor.patients.show',
        compact(
            'patient',
            'medicalRecords',
            'appointments',
            'totalAppointments',
            'totalRecords',
            'totalAttachments'
        )
    );
}
}