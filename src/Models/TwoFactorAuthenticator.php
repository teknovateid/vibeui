<?php

namespace Teknovate\VibeUi\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFactorAuthenticator extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'two_factor_authenticators';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'method',
        'secret',
        'recovery_codes',
        'is_default',
        'confirmed_at',
        'last_used_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'secret',
        'recovery_codes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'secret' => 'encrypted',
            'recovery_codes' => 'encrypted:array',
            'is_default' => 'boolean',
            'confirmed_at' => 'datetime',
            'last_used_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke model User dinamis sesuai config auth Laravel.
     */
    public function user(): BelongsTo
    {
        $userModel = config('auth.providers.users.model', 'App\\Models\\User');

        return $this->belongsTo($userModel, 'user_id');
    }

    /**
     * Scope query untuk hanya mengambil authenticator yang sudah diverifikasi (aktif).
     */
    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->whereNotNull('confirmed_at');
    }

    /**
     * Scope query berdasarkan metode otentikasi ('totp', 'whatsapp', 'sms', 'email').
     */
    public function scopeMethod(Builder $query, string $method): Builder
    {
        return $query->where('method', $method);
    }

    /**
     * Cek apakah metode 2FA ini sudah tervalidasi dan aktif.
     */
    public function isConfirmed(): bool
    {
        return ! is_null($this->confirmed_at);
    }

    /**
     * Tandai metode 2FA ini sebagai aktif dan terkonfirmasi.
     */
    public function markAsConfirmed(): bool
    {
        $this->confirmed_at = now();

        return $this->save();
    }

    /**
     * Catat waktu penggunaan terakhir.
     */
    public function touchUsage(): bool
    {
        $this->last_used_at = now();

        return $this->save();
    }

    /**
     * Verifikasi kode pemulihan dan hapus jika valid (one-time use).
     */
    public function verifyRecoveryCode(string $code): bool
    {
        $codes = $this->recovery_codes ?? [];

        $cleanedInput = trim(str_replace(' ', '', strtolower($code)));

        foreach ($codes as $index => $storedCode) {
            $cleanedStored = trim(str_replace(' ', '', strtolower($storedCode)));

            if (hash_equals($cleanedStored, $cleanedInput)) {
                unset($codes[$index]);
                $this->recovery_codes = array_values($codes);
                $this->touchUsage();

                return true;
            }
        }

        return false;
    }
}
