<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Landing Index')]
#[Layout('components.layouts.topbar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.landing.index');
    }
}
