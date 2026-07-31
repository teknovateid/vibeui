<?php

namespace App\Livewire\Tes;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Tes Blank')]
#[Layout('components.layouts.sidebar')]
class Blank extends Component
{
    public function render()
    {
        return view('livewire.tes.blank');
    }
}
