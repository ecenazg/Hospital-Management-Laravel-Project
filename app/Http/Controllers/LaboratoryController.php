<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Patients;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LaboratoryController extends Controller
{
    public function index(): Response
    {
        $laboratories = Laboratory::all();
    
        return Inertia::render('Laboratory/Index', compact('laboratories'));
    }
    

    public function showTests(Request $request, int $id): Response
{
    $laboratory = Laboratory::findOrFail($id);
    $patients = Patients::where('test', $laboratory->name)->get();
    $patientTests = [];

    foreach ($patients as $patient) {
        $status = $patient->status == 1 ? 'Ready' : 'In Progress';

        $patientName = $patient->name;

        $patientTests[] = [
            'laboratory' => $laboratory->name,
            'patient' => $patientName,
            'status' => $status,
        ];
    }

    return Inertia::render('Laboratory', [
        'laboratory' => $laboratory,
        'patientTests' => $patientTests,
    ]);
}

    public function create(Request $request)
    {
       
    }

    public function store(Request $request)
    {
    }

    public function edit(Request $request, int $id)
    {
        
    }

    public function update(Request $request, int $id)
    {
       
    }

    public function destroy(int $id)
    {
       
    }
}
?>