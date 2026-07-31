<?php

namespace App\Livewire\Tes\Tes;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Tes Tes')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.tes.tes.index');
    }
}
