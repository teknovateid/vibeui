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
        if (! $this->ensurePasswordIsConfirmed()) {
            return;
        }

        $this->validate();

        /** @var User|null $user */
        $user = Auth::user();

        if ($user) {
            $user->update([
                'password' => Hash::make($this->password),
            ]);

            // One-Time Consume: hanguskan sesi konfirmasi setelah kata sandi berhasil diperbarui
            session()->forget([
                'auth.password_confirmed_at',
                'auth.confirmed_route',
                'auth.is_single_page_confirm',
                'auth.one_time_confirmed',
            ]);
        }

        $this->reset(['password', 'password_confirmation']);

        $this->dispatch('toast', [
            'message' => __('vibe/settings.security.password_updated_toast') ?? 'Kata sandi akun Anda berhasil diperbarui.',
            'type' => 'success',
            'title' => __('vibe/settings.security.password_updated_title') ?? 'Kata Sandi Diperbarui',
        ]);
    }

    /**
     * Memeriksa apakah kata sandi pengguna baru saja dikonfirmasi (sudo-mode).
     */
    protected function ensurePasswordIsConfirmed(): bool
    {
        $requireConfirmation = (bool) config(
            'vibe.auth.confirm_password_for_2fa',
            env('VIBE_CONFIRM_PASSWORD_FOR_2FA', true)
        );

        if (! $requireConfirmation) {
            return true;
        }

        $timeout = (int) config('vibe.auth.password_timeout', 300);
        $confirmedAt = session('auth.password_confirmed_at');
        $now = time();

        if (! $confirmedAt || ($now - (int) $confirmedAt) >= $timeout) {
            $targetRoute = \Illuminate\Support\Facades\Route::has('docs.settings.security')
                ? 'docs.settings.security'
                : (\Illuminate\Support\Facades\Route::has('settings.security') ? 'settings.security' : null);

            $fallback = $targetRoute ? route($targetRoute) : url('/');
            $intended = request()->header('referer') ?: $fallback;
            session()->put('url.intended', $intended);
            session()->put('auth.target_route', $targetRoute ?: $intended);

            $confirmUrl = \Illuminate\Support\Facades\Route::has('password.confirm')
                ? route('password.confirm')
                : url('/confirm-password');

            $this->redirect($confirmUrl, navigate: true);

            return false;
        }

        return true;
    }

    public function render()
    {
        return view('livewire.settings.password');
    }
}
