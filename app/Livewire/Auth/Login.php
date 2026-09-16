<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    use AuthenticatesUsers;

    public string $login = '';
    public string $password = '';
    public bool $remember = false;

    /**
     * Define dynamic validation rules based on configured login mode.
     */
    protected function rules(): array
    {
        $loginRules = $this->isOnlyEmail()
            ? ['required', 'string', 'email']
            : ['required', 'string'];

        return [
            'login' => $loginRules,
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Define custom attribute names for validation.
     */
    protected function validationAttributes(): array
    {
        return [
            'login' => $this->getLoginLabel(),
            'password' => __('auth/fields.password'),
        ];
    }

    /**
     * Handle authentication attempt.
     */
    public function authenticate()
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $credentials = $this->resolveCredentials($this->login, $this->password);

        if (! Auth::attempt($credentials, $this->remember)) {
            RateLimiter::hit($this->throttleKey($this->login));

            throw ValidationException::withMessages([
                'login' => trans('auth/errors.failed'),
            ]);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if ($user && method_exists($user, 'hasTwoFactorEnabled') && $user->hasTwoFactorEnabled()) {
            RateLimiter::clear($this->throttleKey($this->login));

            session()->put('auth.2fa.user_id', $user->getAuthIdentifier());
            session()->put('auth.2fa.remember', $this->remember);

            return redirect()->route('two-factor.challenge');
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey($this->login));

        session()->regenerate();

        return redirect()->intended($this->redirectAfterLoginUrl());
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        $key = $this->throttleKey($this->login);

        if (! RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'login' => trans('auth/errors.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Handle passkey authentication error and flash to session.
     */
    public function handlePasskeyError(string $message, bool $isIpAddress = false, ?string $localhostUrl = null): void
    {
        if ($isIpAddress) {
            session()->flash('warning', $message);
            if ($localhostUrl) {
                session()->flash('localhost_url', $localhostUrl);
            }
        } else {
            session()->flash('error', $message);
        }
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.login', [
            'loginLabel' => $this->getLoginLabel(),
            'loginPlaceholder' => $this->getLoginPlaceholder(),
        ]);

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth/titles.login'),
            'description' => __('auth/titles.login_description'),
        ]);
    }
}
