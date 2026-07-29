<?php

namespace App\Livewire\Admin\Resource;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Admin Resource Edit')]
#[Layout('components.layouts.topbar')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.admin.resource.edit');
    }
}
