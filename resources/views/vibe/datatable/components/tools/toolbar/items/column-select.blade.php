@aware(['tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])

<div class="{{ $this->getColumnSelectIsHiddenOnMobile() ? 'hidden sm:block' : ($this->getColumnSelectIsHiddenOnTablet() ? 'hidden md:block' : '') }} w-full md:w-auto" wire:key="{{ $tableName }}-column-select-wrapper">
    <vibe:dropdown align="right" width="56" keyboard>
        <vibe:dropdown.trigger>
            <button
                type="button"
                class="inline-flex items-center justify-center gap-2 h-9 px-3 w-full md:w-auto text-xs font-medium rounded-lg border border-border bg-background text-foreground shadow-2xs hover:bg-muted transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring select-none"
                aria-haspopup="true"
                x-bind:aria-expanded="open"
            >
                <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <path d="M9 3v18"/>
                    <path d="M15 3v18"/>
                </svg>

                <span>{{ __($localisationPath.'Columns') }}</span>

                <svg class="size-3.5 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
        </vibe:dropdown.trigger>

        <vibe:dropdown.content align="right" width="56" class="max-h-72 overflow-y-auto p-1.5">
            {{-- Select All / Deselect All --}}
            <div class="border-b border-border/50 pb-1 mb-1">
                @php($allSelected = $this->getSelectableSelectedColumns()->count() === $this->getSelectableColumns()->count())
                <label
                    wire:loading.attr="disabled"
                    class="group flex items-center gap-2.5 px-2.5 py-1.5 text-xs font-medium rounded-lg hover:bg-muted/70 transition-colors cursor-pointer select-none text-foreground"
                >
                    <input
                        wire:loading.attr="disabled"
                        type="checkbox"
                        class="peer sr-only"
                        @checked($allSelected)
                        @if($allSelected) wire:click="deselectAllColumns" @else wire:click="selectAllColumns" @endif
                    >
                    <span class="size-4 shrink-0 rounded-md border border-input bg-background transition-colors flex items-center justify-center shadow-2xs peer-checked:bg-primary peer-checked:border-primary text-transparent peer-checked:text-primary-foreground peer-focus-visible:ring-2 peer-focus-visible:ring-ring/20">
                        <svg class="size-2.5 stroke-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </span>
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
                            class="group flex items-center gap-2.5 px-2.5 py-1.5 text-xs font-medium rounded-lg hover:bg-muted/70 transition-colors cursor-pointer select-none text-foreground disabled:opacity-50 disabled:cursor-wait"
                        >
                            <input
                                class="peer sr-only"
                                wire:model.live="selectedColumns"
                                wire:target="selectedColumns"
                                wire:loading.attr="disabled"
                                type="checkbox"
                                value="{{ $columnSlug }}"
                            />
                            <span class="size-4 shrink-0 rounded-md border border-input bg-background transition-colors flex items-center justify-center shadow-2xs peer-checked:bg-primary peer-checked:border-primary text-transparent peer-checked:text-primary-foreground peer-focus-visible:ring-2 peer-focus-visible:ring-ring/20">
                                <svg class="size-2.5 stroke-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </span>
                            <span class="truncate">{{ $columnTitle }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </vibe:dropdown.content>
    </vibe:dropdown>
</div>
