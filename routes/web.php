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
Route::post('/doctors/{doctor_id}/send-to-patients', [DoctorController::class, 'sendToPatients'])->name('doctors.sendToPatients');


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
// Appointments Routes
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

// Appointments for Doctor Routes
Route::get('/doctors/{doctor}/appointments/create', [AppointmentController::class, 'createAppointmentForDoctor'])->name('doctors.appointments.create');
Route::get('/doctors/{doctor}/appointments', [AppointmentController::class, 'appointmentsForDoctor'])->name('doctors.appointments');