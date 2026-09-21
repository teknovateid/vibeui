@aware(['tableName', 'isTailwind', 'isBootstrap'])
@props([])
@php($toolBarAttributes = $this->getToolBarAttributesBag)

<div
    {{
        $toolBarAttributes->merge()
            ->class([
                'flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4' => ($toolBarAttributes['default-styling'] ?? true),
            ])
            ->except(['default', 'default-styling', 'default-colors'])
    }}
>
    {{-- Left Toolbar Items --}}
    <div class="flex items-center gap-2 w-full sm:w-auto sm:flex-1">
        @if ($this->hasConfigurableAreaFor('toolbar-left-start'))
            <div x-cloak x-show="!currentlyReorderingStatus" class="inline-flex items-center shrink-0">
                @include($this->getConfigurableAreaFor('toolbar-left-start'), $this->getParametersForConfigurableArea('toolbar-left-start'))
            </div>
        @endif

        @if ($this->showReorderButton())
            <div class="shrink-0">
                <x-livewire-tables::tools.toolbar.items.reorder-buttons />
            </div>
        @endif

        @if ($this->showSearchField())
            <div class="flex-1 min-w-0 sm:max-w-xs">
                <x-livewire-tables::tools.toolbar.items.search-field />
            </div>
        @endif

        @if ($this->showFiltersButton())
            <div class="shrink-0">
                <x-livewire-tables::tools.toolbar.items.filter-button />
            </div>
        @endif

        @if($this->showActionsInToolbarLeft())
            <div class="shrink-0">
                <x-livewire-tables::includes.actions/>
            </div>
        @endif

        @if ($this->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-cloak x-show="!currentlyReorderingStatus" class="inline-flex items-center shrink-0">
                @include($this->getConfigurableAreaFor('toolbar-left-end'), $this->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    {{-- Right Toolbar Items --}}
    <div x-cloak x-show="!currentlyReorderingStatus" class="flex flex-wrap items-center gap-2 w-full sm:w-auto sm:justify-end">
        @includeWhen($this->hasConfigurableAreaFor('toolbar-right-start'), $this->getConfigurableAreaFor('toolbar-right-start'), $this->getParametersForConfigurableArea('toolbar-right-start'))

        @if($this->showActionsInToolbarRight())
            <x-livewire-tables::includes.actions/>
        @endif

        @if ($this->showBulkActionsDropdownAlpine() && $this->shouldAlwaysHideBulkActionsDropdownOption != true)
            <x-livewire-tables::tools.toolbar.items.bulk-actions />
        @endif

        @if ($this->columnSelectIsEnabled)
            <x-livewire-tables::tools.toolbar.items.column-select />
        @endif

        @if ($this->showPaginationDropdown())
            <x-livewire-tables::tools.toolbar.items.pagination-dropdown />
        @endif

        @includeWhen($this->hasConfigurableAreaFor('toolbar-right-end'), $this->getConfigurableAreaFor('toolbar-right-end'), $this->getParametersForConfigurableArea('toolbar-right-end'))
    </div>
</div>
