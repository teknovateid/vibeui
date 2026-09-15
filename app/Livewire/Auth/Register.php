<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Register extends Component
{
    use AuthenticatesUsers;
    public string $name = '';
    public string $email = '';
    public string $username = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'string', 'lowercase', 'alpha_dash', 'max:50', 'unique:users,username'],
            'phone' => ['required', 'string', 'max:20', 'unique:users,phone'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ];
    }

    /**
     * Custom validation attribute names.
     */
    protected function validationAttributes(): array
    {
        return [
            'name' => __('auth/fields.name'),
            'email' => __('auth/fields.email'),
            'username' => __('auth/fields.username'),
            'phone' => __('auth/fields.phone'),
            'password' => __('auth/fields.password'),
            'password_confirmation' => __('auth/fields.password_confirmation'),
        ];
    }

    /**
     * Handle user registration.
     */
    public function register()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => strtolower($validated['username']),
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended($this->redirectAfterLoginUrl());
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.register');

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth/titles.register'),
            'description' => __('auth/titles.register_description'),
        ]);
    }
}
