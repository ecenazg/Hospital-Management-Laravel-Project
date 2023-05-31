<?

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('departments', compact('departments'));
    }

    public function showDoctors($id)
    {
        $selectedDepartment = Department::findOrFail($id);

        return view('departments', compact('selectedDepartment'));
    }
}
