<?php

namespace App\Livewire\Dashboard\Product;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard Product')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.product.index');
    }
}
