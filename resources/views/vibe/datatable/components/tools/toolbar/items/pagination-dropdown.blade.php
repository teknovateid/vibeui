@aware(['tableName', 'localisationPath'])

<div class="w-full md:w-auto" wire:key="{{ $tableName }}-pagination-dropdown-wrapper">
    <vibe:dropdown align="right" width="min" keyboard>
        <vibe:dropdown.trigger>
            <button
                type="button"
                class="inline-flex items-center justify-between gap-2 h-9 px-3 min-w-18 text-xs font-medium rounded-lg border border-border bg-background text-foreground shadow-2xs hover:bg-muted transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring select-none"
                aria-haspopup="true"
                x-bind:aria-expanded="open"
            >
                <span>{{ $this->perPage === -1 ? __($localisationPath.'All') : $this->perPage }}</span>

                <svg class="size-3.5 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
        </vibe:dropdown.trigger>

        <vibe:dropdown.body align="right" width="min">
            <div class="flex flex-col gap-0.5 min-w-18">
                @foreach ($this->getPerPageAccepted() as $item)
                    @php($isCurrent = (int)$this->perPage === (int)$item)
                    <button
                        type="button"
                        wire:click="$set('perPage', {{ $item }})"
                        @click="close()"
                        class="w-full text-center px-3 py-1.5 text-xs rounded-lg transition-colors cursor-pointer select-none {{ $isCurrent ? 'bg-accent text-accent-foreground font-semibold' : 'text-popover-foreground hover:bg-muted/70 font-medium' }}"
                    >
                        {{ $item === -1 ? __($localisationPath.'All') : $item }}
                    </button>
                @endforeach
            </div>
        </vibe:dropdown.body>
    </vibe:dropdown>
</div>
