<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MedicalRecordFile;

class MedicalRecordController extends Controller
{
    
    public function store(
        Request $request,
        $id
    )
    {
        $request->validate([
            'diagnosis' => ['required', 'string'],
            'prescription' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment =
            Appointment::findOrFail($id);

        $exists = MedicalRecord::where(
            'appointment_id',
            $appointment->id
        )->exists();

        if($exists)
        {
            return back()->with(
                'error',
                'Medical record already exists for this appointment.'
            );
        }
        if (
            $appointment->doctor_id !=
            auth()->user()->doctor->id
        ) {
            abort(403);
        }

        MedicalRecord::create([

            'patient_id' =>
                $appointment->patient_id,

            'doctor_id' =>
                $appointment->doctor_id,

            'appointment_id' =>
                $appointment->id,

            'diagnosis' =>
                $request->diagnosis,

            'prescription' =>
                $request->prescription,

            'notes' =>
                $request->notes
        ]);

        return back()->with(
            'success',
            'Medical record saved.'
        );
    }
    public function downloadPdf($id)
    {
        
        $record = MedicalRecord::with([
            'doctor.user',
            'patient.user',
            'appointment',
            'files',
            'doctor.specialization'
        ])->findOrFail($id);

        $user = auth()->user();

        if (
            $user->isDoctor() &&
            $record->doctor_id != $user->doctor->id
        ) {
            abort(403);
        }

        if (
            $user->isPatient() &&
            $record->patient_id != $user->patient->id
        ) {
            abort(403);
        }

        $patient = $record->patient;

        $records = MedicalRecord::with([
            'doctor.user',
            'appointment',
            'files',
            'doctor.specialization'
        ])
        ->where('patient_id', $patient->id)
            ->latest()
            ->get();

        $profilePhoto = $this->imageDataUri(
            $patient->profile_photo
                ? storage_path('app/public/' . $patient->profile_photo)
                : null
        );

        $attachmentImages = [];

        foreach ($records as $medicalRecord) {
            foreach ($medicalRecord->files as $file) {
                $path = storage_path('app/public/' . $file->file_path);
                $attachmentImages[$file->id] = $this->imageDataUri($path);
            }
        }
         $doctorSignature = $this->imageDataUri(
            $record->doctor->signature
                ? storage_path(
                    'app/public/' .
                    $record->doctor->signature
                )
                : null
        );

        $pdf = Pdf::loadView(
            'pdf.medical-record',
            compact('record', 'patient', 'records', 'profilePhoto', 'attachmentImages','doctorSignature')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'patient-medical-file-'.$patient->id.'.pdf'
        );
       
        
    }
    public function index()
        {
            $records = MedicalRecord::with([
                'patient.user'
            ])
            ->where(
                'doctor_id',
                auth()->user()->doctor->id
            );

            if(request('search'))
            {
                $records->whereHas(
                    'patient.user',
                    function($query)
                    {
                        $query->where(
                            'first_name',
                            'like',
                            '%' . request('search') . '%'
                        )
                        ->orWhere(
                            'last_name',
                            'like',
                            '%' . request('search') . '%'
                        );
                    }
                );
            }

            $records = $records
            ->latest()
            ->paginate(10);

            return view(
                'doctor.medical-records.index',
                compact('records')
            );
        }
    public function show($id)
    {
        $record = MedicalRecord::with([
            'patient.user',
            'doctor.user',
            'appointment'
        ])
        ->findOrFail($id);

        if(
            $record->doctor_id !=
            auth()->user()->doctor->id
        ){
            abort(403);
        }

        return view(
            'doctor.medical-records.show',
            compact('record')
        );
    }
    public function edit($id)
    {
        $record = MedicalRecord::findOrFail($id);
        if(
            $record->doctor_id !=
            auth()->user()->doctor->id
        ){
            abort(403);
        }
        

        return view(
            'doctor.medical-records.edit',
            compact('record')
        );
    }
    public function update(
        Request $request,
        $id
    )
    {
        $request->validate([
            'diagnosis' => ['required', 'string'],
            'prescription' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $record =
            MedicalRecord::findOrFail($id);

        if(
            $record->doctor_id !=
            auth()->user()->doctor->id
        ){
            abort(403);
        }

        $record->update([

            'diagnosis' =>
                $request->diagnosis,

            'prescription' =>
                $request->prescription,

            'notes' =>
                $request->notes

        ]);

        return redirect(
            '/doctor/medical-records/' .
            $record->id
        )->with(
            'success',
            'Medical record updated successfully.'
        );
    }
    public function uploadFile(
        Request $request,
        $id
    )
    {
        $request->validate([
            'attachment' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,doc,docx',
                'max:5120',
            ],
        ]);

        $record =
            MedicalRecord::findOrFail($id);

        if(
            $record->doctor_id !=
            auth()->user()->doctor->id
        ){
            abort(403);
        }

        $file =
            $request->file('attachment');

        $path =
            $file->store(
                'medical-records',
                'public'
            );

        MedicalRecordFile::create([

            'medical_record_id' =>
                $record->id,

            'file_name' =>
                $file->getClientOriginalName(),

            'file_path' =>
                $path
        ]);

        return back();
    }

    private function imageDataUri(?string $path): ?string
    {
        if (!$path || !file_exists($path)) {
            return null;
        }

        $mime = mime_content_type($path);

        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'], true)) {
            return null;
        }

        return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
    }
}
