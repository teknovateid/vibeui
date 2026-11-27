<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Teknovate\VibeUi\Services\QrLogin\QrLoginService;

class Login extends Component
{
    use AuthenticatesUsers;

    public string $login = '';
    public string $password = '';
    public bool $remember = false;

    public bool $qrMode = false;

    #[Locked]
    public ?string $qrToken = null;

    #[Locked]
    public ?string $qrCode = null;

    #[Locked]
    public ?string $qrApproveUrl = null;

    #[Locked]
    public ?int $qrExpiresAt = null;

    #[Locked]
    public ?string $qrExchangeCode = null;

    #[Locked]
    public int $qrTtl = 120;

    #[Locked]
    public bool $qrAutoRefresh = true;

    #[Locked]
    public int $qrMaxAutoRefresh = 0;

    #[Locked]
    public ?string $qrDriver = null;

    /** @var array<string, mixed> */
    #[Locked]
    public array $qrClientConfig = [];

    public string $qrStatus = 'idle';

    public ?string $qrError = null;

    /**
     * Automatically enter QR login mode when requested via ?method=qrcode.
     */
    public function mount(QrLoginService $qrLogin): void
    {
        $method = strtolower(trim((string) request()->query('method', '')));

        if (in_array($method, ['qrcode', 'qr'], true) && $qrLogin->isEnabled()) {
            $this->startQrLogin($qrLogin);
        }
    }

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

        $user = Auth::user();
        RateLimiter::clear($this->throttleKey($this->login));

        if (! $user) {
            throw ValidationException::withMessages([
                'login' => trans('auth/errors.failed'),
            ]);
        }

        return $this->completeAuthenticatedLogin($user, $this->remember);
    }

    /**
     * Enter QR login mode and resume any active session challenge (or create a fresh one).
     */
    public function startQrLogin(QrLoginService $qrLogin, bool $forceNew = false): void
    {
        if (! $qrLogin->isEnabled()) {
            return;
        }

        $this->qrMode = true;
        $this->qrError = null;

        try {
            $challenge = $forceNew
                ? $qrLogin->createChallenge(request())
                : $qrLogin->resumeOrCreateChallenge(request());
        } catch (\Throwable $e) {
            $this->qrStatus = 'error';
            $this->qrError = $e->getMessage();
            $this->qrToken = null;
            $this->qrCode = null;
            $this->qrApproveUrl = null;
            $this->qrClientConfig = [];

            return;
        }

        $this->qrDriver = (string) ($challenge['driver'] ?? 'pusher');
        $this->qrClientConfig = (array) ($challenge['client'] ?? []);

        if (($this->qrClientConfig['configured'] ?? true) === false) {
            $this->qrStatus = 'unconfigured';
            $this->qrToken = null;
            $this->qrCode = null;
            $this->qrApproveUrl = null;
            $this->qrExpiresAt = null;
            $this->qrError = __('auth/qr_login.not_configured', ['driver' => $this->qrDriver]);
            $this->dispatch('vibe-qr-login-stopped');

            return;
        }

        $this->qrToken = (string) $challenge['token'];
        $this->qrCode = (string) ($challenge['code'] ?? '');
        $this->qrApproveUrl = (string) $challenge['approve_url'];
        $this->qrExpiresAt = (int) $challenge['expires_at'];
        $this->qrExchangeCode = isset($challenge['exchange_code']) ? (string) $challenge['exchange_code'] : null;
        $this->qrTtl = (int) $challenge['ttl'];
        $this->qrAutoRefresh = (bool) ($challenge['auto_refresh'] ?? true);
        $this->qrMaxAutoRefresh = (int) ($challenge['max_auto_refresh'] ?? 0);
        $this->qrStatus = (string) ($challenge['status'] ?? 'pending');

        $this->dispatch(
            'vibe-qr-login-started',
            token: $this->qrToken,
            expiresAt: $this->qrExpiresAt,
            status: $this->qrStatus,
            exchangeCode: $this->qrExchangeCode,
            autoRefresh: $this->qrAutoRefresh,
            maxAutoRefresh: $this->qrMaxAutoRefresh,
            config: $this->qrClientConfig,
        );
    }

    /**
     * Force-generate a brand-new QR challenge (explicit refresh or auto-refresh on expiry).
     */
    public function refreshQrLogin(QrLoginService $qrLogin): void
    {
        $this->startQrLogin($qrLogin, forceNew: true);
    }

    /**
     * Exit QR login mode and return to standard credentials form.
     */
    public function cancelQrLogin(): void
    {
        $this->qrMode = false;
        $this->qrStatus = 'idle';
        $this->qrToken = null;
        $this->qrCode = null;
        $this->qrApproveUrl = null;
        $this->qrExpiresAt = null;
        $this->qrExchangeCode = null;
        $this->qrDriver = null;
        $this->qrClientConfig = [];
        $this->qrError = null;

        $this->dispatch('vibe-qr-login-stopped');
    }

    /**
     * Complete login after Device B approves the QR challenge.
     */
    public function completeQrLogin(string $token, string $exchangeCode, QrLoginService $qrLogin)
    {
        if (! $qrLogin->isEnabled()) {
            return null;
        }

        $result = $qrLogin->complete($token, $exchangeCode, request());

        if (! ($result['ok'] ?? false) || empty($result['user'])) {
            $reason = $result['reason'] ?? 'error';

            if ($reason === 'expired' && $qrLogin->autoRefreshEnabled()) {
                $this->startQrLogin($qrLogin, forceNew: true);

                return null;
            }

            $this->qrStatus = $reason === 'expired' ? 'expired' : 'error';
            $this->qrError = match ($reason) {
                'expired' => __('auth/qr_login.status_expired'),
                'invalid_session' => __('auth/qr_login.invalid_session'),
                default => __('auth/qr_login.complete_failed'),
            };

            return null;
        }

        return $this->completeAuthenticatedLogin(
            $result['user'],
            $this->remember,
            $qrLogin->shouldBypassTwoFactor(),
        );
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
            'title' => $this->qrMode ? __('auth/qr_login.panel_title') : __('auth/titles.login'),
            'hideHeader' => true,
        ]);
    }
}
