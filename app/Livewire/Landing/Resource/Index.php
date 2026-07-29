<?php

namespace App\Livewire\Landing\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Landing Resource Index')]
#[Layout('components.layouts.topbar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.landing.resource.index');
    }
}
