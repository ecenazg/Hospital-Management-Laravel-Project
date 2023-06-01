<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctors;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // Retrieve all departments
        $departments = Department::all();

        return view('department', ['departments' => $departments]);
    }
    public function showDoctors($department_name)
{
    // Find the department by department_name
    $department = Department::where('department_name', $department_name)->first();

    // Check if the department exists
    if (!$department) {
        return redirect()->back()->with('error', 'Department not found.');
    }

    // Get the doctors of the department
    $doctors = Doctors::where('department_name', $department_name)->get();

    return response()->json(['department' => $department, 'doctors' => $doctors]);//response json
}


}

