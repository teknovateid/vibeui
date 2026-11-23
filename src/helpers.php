<?php

declare(strict_types=1);

use TailwindMerge\Contracts\TailwindMergeContract;

if (! function_exists('twMerge')) {
    /**
     * Merge multiple Tailwind CSS classes by automatically resolving conflicts.
     *
     * @param  array<array-key, string|array<array-key, string>>  ...$args
     */
    function twMerge(...$args): string
    {
        return resolve(TailwindMergeContract::class)->merge(...$args);
    }
}

if (! function_exists('vibe_parse_template')) {
    /**
     * Parse and interpolate dynamic variables in editor HTML template.
     *
     * @param  string  $content  HTML content containing variables
     * @param  array  $data  Data array or Eloquent models (e.g. ['user' => $user, 'order' => $order])
     * @param  bool  $escape  Whether to escape replacement values (default: true)
     * @param  bool  $stripMissing  Whether to remove unparsed variables (default: false)
     */
    function vibe_parse_template(string $content, array $data = [], bool $escape = true, bool $stripMissing = false): string
    {
        return \Teknovate\VibeUi\Vibe::parseTemplate($content, $data, $escape, $stripMissing);
    }
}
