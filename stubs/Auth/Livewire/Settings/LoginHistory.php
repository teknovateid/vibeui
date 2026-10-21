<?php

namespace App\Livewire\Settings;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class LoginHistory extends Component
{
    public bool $confirmingLogout = false;
    public string $logoutMode = 'other'; // 'other', 'all', or 'single'
    public string $selectedSessionId = '';
    public string $selectedDeviceName = '';
    public string $password = '';

    public function confirmLogout(string $mode = 'other', string $sessionId = '', string $deviceName = ''): void
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->logoutMode = in_array($mode, ['other', 'all', 'single'], true) ? $mode : 'other';
        $this->selectedSessionId = $sessionId;
        $this->selectedDeviceName = $deviceName;
        $this->confirmingLogout = true;
    }

    public function executeLogout(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        if ($this->logoutMode === 'all') {
            $this->terminateAllSessions();
        } elseif ($this->logoutMode === 'single') {
            $this->terminateSingleSession();
        } else {
            $this->terminateOtherSessions();
        }
    }

    public function terminateSession(string $sessionId, ?string $password = null): void
    {
        $this->selectedSessionId = $sessionId;
        $this->logoutMode = 'single';

        if ($password !== null) {
            $this->password = $password;
            $this->executeLogout();
            return;
        }

        $this->confirmLogout('single', $sessionId);
    }

    public function terminateSingleSession(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $sessionId = $this->selectedSessionId;
        $currentSessionId = $this->getCurrentSessionId();

        if ($sessionId === $currentSessionId) {
            DB::table('sessions')
                ->where('user_id', Auth::id())
                ->where('id', $sessionId)
                ->delete();

            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            $this->redirect(route('login'), navigate: true);
            return;
        }

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', $sessionId)
            ->delete();

        $this->confirmingLogout = false;
        $this->password = '';
        $this->selectedSessionId = '';

        $deviceName = $this->selectedDeviceName ?: 'perangkat';

        $this->dispatch('toast', [
            'message' => __('vibe/settings.login_history.terminated_single_toast', ['device' => $deviceName]) ?: 'Sesi perangkat telah berhasil diakhiri.',
            'type' => 'success',
            'title' => __('vibe/settings.login_history.terminated_single_title') ?: 'Sesi Diakhiri',
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
        $this->selectedSessionId = '';

        $this->dispatch('toast', [
            'message' => __('vibe/settings.login_history.terminated_all_toast') ?: 'Semua sesi lain berhasil diakhiri.',
            'type' => 'success',
            'title' => __('vibe/settings.login_history.terminated_all_title') ?: 'Sesi Diakhiri',
        ]);
    }

    public function terminateAllSessions(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->delete();

        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirect(route('login'), navigate: true);
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

                $isOnline = (time() - (int) $session->last_activity) < 300;

                return (object) [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address ?: '127.0.0.1',
                    'is_current' => $session->id === $currentSessionId,
                    'is_online' => $isOnline,
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
        $agent = new Agent();
        $agent->setUserAgent($userAgent);

        $platform = $agent->platform() ?: 'Sistem Tidak Diketahui';
        if ($platform === 'OS X') {
            $platform = 'macOS';
        }

        $browser = $agent->browser() ?: 'Web Browser';
        $browserVersion = $agent->version($browser);
        if ($browserVersion) {
            $majorVersion = explode('.', (string) $browserVersion)[0] ?? null;
            if ($majorVersion) {
                $browser .= ' ' . $majorVersion;
            }
        }

        $device = 'Perangkat Tidak Diketahui';
        if ($agent->isDesktop()) {
            $device = ($platform === 'macOS') ? 'Mac' : ($platform ? $platform . ' PC' : 'Komputer Desktop');
        } elseif ($agent->isTablet()) {
            $deviceName = $agent->device();
            $device = ($deviceName && $deviceName !== 'WebKit') ? $deviceName : 'Tablet';
        } elseif ($agent->isPhone() || $agent->isMobile()) {
            $deviceName = $agent->device();
            $device = ($deviceName && $deviceName !== 'WebKit') ? $deviceName : 'Smartphone';
        } else {
            $deviceName = $agent->device();
            $device = ($deviceName && $deviceName !== 'WebKit') ? $deviceName : 'Perangkat';
        }

        $icon = 'laptop';
        if ($agent->isTablet()) {
            $icon = 'tablet';
        } elseif ($agent->isPhone() || $agent->isMobile()) {
            $icon = 'smartphone';
        } elseif ($agent->isDesktop()) {
            $icon = 'laptop';
        } else {
            $icon = 'monitor';
        }

        return [
            'device' => $device,
            'browser' => $browser,
            'os' => $platform,
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
