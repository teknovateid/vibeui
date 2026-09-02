@aware(['tableName'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table'])

<div class="space-y-1.5">
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName />

    <input
        id="{{ $tableName }}-filter-{{ $filter->getKey() }}"
        type="text"
        {!! $filter->getWireMethod('filterComponents.'.$filter->getKey()) !!}
        class="w-full h-9 rounded-lg border border-input bg-background px-3 text-xs text-foreground shadow-2xs transition-colors placeholder:text-muted-foreground hover:border-border/80 focus:outline-none focus:ring-2 focus:ring-ring/20 focus:border-ring"
        placeholder="{{ $filter->getConfig('placeholder') ?? 'Cari...' }}"
    />
</div>
