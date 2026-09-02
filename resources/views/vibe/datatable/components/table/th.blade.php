@aware(['isTailwind', 'isBootstrap'])
@props(['column', 'index'])

@php
    $allThAttributes = $this->getAllThAttributes($column);
    $customThAttributes = $allThAttributes['customAttributes'];
    $customSortButtonAttributes = $allThAttributes['sortButtonAttributes'];
    $customLabelAttributes = $allThAttributes['labelAttributes'];
    $customIconAttributes = $this->getThSortIconAttributes($column);
    $direction = $column->hasField() ? $this->getSort($column->getColumnSelectName()) : $this->getSort($column->getSlug()) ?? null;
@endphp

<th {{
    $attributes->merge($customThAttributes)
        ->class([
            'py-3 px-4 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground select-none' => ($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true),
            'hidden' => $column->shouldCollapseAlways(),
            'hidden md:table-cell' => $column->shouldCollapseOnMobile(),
            'hidden lg:table-cell' => $column->shouldCollapseOnTablet(),
        ])
        ->except(['default', 'default-colors', 'default-styling'])
}}>
    @if($column->getColumnLabelStatus())
        @unless ($this->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))
            <x-livewire-tables::table.th.label :$customLabelAttributes :columnTitle="$column->getTitle()" />
        @else
            <button
                type="button"
                wire:click="sortBy('{{ $column->getColumnSortKey() }}')"
                {{
                    $attributes->merge($customSortButtonAttributes)
                        ->class([
                            'group inline-flex items-center gap-1.5 text-left text-xs font-semibold uppercase tracking-wider text-muted-foreground hover:text-foreground transition-colors focus:outline-none' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                        ])
                        ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}
            >
                <x-livewire-tables::table.th.label :$customLabelAttributes :columnTitle="$column->getTitle()" />
                <x-livewire-tables::table.th.sort-icons :$direction :$customIconAttributes />
            </button>
        @endunless
    @endif
</th>
