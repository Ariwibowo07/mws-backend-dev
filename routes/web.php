<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;



// Google OAuth web routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
