<?php

namespace App\Livewire\Admin\Asset\News;

use App\Models\News as ModelsNews;
use App\Models\Report as ModelsReport;
use Livewire\Component;
use App\Models\Research;
use Livewire\WithPagination;

class News extends Component
{
 
    protected $listeners = ['delete-goal' => 'delete'];
    use WithPagination;

    public $pageTitle = "News List";
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
        $data = ModelsNews::with(['goals', 'creator'])->findOrFail($id);
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
        $dataList = ModelsNews::with('goals')
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.asset.news.news', [
            'dataList' => $dataList
        ]);
    }

    public function delete($id)
    {
        $data = ModelsNews::findOrFail($id);

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
