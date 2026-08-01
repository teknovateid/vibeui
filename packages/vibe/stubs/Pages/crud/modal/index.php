<?php

namespace [Namespace];

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use [ModelNamespace];

#[Title('[Title]')]
#[Layout('[Layout]')]
class [ClassName] extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $editId = null;

    [Properties]

    protected function rules()
    {
        return [
            [Rules]
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset([ResetFields]);
        $this->editId = null;
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $model = [ModelName]::findOrFail($id);
        $this->editId = $id;

        [SetProperties]

        $this->isOpen = true;
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->editId) {
            [ModelName]::findOrFail($this->editId)->update($data);
        } else {
            [ModelName]::create($data);
        }

        $this->isOpen = false;
        $this->reset([ResetFields]);
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
