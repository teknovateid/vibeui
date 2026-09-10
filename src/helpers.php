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
