<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;
use App\Models\Goal;
use App\Models\GoalAsset;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Policy;
use App\Models\Service;
use App\Models\Programme;
use App\Models\Event;
use App\Models\Partnership;
use App\Models\Facility;
use App\Models\Research;
use App\Models\Report;
use App\Models\News;

class GoalsDetails extends Component
{
    public $listeners = [
        'delete-goal' => 'delete',
        'initQuillEditor'
    ];


    use WithFileUploads;

    public $pageTitle = "Goal Details";

    public $goalId;
    public $title;
    public $status;
    public $short_description;
    public $image;
    public $selectedItems = [];
    public $createdAt;
    public $updatedAt;
    public $createdBy;

    public $goalAssetList;


    public $isAssetModalOpen = false;
    public $assetName;
    public $assetFields = [];
    public $formData = [];
    public $editingAssetId = null;


    public $isAssetDetailsModalOpen = false;


    public $assetId;
    public $asset_type;
    public $asset_data;
    public $asset_status;
    public $asset_createdAt;
    public $asset_updatedAt;
    public $asset_createdBy;

    public $total_policies;
    public $total_services;
    public $total_programmes;
    public $total_events;
    public $total_partnerships;
    public $total_facilities;
    public $total_research;
    public $total_reports;
    public $total_news;

    public $policiesData;
    public $servicesData;
    public $programmesData;
    public $eventsData;
    public $partnershipsData;
    public $facilitiesData;
    public $researchData;
    public $reportsData;
    public $newsData;



    public function openAssetDetailsModal($assetId)
    {
        $goalAsset = GoalAsset::findOrFail($assetId)->with(['creator'])->first();

        $this->assetId = $goalAsset->id;
        $this->asset_type = $goalAsset->asset_type;
        $this->asset_status = $goalAsset->status;
        $this->asset_data = json_decode($goalAsset->data);
        $this->asset_createdAt = $goalAsset->created_at;
        $this->asset_updatedAt = $goalAsset->updated_at;
        $this->asset_createdBy = $goalAsset->creator?->name ?? 'N/A';


        $this->isAssetDetailsModalOpen = true;
    }

    public function closeAssetDetailsModal()
    {
        $this->isAssetDetailsModalOpen = false;
    }


    public function delete($id)
    {
        $goalAssetData = GoalAsset::findOrFail($id);
        $goalAsset = json_decode($goalAssetData->data);

        // Delete image if exists
        if (isset($goalAsset->image) && \Storage::disk('public')->exists($goalAsset->image)) {
            \Storage::disk('public')->delete($goalAsset->image);
        }

        $goalAssetData->delete();

        session()->flash('message', ucfirst($goalAssetData->asset_type) . 'deleted successfully!');
        return redirect()->route('admin.goals.details', $this->goalId); // redirect back to list
    }

    public function store()
    {
        // 1️⃣ Build validation rules dynamically
        $rules = [];
        foreach ($this->assetFields as $field) {
            if ($field === 'image') {
                $rules["formData.$field"] = 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048';
            } elseif ($field === 'url') {
                $rules["formData.$field"] = 'nullable|url';
            } elseif ($field === 'title') {
                $rules["formData.$field"] = 'required|string|max:255';
            } elseif ($field === 'short_description') {
                $rules["formData.$field"] = 'required|string||max:1000';
            } elseif ($field === 'description') {
                $rules["formData.$field"] = 'nullable|string|max:5000';
            } elseif ($field === 'event_date') {
                $rules["formData.$field"] = 'required|date|before:today';
            } else {
                $rules["formData.$field"] = 'nullable|string';
            }
        }

        $rules['status'] = 'required|boolean';

        $messages = [
            'formData.image.image' => 'The uploaded file must be an image.',
            'formData.image.mimes' => 'Allowed image types are jpg, jpeg, png, webp, gif.',
            'formData.image.max' => 'The image size must not exceed 2MB.',

            'formData.url.url' => 'The url must be a valid URL.',

            'formData.title.required' => 'Please enter a title.',
            'formData.title.string' => 'The title must be text.',
            'formData.title.max' => 'The title may not exceed 255 characters.',

            'formData.short_description.required' => 'Please enter a short description.',
            'formData.short_description.string' => 'The short description must be text.',
            'formData.short_description.max' => 'The short description may not exceed 1000 characters.',

            'formData.description.string' => 'The description must be text.',
            'formData.description.max' => 'The description may not exceed 5000 characters.',

            'formData.event_date.required' => 'Please select an event date.',
            'formData.event_date.date' => 'The event date must be a valid date.',
            'formData.event_date.after' => 'The event date must be a future date.',

            'status.required' => 'Please select a status.',
            'status.boolean' => 'The status must be either active or inactive.',
        ];


        $this->validate($rules, $messages);

        // 2️⃣ Prepare form data for saving
        $dataToSave = $this->formData;


        // Handle image upload: convert UploadedFile to string path
        if (isset($dataToSave->image) && is_object($dataToSave->image)) {
            $path = $dataToSave->image->store('goal_assets', 'public');
            $dataToSave->image = $path;
        }

        // 3️⃣ Create or update record
        if ($this->editingAssetId) {
            // Edit mode
            $asset = GoalAsset::findOrFail($this->editingAssetId);
            $asset->update([
                'data' => json_encode($dataToSave),          // JSON column
                'status' => $this->status,      // separate column
            ]);

            session()->flash('success', ucfirst($this->assetName) . ' asset updated successfully!');
        } else {
            // Create mode
            GoalAsset::create([
                'goal_id' => $this->goalId,
                'asset_type' => (string)$this->assetName,
                'data' => json_encode($dataToSave),          // JSON column
                'status' => $this->status,      // separate column
                'created_by' => auth()->id(),
            ]);

            session()->flash('success', ucfirst($this->assetName) . ' asset saved successfully!');
        }

        // 4️⃣ Reset modal
        $this->closeAssetModal();

        // Optional: refresh asset list via event
        // $this->emit('goalsDetails');
        return redirect()->route('admin.goals.details', $this->goalId);
    }



    public function openAssetModal($assetName, $assetId = null)
    {

        $this->assetName = $assetName;
        $properties = goalAssetsProperty();
        $this->assetFields = $properties[$assetName] ?? [];


        if ($assetId) {
            // Edit mode
            $asset = GoalAsset::findOrFail($assetId);
            $this->editingAssetId = $assetId;
            $this->status = $asset->status;
            $this->formData = json_decode($asset->data) ?? [];
        } else {
            // Create mode
            $this->editingAssetId = null;
            $this->status = 1;
            $this->formData = [];
            foreach ($this->assetFields as $field) {
                $this->formData[$field] = '';
            }
        }


        // dd($this->formData);

        $this->isAssetModalOpen = true;

        $this->dispatch('initQuillEditor');
    }

    public function closeAssetModal()
    {
        $this->reset(['assetName', 'assetFields', 'formData', 'status', 'editingAssetId']);
        $this->isAssetModalOpen = false;
    }

    public function mount($goalId)
    {

        $goal = Goal::findOrFail($goalId)->with(['creator'])->first();
        $this->goalId = $goal->id;
        $this->title = $goal->title;
        $this->status = $goal->status;
        $this->short_description = $goal->short_description;
        $this->selectedItems = json_decode($goal->achievements, true) ?? [];
        $this->image = $goal->images;
        $this->createdAt = $goal->created_at;
        $this->updatedAt = $goal->updated_at;
        $this->createdBy = $goal->creator->name;

        // $this->policiesData = Policy::all();
        // $this->total_policies = $this->policiesData->count();


        // $this->servicesData = Service::all();
        // $this->total_services = $this->servicesData->count();

        // $this->programmesData = Programme::all();
        // $this->total_programmes = $this->programmesData->count();

        // $this->eventsData = Event::all();
        // $this->total_events = $this->eventsData->count();

        // $this->partnershipsData = Partnership::all();
        // $this->total_partnerships = $this->partnershipsData->count();

        // $this->facilitiesData = Facility::all();
        // $this->total_facilities = $this->facilitiesData->count();

        // $this->researchData = Research::all();
        // $this->total_research = $this->researchData->count();

        // $this->reportsData = Report::all();
        // $this->total_reports = $this->reportsData->count();

        // $this->newsData = News::all();
        // $this->total_news = $this->newsData->count();




        // $goalAssets = GoalAsset::all();
        // $this->goalAssetList = $goalAssets;
    }

    public function render()
    {
        return view('livewire.admin.goals.goals-details');
    }
}
