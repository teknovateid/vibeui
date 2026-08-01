<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

#[Title('Dashboard User')]
#[Layout('components.dashboard.layouts.sidebar')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $editId = null;

    public $name;
    public $username;
    public $phone;
    public $email;
    

    protected function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->reset('name', 'username', 'phone', 'email');
        $this->editId = null;
        $this->dispatch('open-sheet', 'create-user-sheet');
    }

    public function edit($id)
    {
        $model = User::findOrFail($id);
        $this->editId = $id;

        $this->name = $model->name;
        $this->username = $model->username;
        $this->phone = $model->phone;
        $this->email = $model->email;

        $this->dispatch('open-sheet', 'edit-user-sheet');
    }


    public function save()
    {
        $throttleKey = 'save-user:' . session()->getId();
        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            $this->dispatch('toast', [
                'type' => 'warning', 
                'message' => 'Tunggu sebentar sebelum menyimpan lagi.', 
            ]);
            return;
        }
        RateLimiter::hit($throttleKey, 3); // Kunci selama 3 detik

        $data = $this->validate();

        if ($this->editId) {
            User::findOrFail($this->editId)->update($data);
            // $this->dispatch('close-sheet', 'edit-user-sheet');
        } else {
            User::create($data);
            $this->reset('name', 'username', 'phone', 'email');
            $this->dispatch('close-sheet', 'create-user-sheet');
        }

        $this->dispatch('toast', [
            'type' => 'success', 
            'message' => 'Data user berhasil disimpan!', 
            'sound' => asset('vibe/sounds/mixkit-software-interface-remove-2576.wav')
        ]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->dispatch('toast', [
            'type' => 'success', 
            'message' => 'Data user berhasil dihapus!',
        ]);
    }

    public function render()
    {
        $items = User::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.dashboard.user.index', compact('items'));
    }
}
