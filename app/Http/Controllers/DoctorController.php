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

        return view('doctors', ['doctors' => $doctors]);
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
                'specialization' => $doctor->specialization
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
