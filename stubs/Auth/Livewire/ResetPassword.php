<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ResetPassword extends Component
{
    use AuthenticatesUsers;
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token)
    {
        $this->token = $token;
        $this->email = (string) request()->query('email', '');
    }

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', PasswordRule::defaults(), 'confirmed'],
        ];
    }

    /**
     * Validation attributes.
     */
    protected function validationAttributes(): array
    {
        return [
            'email' => __('auth/fields.email'),
            'password' => __('auth/fields.new_password'),
            'password_confirmation' => __('auth/fields.confirm_new_password'),
        ];
    }

    /**
     * Execute password reset.
     */
    public function resetPassword()
    {
        $this->validate();

        $credentials = [
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];

        $status = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', trans($status));

            return redirect()->route('login');
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.reset-password');

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth/titles.reset_password'),
            'description' => __('auth/titles.reset_password_description'),
        ]);
    }
}
