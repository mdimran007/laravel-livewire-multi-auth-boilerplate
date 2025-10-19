<?php

namespace App\Livewire\Admin\Goals;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Goals extends Component
{
    use WithFileUploads;

    protected $listeners = ['delete-goal' => 'delete'];


    public $pageTitle = "Goals";
    public $goals;

    public function delete($id)
    {
        $goal = Goal::findOrFail($id);

        // Delete image if exists
        if ($goal->images && \Storage::disk('public')->exists($goal->images)) {
            \Storage::disk('public')->delete($goal->images);
        }

        $goal->delete();

        session()->flash('message', 'Goal deleted successfully!');
        return redirect()->route('admin.goals'); // redirect back to list
    }


    public function render()
    {
        $this->goals = Goal::all();
        return view('livewire.admin.goals.goals');
    }
}
