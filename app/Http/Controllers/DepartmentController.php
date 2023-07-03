<?php
namespace App\Http\Controllers;

use App\Models\Department;

use App\Models\Doctors;
use Inertia\Inertia;


class DepartmentController extends Controller
{
    public function index()
    {
        // Retrieve all departments
        $departments = Department::all();
        //dd($departments);
        return Inertia::render('Department', [
            'departments' => $departments,

        ]);
    }
    
    public function showDoctors($department_name)
    {
        // Find the department by department_name
        $department = Department::where('department_name', $department_name)->first();

        // Check if the department exists
        if (!$department) {
            return redirect()->with('error', 'Department not found.');
        }

        // Get the doctors of the department
        $doctors = Doctors::where('department_name', $department_name)->get();

        return response()->json([
            'department' => $department,
            'doctors' => $doctors,
        ]);
    }
}
?>