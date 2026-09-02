@aware(['isTailwind', 'isBootstrap'])
<input
    wire:model{{ $this->getSearchOptions() }}="search"
    placeholder="{{ $this->getSearchPlaceholder() }}"
    type="text"
    {{ 
        $attributes->merge($this->getSearchFieldAttributes())
            ->class([
                'h-9 w-full rounded-lg border border-border bg-background py-1.5 text-sm text-foreground shadow-2xs placeholder:text-muted-foreground transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50',
                'pl-9' => $this->hasSearchIcon,
                'px-3' => ! $this->hasSearchIcon,
                'pr-9' => $this->hasSearch,
            ])
            ->except(['default', 'default-styling', 'default-colors']) 
    }}
/>
