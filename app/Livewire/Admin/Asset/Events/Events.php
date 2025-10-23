<?php

namespace App\Livewire\Admin\Asset\Events;

use App\Models\Event;
use App\Models\Facility;
use App\Models\News as ModelsNews;
use App\Models\Policy as ModelsPolicy;
use App\Models\Programme;
use App\Models\Report as ModelsReport;
use Livewire\Component;
use App\Models\Research;
use Livewire\WithPagination;

class Events extends Component
{
     protected $listeners = ['delete-goal' => 'delete'];
    use WithPagination;

    public $pageTitle = "Event List";
    public $dataId;
    public $goals = [];
    public $title;
    public $short_description;
    public $description;
    public $downloadurl;
    public $status = STATUS_ACTIVE;
    public $image;
    public $existingImage;
    public $event_date;



    public $createdAt;
    public $updatedAt;
    public $createdBy;

    public $goalList;

    public $isDetailsModalOpen = false;

    public function detailsModalOpenAction($id)
    {
        $data = Event::with(['goals', 'creator'])->findOrFail($id);
        $this->dataId = $data->id;
        $this->title = $data->title;
        $this->short_description = $data->short_description;
        $this->description = $data->description;
        $this->downloadurl = $data->url;
        $this->event_date = $data->event_date;
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
        $dataList = Event::with('goals')
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.asset.events.events', [
            'dataList' => $dataList
        ]);
    }

    public function delete($id)
    {
        $data = Event::findOrFail($id);

        // Delete image if exists
        if ($data->images && \Storage::disk('public')->exists($data->images)) {
            \Storage::disk('public')->delete($data->images);
        }

        $data->delete();

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Deleted successfully!',
        ]);

        return redirect()->route('admin.policy.index');
    }

}
