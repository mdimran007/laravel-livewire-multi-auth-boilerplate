<?php

namespace App\Livewire\Admin\Asset\Research;

use Livewire\Component;
use App\Models\Research;
use Livewire\WithPagination;

class ResearchList extends Component
{

    protected $listeners = ['delete-goal' => 'delete'];
    use WithPagination;

    public $pageTitle = "Research List";
    public $researchId;
    public $goals = [];
    public $title;
    public $short_description;
    public $description;
    public $downloadurl;
    public $status = STATUS_ACTIVE;
    public $image;
    public $existingImage;

    public $createdAt;
    public $updatedAt;
    public $createdBy;

    public $goalList;

    public $isDetailsModalOpen = false;

    public function detailsModalOpenAction($id)
    {
        $research = Research::with(['goals','creator'])->findOrFail($id);
        $this->researchId = $research->id;
        $this->title = $research->title;
        $this->short_description = $research->short_description;
        $this->description = $research->description;
        $this->downloadurl = $research->url;
        $this->status = $research->status;
        $this->image = $research->images;
        $this->goals = $research->goals->pluck('id')->toArray();

        $this->createdAt = $research->created_at;
        $this->updatedAt = $research->updated_at;
        $this->createdBy = $research->creator?->name ?? 'N/A';

        $this->isDetailsModalOpen = true;
    }

    public function closeDetailsModalAction()
    {
        $this->isDetailsModalOpen = false;
    }


    public function render()
    {
        $researchList = Research::with('goals')
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.asset.research.research', [
            'researchList' => $researchList
        ]);
    }


    public function delete($id)
    {
        $data = Research::findOrFail($id);

        // Delete image if exists
        if ($data->images && \Storage::disk('public')->exists($data->images)) {
            \Storage::disk('public')->delete($data->images);
        }

        $data->delete();

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Deleted successfully!',
        ]);

        return redirect()->route('admin.research.index');
    }
}
