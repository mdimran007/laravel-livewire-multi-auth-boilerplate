<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


