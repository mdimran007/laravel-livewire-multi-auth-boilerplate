<?php

namespace App\Livewire\Frontend;

use App\Models\Goal;
use Livewire\Component;

class CommitteeDetails extends Component
{
    public $pageTitle = "Committee Details";
    public $goalDetails;

    public function mount($slug)
    {

        $this->goalDetails = Goal::where('slug', $slug)
            ->where('status', STATUS_ACTIVE)
            ->with('committeeMembers')
            ->firstOrFail();

            // dd($this->goalDetails);

    }

    public function render()
    {
        return view('livewire.frontend.committee-details');
    }
}
