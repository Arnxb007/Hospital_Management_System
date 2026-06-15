<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;

class PatientController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->search;

        $patients = Patient::with('user')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('user', function ($q) use ($search) {

                    $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
                });

            })

            ->latest()
            ->get();

        return view(
            'admin.patients.index',
            compact('patients', 'search')
        );
    }
   public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        $user = $patient->user;

        $patient->delete();

        if ($user) {
            $user->delete();
        }

        return back()->with(
            'success',
            'Patient deleted successfully.'
        );
    }
    public function show($id)
    {
        $patient = Patient::with('user')
            ->findOrFail($id);

        return view(
            'admin.patients.show',
            compact('patient')
        );
    }
    public function edit($id)
    {
        $patient = Patient::with('user')
            ->findOrFail($id);

        return view(
            'admin.patients.edit',
            compact('patient')
        );
    }
    public function update(Request $request, $id)
    {
        $patient = Patient::with('user')
            ->findOrFail($id);

        $patient->user->update([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,

        ]);

       $patient->update([

            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,

            'height' => $request->height,
            'weight' => $request->weight,

            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact,

            'has_diabetes' => $request->has_diabetes ? 1 : 0,
            'has_hypertension' => $request->has_hypertension ? 1 : 0,
            'has_heart_disease' => $request->has_heart_disease ? 1 : 0,
            'has_asthma' => $request->has_asthma ? 1 : 0,

            'current_medications' => $request->current_medications,
            'past_surgeries' => $request->past_surgeries,

            'allergies' => $request->allergies,
            'medical_history' => $request->medical_history,

            'family_medical_history' =>
                $request->family_medical_history,

            'last_health_checkup' =>
                $request->last_health_checkup,

            'smoker' =>
                $request->smoker ? 1 : 0,

            'alcohol_consumer' =>
                $request->alcohol_consumer ? 1 : 0,

            'additional_notes' =>
                $request->additional_notes,

            'profile_completed' => true,
        ]);


        return redirect('/admin/patients')
            ->with(
                'success',
                'Patient updated successfully.'
            );
    }
}