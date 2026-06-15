<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with([
            'doctor.user'
        ])
        ->where(
            'patient_id',
            Auth::user()->patient->id
        )
            ->latest()
            ->get();
        return view(
            'patient.medical-records.index',
            compact('records')
        );
    }
    public function show($id)
    {
        $record = MedicalRecord::with([
            'doctor.user',
            'patient.user',
            'appointment',
            'files'
        ])
        ->findOrFail($id);

        if (
            $record->patient_id !=
            Auth::user()->patient->id
        ) {
            abort(403);
        }

        return view(
            'patient.medical-records.show',
            compact('record')
        );
    }
}
