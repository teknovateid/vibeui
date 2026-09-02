@aware(['tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])

<div class="{{ $this->getColumnSelectIsHiddenOnMobile() ? 'hidden sm:block' : ($this->getColumnSelectIsHiddenOnTablet() ? 'hidden md:block' : '') }} w-full md:w-auto">
    <div
        x-data="{ open: false, childElementOpen: false }"
        @keydown.window.escape="if (!childElementOpen) { open = false }"
        x-on:click.away="if (!childElementOpen) { open = false }"
        class="inline-block relative w-full text-left md:w-auto"
        wire:key="{{ $tableName }}-column-select-button"
    >
        <div>
            <button
                x-on:click="open = !open"
                type="button"
                {{
                    $attributes->merge($this->getColumnSelectButtonAttributes())
                    ->class([
                        'inline-flex items-center justify-center gap-2 h-9 px-3 w-full md:w-auto text-sm font-medium rounded-lg border border-border bg-background text-foreground shadow-2xs hover:bg-muted transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring' => $this->getColumnSelectButtonAttributes()['default-styling'] ?? true,
                    ])
                    ->except(['default-styling', 'default-colors'])
                }}
                aria-haspopup="true"
                x-bind:aria-expanded="open"
            >
                <svg class="h-3.5 w-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <path d="M9 3v18"/>
                    <path d="M15 3v18"/>
                </svg>

                <span>{{ __($localisationPath.'Columns') }}</span>

                <svg class="h-3.5 w-3.5 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
        </div>

        <div
            x-cloak
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 z-50 mt-2 w-56 rounded-xl border border-border bg-popover p-1.5 text-popover-foreground shadow-lg origin-top-right focus:outline-none max-h-72 overflow-y-auto"
        >
            {{-- Select All / Deselect All --}}
            <div class="border-b border-border/50 pb-1 mb-1">
                <label
                    wire:loading.attr="disabled"
                    class="flex items-center gap-2.5 px-2.5 py-1.5 text-xs font-medium rounded-lg hover:bg-muted/60 transition-colors cursor-pointer select-none text-foreground"
                >
                    <input
                        wire:loading.attr="disabled"
                        type="checkbox"
                        class="h-4 w-4 rounded border-border text-primary focus:ring-primary bg-background"
                        @checked($this->getSelectableSelectedColumns()->count() === $this->getSelectableColumns()->count())
                        @if($this->getSelectableSelectedColumns()->count() === $this->getSelectableColumns()->count()) wire:click="deselectAllColumns" @else wire:click="selectAllColumns" @endif
                    >
                    <span>{{ __($localisationPath.'All Columns') }}</span>
                </label>
            </div>

            {{-- Column List --}}
            <div class="space-y-0.5">
                @foreach ($this->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                    <div wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}">
                        <label
                            wire:loading.attr="disabled"
                            wire:target="selectedColumns"
                            class="flex items-center gap-2.5 px-2.5 py-1.5 text-xs font-medium rounded-lg hover:bg-muted/60 transition-colors cursor-pointer select-none text-foreground disabled:opacity-50 disabled:cursor-wait"
                        >
                            <input
                                class="h-4 w-4 rounded border-border text-primary focus:ring-primary bg-background disabled:opacity-50"
                                wire:model.live="selectedColumns"
                                wire:target="selectedColumns"
                                wire:loading.attr="disabled"
                                type="checkbox"
                                value="{{ $columnSlug }}"
                            />
                            <span class="truncate">{{ $columnTitle }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
