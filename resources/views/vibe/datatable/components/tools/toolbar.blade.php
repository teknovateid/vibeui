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
    <div class="flex flex-wrap items-center gap-2 flex-1">
        @if ($this->hasConfigurableAreaFor('toolbar-left-start'))
            <div x-cloak x-show="!currentlyReorderingStatus" class="inline-flex items-center">
                @include($this->getConfigurableAreaFor('toolbar-left-start'), $this->getParametersForConfigurableArea('toolbar-left-start'))
            </div>
        @endif

        @if ($this->showReorderButton())
            <x-livewire-tables::tools.toolbar.items.reorder-buttons />
        @endif

        @if ($this->showSearchField())
            <div class="w-full sm:w-auto sm:max-w-xs flex-1">
                <x-livewire-tables::tools.toolbar.items.search-field />
            </div>
        @endif

        @if ($this->showFiltersButton())
            <x-livewire-tables::tools.toolbar.items.filter-button />
        @endif

        @if($this->showActionsInToolbarLeft())
            <x-livewire-tables::includes.actions/>
        @endif

        @if ($this->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-cloak x-show="!currentlyReorderingStatus" class="inline-flex items-center">
                @include($this->getConfigurableAreaFor('toolbar-left-end'), $this->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    {{-- Right Toolbar Items --}}
    <div x-cloak x-show="!currentlyReorderingStatus" class="flex flex-wrap items-center gap-2">
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
