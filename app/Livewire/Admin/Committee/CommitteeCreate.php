<?php

namespace App\Livewire\Admin\Committee;

use App\Models\CommitteeMember;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Goal;

class CommitteeCreate extends Component
{
    use WithFileUploads;

    public $pageTitle = "New Programme";

    public $dataId;
    public $goals = [];
    public $name;
    public $designation;
    public $url;
    public $status = STATUS_ACTIVE;
    public $picture;
    public $existingPicture;

    public $goalList;
    public $selectedGoals = [];

    public function mount()
    {
        $this->goalList = Goal::where('status', STATUS_ACTIVE)->get();
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'url' => 'nullable|url',
        'picture' => 'nullable|image|max:2048',
        'status' => 'required|in:0,1',
        'selectedGoals' => 'required|array',
        'selectedGoals.*' => 'exists:goals,id',
    ];

    // Custom messages
    protected $messages = [
        'name.required' => 'The Name field is required.',
        'name.max' => 'The Name may not be greater than 255 characters.',
        'designation.required' => 'The Designation field is required.',
        'designation.max' => 'The Designation may not be greater than 255 characters.',
        'url.url' => 'The URL must be a valid URL.',
        'picture.image' => 'The Picture must be an image file.',
        'picture.max' => 'The Picture may not be greater than 2MB.',
        'status.required' => 'The Status field is required.',
        'status.in' => 'The selected Status is invalid.',
        'selectedGoals.required' => 'Please select at least one Goal.',
        'selectedGoals.array' => 'Invalid format for selected Goals.',
        'selectedGoals.*.exists' => 'One of the selected Goals is invalid.',
    ];

    // Live validation for each property
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate($this->rules, $this->messages);

        $data = [
            'name' => $this->name,
            'designation' => $this->designation,
            'url' => $this->url,
            'status' => $this->status,
            'created_by' => auth()->id(),
        ];

        if ($this->picture) {
            $path = $this->picture->store('committee', 'public');
            $data['picture'] = $path;
        }

        $data = CommitteeMember::updateOrCreate(['id' => $this->dataId], $data);

        // Sync goals
        $data->goals()->sync($this->selectedGoals ?? []);

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => $this->dataId ? 'Updated successfully!' : 'Created successfully!',
        ]);

        $this->reset(['name', 'designation', 'url', 'picture', 'selectedGoals', 'status']);

        return redirect()->route('admin.committee.index');
    }

    public function render()
    {
        return view('livewire.admin.committee.committee-create');
    }
}
