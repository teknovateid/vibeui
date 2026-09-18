<?php

namespace App\Livewire\Settings;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LoginHistory extends Component
{
    public bool $confirmingLogout = false;
    public string $password = '';

    public function confirmLogout(): void
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->confirmingLogout = true;
    }

    public function terminateSession(string $sessionId): void
    {
        $currentSessionId = $this->getCurrentSessionId();

        if ($sessionId === $currentSessionId) {
            return;
        }

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', $sessionId)
            ->delete();

        $this->dispatch('toast', [
            'message' => 'Sesi perangkat telah berhasil diakhiri.',
            'type' => 'success',
            'title' => __('vibe/settings.login_history.terminated_single_title') ?? 'Sesi Diakhiri',
        ]);
    }

    public function terminateOtherSessions(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        Auth::logoutOtherDevices($this->password);

        $currentSessionId = $this->getCurrentSessionId();

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', '!=', $currentSessionId)
            ->delete();

        $this->confirmingLogout = false;
        $this->password = '';

        $this->dispatch('toast', [
            'message' => __('vibe/settings.login_history.terminated_all_toast') ?? 'Semua sesi lain berhasil diakhiri.',
            'type' => 'success',
            'title' => __('vibe/settings.login_history.terminated_all_title') ?? 'Sesi Diakhiri',
        ]);
    }

    protected function getCurrentSessionId(): string
    {
        if (request()->hasSession()) {
            return request()->session()->getId();
        }

        try {
            if (session()->isStarted()) {
                return session()->getId();
            }
        } catch (\Throwable) {
            // Ignored
        }

        return '';
    }

    public function getSessionsProperty(): Collection
    {
        if (! Auth::check()) {
            return collect();
        }

        $currentSessionId = $this->getCurrentSessionId();

        return DB::table('sessions')
            ->where('user_id', Auth::id())
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($session) use ($currentSessionId) {
                $agent = $this->parseUserAgent($session->user_agent ?? '');

                return (object) [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address ?: '127.0.0.1',
                    'is_current' => $session->id === $currentSessionId,
                    'device' => $agent['device'],
                    'browser' => $agent['browser'],
                    'os' => $agent['os'],
                    'icon' => $agent['icon'],
                    'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                ];
            });
    }

    protected function parseUserAgent(string $userAgent): array
    {
        $os = 'Sistem Tidak Diketahui';
        $icon = 'monitor';
        $device = 'Perangkat Komputer';

        // Detect OS
        if (preg_match('/windows nt 10/i', $userAgent)) {
            $os = 'Windows 10/11';
            $device = 'Windows PC';
        } elseif (preg_match('/windows/i', $userAgent)) {
            $os = 'Windows';
            $device = 'Windows PC';
        } elseif (preg_match('/iphone/i', $userAgent)) {
            $os = 'iOS';
            $device = 'iPhone';
            $icon = 'smartphone';
        } elseif (preg_match('/ipad/i', $userAgent)) {
            $os = 'iPadOS';
            $device = 'iPad';
            $icon = 'smartphone';
        } elseif (preg_match('/android/i', $userAgent)) {
            $os = 'Android';
            $device = 'Android Device';
            $icon = 'smartphone';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $os = 'macOS';
            $device = 'Mac';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $os = 'Linux';
            $device = 'Linux Desktop';
        }

        // Detect Browser
        $browser = 'Web Browser';
        if (preg_match('/edg/i', $userAgent)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/chrome|crios/i', $userAgent)) {
            $browser = 'Google Chrome';
        } elseif (preg_match('/firefox|fxios/i', $userAgent)) {
            $browser = 'Mozilla Firefox';
        } elseif (preg_match('/safari/i', $userAgent)) {
            $browser = 'Apple Safari';
        } elseif (preg_match('/opera|opr/i', $userAgent)) {
            $browser = 'Opera';
        }

        return [
            'device' => $device,
            'browser' => $browser,
            'os' => $os,
            'icon' => $icon,
        ];
    }

    public function render()
    {
        return view('livewire.settings.login-history', [
            'sessions' => $this->sessions,
        ]);
    }
}
