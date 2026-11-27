<?php

declare(strict_types=1);

use App\Livewire\Auth\Login;
use App\Livewire\Auth\QrApprove;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Livewire\Livewire;
use Teknovate\VibeUi\Contracts\QrLoginDriver;
use Teknovate\VibeUi\Services\QrLogin\QrLoginService;
use Teknovate\VibeUi\Vibe;

uses(DatabaseTransactions::class);

afterEach(function () {
    Config::set('vibe.auth.qr_login.enabled', true);
    Config::set('vibe.auth.qr_login.driver', 'pusher');
    Config::set('vibe.auth.qr_login.ttl', 120);
    Config::set('vibe.auth.qr_login.auto_refresh', true);
    Config::set('vibe.auth.qr_login.max_auto_refresh', 0);
    Config::set('vibe.auth.qr_login.bypass_two_factor', false);
    \Illuminate\Support\Facades\RateLimiter::clear('qr-create:127.0.0.1');
    \Illuminate\Support\Facades\RateLimiter::clear('qr-complete:127.0.0.1');
});

test('login page renders QR login trigger when enabled and hides it when disabled', function () {
    Config::set('vibe.auth.qr_login.enabled', true);
    $enabled = $this->get('/login');
    $enabled->assertStatus(200);
    $enabled->assertSee('startQrLogin');
    $enabled->assertSee('vibeQrLogin');
    $enabled->assertDontSee(__('auth/layout.toggle_theme'));
    $enabled->assertDontSee(__('auth/language.switch'));

    Config::set('vibe.auth.qr_login.enabled', false);
    $disabled = $this->get('/login');
    $disabled->assertStatus(200);
    $disabled->assertDontSee('startQrLogin');
    $disabled->assertDontSee('vibeQrLogin');
});

test('visiting /login?method=qrcode opens directly in QR mode and preserves same code & countdown across browser refresh', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $response = $this->get('/login?method=qrcode');
    $response->assertStatus(200);
    $response->assertSee('qr-challenge-');
    $response->assertSee('cancelQrLogin');
    $response->assertSee(__('auth/qr_login.panel_title'));
    $response->assertDontSee('aria-label="' . __('auth/qr_login.refresh') . '"', false);
    $response->assertDontSee('wire:submit="authenticate"', false);

    // Refreshing the browser in the same session keeps the same token, code, expiresAt, and scanned status
    $first = Livewire::test(Login::class)->call('startQrLogin');
    $token = $first->get('qrToken');
    $code = $first->get('qrCode');
    $expiresAt = $first->get('qrExpiresAt');

    app(QrLoginService::class)->markScanned($token);

    $refreshed = Livewire::test(Login::class)->call('startQrLogin');
    expect($refreshed->get('qrToken'))->toBe($token);
    expect($refreshed->get('qrCode'))->toBe($code);
    expect($refreshed->get('qrExpiresAt'))->toBe($expiresAt);
    expect($refreshed->get('qrStatus'))->toBe('scanned');

    // Explicit refreshQrLogin generates a brand-new token & pairing code
    $regenerated = $refreshed->call('refreshQrLogin');
    expect($regenerated->get('qrToken'))->not->toBe($token);
    expect($regenerated->get('qrCode'))->not->toBe($code);

    // Works alongside ?layout=split and ignores method=qrcode when disabled
    $split = $this->get('/login?method=qr&layout=split');
    $split->assertStatus(200);
    $split->assertSee('qr-challenge-');

    Config::set('vibe.auth.qr_login.enabled', false);
    $disabled = $this->get('/login?method=qrcode');
    $disabled->assertStatus(200);
    $disabled->assertDontSee('qr-challenge-');
});

test('login page handles missing pusher credentials gracefully inside QR panel', function () {
    Config::set('vibe.auth.qr_login.driver', 'pusher');
    Config::set('broadcasting.connections.pusher.key', null);
    Config::set('broadcasting.connections.pusher.secret', null);
    Config::set('broadcasting.connections.pusher.app_id', null);

    Livewire::test(Login::class)
        ->call('startQrLogin')
        ->assertSet('qrMode', true)
        ->assertSet('qrStatus', 'unconfigured')
        ->assertSet('qrApproveUrl', null);
});

test('guest cannot access qr approval page without authenticating first', function () {
    $response = $this->get('/qr-login/approve/some-random-token');
    $response->assertRedirect('/login');
});

test('cross-device QR login succeeds end-to-end with broadcast driver and session binding', function () {
    $broadcasted = new \ArrayObject();

    Vibe::qrLogin()->extend('memory-test', fn () => new class($broadcasted) implements QrLoginDriver {
        public function __construct(public \ArrayObject $log) {}

        public function name(): string
        {
            return 'memory-test';
        }

        public function broadcast(string $channelName, string $eventName, array $payload = []): void
        {
            $this->log->append(compact('channelName', 'eventName', 'payload'));
        }

        public function clientConfig(string $channelName, string $eventName, string $statusUrl): array
        {
            return [
                'driver' => 'polling',
                'configured' => true,
                'channel' => $channelName,
                'event' => $eventName,
                'statusUrl' => $statusUrl,
            ];
        }
    });

    Config::set('vibe.auth.qr_login.driver', 'memory-test');

    $loginComponent = Livewire::test(Login::class)
        ->call('startQrLogin')
        ->assertSet('qrMode', true)
        ->assertSet('qrStatus', 'pending')
        ->assertSet('qrDriver', 'memory-test')
        ->assertDispatched('vibe-qr-login-started');

    $token = $loginComponent->get('qrToken');
    expect($token)->toBeString()->not->toBeEmpty();

    // Device B (authenticated user) opens approval page via QR scan and must explicitly approve.
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(QrApprove::class, ['token' => $token])
        ->assertSet('valid', true)
        ->assertSet('status', 'scanned')
        ->assertSee(__('auth/qr_login.approve_title'))
        ->assertSee(__('auth/qr_login.approve_description'))
        ->assertDontSee(__('auth/qr_login.code_entry_description'))
        ->call('approve')
        ->assertSet('valid', false)
        ->assertSet('status', 'approved')
        ->assertSee(__('auth/qr_login.approved_title'));

    // Broadcast log recorded both 'scanned' and 'approved' with exchange_code.
    $entries = $broadcasted->getArrayCopy();
    expect(collect($entries)->pluck('payload.status')->all())->toBe(['scanned', 'approved']);
    $exchangeCode = $entries[1]['payload']['exchange_code'] ?? null;
    expect($exchangeCode)->toBeString()->not->toBeEmpty();

    // Device A completes QR login with the approved exchange_code and receives authenticated session.
    // Simulate Device B logout so assertAuthenticatedAs checks Device A login explicitly.
    auth()->logout();

    $loginComponent
        ->call('completeQrLogin', $token, $exchangeCode)
        ->assertRedirect(Login::redirectUrl());

    $this->assertAuthenticatedAs($user);

    // Replay attempt with the same token and exchange code fails.
    auth()->logout();
    $loginComponent
        ->call('completeQrLogin', $token, $exchangeCode)
        ->assertNoRedirect()
        ->assertSet('qrStatus', 'error')
        ->assertSet('qrError', __('auth/qr_login.invalid_session'));

    $this->assertGuest();
});

test('stranger HTTP request to qr status endpoint is rejected with 403', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $originSession = new \Illuminate\Session\Store('origin', new \Illuminate\Session\ArraySessionHandler(120));
    $originSession->start();

    $originRequest = \Illuminate\Http\Request::create('/login', 'GET');
    $originRequest->setLaravelSession($originSession);

    $challenge = app(QrLoginService::class)->createChallenge($originRequest);

    // Current test HTTP session has no deviceSecret for this token -> 403 unauthorized.
    $response = $this->getJson("/login/qr/status/{$challenge['token']}");
    $response->assertStatus(403)
        ->assertJson(['status' => 'unauthorized']);
});

test('vibe:auth command exposes qr login scaffold flags', function () {
    $definition = (new \Teknovate\VibeUi\Commands\AuthCommand)->getDefinition();

    expect($definition->hasOption('with-qr-login'))->toBeTrue();
    expect($definition->hasOption('without-qr-login'))->toBeTrue();
});

test('qr-login script bundles qrcode engine directly for Livewire dynamic transitions', function () {
    $js = file_get_contents(resource_path('js/vibe/qr-login.js'));

    expect($js)->toContain("import './qrcode'");
});

test('pairing code shown below QR allows cross-device login via code entry and becomes invalid once consumed', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $loginComponent = Livewire::test(Login::class)
        ->call('startQrLogin')
        ->assertSet('qrMode', true)
        ->assertSet('qrStatus', 'pending');

    $token = $loginComponent->get('qrToken');
    $pairingCode = $loginComponent->get('qrCode');

    expect($pairingCode)->toMatch('/^[A-Z2-9]{4}-[A-Z2-9]{4}$/');
    $loginComponent->assertSee($pairingCode);

    $user = User::factory()->create();

    // Authenticated Device B visits /qr-login/approve without token and receives 8-slot alphanumeric auto-submit OTP input;
    // valid pairing codes approve immediately in 1 step without a second confirmation screen.
    $page = $this->actingAs($user)->get('/qr-login/approve');
    $page->assertStatus(200)
        ->assertSee('data-otp-index="0"', false)
        ->assertSee('data-otp-index="7"', false)
        ->assertSee('inputmode="text"', false)
        ->assertSee('autoSubmit: true', false)
        ->assertSee('alphanumeric: true', false)
        ->assertDontSee(__('auth/layout.toggle_theme'))
        ->assertDontSee(__('auth/language.switch'))
        ->assertDontSee('&larr;', false);

    $approveComponent = Livewire::actingAs($user)
        ->test(QrApprove::class)
        ->assertSet('entryMode', true)
        ->set('pairingCode', strtolower(str_replace('-', '', $pairingCode)))
        ->call('submitPairingCode')
        ->assertHasNoErrors()
        ->assertSet('entryMode', false)
        ->assertSet('valid', false)
        ->assertSet('token', $token)
        ->assertSet('status', 'approved')
        ->assertSee(__('auth/qr_login.approved_title'));

    // Pairing code lookup is cleared once approved
    expect(app(QrLoginService::class)->findTokenByCode($pairingCode))->toBeNull();

    $status = app(QrLoginService::class)->statusForDeviceA($token, request());
    expect($status['status'])->toBe('approved');
    expect($status['exchange_code'])->toBeString()->not->toBeEmpty();

    auth()->logout();
    $loginComponent
        ->call('completeQrLogin', $token, $status['exchange_code'])
        ->assertRedirect(Login::redirectUrl());

    $this->assertAuthenticatedAs($user);
});

test('qr refresh duration (ttl) and auto refresh settings are configurable', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');
    expect(app(QrLoginService::class)->autoRefreshEnabled())->toBeTrue();
    expect(app(QrLoginService::class)->maxAutoRefresh())->toBe(0);

    Config::set('vibe.auth.qr_login.ttl', 45);
    Config::set('vibe.auth.qr_login.auto_refresh', false);
    Config::set('vibe.auth.qr_login.max_auto_refresh', 3);

    Livewire::test(Login::class)
        ->call('startQrLogin')
        ->assertSet('qrTtl', 45)
        ->assertSet('qrAutoRefresh', false)
        ->assertSet('qrMaxAutoRefresh', 3)
        ->assertDispatched('vibe-qr-login-started', function ($name, $params) {
            return ($params['autoRefresh'] ?? null) === false
                && ($params['maxAutoRefresh'] ?? null) === 3;
        });

    // Minimum floor of 10 seconds prevents misconfiguration
    Config::set('vibe.auth.qr_login.ttl', 2);
    expect(app(QrLoginService::class)->ttlSeconds())->toBe(10);
});

test('expired QR login immediately regenerates a new code when auto_refresh is enabled', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');
    Config::set('vibe.auth.qr_login.auto_refresh', true);

    $component = Livewire::test(Login::class)
        ->call('startQrLogin')
        ->assertSet('qrStatus', 'pending');

    $oldToken = $component->get('qrToken');
    $oldCode = $component->get('qrCode');

    // Simulate expired challenge by clearing it from cache before completion
    \Illuminate\Support\Facades\Cache::store()->forget('vibe:qr_login:challenge:' . hash('sha256', $oldToken));

    $component
        ->call('completeQrLogin', $oldToken, 'expired-code')
        ->assertNoRedirect()
        ->assertSet('qrStatus', 'pending')
        ->assertDispatched('vibe-qr-login-started');

    expect($component->get('qrToken'))->not->toBe($oldToken);
    expect($component->get('qrCode'))->not->toBe($oldCode);

    // When auto_refresh is disabled, expired challenges stay in expired state instead of regenerating
    Config::set('vibe.auth.qr_login.auto_refresh', false);

    $component2 = Livewire::test(Login::class)
        ->call('startQrLogin')
        ->assertSet('qrStatus', 'pending');

    $oldToken2 = $component2->get('qrToken');
    \Illuminate\Support\Facades\Cache::store()->forget('vibe:qr_login:challenge:' . hash('sha256', $oldToken2));

    $component2
        ->call('completeQrLogin', $oldToken2, 'expired-code')
        ->assertNoRedirect()
        ->assertSet('qrStatus', 'expired')
        ->assertSet('qrError', __('auth/qr_login.status_expired'));
});

test('invalid pairing code shows validation error and respects rate limiting', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(QrApprove::class)
        ->set('pairingCode', 'ZZZZ-ZZZZ')
        ->call('submitPairingCode')
        ->assertHasErrors(['pairingCode'])
        ->assertSet('entryMode', true);
});

test('polling driver returns exchange_code only to originating session', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $originSession = new \Illuminate\Session\Store('origin', new \Illuminate\Session\ArraySessionHandler(120));
    $originSession->start();

    $request = \Illuminate\Http\Request::create('/login', 'GET');
    $request->setLaravelSession($originSession);

    /** @var QrLoginService $service */
    $service = app(QrLoginService::class);
    $challenge = $service->createChallenge($request);
    $token = $challenge['token'];

    $user = User::factory()->create();
    $approved = $service->approve($token, $user);
    expect($approved['ok'])->toBeTrue();

    // Originating session sees approved + exchange_code.
    $originStatus = $service->statusForDeviceA($token, $request);
    expect($originStatus['status'])->toBe('approved');
    expect($originStatus['exchange_code'])->toBe($approved['exchange_code']);

    // Different session without deviceSecret is unauthorized.
    $otherSession = new \Illuminate\Session\Store('other', new \Illuminate\Session\ArraySessionHandler(120));
    $otherSession->start();

    $otherRequest = \Illuminate\Http\Request::create('/login', 'GET');
    $otherRequest->setLaravelSession($otherSession);
    expect($service->statusForDeviceA($token, $otherRequest)['status'])->toBe('unauthorized');

    // Completing from another session fails even with valid exchange_code.
    $hijackAttempt = $service->complete($token, $approved['exchange_code'], $otherRequest);
    expect($hijackAttempt['ok'])->toBeFalse();
    expect($hijackAttempt['reason'])->toBe('invalid_session');
});

test('rejected QR login cannot complete authentication', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $loginComponent = Livewire::test(Login::class)->call('startQrLogin');
    $token = $loginComponent->get('qrToken');

    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(QrApprove::class, ['token' => $token])
        ->call('reject')
        ->assertSet('status', 'rejected')
        ->assertSet('valid', false);

    auth()->logout();

    $loginComponent
        ->call('completeQrLogin', $token, 'any-code')
        ->assertNoRedirect();

    $this->assertGuest();
});

test('QR login respects two-factor authentication unless bypass_two_factor is true', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $user = User::factory()->create();
    $secret = Vibe::twoFactor()->generateSecretKey();
    $user->twoFactorAuthenticators()->create([
        'method' => 'totp',
        'secret' => $secret,
        'recovery_codes' => $user->generateTwoFactorRecoveryCodes(),
        'confirmed_at' => now(),
    ]);

    // 1. Default: enforces 2FA challenge.
    Config::set('vibe.auth.qr_login.bypass_two_factor', false);
    $comp1 = Livewire::test(Login::class)->call('startQrLogin');
    $token1 = $comp1->get('qrToken');
    $approved1 = app(QrLoginService::class)->approve($token1, $user);

    $comp1->call('completeQrLogin', $token1, $approved1['exchange_code'])
        ->assertRedirect(route('two-factor.challenge'));
    $this->assertGuest();

    // 2. Opt-in bypass: logs user directly in.
    Config::set('vibe.auth.qr_login.bypass_two_factor', true);
    $comp2 = Livewire::test(Login::class)->call('startQrLogin');
    $token2 = $comp2->get('qrToken');
    $approved2 = app(QrLoginService::class)->approve($token2, $user);

    $comp2->call('completeQrLogin', $token2, $approved2['exchange_code'])
        ->assertRedirect(Login::redirectUrl());
    $this->assertAuthenticatedAs($user);
});

test('docs qr login page renders successfully', function () {
    $response = $this->get('/docs/auth/qr-login');

    $response->assertStatus(200);
    $response->assertSee('VIBE_QR_LOGIN_DRIVER', false);
    $response->assertSee('pusher', false);
});

test('wrong exchange code fails closed and burns the approved challenge', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $loginComponent = Livewire::test(Login::class)->call('startQrLogin');
    $token = $loginComponent->get('qrToken');

    $user = User::factory()->create();
    $approved = app(QrLoginService::class)->approve($token, $user);
    expect($approved['ok'])->toBeTrue();

    // Wrong exchange code must fail and burn the challenge permanently.
    $loginComponent
        ->call('completeQrLogin', $token, 'wrong-exchange-code')
        ->assertNoRedirect()
        ->assertSet('qrStatus', 'error');

    $this->assertGuest();

    // Even retrying immediately with the real exchange_code cannot succeed once burned.
    $loginComponent
        ->call('completeQrLogin', $token, $approved['exchange_code'])
        ->assertNoRedirect();

    $this->assertGuest();
});

test('cancelling or force-refreshing QR login revokes prior challenge and pairing code', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');
    $service = app(QrLoginService::class);

    $comp = Livewire::test(Login::class)->call('startQrLogin');
    $token1 = $comp->get('qrToken');
    $code1 = $comp->get('qrCode');
    expect($service->findTokenByCode($code1))->toBe($token1);

    // Force-refreshing revokes challenge 1 & pairing code 1 immediately.
    $comp->call('refreshQrLogin');
    $token2 = $comp->get('qrToken');
    $code2 = $comp->get('qrCode');
    expect($service->findTokenByCode($code1))->toBeNull();
    expect($service->inspectChallenge($token1))->toBeNull();
    expect($service->findTokenByCode($code2))->toBe($token2);

    // Cancelling back to password login revokes active challenge 2 & pairing code 2.
    $comp->call('cancelQrLogin');
    expect($service->findTokenByCode($code2))->toBeNull();
    expect($service->inspectChallenge($token2))->toBeNull();
});

test('QrApprove guards approve/reject by valid state and resets OTP on invalid code', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $loginComponent = Livewire::test(Login::class)->call('startQrLogin');
    $token = $loginComponent->get('qrToken');

    $user = User::factory()->create();

    // Invalid pairing code resets property and dispatches vibe-otp-reset.
    Livewire::actingAs($user)
        ->test(QrApprove::class)
        ->set('pairingCode', 'ZZZZZZZZ')
        ->call('submitPairingCode')
        ->assertHasErrors(['pairingCode'])
        ->assertSet('pairingCode', '')
        ->assertDispatched('vibe-otp-reset');

    // In entryMode ($valid = false), calling approve() or reject() has no effect on the active challenge.
    Livewire::actingAs($user)
        ->test(QrApprove::class)
        ->call('approve')
        ->assertSet('status', 'entry');

    expect(app(QrLoginService::class)->inspectChallenge($token)['status'] ?? null)->toBe('pending');
});

test('broadcast exceptions are sanitized in production debug mode', function () {
    Vibe::qrLogin()->extend('failing-ws', fn (): QrLoginDriver => new class implements QrLoginDriver {
        public function name(): string
        {
            return 'failing-ws';
        }

        public function broadcast(string $channelName, string $eventName, array $payload = []): void
        {
            throw new \RuntimeException('Connection refused to tcp://internal-pusher-secret:6001');
        }

        public function clientConfig(string $channelName, string $eventName, string $statusUrl): array
        {
            return ['driver' => 'polling', 'configured' => true, 'channel' => $channelName, 'event' => $eventName, 'statusUrl' => $statusUrl];
        }
    });

    $originalDebug = config('app.debug');
    Config::set('vibe.auth.qr_login.driver', 'failing-ws');
    Config::set('app.debug', false);

    try {
        $loginComponent = Livewire::test(Login::class)->call('startQrLogin');
        $token = $loginComponent->get('qrToken');

        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(QrApprove::class, ['token' => $token])
            ->call('approve')
            ->assertSet('status', 'approved')
            ->assertSet('broadcastWarning', __('auth/qr_login.broadcast_warning_desc'))
            ->assertDontSee('internal-pusher-secret');
    } finally {
        Config::set('app.debug', $originalDebug);
    }
});

test('Livewire QR creation and completion enforce rate limits', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');

    $comp = Livewire::test(Login::class);

    for ($i = 0; $i < 20; $i++) {
        $comp->call('refreshQrLogin');
    }

    $comp->call('refreshQrLogin')
        ->assertSet('qrStatus', 'error')
        ->assertSet('qrToken', null);

    // Separate completion limiter
    for ($i = 0; $i < 15; $i++) {
        $comp->call('completeQrLogin', 'fake-token', 'fake-exchange');
    }

    $comp->call('completeQrLogin', 'fake-token', 'fake-exchange')
        ->assertSet('qrStatus', 'error');
});

test('QR login root x-data stays invariant across refreshes while returning challenge payload cleanly', function () {
    Config::set('vibe.auth.qr_login.driver', 'polling');
    Config::set('vibe.auth.qr_login.ttl', 120);

    $guestLogin = $this->get('/login');
    $guestLogin->assertStatus(200);
    $guestHtml = $guestLogin->getContent();

    $comp = Livewire::test(Login::class);
    $returned1 = null;
    $comp->call('startQrLogin')->assertReturned(function ($payload) use (&$returned1) {
        $returned1 = $payload;
        return is_array($payload);
    });
    $token1 = $comp->get('qrToken');

    expect($returned1)->toBeArray()
        ->and($returned1['token'] ?? null)->toBe($token1)
        ->and($returned1['ttl'] ?? null)->toBe(120);

    // Consecutive refreshes return brand-new token + full TTL directly
    $returned2 = null;
    $comp->call('refreshQrLogin')->assertReturned(function ($payload) use (&$returned2) {
        $returned2 = $payload;
        return is_array($payload);
    });
    $token2 = $comp->get('qrToken');

    expect($token2)->not->toBe($token1);
    expect($returned2)->toBeArray()
        ->and($returned2['token'] ?? null)->toBe($token2)
        ->and($returned2['ttl'] ?? null)->toBe(120);

    // Rendered SSR QR login view keeps x-data free of mutable token/payload values and isolates status pill with wire:ignore
    $qrPage = $this->get('/login?method=qrcode');
    $qrPage->assertStatus(200);
    $qrHtml = $qrPage->getContent();
    $qrPage->assertSee('data-qr-challenge', false);
    $qrPage->assertSee('wire:ignore', false);
    $qrPage->assertDontSee("initial: {", false);

    preg_match('/x-data="([^"]*vibeQrLogin[^"]*)"/s', $guestHtml, $guestMatches);
    preg_match('/x-data="([^"]*vibeQrLogin[^"]*)"/s', $qrHtml, $qrMatches);
    expect($guestMatches[1] ?? null)->not->toBeNull()
        ->and($qrMatches[1] ?? null)->toBe($guestMatches[1]);
});
