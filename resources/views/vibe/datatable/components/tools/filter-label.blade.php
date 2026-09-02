@aware(['tableName'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table', 'for' => null])

@php
    $customLabelAttributes = $filter->getLabelAttributes();
@endphp

<label
    for="{{ $for ?? $tableName.'-filter-'.$filter->getKey() }}"
    {{ $attributes->merge($customLabelAttributes)->class([
        'block text-xs font-semibold text-foreground leading-tight' => true
    ]) }}
>
    {{ $filter->getName() }}
</label>
