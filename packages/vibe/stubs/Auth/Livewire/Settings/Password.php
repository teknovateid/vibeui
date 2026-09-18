<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Component;

class Password extends Component
{
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules(): array
    {
        return [
            'password' => ['required', 'string', PasswordRule::min(8), 'confirmed'],
        ];
    }

    public function updatePassword(): void
    {
        $this->validate();

        /** @var User|null $user */
        $user = Auth::user();

        if ($user) {
            $user->update([
                'password' => Hash::make($this->password),
            ]);
        }

        $this->reset(['password', 'password_confirmation']);

        $this->dispatch('toast', [
            'message' => __('vibe/settings.security.password_updated_toast') ?? 'Kata sandi akun Anda berhasil diperbarui.',
            'type' => 'success',
            'title' => __('vibe/settings.security.password_updated_title') ?? 'Kata Sandi Diperbarui',
        ]);
    }

    public function render()
    {
        return view('livewire.settings.password');
    }
}
