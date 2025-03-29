<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiSaucesController;
use App\Http\Controllers\Api\ApiAuthController;

// Sauces (api)

// Auth routes
Route::post('/auth/register', [ApiAuthController::class, 'register']); // Register a new user

Route::post('/auth/login', [ApiAuthController::class, 'login']); // Login as user

// Sauces routes
Route::get('/sauces', [ApiSaucesController::class, 'index'])->name('api.sauces.index')->middleware('auth:sanctum'); // List of sauces

Route::get('/sauces/{id}', [ApiSaucesController::class, 'show'])->name('api.sauces.show')->middleware('auth:sanctum'); // Show a sauce

Route::post('/sauces', [ApiSaucesController::class, 'store'])->name('api.sauces.store')->middleware('auth:sanctum'); // Create a new sauce

Route::put('/sauces/{id}', [ApiSaucesController::class, 'update'])->name('api.sauces.update')->middleware('auth:sanctum'); // Update a sauce

Route::delete('/sauces/{id}', [ApiSaucesController::class, 'destroy'])->name('api.sauces.destroy')->middleware('auth:sanctum'); // Delete a sauce

Route::post('/sauces/{id}/like', [ApiSaucesController::class, 'like'])->name('api.sauces.like')->middleware('auth:sanctum'); // Like a sauce