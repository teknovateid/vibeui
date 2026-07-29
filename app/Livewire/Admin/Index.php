<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Admin Index')]
#[Layout('components.layouts.topbar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.index');
    }
}
