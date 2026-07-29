<?php

namespace App\Livewire\Admin\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Admin Resource Index')]
#[Layout('components.layouts.topbar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.resource.index');
    }
}
