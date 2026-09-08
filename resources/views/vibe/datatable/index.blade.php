@blaze

@props([
    'component' => null,
    'bordered' => false,
    'lazy' => false,
])

@pushOnce('head', 'vibe-datatable-styles')
    @rappasoftTableStyles
    @rappasoftTableThirdPartyStyles
@endPushOnce

@pushOnce('head', 'vibe-datatable-scripts')
    @rappasoftTableScripts
    @rappasoftTableThirdPartyScripts
@endPushOnce

@php
    $classAttr = (string) $attributes->get('class', '');
    $classesList = preg_split('/\s+/', trim($classAttr));
    $hasBorderClass = in_array('border', $classesList, true) || in_array('bordered', $classesList, true);

    $isBordered = $bordered || $hasBorderClass;
    $borderedCellStyles = $isBordered ? '[&_th]:border [&_th]:border-border [&_td]:border [&_td]:border-border border-collapse' : '';
@endphp

@if ($component)
    <div {{ $attributes->twMerge(['class' => "w-full {$borderedCellStyles}"]) }}>
        @if ($lazy)
            <livewire:is :$component lazy />
        @else
            <livewire:is :$component />
        @endif
    </div>
@else
    <div {{ $attributes->twMerge(['class' => "w-full space-y-4 {$borderedCellStyles}"]) }}>
        {{ $slot }}
    </div>
@endif
