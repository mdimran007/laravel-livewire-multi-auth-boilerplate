<?php

namespace App\Livewire\Admin\Asset\Partnerships;

use App\Models\Facility;
use App\Models\News as ModelsNews;
use App\Models\Partnership;
use App\Models\Programme;
use App\Models\Report as ModelsReport;
use Livewire\Component;
use App\Models\Research;
use Livewire\WithPagination;

class Partnerships extends Component
{
     protected $listeners = ['delete-goal' => 'delete'];
    use WithPagination;

    public $pageTitle = "Partnership List";
    public $dataId;
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
        $data = Partnership::with(['goals', 'creator'])->findOrFail($id);
        $this->dataId = $data->id;
        $this->title = $data->title;
        $this->short_description = $data->short_description;
        $this->description = $data->description;
        $this->downloadurl = $data->url;
        $this->status = $data->status;
        $this->image = $data->images;
        $this->goals = $data->goals->pluck('id')->toArray();

        $this->createdAt = $data->created_at;
        $this->updatedAt = $data->updated_at;
        $this->createdBy = $data->creator?->name ?? 'N/A';

        $this->isDetailsModalOpen = true;
    }

    public function closeDetailsModalAction()
    {
        $this->isDetailsModalOpen = false;
    }


    public function render()
    {
        $dataList = Partnership::with('goals')
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.asset.partnerships.partnerships', [
            'dataList' => $dataList
        ]);
    }

    public function delete($id)
    {
        $data = Partnership::findOrFail($id);

        // Delete image if exists
        if ($data->images && \Storage::disk('public')->exists($data->images)) {
            \Storage::disk('public')->delete($data->images);
        }

        $data->delete();

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Deleted successfully!',
        ]);

        return redirect()->route('admin.partnerships.index');
    }

}
