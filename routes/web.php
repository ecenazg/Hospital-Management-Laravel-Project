<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\NurseController;


Route::get('/', function () {
    return view('index');
});

Route::get('/doctors', [DoctorController::class, 'index']);
Route::post('/doctors/createDoctor', [DoctorController::class, 'createDoctor'])->name('doctors.create');
Route::post('/doctors/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

Route::get('/patients', [PatientController::class, 'index']);
Route::post('/patients/createPatient', [PatientController::class, 'createPatient'])->name('patients.create');
Route::post('/patients/{id}', [PatientController::class, 'edit'])->name('patients.edit');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::get('/nurses', [NurseController::class, 'index']);
Route::post('/nurses/createNurse', [NurseController::class, 'createNurse'])->name('nurses.create');
Route::post('/nurses/{id}', [NurseController::class, 'edit'])->name('nurses.edit');
Route::delete('/nurses/{id}', [NurseController::class, 'destroy'])->name('nurses.destroy');



