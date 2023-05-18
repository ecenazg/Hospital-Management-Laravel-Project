<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        echo "Patients\n";
        // Retrieve all patients
        $patient = Patients::all();

        return response()->json($patient);
    }

    public function createPatient(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'illness' => 'required',
            'email' => 'required',
        ]);

        $patient = Patients::create($request->only('name', 'email' , 'illness'));
        return response()->json($patient, 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'illness' => 'required',
            'email' => 'required',
        ]);

        $patient = Patients::findOrFail($id);
        $patient->update($request->only('name', 'email' , 'illness'));

        return response()->json($patient);
    }

    public function destroy(int $id)
    {
        // Delete a specific patient
        $patient = Patients::findOrFail($id);
        $patient->delete();

        return response()->json(null, 204);
    }
}
