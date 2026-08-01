<?php

namespace App\Livewire\Coba;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Coba Index')]
#[Layout('components.coba.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.coba.index');
    }
}
