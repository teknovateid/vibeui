@aware(['tableName', 'isTailwind', 'isBootstrap4', 'isBootstrap5'])

<div
    x-data="filterPillsHandler(@js($setupData))"
    x-bind="trigger" 
    wire:key="{{ $tableName }}-filter-pill-{{ $filterKey }}"
    {{
        $attributes->merge($filterPillsItemAttributes)
            ->class([
                'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-muted text-foreground border border-border shadow-2xs' => ($filterPillsItemAttributes['default-styling'] ?? true),
            ])
            ->except(['default', 'default-styling', 'default-colors'])
    }}
>
    <span {{ $attributes->merge($pillTitleDisplayDataArray) }} class="font-semibold text-muted-foreground"></span>:&nbsp;
    <span {{ $attributes->merge($pillDisplayDataArray) }}></span>

    <x-livewire-tables::tools.filter-pills.buttons.reset-filter :$filterKey :$filterPillData/>
</div>
