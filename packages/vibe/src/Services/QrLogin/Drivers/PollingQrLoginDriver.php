<?php

namespace Teknovate\VibeUi\Services\QrLogin\Drivers;

use Teknovate\VibeUi\Contracts\QrLoginDriver;

class PollingQrLoginDriver implements QrLoginDriver
{
    public function __construct(
        protected int $intervalMs = 1500,
    ) {}

    public function name(): string
    {
        return 'polling';
    }

    public function broadcast(string $channelName, string $eventName, array $payload = []): void
    {
        // State is retrieved directly via HTTP polling from the QR login cache store.
    }

    public function clientConfig(string $channelName, string $eventName, string $statusUrl): array
    {
        return [
            'driver' => 'polling',
            'connection' => 'polling',
            'configured' => true,
            'channel' => $channelName,
            'event' => $eventName,
            'statusUrl' => $statusUrl,
            'intervalMs' => $this->intervalMs,
        ];
    }
}
