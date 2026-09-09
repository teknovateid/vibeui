@aware(['tableName', 'localisationPath'])

<div
    x-cloak
    x-show="filterPopoverOpen"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="absolute left-0 z-50 mt-2 w-72 rounded-xl border border-border bg-popover p-4 text-popover-foreground shadow-lg origin-top-left focus:outline-none space-y-4"
    role="menu"
    aria-orientation="vertical"
    aria-labelledby="filters-menu"
>
    {{-- Popover Header --}}
    <div class="flex items-center justify-between border-b border-border/50 pb-2.5">
        <span class="text-[11px] font-bold uppercase tracking-wider text-muted-foreground">
            {{ __($localisationPath.'Filters') }}
        </span>

        @if ($this->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
            <button
                wire:click="clearFilterValues"
                type="button"
                class="text-xs font-medium text-destructive hover:underline cursor-pointer focus:outline-none transition-colors"
            >
                {{ __('vibe/datatable.reset_filter') }}
            </button>
        @endif
    </div>

    {{-- Filter Controls --}}
    <div class="space-y-3">
        @foreach ($this->getVisibleFilters() as $filter)
            <div id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper" wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-toolbar">
                {{ $filter->setGenericDisplayData($this->getFilterGenericData)->render() }}
            </div>
        @endforeach
    </div>
</div>
