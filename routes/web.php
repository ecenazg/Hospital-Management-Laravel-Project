<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Inertia\Inertia;

use App\Http\Controllers\LaboratoryController;

Route::group(['prefix' => 'laboratories'], function () {
    Route::get('/', [LaboratoryController::class, 'index'])->name('laboratories.index');
    Route::get('/create', [LaboratoryController::class, 'create'])->name('laboratories.create');
    Route::post('/', [LaboratoryController::class, 'store'])->name('laboratories.store');
    Route::get('/{id}/edit', [LaboratoryController::class, 'edit'])->name('laboratories.edit');
    Route::put('/{id}', [LaboratoryController::class, 'update'])->name('laboratories.update');
    Route::delete('/{id}', [LaboratoryController::class, 'destroy'])->name('laboratories.destroy');
});



Route::get('/doctors', [DoctorController::class, 'index'])
    ->name('doctors.index')
    ->middleware('auth');

Route::post('/doctors/{id}', [DoctorController::class, 'update'])
    ->name('doctors.update')
    ->middleware('auth');

Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])
    ->name('doctors.destroy')
    ->middleware('auth');

Route::post('/doctors/{id}/send-to-patients', [DoctorController::class, 'sendToPatients'])
    ->name('doctors.sendToPatients')
    ->middleware('auth');


Route::get('/', function () {
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/patients', [PatientController::class, 'index'])
    ->name('patients.index')
    ->middleware('auth');

Route::post('/patients', [PatientController::class, 'createPatient'])
    ->name('patients.create')
    ->middleware('auth');

Route::post('/patients/{id}', [PatientController::class, 'edit'])
    ->name('patients.edit')
    ->middleware('auth');

Route::delete('/patients/{id}', [PatientController::class, 'destroy'])
    ->name('patients.destroy')
    ->middleware('auth');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
