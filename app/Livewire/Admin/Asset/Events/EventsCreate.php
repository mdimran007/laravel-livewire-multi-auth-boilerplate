<?php

namespace App\Livewire\Admin\Asset\Events;

use App\Models\Event;
use App\Models\Facility;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Goal;
use App\Models\News;
use App\Models\Policy;
use App\Models\Programme;
use App\Models\Report;

class EventsCreate extends Component
{
     use WithFileUploads;

    public $pageTitle = "Event Programme";

    public $dataId;
    public $goals = [];
    public $title;
    public $short_description;
    public $description;
    public $url;
    public $status = STATUS_ACTIVE;
    public $image;
    public $existingImage;
    public $event_date;

    public $goalList;

    public function mount()
    {
        $this->goalList = Goal::where('status', STATUS_ACTIVE)->get();
    }

    public function render()
    {
        return view('livewire.admin.asset.events.events-create');
    }

    private function resetInput()
    {
        $this->dataId = null;
        $this->goals = [];
        $this->title = '';
        $this->short_description = '';
        $this->description = '';
        $this->url = '';
        $this->status = STATUS_ACTIVE;
        $this->image = null;
        $this->existingImage = null;
        $this->event_date = null;
    }

    public function store()
    {
        $this->validate(
            [
                'title' => 'required|string|max:255',
                'short_description' => 'required|string|max:500',
                'description' => 'nullable|string',
                'url' => 'nullable|url',
                'event_date' => 'nullable|date',
                'status' => 'required|in:' . STATUS_ACTIVE . ',' . STATUS_INACTIVE,
                'goals' => 'required|array',
                'goals.*' => 'exists:goals,id',
                'image' => 'nullable|image|max:1024',
            ],
            [
                'title.required' => 'The event title is required.',
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
                'event_date.date' => 'Event date is not valid!',
            ]
        );


        $data = [
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'url' => $this->url,
            'event_date' => $this->event_date,
            'status' => $this->status,
            'created_by' => auth()->id(),
        ];

        if ($this->image) {
            $path = $this->image->store('event', 'public');
            $data['images'] = $path;
        }

        $data = Event::updateOrCreate(['id' => $this->dataId], $data);

        // Sync goals
        $data->goals()->sync($this->goals ?? []);

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => $this->dataId ? 'Updated successfully!' : 'Created successfully!',
        ]);

        $this->resetInput();

        // return redirect()->route('admin.research.index');
    }
 
}
