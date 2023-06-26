<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Nurses;
use App\Models\Patients;
use Inertia\Inertia;

class ManagementController extends Controller
{
    public function index()
    {
        // Return the view for the management page using Inertia
        return Inertia::render('Management');
    }

    public function createDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'email' => 'required',
        ]);

        $doctor = Doctors::create($request->only('name', 'email', 'specialization'));

        // Redirect back to the index page with a success message
        return redirect()->with('success', 'Doctor created successfully.');
    }

    public function createNurse(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
        ]);

        $nurse = Nurses::create($request->only('name', 'email', 'department'));

        // Redirect back to the index page with a success message
        return redirect()->with('success', 'Nurse created successfully.');
    }

    public function createPatient(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'illness' => 'required',
            'email' => 'required',
        ]);

        $patient = Patients::create($request->only('name', 'email', 'illness'));

        // Redirect back to the index page with a success message
        return redirect()->with('success', 'Patient created successfully.');
    }
}
?>