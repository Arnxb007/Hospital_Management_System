<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::latest()->get();

        return view(
            'admin.specializations.index',
            compact('specializations')
        );
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specializations'
        ]);

        Specialization::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/admin/specializations')
            ->with('success','Specialization Created');
    }
}