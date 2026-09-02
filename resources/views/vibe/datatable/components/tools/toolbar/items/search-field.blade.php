@aware(['isTailwind', 'isBootstrap'])

<div class="relative w-full">
    @if($this->hasSearchIcon)
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.3-4.3"/>
            </svg>
        </div>
    @endif

    <x-livewire-tables::tools.toolbar.items.search.input />

    @if ($this->hasSearch)
        <button
            type="button"
            wire:click="clearSearch"
            class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted-foreground hover:text-foreground transition-colors cursor-pointer"
            title="Clear search"
        >
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
            </svg>
        </button>
    @endif
</div>
