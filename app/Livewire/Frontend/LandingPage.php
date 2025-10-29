<?php

namespace App\Livewire\Frontend;

use App\Models\Event;
use App\Models\Facility;
use App\Models\Goal;
use App\Models\News;
use App\Models\Partnership;
use App\Models\Policy;
use App\Models\Programme;
use App\Models\Report;
use App\Models\Research;
use App\Models\Service;
use Livewire\Component;

class LandingPage extends Component
{
    public $pageTitle = "Home";

    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex items-center justify-center h-64">
            <svg class="animate-spin h-10 w-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
        HTML;
    }

    public function render()
    {

        return view('livewire.frontend.landing-page', [
            'goals' => Goal::where('status', STATUS_ACTIVE)->withCount([
                'policies',
                'services',
                'programmes',
                'facilities',
                'events',
                'researches',
                'reports',
                'news',
                'partnerships'
            ])->with(['creator'])->paginate(20),
        ]);
    }
}
