<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class PatientController extends Controller
{
    public function showCompleteProfile()
    {
        return view('patient.complete-profile');
    }

    public function saveProfile(Request $request)
    {
        $patient = Auth::user()->patient;

        $patient->update([
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'height' => $request->height,
            'weight' => $request->weight,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,
            'allergies' => $request->allergies,
            'medical_history' => $request->medical_history,
            'profile_completed' => true
        ]);

        return redirect('/patient/dashboard');
    }
    public function step1()
    {
        return view('patient.step1');
    }

    public function saveStep1(Request $request)
    {
        $patient = auth()->user()->patient;

        $patient->update([
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'height' => $request->height,
            'weight' => $request->weight
        ]);

        return redirect('/patient/profile/step-2');
    }
    public function step2()
{
    return view('patient.step2');
    }

    public function saveStep2(Request $request)
    {
        $patient = auth()->user()->patient;

        $patient->update([
            'has_diabetes' => $request->has('has_diabetes'),
            'has_hypertension' => $request->has('has_hypertension'),
            'has_heart_disease' => $request->has('has_heart_disease'),
            'has_asthma' => $request->has('has_asthma'),
        ]);

        return redirect('/patient/profile/step-3');
    }
    public function step3()
{
    return view('patient.step3');
}

    public function saveStep3(Request $request)
    {
        $patient = auth()->user()->patient;

        $patient->update([
            'past_surgeries' => $request->past_surgeries,
            'current_medications' => $request->current_medications,
            'last_health_checkup' => $request->last_health_checkup,
        ]);

        return redirect('/patient/profile/step-4');
    }
    public function step4()
{
    return view('patient.step4');
}

    public function saveStep4(Request $request)
    {
        $patient = auth()->user()->patient;

        $patient->update([
            'smoker' => $request->smoker,
            'alcohol_consumer' => $request->alcohol_consumer,
            'family_medical_history' => $request->family_medical_history,
            'additional_notes' => $request->additional_notes,
        ]);
        

        return redirect('/patient/profile/review');
    }
    public function review()
{
    $patient = auth()->user()->patient;

    return view('patient.review', compact('patient'));
}

    public function completeProfile()
    {
        $patient = auth()->user()->patient;

        $patient->update([
            'profile_completed' => true
        ]);

        return redirect('/patient/dashboard');
    }
    public function profile()
    {
        $patient =
            Auth::user()->patient;

        return view(
            'patient.profile',
            compact('patient')
        );
    }
    public function updateProfile(
        Request $request
    )
    {
        $patient =
            Auth::user()->patient;

        $patient->update([

            'date_of_birth' =>
                $request->date_of_birth,

            'gender' =>
                $request->gender,

            'blood_group' =>
                $request->blood_group,

            'height' =>
                $request->height,

            'weight' =>
                $request->weight,

            'address' =>
                $request->address,

            'emergency_contact' =>
                $request->emergency_contact,

            'allergies' =>
                $request->allergies,

            'medical_history' =>
                $request->medical_history,

            'current_medications' =>
                $request->current_medications,

            'past_surgeries' =>
                $request->past_surgeries,

            'family_medical_history' =>
                $request->family_medical_history,

            'additional_notes' =>
                $request->additional_notes,

            'smoker' =>
                $request->has('smoker'),

            'alcohol_consumer' =>
                $request->has('alcohol_consumer'),

            'profile_completed' => true
        ]);
        if($request->hasFile('profile_photo'))
            {
                $patient->profile_photo =
                    $request->file('profile_photo')
                    ->store(
                        'patient-profiles',
                        'public'
                    );
            }
        $patient->save();
        
        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }
}