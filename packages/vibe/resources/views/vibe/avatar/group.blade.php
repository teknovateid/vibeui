@props([
    'limit'   => null,
    'total'   => null,
    'size'    => 'md',
    'overlap' => true,
])

@php
    use Illuminate\Support\Str;

    $groupId  = 'ag-' . Str::random(8);
    $limitInt = $limit !== null ? (int) $limit : null;

    $slotHtml     = (string) $slot;
    $computedTotal = $total !== null
        ? (int) $total
        : substr_count($slotHtml, 'data-avatar');

    $overflow = ($limitInt !== null && $computedTotal > $limitInt)
        ? $computedTotal - $limitInt
        : 0;

    $limitClass = $limitInt ? "[&>[data-avatar]:nth-child(n+" . ($limitInt + 1) . ")]:hidden!" : "";
    $overlapClass = $overlap ? '-space-x-3' : 'gap-2';
    $baseClasses  = "vibe-avatar-group flex items-center {$overlapClass} [&>[data-avatar]]:ring-2 [&>[data-avatar]]:ring-white dark:[&>[data-avatar]]:ring-vibe-900 {$limitClass}";

    $badgeSizeClasses = match ($size) {
        'xs'    => 'w-6 h-6 text-xs',
        'sm'    => 'w-8 h-8 text-xs',
        'lg'    => 'w-12 h-12 text-base',
        'xl'    => 'w-14 h-14 text-lg',
        '2xl'   => 'w-16 h-16 text-xl',
        default => 'w-10 h-10 text-sm',
    };

    $badgeClasses = "relative inline-flex items-center justify-center font-medium shrink-0 rounded-full bg-vibe-200 dark:bg-vibe-700 text-vibe-700 dark:text-vibe-200 ring-2 ring-white dark:ring-vibe-900 z-10 select-none {$badgeSizeClasses}";
@endphp

@php
    // Map size prop to CSS dimensions (matches Tailwind's w/h scale)
    $avatarSize = match ($size) {
        'xs'    => ['dim' => '1.5rem', 'font' => '0.75rem'],   // w-6 h-6
        'sm'    => ['dim' => '2rem',   'font' => '0.875rem'],   // w-8 h-8
        'lg'    => ['dim' => '3rem',   'font' => '1.125rem'],   // w-12 h-12
        'xl'    => ['dim' => '3.5rem', 'font' => '1.25rem'],    // w-14 h-14
        '2xl'   => ['dim' => '4rem',   'font' => '1.5rem'],     // w-16 h-16
        default => ['dim' => '2.5rem', 'font' => '1rem'],       // w-10 h-10 (md)
    };
@endphp

<div
    id="{{ $groupId }}"
    {{ $attributes->twMerge(['class' => $baseClasses]) }}
    style="--avatar-dim: {{ $avatarSize['dim'] }}; --avatar-font: {{ $avatarSize['font'] }};"
>
    {{ $slot }}

    @if($limitInt && $overflow > 0)
        <div class="{{ $badgeClasses }}">+{{ $overflow }}</div>
    @endif
</div>
