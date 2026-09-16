<?php

namespace Teknovate\VibeUi\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Teknovate\VibeUi\Models\TwoFactorAuthenticator;
use Teknovate\VibeUi\Vibe;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait TwoFactorAuthenticatable
{
    /**
     * Relasi ke seluruh metode autentikasi 2FA pengguna (menggunakan dynamic model).
     */
    public function twoFactorAuthenticators(): HasMany
    {
        /** @var \Illuminate\Database\Eloquent\Model $this */
        return $this->hasMany(Vibe::twoFactorModel(), 'user_id');
    }

    /**
     * Cek apakah pengguna telah mengaktifkan 2FA (secara umum atau spesifik per method).
     */
    public function hasTwoFactorEnabled(?string $method = null): bool
    {
        $query = $this->twoFactorAuthenticators()->whereNotNull('confirmed_at');

        if ($method !== null) {
            $query->where('method', $method);
        }

        return $query->exists();
    }

    /**
     * Ambil metode 2FA yang aktif berdasarkan nama metode (atau default/pertama jika method null).
     */
    public function getTwoFactorAuthenticator(?string $method = null): ?TwoFactorAuthenticator
    {
        if ($method !== null) {
            return $this->twoFactorAuthenticators()
                ->where('method', $method)
                ->whereNotNull('confirmed_at')
                ->first();
        }

        return $this->defaultTwoFactorAuthenticator();
    }

    /**
     * Ambil metode 2FA default atau yang pertama kali aktif.
     */
    public function defaultTwoFactorAuthenticator(): ?TwoFactorAuthenticator
    {
        return $this->twoFactorAuthenticators()
            ->whereNotNull('confirmed_at')
            ->orderByDesc('is_default')
            ->orderBy('id')
            ->first();
    }

    /**
     * Ambil semua metode 2FA yang sedang aktif untuk pengguna ini.
     *
     * @return Collection<int, TwoFactorAuthenticator>
     */
    public function confirmedTwoFactorAuthenticators(): Collection
    {
        return $this->twoFactorAuthenticators()
            ->whereNotNull('confirmed_at')
            ->get();
    }

    /**
     * Helper untuk menghasilkan array kode pemulihan acak berformat xxxx-xxxx-xxxx.
     *
     * @return list<string>
     */
    public function generateTwoFactorRecoveryCodes(int $count = 8): array
    {
        $codes = [];

        for ($i = 0; $i < $count; $i++) {
            $codes[] = sprintf(
                '%s-%s-%s',
                Str::lower(Str::random(4)),
                Str::lower(Str::random(4)),
                Str::lower(Str::random(4))
            );
        }

        return $codes;
    }
}
