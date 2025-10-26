<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Frontend\GoalAssetDetails;
use App\Livewire\Frontend\GoalDetails;
use App\Livewire\Frontend\LandingPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', LandingPage::class)->name('frontend.index');
Route::get('/goal/details/{slug}', GoalDetails::class)->name('goal.details');
Route::get('/goal/asset/{type}/{slug}', GoalAssetDetails::class)->name('goal.asset.details');
//  Route::get('/sdg-report', [PageController::class, 'sdgReport'])->name('frontend.sdg-report');
//  Route::get('/committee', [PageController::class, 'committee'])->name('frontend.committee');
