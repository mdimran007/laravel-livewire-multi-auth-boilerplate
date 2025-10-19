<?php

namespace App\Livewire\Admin\Goals;

use App\Models\Goal;
use Livewire\Component;

use Livewire\WithFileUploads;

class Goals extends Component
{
    use WithFileUploads;

    public $pageTitle = "Goals";
    public $goals;

    public function render()
    {
        $this->goals = Goal::all();
        return view('livewire.admin.goals.goals');
    }
}
