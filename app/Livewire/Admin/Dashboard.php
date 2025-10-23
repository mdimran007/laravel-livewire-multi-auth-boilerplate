<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Policy;
use App\Models\Service;
use App\Models\Programme;
use App\Models\Event;
use App\Models\Partnership;
use App\Models\Facility;
use App\Models\Goal;
use App\Models\Research;
use App\Models\Report;
use App\Models\News;

class Dashboard extends Component
{
    public $pageTitle = "Dashboard";
    public $total_goals;
    public $total_policies;
    public $total_services;
    public $total_programmes;
    public $total_events;
    public $total_partnerships;
    public $total_facilities;
    public $total_research;
    public $total_reports;
    public $total_news;

    public function mount()
    {
        $this->total_goals = Goal::where('status', STATUS_ACTIVE)->count();
        $this->total_policies = Policy::where('status', STATUS_ACTIVE)->count();
        $this->total_services = Service::where('status', STATUS_ACTIVE)->count();
        $this->total_programmes = Programme::where('status', STATUS_ACTIVE)->count();
        $this->total_events = Event::where('status', STATUS_ACTIVE)->count();
        $this->total_partnerships = Partnership::where('status', STATUS_ACTIVE)->count();
        $this->total_facilities = Facility::where('status', STATUS_ACTIVE)->count();
        $this->total_research = Research::where('status', STATUS_ACTIVE)->count();
        $this->total_reports = Report::where('status', STATUS_ACTIVE)->count();
        $this->total_news = News::where('status', STATUS_ACTIVE)->count();
    }


    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
