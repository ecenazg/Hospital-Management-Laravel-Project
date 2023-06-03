<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\DepartmentController;



Route::get('/', function () {
    return view('index');
});

Route::get('/doctors', [DoctorController::class, 'index']);
Route::post('/doctors/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::post('/doctors/{doctor_id}/patients', [DoctorController::class, 'sendToPatients'])->name('doctors.sendToPatients');

Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

Route::get('/patients', [PatientController::class, 'index']);
Route::post('/patients/{id}', [PatientController::class, 'edit'])->name('patients.edit');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::get('/nurses', [NurseController::class, 'index']);
Route::post('/nurses/{id}', [NurseController::class, 'edit'])->name('nurses.edit');
Route::delete('/nurses/{id}', [NurseController::class, 'destroy'])->name('nurses.destroy');


Route::get('/management', [ManagementController::class, 'index']);
Route::post('/management/create-patient', [ManagementController::class, 'createPatient'])->name('management.createPatient');
Route::post('/management/create-doctor', [ManagementController::class, 'createDoctor'])->name('management.createDoctor');
Route::post('/management/create-nurse', [ManagementController::class, 'createNurse'])->name('management.createNurse');


Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
Route::get('/department/{department_name}/doctors', [DepartmentController::class , 'showDoctors'])->name('department.doctors');






