<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return redirect()->route('partials.index');
});

// View all participants
Route::get('/registrations', [RegistrationController::class, 'index'])->name('partials.index');

// Registration Form
Route::get('/register', [RegistrationController::class, 'create'])->name('partials.create');

// Store data from registration form
Route::post('/register', [RegistrationController::class, 'store'])->name('partials.store');

// Search
Route::get('/registrations/search', [RegistrationController::class, 'search'])->name('partials.search');

// Edit a registration
Route::get('/registrations/{id}/edit', [RegistrationController::class, 'edit'])->name('partials.editregister');
Route::put('/registrations/{id}', [RegistrationController::class, 'update'])->name('partials.update');

// Delete a registration
Route::delete('/registrations/{id}', [RegistrationController::class, 'destroy'])->name('partials.destroy');