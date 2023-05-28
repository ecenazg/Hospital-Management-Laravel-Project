<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Nurses;
use App\Models\Patients;

class ManagementController extends Controller
{
    public function index()
    {
        // Return the view for the management page
        return view('management.index');
    }

    public function createDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'email' => 'required',
        ]);

        $doctor = Doctors::create($request->only('name', 'email' , 'specialization'));
        
        $doctors = Doctors::orderBy('id', 'asc')->get();
        return redirect('/doctors')->with('success', 'Doctor created successfully.');
    }

    public function createNurse(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
        ]);

        $nurse = Nurses::create($request->only('name', 'email' , 'department'));
        
        $nurses = Nurses::orderBy('id', 'asc')->get();
        return redirect('/nurses')->with('success', 'Nurse created successfully.');
    }

    public function createPatient(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'illness' => 'required',
            'email' => 'required',
        ]);

        $patient = Patients::create($request->only('name', 'email' , 'illness'));
        $patients = Patients::orderBy('id', 'asc')->get();
        return redirect('/patients')->with('success', 'Patient created successfully.');

    }
}
