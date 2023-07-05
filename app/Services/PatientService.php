<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\Patients;
use Exception;
use Illuminate\Support\Facades\DB;

class PatientService
{
    public function createPatient($patientData): Patients
    {
        $settingService = app()->make(SettingService::class);

        try {
            DB::beginTransaction();
            $patientNumber = $settingService->getNextPatientNumber();

            $patient = Patients::create([
                'patient_id' => now()->format('Ym') . $patientNumber,
                'name' => $patientData['name'],
                'phone_number' => $patientData['phone_number'],
                'year_of_birth' => now()->subYears($patientData['age'])->format('Y'),
                
            ]);

            $settingService->incrementLastPatientNumber();
            DB::commit();

            return $patient;
        } catch (Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }

    public function updatePatient($patientData)
    {
        $patient = Patients::find($patientData['id']);

        $patient->name = $patientData['name'];
        $patient->phone_number = $patientData['phone_number'];
        $patient->year_of_birth = now()->subYears($patientData['age'])->format('Y');
        
        $patient->save();

        return $patient;
    }
}