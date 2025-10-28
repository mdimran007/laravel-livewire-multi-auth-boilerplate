<?php

namespace App\Livewire\Frontend;

use App\Models\Goal;
use Livewire\Component;

class Committee extends Component
{
    public function render()
    {
        $goals = Goal::withCount('committeeMembers')
            ->get();

        return view('livewire.frontend.committee', compact('goals'));
    }
}
