<?php

namespace App\Livewire\Docs;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Docs Index')]
#[Layout('components.docs.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.docs.index');
    }
}
