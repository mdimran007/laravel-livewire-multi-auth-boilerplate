<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class GoalsEdit extends Component
{
    public $pageTitle = "Update Goal";

    use WithFileUploads;

    public $goalId;
    public $title;
    public $short_description;
    public $images;
    public $newImage;
    public $status = 1;
    public $achievements = [];

    // This runs automatically when the component is loaded
    public function mount($goalId)
    {
        $goal = Goal::findOrFail($goalId);

        $this->goalId = $goal->id;
        $this->title = $goal->title;
        $this->short_description = $goal->short_description;
        $this->images = $goal->images;
        $this->status = $goal->status;
        $this->achievements = $goal->achievements ?? [];
    }


    public function render()
    {
        return view('livewire.admin.goals.goals-edit');
    }
}
