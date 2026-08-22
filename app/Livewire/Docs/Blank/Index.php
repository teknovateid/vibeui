<?php

namespace App\Livewire\Docs\Blank;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Docs Blank')]
#[Layout('components.docs.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.docs.blank.index');
    }
}
