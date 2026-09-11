@blaze(fold: true)

@props([
    'icon' => null,
    'badge' => null,
    'badgeVariant' => 'secondary',
    'subtitle' => null,
    'tag' => 'h3',
])

<{{ $tag }} class="m-0 p-0 font-normal">
    <button
        type="button"
        @click="toggle(itemValue, itemDisabled)"
        :disabled="accordionDisabled || itemDisabled"
        :aria-expanded="isOpen(itemValue)"
        :aria-controls="'accordion-content-' + itemValue"
        :id="'accordion-trigger-' + itemValue"
        :class="{
            'py-2.5 px-3.5 text-xs gap-2.5': size === 'sm',
            'py-4 px-5 text-base gap-3.5': size === 'lg',
            'py-3.5 px-4 text-sm gap-3': size !== 'sm' && size !== 'lg',
            'flex-row-reverse': chevronPosition === 'left',
            'cursor-not-allowed opacity-50': accordionDisabled || itemDisabled,
            'cursor-pointer hover:bg-accent/40 text-foreground': !accordionDisabled && !itemDisabled
        }"
        {{ $attributes->twMerge([
            'class' => 'w-full flex items-center justify-between text-left font-medium transition-all duration-200 select-none focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring/50 focus-visible:ring-offset-1'
        ]) }}
    >
        {{-- Left: Icon + Title/Subtitle Content --}}
        <div class="flex items-center gap-2.5 min-w-0 flex-1">
            {{-- Icon (Prop or Named Slot) --}}
            @if (isset($iconSlot))
                <div class="shrink-0 text-muted-foreground group-hover/item:text-foreground transition-colors">
                    {{ $iconSlot }}
                </div>
            @elseif ($icon)
                <div class="shrink-0 text-muted-foreground group-hover/item:text-foreground transition-colors">
                    {!! $icon !!}
                </div>
            @endif

            {{-- Title & Subtitle Wrapper --}}
            <div class="min-w-0 flex-1 flex flex-col">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="truncate font-semibold text-foreground group-hover/item:text-foreground transition-colors">
                        {{ $slot }}
                    </span>

                    {{-- Badge (Prop or Named Slot) --}}
                    @if (isset($badgeSlot))
                        {{ $badgeSlot }}
                    @elseif ($badge)
                        <vibe:badge :variant="$badgeVariant" size="xs" class="font-medium shrink-0">
                            {{ $badge }}
                        </vibe:badge>
                    @endif
                </div>

                @if ($subtitle)
                    <span class="text-xs text-muted-foreground font-normal mt-0.5 truncate">
                        {{ $subtitle }}
                    </span>
                @endif
            </div>
        </div>

        {{-- Right/Left: Animated Rotating Chevron Icon --}}
        <template x-if="chevron">
            <span
                class="shrink-0 text-muted-foreground transition-transform duration-200 ease-out"
                :class="{
                    'rotate-180 text-foreground': isOpen(itemValue),
                    'size-3.5': size === 'sm',
                    'size-4.5': size === 'lg',
                    'size-4': size !== 'sm' && size !== 'lg'
                }"
            >
                <svg class="size-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </span>
        </template>
    </button>
</{{ $tag }}>
