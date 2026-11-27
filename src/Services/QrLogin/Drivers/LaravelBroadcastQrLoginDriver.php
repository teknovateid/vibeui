<?php

namespace Teknovate\VibeUi\Services\QrLogin\Drivers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Teknovate\VibeUi\Contracts\QrLoginDriver;

class LaravelBroadcastQrLoginDriver implements QrLoginDriver
{
    public function __construct(
        protected BroadcastFactory $broadcast,
        protected string $connectionName,
        protected ?array $connectionConfig = null,
    ) {}

    public function name(): string
    {
        return $this->connectionName;
    }

    public function broadcast(string $channelName, string $eventName, array $payload = []): void
    {
        $this->broadcast
            ->connection($this->connectionName)
            ->broadcast([new Channel($channelName)], $eventName, $payload);
    }

    public function clientConfig(string $channelName, string $eventName, string $statusUrl): array
    {
        $connection = $this->connectionConfig();
        $transport = (string) ($connection['driver'] ?? $this->connectionName);
        $options = (array) ($connection['options'] ?? []);

        if ($transport === 'pusher') {
            $cluster = $options['cluster'] ?? 'mt1';
            $rawHost = $options['host'] ?? null;
            $isDefaultRestHost = is_string($rawHost)
                && preg_match('/^api-[a-z0-9\-]+\.pusher\.com$/i', $rawHost) === 1;
            $customHost = ($rawHost && ! $isDefaultRestHost) ? $rawHost : null;
            $scheme = (string) ($options['scheme'] ?? 'https');
            $useTLS = array_key_exists('useTLS', $options) ? (bool) $options['useTLS'] : ($scheme === 'https');
            $port = isset($options['port']) ? (int) $options['port'] : ($useTLS ? 443 : 80);

            return [
                'driver' => 'pusher',
                'connection' => $this->connectionName,
                'configured' => filled($connection['key'] ?? null)
                    && filled($connection['secret'] ?? null)
                    && filled($connection['app_id'] ?? null),
                'channel' => $channelName,
                'event' => $eventName,
                'statusUrl' => $statusUrl,
                'key' => $connection['key'] ?? null,
                'cluster' => $cluster ?: 'mt1',
                'wsHost' => $customHost,
                'wsPort' => $customHost ? $port : null,
                'wssPort' => $customHost ? $port : null,
                'forceTLS' => $useTLS,
                'intervalMs' => 2000,
            ];
        }

        if ($transport === 'reverb') {
            $host = $options['host'] ?? null;
            $scheme = (string) ($options['scheme'] ?? 'https');
            $useTLS = array_key_exists('useTLS', $options) ? (bool) $options['useTLS'] : ($scheme === 'https');
            $port = isset($options['port']) ? (int) $options['port'] : ($useTLS ? 443 : 8080);

            return [
                'driver' => 'reverb',
                'connection' => $this->connectionName,
                'configured' => filled($connection['key'] ?? null)
                    && filled($connection['secret'] ?? null)
                    && filled($connection['app_id'] ?? null)
                    && filled($host),
                'channel' => $channelName,
                'event' => $eventName,
                'statusUrl' => $statusUrl,
                'key' => $connection['key'] ?? null,
                'wsHost' => $host,
                'wsPort' => $port,
                'wssPort' => $port,
                'forceTLS' => $useTLS,
                'intervalMs' => 2000,
            ];
        }

        if (in_array($transport, ['log', 'null'], true)) {
            return [
                'driver' => 'polling',
                'connection' => $this->connectionName,
                'configured' => true,
                'channel' => $channelName,
                'event' => $eventName,
                'statusUrl' => $statusUrl,
                'intervalMs' => 1500,
            ];
        }

        return [
            'driver' => $transport,
            'connection' => $this->connectionName,
            'configured' => true,
            'channel' => $channelName,
            'event' => $eventName,
            'statusUrl' => $statusUrl,
            'intervalMs' => 2000,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    protected function connectionConfig(): array
    {
        if ($this->connectionConfig !== null) {
            return $this->connectionConfig;
        }

        return (array) config("broadcasting.connections.{$this->connectionName}", []);
    }
}
