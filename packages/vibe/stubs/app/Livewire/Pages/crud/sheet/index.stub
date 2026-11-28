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
        $this->dispatch('open-sheet', 'create-sheet');
    }

    public function edit($id)
    {
        $model = [ModelName]::findOrFail($id);
        $this->editId = $id;

        [SetProperties]

        $this->dispatch('open-sheet', 'edit-sheet');
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->editId) {
            [ModelName]::findOrFail($this->editId)->update($data);
            $this->dispatch('close-sheet', 'edit-sheet');
        } else {
            [ModelName]::create($data);
            $this->dispatch('close-sheet', 'create-sheet');
        }

        $this->reset([ResetFields]);

        $this->dispatch('toast', [
            'type' => 'success', 
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function delete($id)
    {
        [ModelName]::findOrFail($id)->delete();
        $this->dispatch('toast', [
            'type' => 'success', 
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function render()
    {
        $items = [ModelName]::where('[FirstColumn]', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('[ViewPath]', compact('items'));
    }
}
