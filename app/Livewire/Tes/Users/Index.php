<?php

namespace App\Livewire\Tes\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

#[Title('Tes Users')]
#[Layout('components.tes.layouts.sidebar')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $editId = null;

    public $name;
    public $email;
    public $phone;
    public $username;
    public $position;
    

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'position' => 'required',
            
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset('name', 'email', 'phone', 'username', 'position');
        $this->editId = null;
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $model = User::findOrFail($id);
        $this->editId = $id;

        $this->name = $model->name;
        $this->email = $model->email;
        $this->phone = $model->phone;
        $this->username = $model->username;
        $this->position = $model->position;
        

        $this->isOpen = true;
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->editId) {
            User::findOrFail($this->editId)->update($data);
        } else {
            User::create($data);
        }

        $this->isOpen = false;
        $this->reset('name', 'email', 'phone', 'username', 'position');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }

    public function render()
    {
        $items = User::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.tes.users.index', compact('items'));
    }
}
