<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GoalsEdit extends Component
{
    public $pageTitle = "Update Goal";

    use WithFileUploads;

    public $goalId;
    public $title;
    public $status;
    public $short_description;
    public $image;
    public $old_image;
    public $selectedItems = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'status' => 'required|integer',
        'short_description' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'selectedItems' => 'required|array|min:1|max:4',
        'selectedItems.*' => 'string',
    ];

    protected $messages = [
        'selectedItems.max' => 'You can select up to 4 items only.',
    ];


    // This runs automatically when the component is loaded
    public function mount($goalId)
    {
        $goal = Goal::findOrFail($goalId);
        $this->goalId = $goal->id;
        $this->title = $goal->title;
        $this->status = $goal->status;
        $this->short_description = $goal->short_description;
        $this->selectedItems = json_decode($goal->achievements, true) ?? [];
        $this->old_image = $goal->images;
    }

 

    // Live validation for each property
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $goal = Goal::findOrFail($this->goalId);

        $imagePath = $this->old_image;
        if ($this->image) {
            if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                Storage::disk('public')->delete($this->old_image);
            }
            $imagePath = $this->image->store('goals', 'public');
        }

        $goal->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'short_description' => $this->short_description,
            'images' => $imagePath,
            'achievements' => json_encode($this->selectedItems),
            'status' => $this->status,
            'created_by' => Auth::id(),
        ]);

        session()->flash('message', 'Goal updated successfully!');
        return redirect()->route('admin.goals');
    }


    public function render()
    {
        return view('livewire.admin.goals.goals-edit');
    }
}
