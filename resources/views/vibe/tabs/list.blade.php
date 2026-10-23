@blaze(fold: true)

@props([
    'fitted' => false,
    'grow' => false,
    'footer' => null,
    'mobileTitle' => null,
])

@php
    $isFitted = $fitted || $grow;
    $resolvedMobileTitle = $mobileTitle ?? __('vibe/tabs.mobile_title');
@endphp

<div
    {{ $attributes->twMerge([
        'class' => 'vibe-tabs-list select-none hide-scroll relative',
    ]) }}
    :class="{
        'inline-flex items-center gap-1 p-1 bg-muted rounded-xl border border-border/40 max-w-full overflow-x-auto hide-scroll snap-x': layout === 'rows' && variant === 'pill',
        'flex items-center gap-6 border-b border-border w-full overflow-x-auto hide-scroll snap-x': layout === 'rows' && variant === 'underline',
        'flex flex-wrap items-center gap-2 w-full': layout === 'rows' && variant === 'button',
        'flex flex-row md:flex-col overflow-x-auto md:overflow-visible hide-scroll gap-1 p-1.5 bg-muted rounded-xl border border-border/40 w-full md:w-60 shrink-0': layout === 'cols' && variant === 'pill',
        'flex flex-row md:flex-col overflow-x-auto md:overflow-visible hide-scroll border-b md:border-b-0 md:border-r border-border w-full md:w-60 shrink-0': layout === 'cols' && variant === 'underline',
        'flex flex-row md:flex-col overflow-x-auto md:overflow-visible hide-scroll gap-2 w-full md:w-60 shrink-0': layout === 'cols' && variant === 'button',
        'flex flex-row md:flex-col overflow-x-auto md:overflow-visible hide-scroll border-b md:border-b-0 md:border-r border-border w-full md:w-60 shrink-0 self-stretch p-2 md:p-3.5 gap-1.5 md:gap-1': variant === 'sidebar',
        '*:flex-1 w-full': {{ $isFitted ? 'true' : 'false' }},
    }"
>
    {{-- 1. Mobile Collapsible Trigger (Sleek Vibe UI Selector Bar) --}}
    <div
        x-show="mobileMode === 'collapsible'"
        class="flex md:hidden items-center justify-between w-full"
        :class="{ 'pb-2.5 border-b border-border/50': mobileOpen }"
    >
        <button
            type="button"
            @click="mobileOpen = !mobileOpen"
            :aria-expanded="mobileOpen"
            class="group w-full flex items-center justify-between px-3.5 py-2.5 min-h-10 rounded-xl border border-border/80 bg-card hover:bg-muted/40 text-foreground shadow-2xs hover:border-border transition-all duration-150 active:scale-[0.99] focus:outline-none focus-visible:ring-2 focus-visible:ring-ring"
        >
            <div class="flex items-center gap-2.5 min-w-0">
                <template x-if="activeIconHtml">
                    <span class="size-4 shrink-0 inline-flex items-center justify-center text-primary [&>svg]:size-4 [&>svg]:shrink-0" x-html="activeIconHtml"></span>
                </template>
                <template x-if="!activeIconHtml">
                    <span class="size-4 shrink-0 inline-flex items-center justify-center text-muted-foreground">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="7" height="7" x="3" y="3" rx="1.5"/>
                            <rect width="7" height="7" x="14" y="3" rx="1.5"/>
                            <rect width="7" height="7" x="14" y="14" rx="1.5"/>
                            <rect width="7" height="7" x="3" y="14" rx="1.5"/>
                        </svg>
                    </span>
                </template>

                <span x-text="activeLabel || activeTab || @js($resolvedMobileTitle)" class="truncate font-semibold text-sm text-foreground"></span>

                <template x-if="activeBadgeHtml">
                    <span class="inline-flex shrink-0 [&_.vibe-badge]:h-4 [&_.vibe-badge]:px-1.5 [&_.vibe-badge]:text-[10px]" x-html="activeBadgeHtml"></span>
                </template>
            </div>

            <div class="flex items-center gap-1.5 shrink-0 ml-2">
                <span class="size-6 rounded-lg bg-muted/60 border border-border/50 flex items-center justify-center group-hover:bg-muted group-hover:border-border transition-all">
                    <svg
                        class="size-3.5 text-muted-foreground group-hover:text-foreground transition-transform duration-200"
                        :class="{ 'rotate-180': mobileOpen }"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    >
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </span>
            </div>
        </button>
    </div>

    {{-- 2. Daftar Item Tab --}}
    <div
        role="tablist"
        :aria-orientation="layout === 'cols' ? 'vertical' : 'horizontal'"
        @keydown.right.prevent="if (layout === 'rows') focusNextTab($event, 1)"
        @keydown.left.prevent="if (layout === 'rows') focusNextTab($event, -1)"
        @keydown.down.prevent="if (layout === 'cols') focusNextTab($event, 1)"
        @keydown.up.prevent="if (layout === 'cols') focusNextTab($event, -1)"
        @keydown.home.prevent="focusFirstTab()"
        @keydown.end.prevent="focusLastTab()"
        class="contents md:contents"
        :class="{
            'max-md:hidden': mobileMode === 'collapsible' && !mobileOpen,
            'max-md:flex max-md:flex-col max-md:gap-0.5 max-md:w-full max-md:pt-2': mobileMode === 'collapsible' && mobileOpen,
        }"
    >
        {{ $slot }}

        {{-- Slot Footer di dalam Collapsible Mobile agar ikut tersembunyi saat menu ditutup --}}
        @if (isset($footer))
            <div
                x-show="mobileMode !== 'scroll'"
                class="mt-2 pt-2 border-t border-border/40 md:hidden"
            >
                {{ $footer }}
            </div>
        @endif
    </div>

    {{-- 3. Footer Desktop (Hanya tampil di Desktop >= md agar tidak double di mobile) --}}
    @if (isset($footer))
        <div class="hidden md:block mt-auto p-3 border-t border-border/40">
            {{ $footer }}
        </div>
    @endif
</div>
