<?php

namespace App\Livewire\Admin\Committee;

use App\Models\CommitteeMember;
use Livewire\Component;
use Livewire\WithPagination;

class Committee extends Component
{
    protected $listeners = ['delete-goal' => 'delete'];
    use WithPagination;

    public $pageTitle = "Member List";

    public $dataId;
    public $goals = [];
    public $name;
    public $designation;
    public $url;
    public $status;
    public $picture;
    public $existingPicture;

    public $goalList;


    public $createdAt;
    public $updatedAt;
    public $createdBy;
    public function render()
    {
        $dataList = CommitteeMember::query()
            ->where('status', STATUS_ACTIVE)
            ->with('goals')
            ->orderBy('created_at', 'desc')
            ->paginate(16);

        return view('livewire.admin.committee.committee', [
            'dataList' => $dataList,
        ]);
    }

    public function delete($id)
    {
        $data = CommitteeMember::findOrFail($id);

        // Delete image if exists
        if ($data->picture && \Storage::disk('public')->exists($data->picture)) {
            \Storage::disk('public')->delete($data->picture);
        }

        $data->delete();

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Deleted successfully!',
        ]);

        return redirect()->route('admin.committee.index');
    }
}
