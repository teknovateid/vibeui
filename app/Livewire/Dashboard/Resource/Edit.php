<?php

namespace App\Livewire\Dashboard\Resource;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard Resource Edit')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.dashboard.resource.edit');
    }
}
