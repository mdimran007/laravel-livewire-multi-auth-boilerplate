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
