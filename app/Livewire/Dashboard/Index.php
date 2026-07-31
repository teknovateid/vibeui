<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Dashboard Index')]
#[Layout('components.dashboard.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
