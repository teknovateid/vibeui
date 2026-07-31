<?php

namespace App\Livewire\Tes;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Tes Index')]
#[Layout('components.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.tes.index');
    }
}
