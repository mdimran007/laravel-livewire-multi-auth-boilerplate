<?php

namespace App\Livewire\Frontend;

use App\Models\CommitteeMember;
use App\Models\Goal;
use Livewire\Component;

class CommitteeDetails extends Component
{
    public $pageTitle = "Committee Details";
    public $goalDetails;
    public $isMainCommittee = false;
    public $mainCommitteeTitle = "SDG BUBT Committee";
    public $mainCommitteeShortDesc = "The SDG BUBT Committee is dedicated to promoting and implementing the United Nations Sustainable Development Goals (SDGs) within our university community. Our mission is to raise awareness, foster collaboration, and drive impactful initiatives that contribute to a sustainable future for all.";
    public $committeeMembers;

    public function mount($slug)
    {

        if ($slug === "sdg-bubt-committee") {
            $this->isMainCommittee = true;
            $this->committeeMembers = CommitteeMember::where('status', STATUS_ACTIVE)->get();
        } else {
            $this->isMainCommittee = false;
            $this->goalDetails = Goal::where('slug', $slug)
                ->where('status', STATUS_ACTIVE)
                ->with('committeeMembers')
                ->firstOrFail();
        }



        // dd($this->goalDetails);

    }

    public function render()
    {
        return view('livewire.frontend.committee-details');
    }
}
