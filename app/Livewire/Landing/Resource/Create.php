<?php

namespace App\Livewire\Landing\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Landing Resource Create')]
#[Layout('components.layouts.topbar')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.landing.resource.create');
    }
}
