<?php

namespace App\Livewire\Hehe;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Hehe Index')]
#[Layout('components.hehe.layouts.sidebar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.hehe.index');
    }
}
