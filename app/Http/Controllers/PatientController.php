<?php

namespace App\Http\Controllers;


use App\Models\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        echo "Patients\n";
        // Retrieve all patients
        $patients = Patients::all();

        return view('patients', ['patients' => $patients]);
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

    public function edit(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'illness' => 'required',
            'email' => 'required',
        ]);

        $patient = Patients::findOrFail($id);
        $patient->edit($request->only('name', 'email' , 'illness'));

        return response()->json($patient);
    }

    public function destroy(int $id)
    {
        // Delete a specific patient
        $patient = Patients::findOrFail($id);
        $patient->delete();

        // Get the remaining patients in increasing order of their IDs
        $patients = Patients::orderBy('id', 'asc')->get();

        // Redirect back to the index page with the updated patient list
        return redirect('/patients')->with('patients', $patients)->with('success', 'Patient deleted successfully.');
    }
}
