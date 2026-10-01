<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
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

        $this->ensureIsNotRateLimited();
        $throttleKey = Str::transliterate('confirm-password|' . (Auth::id() ?? 'guest') . '|' . request()->ip());

        $user = Auth::user();

        if (! $user || ! Hash::check($this->password, $user->getAuthPassword())) {
            RateLimiter::hit($throttleKey, 300);

            throw ValidationException::withMessages([
                'password' => __('auth/errors.password'),
            ]);
        }

        RateLimiter::clear($throttleKey);

        session()->put('auth.password_confirmed_at', time());
        session()->forget('auth.session_locked');
        session()->put('auth.last_activity_time', time());

        $isSinglePage = (bool) session('auth.is_single_page_confirm', false);
        $rawTarget = session()->pull('auth.target_route') ?: session('url.intended');
        $fallback = $this->redirectAfterLoginUrl();

        if ($rawTarget && is_string($rawTarget)) {
            $rawTarget = trim($rawTarget);
            $appHost = parse_url(config('app.url'), PHP_URL_HOST);
            $requestHost = request()->getHost();
            $targetHost = parse_url($rawTarget, PHP_URL_HOST);

            $isRouteName = \Illuminate\Support\Facades\Route::has($rawTarget);
            $isSafe = $isRouteName
                || (str_starts_with($rawTarget, '/') && ! str_starts_with($rawTarget, '//'))
                || (! str_contains($rawTarget, '://') && ! str_starts_with($rawTarget, '//'))
                || ($targetHost && in_array($targetHost, array_filter([$appHost, $requestHost, 'localhost', '127.0.0.1']), true));

            $destination = $isSafe ? $rawTarget : $fallback;
            $destinationUrl = $destination;
            if ($isRouteName) {
                try {
                    $destinationUrl = route($destination);
                } catch (\Throwable $e) {
                    $destinationUrl = (! str_contains($destination, '://') && ! str_starts_with($destination, '//'))
                        ? '/' . ltrim($destination, '/')
                        : $fallback;
                }
            } elseif (! str_contains($destinationUrl, '://') && ! str_starts_with($destinationUrl, '//')) {
                $destinationUrl = '/' . ltrim($destinationUrl, '/');
            }

            if ($isSinglePage) {
                // Simpan URL path (bukan route name) agar middleware dapat me-match ulang
                // rute berparameter seperti /users/update/42 setelah konfirmasi.
                $confirmedIdentifier = parse_url($destinationUrl, PHP_URL_PATH) ?: $destinationUrl;
                $confirmedIdentifier = trim($confirmedIdentifier, '/');
                session()->put('auth.confirmed_route', $confirmedIdentifier);
                session()->put('auth.is_single_page_confirm', true);
            } else {
                session()->forget('auth.confirmed_route');
                session()->forget('auth.is_single_page_confirm');
            }

            session()->put('url.intended', $destinationUrl);
        }

        return redirect()->intended($this->redirectAfterLoginUrl());
    }

    /**
     * Pastikan request konfirmasi tidak terkena rate limit.
     */
    protected function ensureIsNotRateLimited(): void
    {
        $key = Str::transliterate('confirm-password|' . (Auth::id() ?? 'guest') . '|' . request()->ip());

        if (! RateLimiter::tooManyAttempts($key, 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'password' => trans('auth/errors.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Log out the current user session.
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        $this->invalidateAuthSession();

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
