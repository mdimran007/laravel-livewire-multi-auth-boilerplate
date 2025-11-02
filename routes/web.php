<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\SdgReport;
use App\Livewire\Frontend\Committee;
use App\Livewire\Frontend\CommitteeDetails;
use App\Livewire\Frontend\GoalAssetDetails;
use App\Livewire\Frontend\GoalDetails;
use App\Livewire\Frontend\LandingPage;
use App\Livewire\Frontend\SdgsReport;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', LandingPage::class)->name('frontend.index');
Route::get('/goal/details/{slug}', GoalDetails::class)->name('goal.details');
Route::get('/goal/asset/{type}/{slug}', GoalAssetDetails::class)->name('goal.asset.details');

Route::get('/committee', Committee::class)->name('committee.index');
Route::get('/committee/{slug}', CommitteeDetails::class)->name('committee.details');

Route::get('/sdgs/report', SdgsReport::class)->name('sdgs.report.index');
