<?php

namespace App\Livewire\Dashboard\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Dashboard Resource Create')]
#[Layout('components.layouts.sidebar')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.dashboard.resource.create');
    }
}
