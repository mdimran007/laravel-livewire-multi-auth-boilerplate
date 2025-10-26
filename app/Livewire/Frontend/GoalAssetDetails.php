<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class GoalAssetDetails extends Component
{
    public $pageTitle = "Goal Asset Details";
    public $goalAssetDetails;
    public $type;

    protected $modelMap = [
        'policies' => \App\Models\Policy::class,
        'services' => \App\Models\Service::class,
        'programmes' => \App\Models\Programme::class,
        'facilities' => \App\Models\Facility::class,
        'events' => \App\Models\Event::class,
        'research' => \App\Models\Research::class,
        'reports' => \App\Models\Report::class,
        'news' => \App\Models\News::class,
        'partnerships' => \App\Models\Partnership::class,
    ];

   public function mount($type, $slug)
    {
        $this->type = strtolower($type);

        if (!isset($this->modelMap[$this->type])) {
            abort(404, 'Invalid type');
        }

        $modelClass = $this->modelMap[$this->type];

        $this->goalAssetDetails = $modelClass::where('slug', $slug)
            ->where('status', STATUS_ACTIVE)
            ->firstOrFail();

        $this->pageTitle = ucfirst($this->type) . " Details";
    }

    public function render()
    {
        return view('livewire.frontend.goal-asset-details');
    }
}
