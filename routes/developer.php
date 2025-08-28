<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':Developer'])->prefix('developer')->group(function () {
    Route::get('/dashboard', fn () => view('dashboards.developer.index'))->name('developer.dashboard');

    // Management Tickets khusus developer
    Route::get('/tickets', [TicketController::class, 'developerTickets'])
        ->name('developer.tickets.index');
});
