<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{
    Goal,
    Policy,
    Service,
    Programme,
    Facility,
    Event,
    Research,
    Report,
    News,
    Partnership
};
use Livewire\WithPagination;

class GoalDetails extends Component
{
    use WithPagination;
     protected $paginationTheme = 'tailwind';

    public $pageTitle = "Goal Details";
    public $goal;
    public $policies;
    public $services;
    public $programmes;
    public $facilities;
    public $events;
    public $research;
    public $reports;
    public $news;
    public $partnerships;

    public function mount($slug)
    {
        // You can fetch the goal details using the slug if needed
        $this->goal = Goal::where('slug', $slug)
            ->where('status', STATUS_ACTIVE)
            ->firstOrFail();
    }
    public function render()
    {
        $data = [
            'policies' => $this->goal->policies()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'policiesPage'),
            'services' => $this->goal->services()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'servicesPage'),
            'programmes' => $this->goal->programmes()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'programmesPage'),
            'facilities' => $this->goal->facilities()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'facilitiesPage'),
            'events' => $this->goal->events()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'eventsPage'),
            'research' => $this->goal->researches()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'researchPage'),
            'reports' => $this->goal->reports()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'reportsPage'),
            'news' => $this->goal->news()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'newsPage'),
            'partnerships' => $this->goal->partnerships()->where('status', STATUS_ACTIVE)->latest()->paginate(20, ['*'], 'partnershipsPage'),
        ];
       return view('livewire.frontend.goal-details', [
        'data' => $data
       ]);
    }
}
