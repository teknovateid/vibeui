<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Landing Blank')]
#[Layout('components.layouts.topbar')]
class Blank extends Component
{
    public function render()
    {
        return view('livewire.landing.blank');
    }
}
