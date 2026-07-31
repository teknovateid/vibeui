<?php

namespace [Namespace];

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use [ModelNamespace];

#[Title('[Title]')]
#[Layout('[Layout]')]
class Edit extends Component
{
    public $editId;
    [Properties]

    protected function rules()
    {
        return [
            [Rules]
        ];
    }

    public function mount($id)
    {
        $model = [ModelName]::findOrFail($id);
        $this->editId = $id;

        [SetProperties]
    }

    public function save()
    {
        $data = $this->validate();

        [ModelName]::findOrFail($this->editId)->update($data);

        return $this->redirectRoute('[RoutePrefix].index', navigate: true);
    }

    public function render()
    {
        return view('[ViewPath]');
    }
}
