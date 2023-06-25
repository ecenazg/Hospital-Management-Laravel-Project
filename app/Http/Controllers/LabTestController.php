<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LabTestController extends Controller
{
    public function showReport(Request $request, int $id): Response
    {
        $labTest = LabTest::findOrFail($id);
        $report = $labTest->report;

        return Inertia::render('LabTests/Report', compact('labTest', 'report'));
    }
    
    public function index(): Response
    {
        $labTests = LabTest::all();

        return Inertia::render('LabTests/Index', compact('labTests'));
    }

    public function create(): Response
    {
        $laboratories = Laboratory::all();

        return Inertia::render('LabTests/Create', compact('laboratories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'percentage' => 'required',
            'created_by_id' => 'required',
            'updated_by_id' => 'required',
        ]);

        LabTest::create($request->all());

        return redirect()->route('lab-tests.index')->with('success', 'Lab Test created successfully.');
    }

    public function edit(int $id)
    {
        $labTest = LabTest::findOrFail($id);
        $laboratories = Laboratory::all();

        return Inertia::render('LabTests/Edit', compact('labTest', 'laboratories'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required', 
            'percentage' => 'required',
            'created_by_id' => 'required',
            'updated_by_id' => 'required',
        ]);

        $labTest = LabTest::findOrFail($id);
        $labTest->update($request->all());

        return redirect()->route('lab-tests.index')->with('success', 'Lab Test updated successfully.');
    }

    public function destroy(int $id)
    {
        $labTest = LabTest::findOrFail($id);
        $labTest->delete();

        return redirect()->route('lab-tests.index')->with('success', 'Lab Test deleted successfully.');
    }
}
