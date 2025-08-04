<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth', RoleMiddleware::class . ':QA Master'])->group(function () {
    Route::get('/qa/reports', fn () => view('qa.reports'))->name('qa.reports');
});
