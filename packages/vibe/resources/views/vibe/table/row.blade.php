@blaze(fold: true)

@props([
    'selected' => false,
    'clickable' => false,
])

@php
    $baseClasses = 'group/row transition-colors';
    $selectedClasses = $selected ? 'bg-primary/5 hover:bg-primary/10 dark:bg-primary/10 dark:hover:bg-primary/15' : '';
    $clickableClasses = $clickable ? 'cursor-pointer active:bg-muted/70' : '';

    $compiledClasses = trim("{$baseClasses} {$selectedClasses} {$clickableClasses}");
@endphp

<tr 
    @if ($selected) data-selected="true" @endif
    {{ $attributes->twMerge(['class' => $compiledClasses]) }}
>
    {{ $slot }}
</tr>
