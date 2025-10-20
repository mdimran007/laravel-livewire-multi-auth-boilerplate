<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;
use App\Models\Goal;
use App\Models\GoalAsset;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GoalsDetails extends Component
{

    protected $listeners = ['delete-goal' => 'delete'];

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


    
    public function delete($id)
    {
        $goalAssetData = GoalAsset::findOrFail($id);
        $goalAsset = json_decode($goalAssetData->data);

        // Delete image if exists
        if (isset($goalAsset->image) && \Storage::disk('public')->exists($goalAsset->image)) {
            \Storage::disk('public')->delete($goalAsset->image);
        }

        $goalAssetData->delete();

        session()->flash('message', ucfirst($goalAssetData->asset_type).'deleted successfully!');
          return redirect()->route('admin.goals.details', $this->goalId); // redirect back to list
    }

    public function store()
    {
        // 1️⃣ Build validation rules dynamically
        $rules = [];
        foreach ($this->assetFields as $field) {
            if ($field === 'image') {
                $rules["formData.$field"] = 'nullable|image|max:2048';
            } elseif ($field === 'download_link') {
                $rules["formData.$field"] = 'nullable|url';
            } else {
                $rules["formData.$field"] = 'nullable|string';
            }
        }

        $rules['status'] = 'required|boolean';

        $this->validate($rules);

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

        $goalAssets = GoalAsset::all();
        $this->goalAssetList = $goalAssets;

    }

    public function render()
    {
        return view('livewire.admin.goals.goals-details');
    }
}
