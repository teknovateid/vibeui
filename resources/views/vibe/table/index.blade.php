@blaze(fold: true)

@props([
    'variant' => 'default', // default, striped, bordered, flush
    'dense' => false,
    'hoverable' => true,
    'caption' => null,
    'containerClass' => null,
])

@php
    $baseContainerClasses = match ($variant) {
        'flush' => 'w-full overflow-x-auto',
        default => 'w-full overflow-x-auto rounded-xl border border-border bg-card text-card-foreground shadow-2xs',
    };

    $containerCompiledClasses = trim("{$baseContainerClasses} {$containerClass}");

    $baseTableClasses = 'w-full text-left text-sm caption-bottom select-text';

    $densityClasses = $dense 
        ? '[&_th]:py-2 [&_th]:px-3 [&_td]:py-2 [&_td]:px-3 text-xs' 
        : '[&_th]:py-3 [&_th]:px-4 [&_td]:py-3.5 [&_td]:px-4';

    $variantClasses = match ($variant) {
        'striped' => '[&_tbody_tr:nth-child(even)]:bg-muted/40 dark:[&_tbody_tr:nth-child(even)]:bg-muted/20',
        'bordered' => 'border-collapse [&_th]:border [&_th]:border-border [&_td]:border [&_td]:border-border',
        'flush' => '',
        default => '',
    };

    $hoverClasses = $hoverable ? '[&_tbody_tr]:transition-colors [&_tbody_tr:hover]:bg-muted/50 dark:[&_tbody_tr:hover]:bg-muted/30' : '';

    $tableCompiledClasses = trim("{$baseTableClasses} {$densityClasses} {$variantClasses} {$hoverClasses}");
@endphp

<div class="{{ $containerCompiledClasses }}">
    <table {{ $attributes->twMerge(['class' => $tableCompiledClasses]) }}>
        @if ($caption)
            <caption class="mt-4 text-xs text-muted-foreground p-3">{{ $caption }}</caption>
        @endif
        {{ $slot }}
    </table>
</div>
