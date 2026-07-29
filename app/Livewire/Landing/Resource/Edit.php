<?php

namespace App\Livewire\Landing\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Landing Resource Edit')]
#[Layout('components.layouts.topbar')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.landing.resource.edit');
    }
}
