<?php

namespace [Namespace];

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use [ModelNamespace];

#[Title('[Title]')]
#[Layout('[Layout]')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        [ModelName]::findOrFail($id)->delete();
    }

    public function render()
    {
        $items = [ModelName]::where('[FirstColumn]', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('[ViewPath]', compact('items'));
    }
}
