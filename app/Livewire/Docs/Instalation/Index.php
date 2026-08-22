<?php

namespace App\Livewire\Docs\Instalation;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Docs Instalation')]
#[Layout('components.docs.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.docs.instalation.index');
    }
}
