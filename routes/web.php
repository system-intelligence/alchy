<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;

Route::get('/', [App\Http\Controllers\alchyController::class, 'index']);
Route::get('/alchies', [App\Http\Controllers\alchyController::class, 'index']);

// Registration routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Logout route
Route::post('/logout', Logout::class)
    ->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::post('/alchies', [App\Http\Controllers\alchyController::class, 'store']);
    Route::get('/alchies/{alchy}/edit', [App\Http\Controllers\alchyController::class, 'edit']);
    Route::put('/alchies/{alchy}', [App\Http\Controllers\alchyController::class, 'update']);
    Route::delete('/alchies/{alchy}', [App\Http\Controllers\alchyController::class, 'destroy']);
});