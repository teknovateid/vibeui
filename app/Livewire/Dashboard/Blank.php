<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard Blank')]
class Blank extends Component
{
    public function render()
    {
        return view('livewire.dashboard.blank');
    }
}
