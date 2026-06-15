<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
   public function index()
    {
        $doctors = \App\Models\Doctor::with([
            'user',
            'specialization'
        ])->get();

        $totalDoctors = \App\Models\Doctor::count();

        $totalSpecializations =
            \App\Models\Specialization::count();

        $activeDoctors =
            \App\Models\Doctor::where(
                'is_available',
                true
            )->count();

        $inactiveDoctors =
            \App\Models\Doctor::where(
                'is_available',
                false
            )->count();

        return view(
            'admin.doctors.index',
            compact(
                'doctors',
                'totalDoctors',
                'totalSpecializations',
                'activeDoctors',
                'inactiveDoctors'
            )
        );
    }


    public function create()
    {
        $specializations = Specialization::all();

        return view(
            'admin.doctors.create',
            compact('specializations')
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'specialization_id' => 'required'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
            'is_active' => true
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'license_number' => 'DOC-' . time(),
            'specialization_id' => $request->specialization_id,
            'qualification' => $request->qualification,
            'experience_years' => $request->experience_years ?? 0,
            'consultation_fee' => $request->consultation_fee ?? 0,
            'is_available' => true,
        ]);

        return redirect('/admin/doctors')
            ->with('success', 'Doctor created successfully.');
    }
    public function show($id)
    {
        $doctor = Doctor::with([
            'user',
            'specialization'
        ])->findOrFail($id);

        return view(
            'admin.doctors.show',
            compact('doctor')
        );
    }
    public function edit($id)
    {
        $doctor = Doctor::with('user')
            ->findOrFail($id);

        $specializations =
            Specialization::all();

        return view(
            'admin.doctors.edit',
            compact(
                'doctor',
                'specializations'
            )
        );
    }
    public function update(Request $request, $id)
    {
        $doctor = Doctor::with('user')
            ->findOrFail($id);

        $doctor->user->update([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,

        ]);

        $doctor->update([

            'license_number' =>
                $request->license_number,

            'specialization_id' =>
                $request->specialization_id,

            'qualification' =>
                $request->qualification,

            'experience_years' =>
                $request->experience_years,

            'consultation_fee' =>
                $request->consultation_fee,

            'is_available' =>
                $request->is_available ? 1 : 0,

        ]);

        return redirect('/admin/doctors')
            ->with(
                'success',
                'Doctor updated successfully.'
            );
    }
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        $user = $doctor->user;

        $doctor->delete();

        if ($user) {
            $user->delete();
        }

        return back()->with(
            'success',
            'Doctor deleted successfully.'
        );
    }
}