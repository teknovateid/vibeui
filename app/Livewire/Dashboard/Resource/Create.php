<?php

namespace App\Livewire\Dashboard\Resource;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard Resource Create')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.dashboard.resource.create');
    }
}
