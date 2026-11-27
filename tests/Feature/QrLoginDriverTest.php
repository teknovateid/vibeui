<?php

declare(strict_types=1);

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\Broadcaster;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Support\Facades\Config;
use Teknovate\VibeUi\Contracts\QrLoginDriver;
use Teknovate\VibeUi\Services\QrLogin\Drivers\LaravelBroadcastQrLoginDriver;
use Teknovate\VibeUi\Services\QrLogin\Drivers\PollingQrLoginDriver;
use Teknovate\VibeUi\Services\QrLogin\QrLoginManager;
use Teknovate\VibeUi\Vibe;

afterEach(function () {
    Config::set('vibe.auth.qr_login.driver', 'pusher');
});

test('qr login manager defaults to pusher broadcasting connection', function () {
    Config::set('vibe.auth.qr_login.driver', 'pusher');

    $driver = app(QrLoginManager::class)->driver();

    expect($driver)->toBeInstanceOf(LaravelBroadcastQrLoginDriver::class);
    expect($driver->name())->toBe('pusher');
});

test('pusher client config excludes secret and app_id and omits default REST host', function () {
    Config::set('broadcasting.connections.pusher', [
        'driver' => 'pusher',
        'key' => 'pub-key-123',
        'secret' => 'super-secret-xyz',
        'app_id' => 'app-id-999',
        'options' => [
            'cluster' => 'ap1',
            'host' => 'api-ap1.pusher.com',
            'port' => 443,
            'scheme' => 'https',
            'useTLS' => true,
        ],
    ]);

    $driver = app(QrLoginManager::class)->driver('pusher');
    $client = $driver->clientConfig('vibe-qr.chan', 'qr-login.status', '/login/qr/status/tok');

    expect($client['driver'])->toBe('pusher');
    expect($client['configured'])->toBeTrue();
    expect($client['key'])->toBe('pub-key-123');
    expect($client['cluster'])->toBe('ap1');
    expect($client['wsHost'])->toBeNull();
    expect($client['forceTLS'])->toBeTrue();
    expect($client)->not->toHaveKey('secret');
    expect($client)->not->toHaveKey('app_id');
});

test('pusher client config preserves custom wsHost when configured', function () {
    Config::set('broadcasting.connections.pusher', [
        'driver' => 'pusher',
        'key' => 'local-key',
        'secret' => 'local-secret',
        'app_id' => 'local-app',
        'options' => [
            'cluster' => 'mt1',
            'host' => 'soketi.internal.test',
            'port' => 6001,
            'scheme' => 'http',
            'useTLS' => false,
        ],
    ]);

    $client = app(QrLoginManager::class)
        ->driver('pusher')
        ->clientConfig('vibe-qr.chan', 'qr-login.status', '/login/qr/status/tok');

    expect($client['wsHost'])->toBe('soketi.internal.test');
    expect($client['wsPort'])->toBe(6001);
    expect($client['forceTLS'])->toBeFalse();
});

test('qr login driver can be swapped to reverb, ably, polling, or custom extend driver', function () {
    Config::set('broadcasting.connections.reverb', [
        'driver' => 'reverb',
        'key' => 'rev-key',
        'secret' => 'rev-secret',
        'app_id' => 'rev-app',
        'options' => [
            'host' => 'reverb.local',
            'port' => 8080,
            'scheme' => 'http',
            'useTLS' => false,
        ],
    ]);

    Config::set('vibe.auth.qr_login.driver', 'reverb');
    $reverb = Vibe::qrLogin()->driver();
    expect($reverb)->toBeInstanceOf(LaravelBroadcastQrLoginDriver::class);
    expect($reverb->name())->toBe('reverb');
    $reverbClient = $reverb->clientConfig('c', 'e', '/s');
    expect($reverbClient['driver'])->toBe('reverb');
    expect($reverbClient['wsHost'])->toBe('reverb.local');
    expect($reverbClient['configured'])->toBeTrue();

    Config::set('vibe.auth.qr_login.driver', 'ably');
    $ably = Vibe::qrLogin()->driver();
    expect($ably->name())->toBe('ably');
    expect($ably->clientConfig('c', 'e', '/s')['driver'])->toBe('ably');

    Config::set('vibe.auth.qr_login.driver', 'polling');
    $polling = Vibe::qrLogin()->driver();
    expect($polling)->toBeInstanceOf(PollingQrLoginDriver::class);
    expect($polling->clientConfig('c', 'e', '/s')['driver'])->toBe('polling');

    Vibe::qrLogin()->extend('custom-ws', fn (): QrLoginDriver => new class implements QrLoginDriver {
        public function name(): string
        {
            return 'custom-ws';
        }

        public function broadcast(string $channelName, string $eventName, array $payload = []): void {}

        public function clientConfig(string $channelName, string $eventName, string $statusUrl): array
        {
            return ['driver' => 'custom-ws', 'configured' => true, 'channel' => $channelName];
        }
    });

    Config::set('vibe.auth.qr_login.driver', 'custom-ws');
    $custom = Vibe::qrLogin()->driver();
    expect($custom->name())->toBe('custom-ws');
    expect($custom->clientConfig('c', 'e', '/s')['driver'])->toBe('custom-ws');
});

test('broadcast driver forwards channel, event and payload through Laravel Broadcast connection', function () {
    $broadcaster = Mockery::mock(Broadcaster::class);
    $broadcaster->shouldReceive('broadcast')
        ->once()
        ->withArgs(function (array $channels, string $event, array $payload): bool {
            return count($channels) === 1
                && $channels[0] instanceof Channel
                && $channels[0]->name === 'vibe-qr.sample'
                && $event === 'qr-login.status'
                && ($payload['status'] ?? null) === 'approved'
                && ($payload['exchange_code'] ?? null) === 'code-123';
        });

    $factory = Mockery::mock(BroadcastFactory::class);
    $factory->shouldReceive('connection')
        ->once()
        ->with('pusher')
        ->andReturn($broadcaster);

    $driver = new LaravelBroadcastQrLoginDriver($factory, 'pusher', [
        'driver' => 'pusher',
        'key' => 'k',
        'secret' => 's',
        'app_id' => 'a',
    ]);

    $driver->broadcast('vibe-qr.sample', 'qr-login.status', [
        'status' => 'approved',
        'exchange_code' => 'code-123',
    ]);
});

test('unknown qr login driver throws InvalidArgumentException', function () {
    expect(fn () => app(QrLoginManager::class)->driver('non-existent-driver'))
        ->toThrow(InvalidArgumentException::class);
});
