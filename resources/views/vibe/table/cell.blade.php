@blaze(fold: true)

@props([
    'align' => 'left', // left, center, right
    'variant' => 'default', // default, strong, muted
    'nowrap' => false,
])

@php
    $alignClasses = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };

    $variantClasses = match ($variant) {
        'strong' => 'font-semibold text-foreground',
        'muted' => 'text-muted-foreground',
        default => 'text-foreground',
    };

    $nowrapClasses = $nowrap ? 'whitespace-nowrap' : '';

    $compiledClasses = trim("align-middle {$alignClasses} {$variantClasses} {$nowrapClasses}");
@endphp

<td {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
    {{ $slot }}
</td>
