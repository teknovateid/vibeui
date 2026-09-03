@blaze

@props([
    'component' => null,
    'bordered' => false,
])

@pushOnce('head', 'vibe-datatable-styles')
    @rappasoftTableStyles
    @rappasoftTableThirdPartyStyles
@endPushOnce

@pushOnce('body', 'vibe-datatable-scripts')
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
        @livewire($component, $attributes->except(['class', 'bordered'])->getAttributes())
    </div>
@else
    <div {{ $attributes->twMerge(['class' => "w-full space-y-4 {$borderedCellStyles}"]) }}>
        {{ $slot }}
    </div>
@endif
