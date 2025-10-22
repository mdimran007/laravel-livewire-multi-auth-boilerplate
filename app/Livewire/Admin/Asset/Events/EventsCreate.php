<?php

namespace App\Livewire\Admin\Asset\Events;

use App\Models\Goal;
use Livewire\Component;

class EventsCreate extends Component
{
    public $pageTitle = "New Event";

    public $goalList;

    public function mount() {

        $this->goalList = Goal::where('status', STATUS_ACTIVE)->get();
    }

    public function render()
    {
        return view('livewire.admin.asset.events.events-create');
    }
}
