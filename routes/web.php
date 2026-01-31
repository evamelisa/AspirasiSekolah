<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserController;

//Login dan Logout
Route::get('auth/login', [AuthController::class, 'showLoginForm'])
->name('login');
Route::post('auth/login.post', [AuthController::class, 'login'])
->name('login.post');

// Route register hanya untuk admin
Route::middleware(['CekRole:admin'])->group(function () {
    Route::get('auth/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');
    Route::post('auth/register', [AuthController::class, 'register'])->name('register');
});

//
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout');

    Route::resource('aspirasi', AspirasiController::class);

    Route::post('/aspirasi/{aspirasi}/responses', [ResponseController::class, 'store'])
    ->name('responses.store');
});

//
Route::middleware(['auth', 'CekRole:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
    ->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])
    ->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])
    ->name('users.destroy');
});