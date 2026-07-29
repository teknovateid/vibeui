<?php

namespace App\Livewire\Admin\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Admin Resource Create')]
#[Layout('components.layouts.topbar')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.admin.resource.create');
    }
}
