<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':Developer'])->group(function () {
    Route::get('/developer/tasks', fn () => view('developer.tasks'))->name('developer.tasks');
});
