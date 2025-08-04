<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':Admin,Project Manager'
])->group(function () {
    // Management Client
    Route::resource('clients', ClientController::class);
    Route::post('/clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])
        ->name('clients.toggle-status');

    // Management Pegawai
    Route::resource('employees', EmployeeController::class);

    // Halaman project (hanya tampilan)
    Route::get('/projects', function () {
        return view('projects.index');
    })->name('projects');
});
