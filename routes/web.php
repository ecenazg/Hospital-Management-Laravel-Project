<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Inertia\Inertia;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TechnologyController;

Route::get('/laboratory', [LaboratoryController::class, 'index'])->name('laboratory.index');



Route::get('/technologies', [TechnologyController::class, 'index'])->name('technology.index');


// Department Routes
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{department_name}', [DepartmentController::class, 'showDoctors'])->name('departments.showDoctors');



Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
Route::post('/create-doctor', [ManagementController::class, 'createDoctor'])->name('management.createDoctor');
Route::post('/create-nurse', [ManagementController::class, 'createNurse'])->name('management.createNurse');
Route::post('/create-patient', [ManagementController::class, 'createPatient'])->name('management.createPatient');



Route::get('/doctors', [DoctorController::class, 'index'])
    ->name('doctors.index')
    ->middleware('auth');

Route::post('/doctors/{id}', [DoctorController::class, 'update'])
    ->name('doctors.update')
    ->middleware('auth');

Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])
    ->name('doctors.destroy')
    ->middleware('auth');

Route::get('/doctors/{id}/send-to-patients', [DoctorController::class, 'sendToPatients'])
    ->name('doctors.sendToPatients')
    ->middleware('auth');

Route::get('/patients', [PatientController::class, 'index'])
    ->name('patients.index')
    ->middleware('auth');

Route::post('/patients/{id}', [PatientController::class, 'edit'])
    ->name('patients.edit')
    ->middleware('auth');

Route::delete('/patients/{id}', [PatientController::class, 'destroy'])
    ->name('patients.destroy')
    ->middleware('auth');

Route::get('/nurses', [NurseController::class, 'index'])
    ->name('nurses.index')
    ->middleware('auth');

Route::post('/nurses/{id}', [NurseController::class, 'edit'])
    ->name('nurses.edit')
    ->middleware('auth');

Route::delete('/nurses/{id}', [NurseController::class, 'destroy'])
    ->name('nurses.destroy')
    ->middleware('auth');

Route::get('/', function () {
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
