<?php

namespace App\Livewire\Dashboard\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Dashboard Resource Index')]
#[Layout('components.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.resource.index');
    }
}
