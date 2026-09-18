<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';
    public string $email = '';
    public string $username = '';
    public string $phone = '';
    public string $position = '';

    public function mount(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if ($user) {
            $this->name = (string) $user->name;
            $this->email = (string) $user->email;
            $this->username = (string) ($user->username ?? '');
            $this->phone = (string) ($user->phone ?? '');
            $this->position = (string) ($user->position ?? '');
        }
    }

    protected function rules(): array
    {
        $userId = Auth::id();

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'username' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:25',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
            'position' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function updateProfile(): void
    {
        $this->validate();

        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username ?: null,
            'phone' => $this->phone ?: null,
            'position' => $this->position ?: null,
        ]);

        $this->dispatch('toast', [
            'message' => __('vibe/settings.profile.saved_toast'),
            'type' => 'success',
            'title' => __('vibe/settings.profile.saved_title'),
        ]);
    }

    public function render()
    {
        return view('livewire.settings.profile');
    }
}
