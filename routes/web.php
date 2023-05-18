<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [DoctorController::class, 'index']);
Route::get('/', [PatientController::class, 'index']);

//Route::get('/', [PatientController::class, 'index']);
//Route::get('/create', [DoctorController::class, 'createDoctor']);


