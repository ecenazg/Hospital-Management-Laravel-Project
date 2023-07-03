<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PatientController extends Controller
{
    public function index(): Response
    {
        // Retrieve all patients
        $patients = Patients::all();

        // Render the patients index page using Inertia
        return Inertia::render('Patients', ['patients' => $patients]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'illness' => 'required',
            'test'=> 'required',
            'doctor_id'=> 'required',
            'department_name'=> 'required',
        ]);

        $patient = Patients::create($request->only('name', 'email', 'illness', 'test', 'doctor_id', 'department_name'));

        // Redirect back to the index page with a success message
        return redirect()->back()->with('success', 'Patient created successfully.');
    }

    public function edit(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'illness' => 'required',
            'test'=> 'required',
            'doctor_id'=> 'required',
            'department_name'=> 'required',
        ]);

        $patient = Patients::findOrFail($id);
        $patient->name = $request->input('name');
        $patient->email = $request->input('email');
        $patient->illness = $request->input('illness');
        $patient->test = $request->input('test');
        $patient->doctor_id = $request->input('doctor_id');
        $patient->department_name = $request->input('department_name');
        $patient->save();

        // Return the updated patient data as JSON response
        return response()->json([
            'message' => 'Patient updated successfully',
            'name' => $patient->name,
            'email' => $patient->email,
            'illness' => $patient->illness,
            'test' => $patient->test,
            'doctor_id' => $patient->doctor_id,
            'department_name' => $patient->department_name,
        ]);
    }

    public function destroy(int $id)
    {
        // Delete a specific patient
        $patient = Patients::findOrFail($id);
        $patient->delete();

        // Get the remaining patients in increasing order of their IDs
        $patients = Patients::orderBy('id', 'asc')->get();

        // Render the patients index page with the updated patient list
        return redirect()->back()->with('patients', $patients)->with('success', 'Patient deleted successfully.');
    }
}
?>