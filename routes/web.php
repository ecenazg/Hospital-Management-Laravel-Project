<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\NurseController;

Route::get('/doctors', [DoctorController::class, 'index']);
Route::post('/doctors/createDoctor', [DoctorController::class, 'createDoctor'])->name('doctors.create');

//Route::match(['put', 'delete'], '/doctors/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');

Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');



Route::get('/patients', [PatientController::class, 'index']);
Route::post('/patients/createPatient', [PatientController::class, 'createPatient'])->name('patients.create');
//Route::put('/patients/{id}', [PatientController::class, 'update']);
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::get('/nurses', [NurseController::class, 'index']);
Route::post('/nurses/createNurse', [NurseController::class, 'createNurse'])->name('nurse.create');
Route::put('/nurses/edit{id}', [NurseController::class, 'update']);
Route::delete('/nurses/{id}', [NurseController::class, 'destroy'])->name('nurse.destroy');



