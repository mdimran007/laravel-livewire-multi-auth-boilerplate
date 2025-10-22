<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\GeneralSettings;
use App\Livewire\Admin\Goals\Goals;
use App\Livewire\Admin\Goals\GoalsCreate;
use App\Livewire\Admin\Goals\GoalsDetails;
use App\Livewire\Admin\Goals\GoalsEdit;
use App\Livewire\Admin\ProfileUpdate;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\Asset\Policy\{
    Policy,
    PolicyCreate,
    PolicyEdit,
    PolicyDetails
};
use App\Livewire\Admin\Asset\Services\{
    Services,
    ServicesCreate,
    ServicesEdit,
    ServicesDetails
};
use App\Livewire\Admin\Asset\Programmes\{
    Programmes,
    ProgrammesCreate,
    ProgrammesEdit,
    ProgrammesDetails
};
use App\Livewire\Admin\Asset\Events\{
    Events,
    EventsCreate,
    EventsEdit,
    EventsDetails
};
use App\Livewire\Admin\Asset\Partnerships\{
    Partnerships,
    PartnershipsCreate,
    PartnershipsEdit,
    PartnershipsDetails
};
use App\Livewire\Admin\Asset\Facilities\{
    Facilities,
    FacilitiesCreate,
    FacilitiesEdit,
    FacilitiesDetails
};
use App\Livewire\Admin\Asset\Research\{
    ResearchList,
    ResearchCreate,
    ResearchEdit,
    ResearchDetails
};
use App\Livewire\Admin\Asset\Report\{
    Report,
    ReportCreate,
    ReportEdit,
    ReportDetails
};
use App\Livewire\Admin\Asset\News\{
    News,
    NewsCreate,
    NewsEdit,
    NewsDetails
};



Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/goals', Goals::class)->name('goals');
    Route::get('/goals/create', GoalsCreate::class)->name('goals.create');
    Route::get('/goals/edit/{goalId}', GoalsEdit::class)->name('goals.edit');
    Route::get('/goals/details/{goalId}', GoalsDetails::class)->name('goals.details');

    Route::get('profile/update', ProfileUpdate::class)->name('profile.update');
    Route::get('general/settings', GeneralSettings::class)->name('general.settings');
    Route::get('users', Users::class)->name('users');

    // Policy
    Route::prefix('policy')->name('policy.')->group(function () {
        Route::get('/', Policy::class)->name('index');
        Route::get('/create', PolicyCreate::class)->name('create');
        Route::get('/edit/{policyId}', PolicyEdit::class)->name('edit');
        Route::get('/details/{policyId}', PolicyDetails::class)->name('details');
    });

    // Services
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', Services::class)->name('index');
        Route::get('/create', ServicesCreate::class)->name('create');
        Route::get('/edit/{serviceId}', ServicesEdit::class)->name('edit');
        Route::get('/details/{serviceId}', ServicesDetails::class)->name('details');
    });

    // Programmes
    Route::prefix('programmes')->name('programmes.')->group(function () {
        Route::get('/', Programmes::class)->name('index');
        Route::get('/create', ProgrammesCreate::class)->name('create');
        Route::get('/edit/{programmeId}', ProgrammesEdit::class)->name('edit');
        Route::get('/details/{programmeId}', ProgrammesDetails::class)->name('details');
    });

    // Events
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', Events::class)->name('index');
        Route::get('/create', EventsCreate::class)->name('create');
        Route::get('/edit/{eventId}', EventsEdit::class)->name('edit');
        Route::get('/details/{eventId}', EventsDetails::class)->name('details');
    });

    // Partnerships
    Route::prefix('partnerships')->name('partnerships.')->group(function () {
        Route::get('/', Partnerships::class)->name('index');
        Route::get('/create', PartnershipsCreate::class)->name('create');
        Route::get('/edit/{partnershipId}', PartnershipsEdit::class)->name('edit');
        Route::get('/details/{partnershipId}', PartnershipsDetails::class)->name('details');
    });

    // Facilities
    Route::prefix('facilities')->name('facilities.')->group(function () {
        Route::get('/', Facilities::class)->name('index');
        Route::get('/create', FacilitiesCreate::class)->name('create');
        Route::get('/edit/{facilityId}', FacilitiesEdit::class)->name('edit');
        Route::get('/details/{facilityId}', FacilitiesDetails::class)->name('details');
    });

    // Research
    Route::prefix('research')->name('research.')->group(function () {
        Route::get('/', ResearchList::class)->name('index');
        Route::get('/create', ResearchCreate::class)->name('create');
        Route::get('/edit/{researchId}', ResearchEdit::class)->name('edit');
        Route::get('/details/{researchId}', ResearchDetails::class)->name('details');
    });

    // Report
    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/', Report::class)->name('index');
        Route::get('/create', ReportCreate::class)->name('create');
        Route::get('/edit/{reportId}', ReportEdit::class)->name('edit');
        Route::get('/details/{reportId}', ReportDetails::class)->name('details');
    });

    // News
    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/', News::class)->name('index');
        Route::get('/create', NewsCreate::class)->name('create');
        Route::get('/edit/{newsId}', NewsEdit::class)->name('edit');
        Route::get('/details/{newsId}', NewsDetails::class)->name('details');
    });
});