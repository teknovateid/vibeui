<?php

namespace App\Livewire\Landing\Home;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Landing Home')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.landing.home.index');
    }
}
