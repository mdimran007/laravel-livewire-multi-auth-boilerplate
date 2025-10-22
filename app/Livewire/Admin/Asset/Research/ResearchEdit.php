<?php

namespace App\Livewire\Admin\Asset\Research;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Research;
use App\Models\Goal;
use Illuminate\Support\Str;

class ResearchEdit extends Component
{
    use WithFileUploads;

    public $pageTitle = "Research Edit";

    public $researchId;
    public $goals = [];
    public $title;
    public $short_description;
    public $description;
    public $url;
    public $status = STATUS_ACTIVE;
    public $image;
    public $existingImage;

    public $goalList;

    public function mount($researchId = null)
    {
        $this->goalList = Goal::where('status', STATUS_ACTIVE)->get();
        if ($researchId) {
            $this->researchId = $researchId;
            $research = Research::with('goals')->findOrFail($researchId);
            $this->title = $research->title;
            $this->short_description = $research->short_description;
            $this->description = $research->description;
            $this->url = $research->url;
            $this->status = $research->status;
            $this->existingImage = $research->images;
            $this->goals = $research->goals->pluck('id')->toArray();
        }
    }

    public function render()
    {
        return view('livewire.admin.asset.research.research-edit');
    }

    public function store()
    {
        $this->validate(
            [
                'title' => 'required|string|max:255',
                'short_description' => 'required|string|max:500',
                'description' => 'nullable|string',
                'url' => 'nullable|url',
                'status' => 'required|in:' . STATUS_ACTIVE . ',' . STATUS_INACTIVE,
                'goals' => 'required|array',
                'goals.*' => 'exists:goals,id',
                'image' => 'nullable|image|max:1024',
            ],
            [
                'title.required' => 'The research title is required.',
                'title.max' => 'The title cannot exceed 255 characters.',
                'short_description.required' => 'Please enter a short description.',
                'short_description.max' => 'Short description cannot exceed 500 characters.',
                'description.string' => 'The description must be a valid string.',
                'url.url' => 'Please enter a valid URL.',
                'status.required' => 'Please select a status.',
                'status.in' => 'The selected status is invalid.',
                'goals.required' => 'Please select at least one goal.',
                'goals.array' => 'The selected goals are invalid.',
                'goals.*.exists' => 'One of the selected goals is invalid.',
                'image.required' => 'Please upload an image.',
                'image.image' => 'The uploaded file must be an image.',
                'image.max' => 'The image must not be larger than 1MB.',
            ]
        );


        $data = [
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'url' => $this->url,
            'status' => $this->status,
            'created_by' => auth()->id(),
        ];

        if ($this->image) {
            $path = $this->image->store('research', 'public');
            $data['images'] = $path;
        }

        $research = Research::updateOrCreate(['id' => $this->researchId], $data);

        // Sync goals
        $research->goals()->sync($this->goals ?? []);

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => $this->researchId ? 'Research updated successfully!' : 'Research created successfully!',
        ]);

        return redirect()->route('admin.research.index');
    }
}
