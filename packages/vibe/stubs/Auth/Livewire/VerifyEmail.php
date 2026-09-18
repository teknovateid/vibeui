<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmail extends Component
{
    use AuthenticatesUsers;

    /**
     * Mount component and check if email is already verified.
     */
    public function mount()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && method_exists($user, 'hasVerifiedEmail') && $user->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectAfterLoginUrl());
        }
    }

    /**
     * Resend verification email notification.
     */
    public function sendVerification()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user && method_exists($user, 'hasVerifiedEmail') && $user->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectAfterLoginUrl());
        }

        $throttleKey = 'verify-email|' . ($user?->id ?? request()->ip());

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            session()->flash('status', 'throttle:' . ceil($seconds / 60));

            return;
        }

        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 600);

        if ($user && method_exists($user, 'sendEmailVerificationNotification')) {
            $user->sendEmailVerificationNotification();
        }

        session()->flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        $this->invalidateAuthSession();

        return redirect()->route('login');
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.verify-email');

        return $view->layout($this->resolveAuthLayout(), [
            'title' => __('auth/titles.verify_email'),
            'description' => __('auth/titles.verify_email_description'),
        ]);
    }
}
