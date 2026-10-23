@blaze(fold: true)

@props([
    'fitted' => false,
    'grow' => false,
    'footer' => null,
    'mobileTitle' => 'Menu Navigasi',
])

@php
    $isFitted = $fitted || $grow;
@endphp

<div
    {{ $attributes->twMerge([
        'class' => 'vibe-tabs-list select-none scrollbar-none relative',
    ]) }}
    :class="{
        'inline-flex items-center gap-1 p-1 bg-muted rounded-xl border border-border/40 max-w-full overflow-x-auto no-scrollbar snap-x': layout === 'rows' && variant === 'pill',
        'flex items-center gap-6 border-b border-border w-full overflow-x-auto no-scrollbar snap-x': layout === 'rows' && variant === 'underline',
        'flex flex-wrap items-center gap-2 w-full': layout === 'rows' && variant === 'button',
        'flex flex-col gap-1 p-1.5 bg-muted rounded-xl border border-border/40 w-full md:w-60 shrink-0': layout === 'cols' && variant === 'pill',
        'flex flex-col border-r border-border w-full md:w-60 shrink-0': layout === 'cols' && variant === 'underline',
        'flex flex-col gap-2 w-full md:w-60 shrink-0': layout === 'cols' && variant === 'button',
        'flex flex-col border-b md:border-b-0 md:border-r border-border w-full md:w-60 shrink-0 self-stretch p-3.5 gap-1': variant === 'sidebar',
        '*:flex-1 w-full': {{ $isFitted ? 'true' : 'false' }},
    }"
>
    {{-- 1. Mobile Collapsible Trigger (Hanya tampil di Mobile < md jika mode 'collapsible') --}}
    <div
        x-show="mobileMode === 'collapsible'"
        class="flex md:hidden items-center justify-between w-full pb-2 mb-2 border-b border-border/40"
    >
        <button
            type="button"
            @click="mobileOpen = !mobileOpen"
            :aria-expanded="mobileOpen"
            class="flex items-center justify-between w-full px-3.5 py-2.5 text-sm font-medium rounded-xl border border-input bg-card text-foreground shadow-2xs transition-all active:scale-[0.99]"
        >
            <div class="flex items-center gap-2.5 truncate">
                <span class="size-2 rounded-full bg-primary shrink-0"></span>
                <span x-text="activeLabel || activeTab || '{{ $mobileTitle }}'" class="truncate font-semibold"></span>
            </div>

            <div class="flex items-center gap-1.5 text-xs text-muted-foreground shrink-0 ml-2">
                <span x-text="mobileOpen ? 'Tutup' : 'Menu'" class="text-[11px] font-medium"></span>
                <svg
                    class="size-4 transition-transform duration-200"
                    :class="{ 'rotate-180': mobileOpen }"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                >
                    <path d="m6 9 6 6 6-6"/>
                </svg>
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
            'max-md:flex max-md:flex-col max-md:gap-1 max-md:w-full': mobileMode === 'collapsible' && mobileOpen,
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
