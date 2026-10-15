@blaze(fold: true)

@props([
    'sticky' => false,
])

@php
    $baseClasses = 'border-b border-table-border bg-table-header text-table-header-foreground font-medium text-xs';
    $stickyClasses = $sticky ? 'sticky top-0 bg-table-header z-10 shadow-2xs' : '';
    $compiledClasses = trim("{$baseClasses} {$stickyClasses}");
@endphp

<thead {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
    <tr>
        {{ $slot }}
    </tr>
</thead>
