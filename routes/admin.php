<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware([
    'auth',
    RoleMiddleware::class . ':Admin,Project Manager'
])->group(function () {

    // ----------------------------
    // Management Client
    // ----------------------------
    Route::resource('clients', ClientController::class);
    Route::post('/clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])
        ->name('clients.toggle-status');

    // ----------------------------
    // Management Pegawai
    // ----------------------------
    Route::resource('employees', EmployeeController::class);

    // ----------------------------
    // Project CRUD
    // ----------------------------
    // Tampilkan semua project & tiket
    Route::get('/projects', [TicketController::class, 'projectTickets'])->name('projects');

    // Simpan project baru
    Route::post('/projects', [TicketController::class, 'storeProject'])->name('projects.store');

    // Hapus project
    Route::delete('/projects/{project}', [TicketController::class, 'destroyProject'])
        ->name('projects.destroy');

    // ----------------------------
    // Tickets
    // ----------------------------
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});
