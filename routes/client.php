<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':Client'])->group(function () {
    // Dashboard route
    Route::get('/client/dashboard', function () {
        return view('dashboards.client.index'); // Sesuai struktur folder Anda
    })->name('client.dashboard');
    
    // Tickets routes group
    Route::prefix('client/tickets')->name('client.tickets.')->group(function () {
        // Index route
        Route::get('/', function () {
            return view('dashboards.client.tickets.index'); // Asumsi file ada di dashboards/client/tickets.blade.php
        })->name('index');
        
        // Create route
        Route::get('/create', function () {
            return view('dashboards.client.tickets-create');
        })->name('create');
        
        // Store route
        Route::post('/', function () {
            // Logic untuk menyimpan ticket
        })->name('store');
        
        // Add other ticket routes as needed
    });

    // History route
    Route::get('/client/history', function () {
        return view('dashboards.client.history'); // Make sure this view exists
    })->name('client.history.index');


    
});