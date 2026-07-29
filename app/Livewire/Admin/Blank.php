<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Admin Blank')]
#[Layout('components.layouts.topbar')]
class Blank extends Component
{
    public function render()
    {
        return view('livewire.admin.blank');
    }
}
