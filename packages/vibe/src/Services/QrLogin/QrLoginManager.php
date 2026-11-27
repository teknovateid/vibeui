<?php

namespace Teknovate\VibeUi\Services\QrLogin;

use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Support\Manager;
use InvalidArgumentException;
use Teknovate\VibeUi\Contracts\QrLoginDriver;
use Teknovate\VibeUi\Services\QrLogin\Drivers\LaravelBroadcastQrLoginDriver;
use Teknovate\VibeUi\Services\QrLogin\Drivers\PollingQrLoginDriver;

class QrLoginManager extends Manager
{
    public function getDefaultDriver(): string
    {
        $configured = config('vibe.auth.qr_login.driver');

        if (is_string($configured) && $configured !== '') {
            return $configured;
        }

        return 'pusher';
    }

    public function createPollingDriver(): QrLoginDriver
    {
        return new PollingQrLoginDriver();
    }

    protected function createDriver($driver): QrLoginDriver
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        if ($driver === 'polling') {
            return $this->createPollingDriver();
        }

        $connectionConfig = config("broadcasting.connections.{$driver}");
        if (is_array($connectionConfig)) {
            return new LaravelBroadcastQrLoginDriver(
                $this->container->make(BroadcastFactory::class),
                (string) $driver,
                $connectionConfig,
            );
        }

        throw new InvalidArgumentException(
            "QR Login driver [{$driver}] is not supported or missing in broadcasting.connections."
        );
    }
}
