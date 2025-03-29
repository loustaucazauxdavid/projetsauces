<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\SaucesController;
use App\Http\Controllers\Web\HomeController; 

// Authentification routes
Auth::routes();

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sauces routes
Route::get('/sauces', [SaucesController::class, 'index'])->name('web.sauces.index'); // List user's sauces

Route::get('/sauces/all', [SaucesController::class, 'index_all'])->name('web.sauces.index.all'); // List all sauces

Route::get('/sauces/create', [SaucesController::class, 'create'])->name('web.sauces.create'); // Show the form to create a new sauce

Route::get('/sauces/{id}', [SaucesController::class, 'show'])->name('web.sauces.show'); // Show a sauce

Route::post('/sauces', [SaucesController::class, 'store'])->name('web.sauces.store'); // Create a new sauce

Route::put('/sauces/{id}', [SaucesController::class, 'update'])->name('web.sauces.update'); // Update a sauce

Route::delete('/sauces/{id}', [SaucesController::class, 'destroy'])->name('web.sauces.destroy'); // Delete a sauce

Route::post('/sauces/{id}/like', [SaucesController::class, 'like'])->name('web.sauces.like'); // Like a sauce

Route::get('/sauces/{id}/edit', [SaucesController::class, 'edit'])->name('web.sauces.edit'); // Edit a sauce