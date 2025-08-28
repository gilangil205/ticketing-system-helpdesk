<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\TicketController;

Route::middleware(['auth', RoleMiddleware::class . ':Client'])->group(function () {

    // Dashboard
    Route::get('/client/dashboard', function () {
        return view('dashboards.client.index'); 
    })->name('client.dashboard');

    // Tickets
    Route::prefix('client/tickets')->name('client.tickets.')->group(function () {
        // Redirect ke create
        Route::get('/', function () {
            return redirect()->route('client.tickets.create'); 
        })->name('index');

        // Form create + store
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');

        // History
        Route::get('/history', [TicketController::class, 'history'])->name('history');

        // Show ticket berdasarkan ticket_number
        Route::get('/{ticket_number}', [TicketController::class, 'showClientTicket'])
            ->name('show');
    });
});
