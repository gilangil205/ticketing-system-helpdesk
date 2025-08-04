<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':Project Manager'])->group(function () {
    Route::get('/manager/overview', fn () => view('manager.overview'))->name('manager.overview');
});
