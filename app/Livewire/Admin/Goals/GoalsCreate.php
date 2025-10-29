<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoalsCreate extends Component
{
    use WithFileUploads;

    public $pageTitle = "Create New Goal";


    public $title;
    public $status;
    public $short_description;
    public $image;
    public $sdg_image;
    public $selectedItems = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'status' => 'required|integer',
        'short_description' => 'required|string',
        'image' => 'required|image|max:2048',
        'sdg_image' => 'required|image|max:2048',
        'selectedItems' => 'required|array|min:1|max:6',
        'selectedItems.*' => 'string',
    ];

    // Custom error messages
    protected $messages = [
        'selectedItems.max' => 'You can select up to 6 items only.',
    ];

    // Live validation for each property
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


   // Store data
    public function store()
    {
        $this->validate();

        $imagePath = $this->image->store('goals', 'public');
        $sdgImagePath = $this->sdg_image->store('goals', 'public');

        Goal::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'short_description' => $this->short_description,
            'images' => $imagePath,
            'sdg_image' => $sdgImagePath,
            'achievements' => json_encode($this->selectedItems),
            'status' => $this->status,
            'created_by' => Auth::id(),
        ]);

        session()->flash('message', 'Goal created successfully!');

        $this->reset(['title', 'status', 'short_description', 'image', 'sdg_image', 'selectedItems']);
        return redirect()->route('admin.goals');
    }


    public function render()
    {
        return view('livewire.admin.goals.goals-create');
    }
}
