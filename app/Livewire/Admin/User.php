<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class User extends Component
{
    public $pageTitle = "Users";

    public function render()
    {
        return view('livewire.admin.user');
    }
}
