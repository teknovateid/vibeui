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
            'email' => __('auth.fields.email'),
        ];
    }

    /**
     * Send password reset link email.
     */
    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = trans($status);
            $this->reset('email');

            return;
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.forgot-password');

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth.titles.forgot_password'),
            'description' => __('auth.titles.forgot_password_description'),
        ]);
    }
}
