<?php

use App\Http\Controllers\RoleController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //** User Route Start */
    Route::resource('users', UserController::class)
        ->only(['create', 'store'])
        ->middleware("permission:users.create");
    Route::resource('users', UserController::class)
        ->only(['edit', 'update'])
        ->middleware("permission:users.update");
    Route::resource('users', UserController::class)
        ->only(['destroy'])
        ->middleware("permission:users.delete");
    Route::resource('users', UserController::class)
        ->only(['index', 'show'])
        ->middleware("permission:users.view|users.create|users.update|users.delete");
    //** User Route End */

    //** Roles Route start */
    Route::resource('roles', RoleController::class)
        ->only(['create', 'store'])
        ->middleware("permission:roles.create");
    Route::resource('roles', RoleController::class)
        ->only(['edit', 'update'])
        ->middleware("permission:roles.update");
    Route::resource('roles', RoleController::class)
        ->only(['destroy'])
        ->middleware("permission:roles.delete");
    Route::resource('roles', RoleController::class)
        ->only(['index', 'show'])
        ->middleware("permission:roles.view|roles.create|roles.update|roles.delete");
    //** Roles Route End */
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
