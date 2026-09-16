<?php

namespace Teknovate\VibeUi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $code,
        public int $ttlMinutes = 10
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $appName = config('app.name', 'Vibe UI');

        return (new MailMessage)
            ->subject("Kode Verifikasi 2FA — {$appName}")
            ->greeting("Halo " . ($notifiable->name ?? 'Pengguna') . ",")
            ->line("Kode verifikasi Autentikasi Dua Faktor (2FA) Anda untuk masuk ke {$appName} adalah:")
            ->line("# {$this->code}")
            ->line("Kode ini hanya berlaku selama {$this->ttlMinutes} menit. Jangan berikan kode ini kepada siapapun demi keamanan akun Anda.")
            ->line("Jika Anda tidak merasa meminta kode ini, segera ubah kata sandi akun Anda.")
            ->salutation("Salam hangat,\nTim " . $appName);
    }
}
