<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;

use Livewire\WithFileUploads;

class Goals extends Component
{
    use WithFileUploads;

    public $pageTitle = "Goals";

    public function render()
    {
        return view('livewire.admin.goals.goals');
    }
}
