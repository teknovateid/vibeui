<?php

namespace App\Livewire\Tes\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Tes Resource Create')]
#[Layout('components.layouts.sidebar')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.tes.resource.create');
    }
}
