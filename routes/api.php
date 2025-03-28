<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiSaucesController;

// Sauces (api)

Route::post('/auth/signup', [ApiAuthController::class, 'api.auth.signup']); // Create a new user

Route::post('/auth/login', [ApiAuthController::class, 'api.auth.apilogin']); // Login as user

// Sauces routes

Route::get('/sauces', [ApiSaucesController::class, 'index'])->name('api.sauces.index'); // List of sauces

Route::get('/sauces/{id}', [ApiSaucesController::class, 'show'])->name('api.sauces.show'); // Show a sauce

Route::post('/sauces', [ApiSaucesController::class, 'store'])->name('api.sauces.store'); // Create a new sauce

Route::put('/sauces/{id}', [ApiSaucesController::class, 'update'])->name('api.sauces.update'); // Update a sauce

Route::delete('/sauces/{id}', [ApiSaucesController::class, 'destroy'])->name('api.sauces.destroy'); // Delete a sauce

Route::post('/sauces/{id}/like', [ApiSaucesController::class, 'like'])->name('api.sauces.like'); // Like a sauce