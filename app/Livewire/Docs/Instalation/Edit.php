<?php

namespace App\Livewire\Docs\Instalation;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Docs Instalation Edit')]
#[Layout('components.docs.layouts.sidebar')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.docs.instalation.edit');
    }
}
