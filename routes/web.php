<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;

// Redirect root ke login
Route::get('/', fn () => redirect()->route('login'));

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Dashboard: menggunakan controller agar bisa ambil data dinamis
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

   Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::middleware(['auth', 'role:Admin,Project Manager'])->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route sesuai role
require __DIR__.'/admin.php';
require __DIR__.'/client.php';
require __DIR__.'/developer.php';
require __DIR__.'/manager.php';
require __DIR__.'/qa.php';

// Route auth dari Laravel Breeze/Jetstream
require __DIR__.'/auth.php';
