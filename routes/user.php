<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});