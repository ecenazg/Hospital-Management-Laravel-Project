<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function index()
    {
        // Retrieve all doctors
        $doctors = Doctors::all();

        return response()->json($doctors);
    }

    public function createDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
            'email' => 'required',
        ]);

        $doctor = Doctors::create($request->only('name', 'email' , 'specialization'));
        return response()->json($doctor, 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'specialization' => 'required',
        ]);

        $doctor = Doctors::findOrFail($id);
        $doctor->update($request->only('name', 'email' , 'specialization'));

        return response()->json($doctor);
    }

    public function destroy(int $id)
    {
        // Delete a specific doctor
        $doctor = Doctors::findOrFail($id);
        $doctor->delete();

        return response()->json(null, 204);
    }
}
