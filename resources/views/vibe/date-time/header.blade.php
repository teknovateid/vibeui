
<div class="flex items-center justify-between px-3.5 py-2.5 border-b border-border/70 select-none">
    {{-- Month & Year Fast Jump Title --}}
    <div class="flex items-center gap-1.5 font-semibold text-sm">
        <template x-if="viewMode === 'days'">
            <div class="flex items-center gap-1">
                <vibe:button
                    type="button"
                    variant="ghost"
                    size="xs"
                    @click="toggleViewMode('months')"
                    class="px-2 py-1 text-foreground font-semibold flex items-center gap-1 h-7"
                >
                    <span x-text="dict.months[currentMonth]"></span>
                    <svg class="size-3 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </vibe:button>
                <vibe:button
                    type="button"
                    variant="ghost"
                    size="xs"
                    @click="toggleViewMode('years')"
                    class="px-2 py-1 text-foreground font-semibold flex items-center gap-1 h-7"
                >
                    <span x-text="currentYear"></span>
                    <svg class="size-3 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </vibe:button>
            </div>
        </template>

        <template x-if="viewMode === 'months'">
            <vibe:button
                type="button"
                variant="ghost"
                size="xs"
                @click="toggleViewMode('years')"
                class="px-2 py-1 text-foreground font-semibold flex items-center gap-1.5 h-7"
            >
                <span x-text="currentYear"></span>
                <span class="text-xs font-normal text-muted-foreground" x-text="'(' + (dict.selectMonth || '{{ __('vibe/date-time.selectMonth', [], $resolvedLocale) }}') + ')'"></span>
                <svg class="size-3 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </vibe:button>
        </template>

        <template x-if="viewMode === 'years'">
            <div class="px-2 py-1 text-foreground font-semibold flex items-center gap-1">
                <span x-text="yearsStart + ' — ' + (yearsStart + 11)"></span>
                <span class="text-xs font-normal text-muted-foreground" x-text="'(' + (dict.selectYear || '{{ __('vibe/date-time.selectYear', [], $resolvedLocale) }}') + ')'"></span>
            </div>
        </template>
    </div>

    {{-- Navigation Prev / Next Arrows --}}
    <div class="flex items-center gap-1">
        <vibe:button
            type="button"
            variant="ghost"
            size="icon-xs"
            @click="viewMode === 'days' ? prevMonth() : (viewMode === 'months' ? currentYear-- : prevDecade())"
            class="size-7 rounded-lg text-muted-foreground hover:text-foreground"
            x-bind:disabled="viewMode === 'days' && !canPrevMonth()"
            x-bind:class="{ 'opacity-25 cursor-not-allowed pointer-events-none': viewMode === 'days' && !canPrevMonth() }"
            x-bind:title="dict.previous"
            x-bind:aria-label="dict.previous"
        >
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </vibe:button>

        <vibe:button
            type="button"
            variant="ghost"
            size="icon-xs"
            @click="viewMode === 'days' ? nextMonth() : (viewMode === 'months' ? currentYear++ : nextDecade())"
            class="size-7 rounded-lg text-muted-foreground hover:text-foreground"
            x-bind:disabled="viewMode === 'days' && !canNextMonth()"
            x-bind:class="{ 'opacity-25 cursor-not-allowed pointer-events-none': viewMode === 'days' && !canNextMonth() }"
            x-bind:title="dict.next"
            x-bind:aria-label="dict.next"
        >
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"/>
            </svg>
        </vibe:button>
    </div>
</div>
