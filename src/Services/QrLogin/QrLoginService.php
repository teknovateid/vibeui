<?php

namespace Teknovate\VibeUi\Services\QrLogin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Throwable;

class QrLoginService
{
    public const EVENT_NAME = 'qr-login.status';

    /**
     * Unambiguous character set for manual pairing codes (excludes 0/O/1/I/L).
     */
    protected const PAIRING_ALPHABET = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';

    public function __construct(
        protected QrLoginManager $manager,
    ) {}

    public function isEnabled(): bool
    {
        return (bool) config('vibe.auth.qr_login.enabled', true);
    }

    public function ttlSeconds(): int
    {
        return max(10, (int) config('vibe.auth.qr_login.ttl', 120));
    }

    public function autoRefreshEnabled(): bool
    {
        return (bool) config('vibe.auth.qr_login.auto_refresh', true);
    }

    public function maxAutoRefresh(): int
    {
        return max(0, (int) config('vibe.auth.qr_login.max_auto_refresh', 0));
    }

    public function shouldBypassTwoFactor(): bool
    {
        return (bool) config('vibe.auth.qr_login.bypass_two_factor', false);
    }

    /**
     * Create a new QR + pairing-code login challenge bound to Device A's session.
     *
     * @return array<string, mixed>
     */
    public function createChallenge(Request $request): array
    {
        $token = Str::random(40);
        $tokenHash = $this->tokenHash($token);
        $rawCode = $this->generateUniquePairingCode();
        $formattedCode = $this->formatPairingCode($rawCode);
        $codeHash = $this->tokenHash($rawCode);
        $deviceSecret = Str::random(64);
        $channel = $this->channelName($token);
        $ttl = $this->ttlSeconds();
        $expiresAt = now()->addSeconds($ttl);

        $this->rememberDeviceSecret($request, $tokenHash, $deviceSecret);
        $this->rememberActiveToken($request, $token);

        $payload = [
            'status' => 'pending',
            'channel' => $channel,
            'code' => $formattedCode,
            'code_hash' => $codeHash,
            'device_secret_hash' => hash('sha256', $deviceSecret),
            'device' => $this->deviceDetails($request),
            'approved_user_id' => null,
            'exchange_code_hash' => null,
            'encrypted_exchange_code' => null,
            'created_at' => now()->timestamp,
            'expires_at' => $expiresAt->timestamp,
        ];

        $this->cache()->put($this->challengeKey($tokenHash), $payload, $expiresAt);
        $this->cache()->put($this->codeKey($codeHash), $token, $expiresAt);

        return $this->buildChallengeResponse($token, $payload);
    }

    /**
     * Resume an existing active challenge for Device A on page refresh, or issue a new one.
     *
     * @return array<string, mixed>
     */
    public function resumeOrCreateChallenge(Request $request): array
    {
        $activeToken = $this->getActiveToken($request);

        if (is_string($activeToken) && $activeToken !== '') {
            $tokenHash = $this->tokenHash($activeToken);
            $sessionSecret = $this->getDeviceSecret($request, $tokenHash);
            $data = $this->inspectChallenge($activeToken);

            if (
                is_array($data)
                && ! empty($data['code'])
                && is_string($sessionSecret)
                && $sessionSecret !== ''
                && hash_equals((string) ($data['device_secret_hash'] ?? ''), hash('sha256', $sessionSecret))
                && in_array($data['status'] ?? '', ['pending', 'scanned', 'approved'], true)
            ) {
                $response = $this->buildChallengeResponse($activeToken, $data);

                if (($data['status'] ?? '') === 'approved' && ! empty($data['encrypted_exchange_code'])) {
                    try {
                        $response['exchange_code'] = Crypt::decryptString($data['encrypted_exchange_code']);
                    } catch (Throwable) {
                        return $this->createChallenge($request);
                    }
                }

                return $response;
            }
        }

        return $this->createChallenge($request);
    }

    /**
     * Build the standardized payload exposed to Device A's Livewire component.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function buildChallengeResponse(string $token, array $data): array
    {
        $driver = $this->manager->driver();
        $channel = (string) ($data['channel'] ?? $this->channelName($token));
        $approveUrl = Route::has('qr-login.approve')
            ? route('qr-login.approve', ['token' => $token])
            : url('/qr-login/approve/' . $token);
        $statusUrl = Route::has('qr-login.status')
            ? route('qr-login.status', ['token' => $token])
            : url('/login/qr/status/' . $token);
        $expiresAt = (int) ($data['expires_at'] ?? now()->timestamp);
        $remainingTtl = max(1, $expiresAt - now()->timestamp);

        return [
            'token' => $token,
            'code' => (string) ($data['code'] ?? ''),
            'status' => (string) ($data['status'] ?? 'pending'),
            'approve_url' => $approveUrl,
            'expires_at' => $expiresAt,
            'ttl' => $remainingTtl,
            'auto_refresh' => $this->autoRefreshEnabled(),
            'max_auto_refresh' => $this->maxAutoRefresh(),
            'driver' => $driver->name(),
            'device' => (array) ($data['device'] ?? []),
            'client' => $driver->clientConfig($channel, self::EVENT_NAME, $statusUrl),
        ];
    }

    /**
     * Resolve an active QR challenge token from a user-entered pairing code.
     */
    public function findTokenByCode(string $code): ?string
    {
        $normalized = $this->normalizePairingCode($code);
        if (strlen($normalized) !== 8) {
            return null;
        }

        $codeHash = $this->tokenHash($normalized);
        $token = $this->cache()->get($this->codeKey($codeHash));

        if (! is_string($token) || $token === '') {
            return null;
        }

        if (! $this->inspectChallenge($token)) {
            $this->cache()->forget($this->codeKey($codeHash));

            return null;
        }

        return $token;
    }

    /**
     * Inspect an active challenge without mutating its state.
     *
     * @return array<string, mixed>|null
     */
    public function inspectChallenge(string $token): ?array
    {
        $tokenHash = $this->tokenHash($token);
        $data = $this->cache()->get($this->challengeKey($tokenHash));

        if (! is_array($data) || $this->isExpired($data)) {
            $this->cache()->forget($this->challengeKey($tokenHash));

            return null;
        }

        return $data;
    }

    /**
     * Transition a pending challenge to scanned when Device B opens the approval screen.
     *
     * @return array<string, mixed>|null
     */
    public function markScanned(string $token): ?array
    {
        $tokenHash = $this->tokenHash($token);

        return $this->withLock($tokenHash, function () use ($tokenHash): ?array {
            $data = $this->cache()->get($this->challengeKey($tokenHash));
            if (! is_array($data) || $this->isExpired($data)) {
                $this->cache()->forget($this->challengeKey($tokenHash));

                return null;
            }

            if ($data['status'] === 'pending') {
                $data['status'] = 'scanned';
                $this->putWithRemainingTtl($tokenHash, $data);
                $this->safeBroadcast($data['channel'], [
                    'status' => 'scanned',
                ]);
            }

            return $data;
        });
    }

    /**
     * Approve the challenge from an authenticated Device B and push exchange code to Device A.
     *
     * @return array<string, mixed>
     */
    public function approve(string $token, Authenticatable $user): array
    {
        $tokenHash = $this->tokenHash($token);

        return $this->withLock($tokenHash, function () use ($tokenHash, $user): array {
            $key = $this->challengeKey($tokenHash);
            $data = $this->cache()->get($key);

            if (! is_array($data) || $this->isExpired($data)) {
                $this->cache()->forget($key);

                return ['ok' => false, 'reason' => 'expired'];
            }

            if (! in_array($data['status'] ?? '', ['pending', 'scanned'], true)) {
                return ['ok' => false, 'reason' => 'already_processed'];
            }

            $exchangeCode = Str::random(64);
            $data['status'] = 'approved';
            $data['approved_user_id'] = $user->getAuthIdentifier();
            $data['exchange_code_hash'] = hash('sha256', $exchangeCode);
            $data['encrypted_exchange_code'] = Crypt::encryptString($exchangeCode);

            $this->putWithRemainingTtl($tokenHash, $data);
            $this->forgetCodeLookup($data);

            $broadcastError = $this->safeBroadcast($data['channel'], [
                'status' => 'approved',
                'exchange_code' => $exchangeCode,
            ]);

            return [
                'ok' => true,
                'exchange_code' => $exchangeCode,
                'broadcast_error' => $broadcastError,
                'device' => (array) ($data['device'] ?? []),
            ];
        });
    }

    /**
     * Reject the challenge from Device B.
     */
    public function reject(string $token): bool
    {
        $tokenHash = $this->tokenHash($token);

        return (bool) $this->withLock($tokenHash, function () use ($tokenHash): bool {
            $key = $this->challengeKey($tokenHash);
            $data = $this->cache()->get($key);

            if (! is_array($data) || $this->isExpired($data)) {
                $this->cache()->forget($key);

                return false;
            }

            if (! in_array($data['status'] ?? '', ['pending', 'scanned'], true)) {
                return false;
            }

            $this->forgetCodeLookup($data);

            $data['status'] = 'rejected';
            $data['approved_user_id'] = null;
            $data['exchange_code_hash'] = null;
            $data['encrypted_exchange_code'] = null;

            // Keep briefly so polling clients can observe 'rejected' before cleanup.
            $this->cache()->put($key, $data, now()->addSeconds(30));

            $this->safeBroadcast($data['channel'], [
                'status' => 'rejected',
            ]);

            return true;
        });
    }

    /**
     * Return challenge status exclusively to the originating Device A session.
     *
     * @return array<string, mixed>
     */
    public function statusForDeviceA(string $token, Request $request): array
    {
        $tokenHash = $this->tokenHash($token);
        $sessionSecret = $this->getDeviceSecret($request, $tokenHash);
        $data = $this->cache()->get($this->challengeKey($tokenHash));

        if (! is_array($data) || $this->isExpired($data)) {
            $this->cache()->forget($this->challengeKey($tokenHash));
            $this->forgetDeviceSecret($request, $tokenHash);

            return ['status' => 'expired'];
        }

        if (! is_string($sessionSecret) || ! hash_equals((string) ($data['device_secret_hash'] ?? ''), hash('sha256', $sessionSecret))) {
            return ['status' => 'unauthorized'];
        }

        $response = [
            'status' => $data['status'],
            'expires_at' => $data['expires_at'],
        ];

        if ($data['status'] === 'approved' && ! empty($data['encrypted_exchange_code'])) {
            try {
                $response['exchange_code'] = Crypt::decryptString($data['encrypted_exchange_code']);
            } catch (Throwable) {
                return ['status' => 'expired'];
            }
        }

        if ($data['status'] === 'rejected') {
            $this->cache()->forget($this->challengeKey($tokenHash));
            $this->forgetDeviceSecret($request, $tokenHash);
        }

        return $response;
    }

    /**
     * Complete login on Device A by verifying both Device A's session secret and the exchange code.
     *
     * @return array<string, mixed>
     */
    public function complete(string $token, string $exchangeCode, Request $request): array
    {
        $tokenHash = $this->tokenHash($token);
        $sessionSecret = $this->getDeviceSecret($request, $tokenHash);

        if (! is_string($sessionSecret) || $sessionSecret === '' || $exchangeCode === '') {
            return ['ok' => false, 'reason' => 'invalid_session'];
        }

        return $this->withLock($tokenHash, function () use ($tokenHash, $sessionSecret, $exchangeCode, $request): array {
            $key = $this->challengeKey($tokenHash);
            $data = $this->cache()->get($key);

            if (! is_array($data) || $this->isExpired($data)) {
                $this->cache()->forget($key);
                $this->forgetDeviceSecret($request, $tokenHash);

                return ['ok' => false, 'reason' => 'expired'];
            }

            if (($data['status'] ?? '') !== 'approved' || empty($data['approved_user_id'])) {
                return ['ok' => false, 'reason' => 'not_approved'];
            }

            if (! hash_equals((string) ($data['device_secret_hash'] ?? ''), hash('sha256', $sessionSecret))) {
                return ['ok' => false, 'reason' => 'invalid_session'];
            }

            if (! hash_equals((string) ($data['exchange_code_hash'] ?? ''), hash('sha256', $exchangeCode))) {
                return ['ok' => false, 'reason' => 'invalid_exchange_code'];
            }

            // Consume single-use challenge atomically before retrieving user.
            $this->forgetCodeLookup($data);
            $this->cache()->forget($key);
            $this->forgetDeviceSecret($request, $tokenHash);

            $user = Auth::guard('web')->getProvider()?->retrieveById($data['approved_user_id']);
            if (! $user instanceof Authenticatable) {
                return ['ok' => false, 'reason' => 'user_not_found'];
            }

            return ['ok' => true, 'user' => $user];
        });
    }

    protected function generateUniquePairingCode(): string
    {
        $alphabet = self::PAIRING_ALPHABET;
        $maxIndex = strlen($alphabet) - 1;

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $code = '';
            for ($i = 0; $i < 8; $i++) {
                $code .= $alphabet[random_int(0, $maxIndex)];
            }

            if (! $this->cache()->has($this->codeKey($this->tokenHash($code)))) {
                return $code;
            }
        }

        return substr(strtoupper(Str::random(12)), 0, 8);
    }

    protected function normalizePairingCode(string $code): string
    {
        return strtoupper((string) preg_replace('/[^A-Za-z0-9]/', '', $code));
    }

    protected function formatPairingCode(string $rawCode): string
    {
        return substr($rawCode, 0, 4) . '-' . substr($rawCode, 4, 4);
    }

    protected function forgetCodeLookup(array $data): void
    {
        if (! empty($data['code_hash']) && is_string($data['code_hash'])) {
            $this->cache()->forget($this->codeKey($data['code_hash']));
        }
    }

    /**
     * Extract safe device metadata from the requesting browser.
     *
     * @return array<string, string>
     */
    protected function deviceDetails(Request $request): array
    {
        $agent = new Agent();
        $agent->setUserAgent((string) $request->userAgent());

        $browser = trim(($agent->browser() ?: 'Browser') . ' ' . ($agent->version((string) $agent->browser()) ?: ''));
        $platform = trim(($agent->platform() ?: 'Unknown OS') . ' ' . ($agent->version((string) $agent->platform()) ?: ''));

        $deviceType = match (true) {
            $agent->isTablet() => 'Tablet',
            $agent->isMobile() => 'Mobile',
            default => 'Desktop',
        };

        return [
            'browser' => $browser,
            'platform' => $platform,
            'type' => $deviceType,
            'ip' => (string) ($request->ip() ?: '127.0.0.1'),
        ];
    }

    protected function tokenHash(string $token): string
    {
        return hash('sha256', $token);
    }

    protected function challengeKey(string $tokenHash): string
    {
        return 'vibe:qr_login:challenge:' . $tokenHash;
    }

    protected function codeKey(string $codeHash): string
    {
        return 'vibe:qr_login:code:' . $codeHash;
    }

    protected function lockKey(string $tokenHash): string
    {
        return 'vibe:qr_login:lock:' . $tokenHash;
    }

    protected function channelName(string $token): string
    {
        return 'vibe-qr.' . hash_hmac('sha256', $token, (string) config('app.key', 'vibe-qr-login'));
    }

    protected function cache(): CacheRepository
    {
        return Cache::store();
    }

    /**
     * @template T
     *
     * @param  callable(): T  $callback
     * @return T
     */
    protected function withLock(string $tokenHash, callable $callback): mixed
    {
        $store = $this->cache()->getStore();

        if (method_exists($store, 'lock')) {
            return $store->lock($this->lockKey($tokenHash), 5)->block(3, $callback);
        }

        return $callback();
    }

    protected function putWithRemainingTtl(string $tokenHash, array $data): void
    {
        $remaining = max(1, (int) ($data['expires_at'] ?? time()) - now()->timestamp);
        $this->cache()->put($this->challengeKey($tokenHash), $data, now()->addSeconds($remaining));
    }

    protected function isExpired(array $data): bool
    {
        return (int) ($data['expires_at'] ?? 0) <= now()->timestamp;
    }

    protected function sessionStore(Request $request)
    {
        return $request->hasSession() ? $request->session() : session();
    }

    protected function rememberDeviceSecret(Request $request, string $tokenHash, string $secret): void
    {
        $session = $this->sessionStore($request);
        $secrets = (array) $session->get('auth.qr_login.secrets', []);
        if (count($secrets) >= 5) {
            $secrets = array_slice($secrets, -4, null, true);
        }
        $secrets[$tokenHash] = $secret;
        $session->put('auth.qr_login.secrets', $secrets);
    }

    protected function getDeviceSecret(Request $request, string $tokenHash): ?string
    {
        $secret = $this->sessionStore($request)->get("auth.qr_login.secrets.{$tokenHash}");

        return is_string($secret) ? $secret : null;
    }

    protected function forgetDeviceSecret(Request $request, string $tokenHash): void
    {
        $session = $this->sessionStore($request);
        $session->forget("auth.qr_login.secrets.{$tokenHash}");

        $activeToken = $session->get('auth.qr_login.active_token');
        if (is_string($activeToken) && $activeToken !== '' && hash_equals($this->tokenHash($activeToken), $tokenHash)) {
            $session->forget('auth.qr_login.active_token');
        }
    }

    protected function rememberActiveToken(Request $request, string $token): void
    {
        $this->sessionStore($request)->put('auth.qr_login.active_token', $token);
    }

    protected function getActiveToken(Request $request): ?string
    {
        $token = $this->sessionStore($request)->get('auth.qr_login.active_token');

        return is_string($token) ? $token : null;
    }

    /**
     * Broadcast status without letting misconfigured external sockets crash HTTP handlers.
     *
     * @param  array<string, mixed>  $payload
     */
    protected function safeBroadcast(string $channel, array $payload): ?string
    {
        try {
            $this->manager->driver()->broadcast($channel, self::EVENT_NAME, $payload);

            return null;
        } catch (Throwable $e) {
            logger()->warning('[VibeUI QR Login] Broadcast failed: ' . $e->getMessage());

            return $e->getMessage();
        }
    }
}
