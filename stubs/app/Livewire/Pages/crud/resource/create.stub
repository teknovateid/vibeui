<?php

namespace [Namespace];

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use [ModelNamespace];

#[Title('[Title]')]
#[Layout('[Layout]')]
class Create extends Component
{
    [Properties]

    protected function rules()
    {
        return [
            [Rules]
        ];
    }

    public function save()
    {
        $data = $this->validate();

        [ModelName]::create($data);

        return $this->redirectRoute('[RoutePrefix].index', navigate: true);
    }

    public function render()
    {
        return view('[ViewPath]');
    }
}
