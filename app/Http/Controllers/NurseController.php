<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;

class NurseController extends Controller
{

    
    public function index()
    {
        echo "Nurses\n";
        // Retrieve all doctors
        $nurses = Nurse::all();

        return view('nurses', ['nurses' => $nurses]);
    }

    public function createNurse(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
        ]);

        $nurse = Nurse::create($request->only('name', 'email' , 'department'));
        
        $nurses = Nurse::orderBy('id', 'asc')->get();
        return redirect('/nurses')->with('success', 'Nurse created successfully.');
    }

    public function edit(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
        ]);

        $nurse = Nurse::findOrFail($id);
        $nurse->edit($request->only('name', 'email' , 'department'));

        return response()->json($nurse);
    }

    public function destroy(int $id)
    {
        // Delete a specific nurse
        $nurse = Nurse::findOrFail($id);
        $nurse->delete();

        $nurses = Nurse::orderBy('id', 'asc')->get();

        return redirect('/nurses')->with('success', 'NUrses deleted successfully.');
    }
}
