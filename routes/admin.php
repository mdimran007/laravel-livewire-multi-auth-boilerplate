<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\GeneralSettings;
use App\Livewire\Admin\Goals\Goals;
use App\Livewire\Admin\Goals\GoalsCreate;
use App\Livewire\Admin\Goals\GoalsDetails;
use App\Livewire\Admin\Goals\GoalsEdit;
use App\Livewire\Admin\ProfileUpdate;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/goals', Goals::class)->name('goals');
    Route::get('/goals/create', GoalsCreate::class)->name('goals.create');
    Route::get('/goals/edit/{goalId}', GoalsEdit::class)->name('goals.edit');
    Route::get('/goals/details/{goalId}', GoalsDetails::class)->name('goals.details');

    Route::get('profile/update', ProfileUpdate::class)->name('profile.update');
    Route::get('general/settings', GeneralSettings::class)->name('general.settings');
});


