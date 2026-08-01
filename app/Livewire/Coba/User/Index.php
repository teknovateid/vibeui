<?php

namespace App\Livewire\Coba\User;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

#[Title('Coba User')]
#[Layout('components.coba.layouts.sidebar')]
class Index extends Component
{
    use WithPagination;


    public $search = '';
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
        $this->dispatch('open-sheet', 'create-sheet');
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
        

        $this->dispatch('open-sheet', 'edit-sheet');
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->editId) {
            User::findOrFail($this->editId)->update($data);
            $this->dispatch('close-sheet', 'edit-sheet');
        } else {
            User::create($data);
            $this->dispatch('close-sheet', 'create-sheet');
        }

        $this->reset('name', 'email', 'phone', 'username', 'position');

        $this->dispatch('toast', [
            'type' => 'success', 
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->dispatch('toast', [
            'type' => 'success', 
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function render()
    {
        $items = User::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.coba.user.index', compact('items'));
    }
}
