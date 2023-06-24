<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\LabTest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LaboratoryController extends Controller
{
    public function index(): Response
    {
        $laboratories = Laboratory::all();

        return Inertia::render('Laboratories/Index', compact('laboratories'));
    }

    public function create(Request $request)
    {
        return Inertia::render('Laboratories/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'created_by_id' => 'required',
            'updated_by_id' => 'required',
        ]);

        Laboratory::create($request->all());

        return redirect()->route('laboratories.index')->with('success', 'Laboratory created successfully.');
    }

    public function edit(Request $request, int $id)
    {
        $laboratory = Laboratory::findOrFail($id);

        return Inertia::render('Laboratories/Edit', compact('laboratory'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'created_by_id' => 'required',
            'updated_by_id' => 'required',
        ]);

        $laboratory = Laboratory::findOrFail($id);
        $laboratory->update($request->all());

        return redirect()->route('laboratories.index')->with('success', 'Laboratory updated successfully.');
    }

    public function destroy(int $id)
    {
        $laboratory = Laboratory::findOrFail($id);
        $laboratory->delete();

        return redirect()->route('laboratories.index')->with('success', 'Laboratory deleted successfully.');
    }
}
