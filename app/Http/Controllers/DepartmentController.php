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
    public function showDoctors($department_name)
    {
        // Departmanı adına göre bul
        $department = Department::where('department_name', $department_name)->first();

        if (!$department) {
            
            return redirect()->back()->with('error', 'Department not found.');
        }

        // Departmana ait doktorları al
        $doctors = $department->doctors;

        return view('department.doctors', ['department' => $department, 'doctors' => $doctors]);
    }

}

