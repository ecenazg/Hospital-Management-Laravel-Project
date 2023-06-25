<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Patients;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DoctorController extends Controller
{
    public function index(): Response
    {
        // Retrieve all doctors
        $doctors = Doctors::all();

        return Inertia::render('Doctors', [
            'doctors' => $doctors,
        ]);
    }

    public function createDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'email' => 'required',
            'department_name' => 'required',
        ]);

        $doctor = Doctors::create($request->only('name', 'email', 'specialization', 'department_name'));

        $doctors = Doctors::orderBy('id', 'asc')->get();

        return redirect('/doctors')->with('success', 'Doctor created successfully.');
    }

    public function edit(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'specialization' => 'required',
        ]);

        $doctor = Doctors::findOrFail($id);
        $doctor->name = $request->input('name');
        $doctor->email = $request->input('email');
        $doctor->specialization = $request->input('specialization');
        $doctor->save();

        return response()->json([
            'message' => 'Doctor updated successfully',
            'name' => $doctor->name,
            'email' => $doctor->email,
            'specialization' => $doctor->specialization,
        ]);
    }

    public function sendToPatients(Request $request, $doctor_id): Response
    {
        // Retrieve the corresponding doctor based on the $doctor_id
        $doctor = Doctors::findOrFail($doctor_id);

        // Retrieve the associated patients of the doctor
        $patients = Patients::where('doctor_id', $doctor->id)->get();

        // Prepare the patient data
        $patientData = $patients->map(function ($patient) {
            return [
                'id' => $patient->id,
                'name' => $patient->name,
                'email' => $patient->email,
            ];
        });

        return Inertia::render('Doctors/SendToPatients', [
            'patients' => $patientData,
        ]);
    }

    public function destroy(int $id)
    {
        // Delete a specific doctor
        $doctor = Doctors::findOrFail($id);
        $doctor->delete();

        $doctors = Doctors::orderBy('id', 'asc')->get();

        return redirect('/doctors')->with('success', 'Doctor deleted successfully.');
    }
}
