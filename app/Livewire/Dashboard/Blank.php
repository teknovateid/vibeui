<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Dashboard Blank')]
#[Layout('components.layouts.sidebar')]
class Blank extends Component
{
    public function render()
    {
        return view('livewire.dashboard.blank');
    }
}
