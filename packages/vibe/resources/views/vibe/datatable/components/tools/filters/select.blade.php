@aware(['tableName'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table'])

@php
    $wireProp = 'filterComponents.' . $filter->getKey();
    $rawOptions = $filter->getOptions();
    $options = [];
    foreach ($rawOptions as $key => $val) {
        if (!is_iterable($val)) {
            $options[$key] = (string) $val;
        }
    }
@endphp

<div class="space-y-1.5" x-on:click.stop="" x-on:mousedown.stop="">
    <vibe:select
        :label="$filter->getName()"
        size="sm"
        wire:model.live="{{ $wireProp }}"
        :options="$options"
        wrapperClass="w-full"
    />
</div>
