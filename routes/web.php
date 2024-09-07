<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;

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

Route::get('/', [FormController::class, 'index'])->name('forms.index');
Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');

Route::post('/forms', [FormController::class, 'store'])->name('forms.store');
Route::get('forms/data', [FormController::class, 'getFormsData'])->name('forms.data');

Route::get('forms/{id}/edit', [FormController::class, 'edit'])->name('forms.edit');
Route::post('forms/{id}', [FormController::class, 'update'])->name('forms.update');

Route::delete('forms/{id}', [FormController::class, 'destroy'])->name('forms.destroy');

// For dependent dropdowns
Route::get('/states/{countryId}', [FormController::class, 'getStates']);
Route::get('/cities/{stateId}', [FormController::class, 'getCities']);

