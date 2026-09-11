@blaze(fold: true)

@props([
    'value' => null,
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'badge' => null,
    'badgeVariant' => 'secondary',
    'disabled' => false,
    'open' => false,
    'id' => null,
])

@php
    $itemValue = (string) ($value ?? uniqid('item-'));
    $itemId = $id ?? 'accordion-item-' . $itemValue;
@endphp

<div
    id="{{ $itemId }}"
    data-vibe-accordion-item
    x-data="{
        itemValue: '{{ $itemValue }}',
        itemDisabled: {{ $disabled ? 'true' : 'false' }},
        init() {
            if ({{ $open ? 'true' : 'false' }}) {
                if (this.type === 'multiple') {
                    if (!this.selected.includes(this.itemValue)) {
                        this.selected.push(this.itemValue);
                    }
                } else if (!this.selected) {
                    this.selected = this.itemValue;
                }
            }
        }
    }"
    :class="{
        'rounded-xl border border-border bg-card shadow-2xs transition-all duration-200': variant === 'separated' || variant === 'card',
        'border-primary/40 ring-1 ring-primary/20 shadow-xs': (variant === 'separated' || variant === 'card') && isOpen(itemValue),
        'opacity-60 pointer-events-none select-none': accordionDisabled || itemDisabled
    }"
    {{ $attributes->twMerge(['class' => 'group/item w-full relative transition-colors']) }}
>
    @if ($title)
        <vibe:accordion.heading
            :icon="$icon"
            :badge="$badge"
            :badgeVariant="$badgeVariant"
            :subtitle="$subtitle"
        >
            {{ $title }}
        </vibe:accordion.heading>

        <vibe:accordion.content>
            {{ $slot }}
        </vibe:accordion.content>
    @else
        {{ $slot }}
    @endif
</div>
