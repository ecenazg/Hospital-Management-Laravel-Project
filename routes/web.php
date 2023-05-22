<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

// Route for displaying the doctor management interface
Route::get('/doctors', [DoctorController::class, 'index']);

// Route for creating a new doctor
Route::post('/doctors', [DoctorController::class, 'createDoctor']);

// Route for updating a doctor
Route::put('/doctors/{id}', [DoctorController::class, 'update']);

// Route for deleting a doctor
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy']);

Route::get('/patients', [PatientController::class, 'index']);
Route::post('/patients', [PatientController::class, 'createPatient']);
Route::put('/patients/{id}', [PatientController::class, 'update']);
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);




Route::get('/departments', [DepartmentController::class, 'index']);
Route::post('/departments', [DepartmentController::class, 'createDepartment']);
Route::put('/departments/{id}', [DepartmentController::class, 'update']);
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy']);



//Route::get('/', [DoctorController::class, 'index']);

//Route::get('/', [PatientController::class, 'index']);

//Route::get('/', [PatientController::class, 'index']);
//Route::get('/create', [DoctorController::class, 'createDoctor']);


