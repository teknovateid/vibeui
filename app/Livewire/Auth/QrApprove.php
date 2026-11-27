<?php

namespace App\Livewire\Auth;

use App\Livewire\Auth\Concerns\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Teknovate\VibeUi\Services\QrLogin\QrLoginService;

class QrApprove extends Component
{
    use AuthenticatesUsers;

    #[Locked]
    public string $token = '';

    #[Locked]
    public bool $valid = false;

    #[Locked]
    public bool $entryMode = false;

    public string $pairingCode = '';

    /** @var array<string, string> */
    #[Locked]
    public array $device = [];

    #[Locked]
    public ?int $expiresAt = null;

    public string $status = 'pending';

    public ?string $feedback = null;

    public ?string $broadcastWarning = null;

    public function mount(?string $token = null, ?QrLoginService $qrLogin = null): void
    {
        $qrLogin ??= app(QrLoginService::class);
        abort_unless($qrLogin->isEnabled(), 404);

        if ($token === null || $token === '') {
            $this->entryMode = true;
            $this->valid = false;
            $this->status = 'entry';

            return;
        }

        $this->loadTokenChallenge($token, $qrLogin);
    }

    protected function validationAttributes(): array
    {
        return [
            'pairingCode' => __('auth/qr_login.code_input_label'),
        ];
    }

    public function submitPairingCode(QrLoginService $qrLogin): void
    {
        $this->resetValidation();
        $this->feedback = null;

        $this->validate([
            'pairingCode' => ['required', 'string', 'min:8'],
        ]);

        $throttleKey = 'qr-code-lookup:' . (Auth::id() ?? 'guest') . '|' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 10)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('pairingCode', __('auth/qr_login.code_throttled', ['seconds' => $seconds]));

            return;
        }

        RateLimiter::hit($throttleKey, 60);

        $token = $qrLogin->findTokenByCode($this->pairingCode);
        if (! $token) {
            $this->addError('pairingCode', __('auth/qr_login.code_invalid'));

            return;
        }

        RateLimiter::clear($throttleKey);

        $user = Auth::user();
        if (! $user) {
            return;
        }

        $this->token = $token;
        $result = $qrLogin->approve($token, $user);

        $this->entryMode = false;
        $this->valid = false;
        $this->device = (array) ($result['device'] ?? []);

        if (! ($result['ok'] ?? false)) {
            $this->status = (string) ($result['reason'] ?? 'expired');
            $this->feedback = ($result['reason'] ?? '') === 'already_processed'
                ? __('auth/qr_login.already_processed')
                : __('auth/qr_login.approve_expired');

            return;
        }

        $this->status = 'approved';
        $this->feedback = __('auth/qr_login.approved_success');
        $this->broadcastWarning = ! empty($result['broadcast_error'])
            ? (string) $result['broadcast_error']
            : null;
    }

    public function resetToCodeEntry(): void
    {
        $this->token = '';
        $this->pairingCode = '';
        $this->valid = false;
        $this->entryMode = true;
        $this->status = 'entry';
        $this->feedback = null;
        $this->broadcastWarning = null;
        $this->device = [];
        $this->expiresAt = null;
        $this->resetValidation();
    }

    protected function loadTokenChallenge(string $token, QrLoginService $qrLogin): void
    {
        $this->token = $token;
        $challenge = $qrLogin->markScanned($token);

        if (! $challenge) {
            $this->valid = false;
            $this->status = 'expired';
            $this->feedback = __('auth/qr_login.approve_expired');

            return;
        }

        if (! in_array($challenge['status'] ?? '', ['pending', 'scanned'], true)) {
            $this->valid = false;
            $this->status = (string) ($challenge['status'] ?? 'already_processed');
            $this->feedback = __('auth/qr_login.already_processed');

            return;
        }

        $this->valid = true;
        $this->status = (string) $challenge['status'];
        $this->device = (array) ($challenge['device'] ?? []);
        $this->expiresAt = isset($challenge['expires_at']) ? (int) $challenge['expires_at'] : null;
    }

    public function approve(QrLoginService $qrLogin): void
    {
        $user = Auth::user();
        if (! $user || $this->token === '') {
            return;
        }

        $result = $qrLogin->approve($this->token, $user);

        if (! ($result['ok'] ?? false)) {
            $this->valid = false;
            $this->status = (string) ($result['reason'] ?? 'expired');
            $this->feedback = ($result['reason'] ?? '') === 'already_processed'
                ? __('auth/qr_login.already_processed')
                : __('auth/qr_login.approve_expired');

            return;
        }

        $this->valid = false;
        $this->status = 'approved';
        $this->device = (array) ($result['device'] ?? $this->device);
        $this->feedback = __('auth/qr_login.approved_success');
        $this->broadcastWarning = ! empty($result['broadcast_error'])
            ? (string) $result['broadcast_error']
            : null;
    }

    public function reject(QrLoginService $qrLogin): void
    {
        if ($this->token === '') {
            return;
        }

        $rejected = $qrLogin->reject($this->token);

        $this->valid = false;
        $this->status = $rejected ? 'rejected' : 'expired';
        $this->feedback = $rejected
            ? __('auth/qr_login.rejected_success')
            : __('auth/qr_login.approve_expired');
    }

    public function render()
    {
        /** @var mixed $view */
        $view = view('auth.qr-approve', [
            'currentUser' => Auth::user(),
        ]);

        $title = match (true) {
            $this->entryMode => __('auth/qr_login.code_entry_title'),
            $this->valid => __('auth/qr_login.approve_title'),
            $this->status === 'approved' => __('auth/qr_login.approved_title'),
            $this->status === 'rejected' => __('auth/qr_login.rejected_title'),
            default => __('auth/qr_login.unavailable_title'),
        };

        return $view->layout($this->resolveAuthLayout(), [
            'title' => $title,
            'hideHeader' => true,
        ]);
    }
}
