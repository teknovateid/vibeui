@aware(['tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])
@props([])

@php
    $badgeAttributes = new \Illuminate\View\ComponentAttributeBag($this->getFilterButtonBadgeAttributes);
@endphp

<div>
    <div
        @if ($this->isFilterLayoutPopover())
            x-data="{ filterPopoverOpen: false }"
            x-on:keydown.escape.stop="if (!this.childElementOpen) { filterPopoverOpen = false }"
            x-on:mousedown.away="if (!this.childElementOpen) { filterPopoverOpen = false }"
        @endif
        class="relative inline-block text-left"
    >
        <div>
            <button
                type="button"
                {{
                    $attributes
                    ->merge($this->getFilterButtonAttributes)
                    ->class([
                        'inline-flex items-center justify-center gap-2 h-9 px-3 text-sm font-medium rounded-lg border border-border bg-background text-foreground shadow-2xs hover:bg-muted transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring' => ($this->getFilterButtonAttributes['default-styling'] ?? true),
                    ])
                    ->except(['default', 'default-styling', 'default-colors'])
                }}
                @if ($this->isFilterLayoutPopover())
                    x-on:click="filterPopoverOpen = !filterPopoverOpen"
                    aria-haspopup="true"
                    x-bind:aria-expanded="filterPopoverOpen"
                @endif
                @if ($this->isFilterLayoutSlideDown())
                    x-on:click="filtersOpen = !filtersOpen"
                @endif
            >
                <svg class="h-3.5 w-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>

                <span>{{ __($localisationPath.'Filters') }}</span>

                @if ($count = $this->getFilterBadgeCount())
                    <span {{
                        $badgeAttributes
                            ->class([
                                'inline-flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-[11px] font-semibold rounded-full bg-primary text-primary-foreground'
                            ])
                            ->except(['default', 'default-styling', 'default-colors'])
                    }}>
                        {{ $count }}
                    </span>
                @endif
            </button>
        </div>

        @if ($this->isFilterLayoutPopover())
            <x-livewire-tables::tools.toolbar.items.filter-popover />
        @endif
    </div>
</div>
