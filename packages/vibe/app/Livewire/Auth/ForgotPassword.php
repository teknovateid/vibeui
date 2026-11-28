<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ForgotPassword extends Component
{
    use AuthenticatesUsers;
    public string $email = '';
    public ?string $status = null;

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
        ];
    }

    /**
     * Validation attributes.
     */
    protected function validationAttributes(): array
    {
        return [
            'email' => __('auth/fields.email'),
        ];
    }

    /**
     * Send password reset link email.
     */
    public function sendResetLink()
    {
        $this->ensureIsNotRateLimited();

        $this->validate();

        $throttleKey = 'forgot-password|' . request()->ip();
        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 900);

        $status = Password::sendResetLink(['email' => $this->email]);

        // Cegah User Enumeration: berikan respon generik sukses baik email terdaftar maupun tidak
        if ($status === Password::RESET_LINK_SENT || $status === Password::INVALID_USER) {
            $this->status = trans(Password::RESET_LINK_SENT);
            $this->reset('email');

            return;
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /**
     * Pastikan permintaan reset password tidak melebihi batas percobaan.
     */
    protected function ensureIsNotRateLimited(): void
    {
        $key = 'forgot-password|' . request()->ip();

        if (! \Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'email' => trans('auth/errors.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.forgot-password');

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth/titles.forgot_password'),
            'description' => __('auth/titles.forgot_password_description'),
        ]);
    }
}
