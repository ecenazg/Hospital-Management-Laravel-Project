<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // Retrieve all departments
        $departments = Department::all();

        return view('department', ['departments' => $departments]);
    }

    public function showDoctors($id)
    {
        // Find the department by ID
        $department = Department::find($id);

        // Check if the department exists
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }

        // Get the doctors of the department
        $doctors = $department->doctors;

        return view('department.doctors', ['department' => $department, 'doctors' => $doctors]);
    }
}

