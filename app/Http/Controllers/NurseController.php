<?php
namespace App\Http\Controllers;

use App\Models\Nurses;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NurseController extends Controller
{
    public function index()
    {
        $nurses = Nurses::all();

        return Inertia::render('Nurses', [
            'nurses' => $nurses
        ]);
    }

    public function createNurse(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
        ]);

        $nurse = Nurses::create($request->only('name', 'email', 'department'));

        return redirect()->with('success', 'Nurse created successfully.');
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
        ]);

        $nurse = Nurses::findOrFail($id);

        $nurse->name = $request->input('name');
        $nurse->email = $request->input('email');
        $nurse->department = $request->input('department');
        $nurse->save();

        return response()->json([
            'message' => 'Nurse updated successfully',
            'name' => $nurse->name,
            'email' => $nurse->email,
            'department' => $nurse->department,
        ]);
    }

    public function destroy(int $id)
    {
        $nurse = Nurses::findOrFail($id);
        $nurse->delete();

        return redirect()->with('success', 'Nurse deleted successfully.');
    }
}
?>