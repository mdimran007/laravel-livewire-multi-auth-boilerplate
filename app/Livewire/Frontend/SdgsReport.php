<?php

namespace App\Livewire\Frontend;

use App\Models\SDGReport as SDGReportData;
use Livewire\Component;

class SdgsReport extends Component
{
    public $sdgReport;
    public function mount()
    {
        $this->sdgReport = SDGReportData::first();
    }
    public function render()
    {
        return view('livewire.frontend.sdgs-report', [
            'sdgReport' => $this->sdgReport,
        ]);
    }
}
