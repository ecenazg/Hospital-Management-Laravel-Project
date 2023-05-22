<?
namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        echo "Departments\n";
        // Retrieve all departments
        $departments = Departments::all();

        return response()->json($departments);
    }

    public function createDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $department = Departments::create($request->only('name', 'description'));
        return response()->json($department, 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $department = Departments::findOrFail($id);
        $department->update($request->only('name', 'description'));

        return response()->json($department);
    }

    public function destroy(int $id)
    {
        // Delete a specific department
        $department = Departments::findOrFail($id);
        $department->delete();

        return response()->json(null, 204);
    }
}
