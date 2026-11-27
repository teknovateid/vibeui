<?php

namespace Teknovate\VibeUi\Contracts;

interface QrLoginDriver
{
    /**
     * Get the active driver or Laravel broadcasting connection name.
     */
    public function name(): string;

    /**
     * Broadcast a QR login status update to the waiting device channel.
     *
     * @param  array<string, mixed>  $payload
     */
    public function broadcast(string $channelName, string $eventName, array $payload = []): void;

    /**
     * Return secret-free client configuration needed by the browser listener.
     *
     * @return array<string, mixed>
     */
    public function clientConfig(string $channelName, string $eventName, string $statusUrl): array;
}
