<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ConfirmPassword extends Component
{
    use AuthenticatesUsers;

    public string $password = '';

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Validation attributes.
     */
    protected function validationAttributes(): array
    {
        return [
            'password' => __('auth/fields.password'),
        ];
    }

    /**
     * Confirm user password.
     */
    public function confirmPassword()
    {
        $this->validate();

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()?->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth/errors.password'),
            ]);
        }

        session()->put('auth.password_confirmed_at', time());
        session()->forget('auth.session_locked');
        session()->put('auth.last_activity_time', time());

        $targetRoute = session()->pull('auth.target_route') ?: session('url.intended');
        if ($targetRoute) {
            session()->put('auth.confirmed_route', $targetRoute);
            session()->put('auth.is_single_page_confirm', true);
        }

        return redirect()->intended($this->redirectAfterLoginUrl());
    }

    /**
     * Log out the current user session.
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.confirm-password');

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth/titles.confirm_password'),
            'description' => __('auth/titles.confirm_password_description'),
        ]);
    }
}
