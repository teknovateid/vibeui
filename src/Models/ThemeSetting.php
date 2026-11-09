<?php

namespace Teknovate\VibeUi\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'theme_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'tokens',
        'css',
        'is_locked',
        'updated_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tokens' => 'array',
            'is_locked' => 'boolean',
        ];
    }
}
