<?php

namespace Teknovate\VibeUi;

class Vibe
{
    /**
     * The current version of Vibe UI.
     */
    const VERSION = '0.1.4';

    /**
     * Get the current Vibe UI version.
     */
    public static function version(): string
    {
        return self::VERSION;
    }
}
