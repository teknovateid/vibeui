@blaze(fold: true)

@props([
    'type' => 'single', // 'single' | 'multiple'
    'collapsible' => true, // Pada mode single, apakah item yang sedang aktif bisa ditutup kembali
    'selected' => null, // Item yang terbuka di awal (string untuk single, string|array untuk multiple)
    'value' => null, // Alias untuk selected
    'default' => null, // Alias untuk selected
    'variant' => 'default', // 'default' | 'separated' | 'card' | 'flush' | 'filled' | 'muted'
    'size' => 'md', // 'sm' | 'md' | 'lg'
    'chevron' => true, // Tampilkan chevron icon
    'chevronPosition' => 'right', // 'right' | 'left'
    'disabled' => false,
    'id' => null,
])

@php
    $accId = $id ?? uniqid('accordion-');
    $initialRaw = $selected ?? $value ?? $default;

    if ($type === 'multiple') {
        $initialSelected = is_array($initialRaw) ? $initialRaw : ($initialRaw !== null && $initialRaw !== '' ? [$initialRaw] : []);
    } else {
        $initialSelected = is_array($initialRaw) ? ($initialRaw[0] ?? null) : $initialRaw;
    }

    $variantClasses = match ($variant) {
        'separated', 'card' => 'space-y-3',
        'flush' => 'divide-y divide-border border-b border-border',
        'filled', 'muted' => 'divide-y divide-border/60 bg-muted/35 rounded-2xl border border-border/70 overflow-hidden',
        default => 'divide-y divide-border rounded-2xl border border-border bg-card overflow-hidden shadow-2xs',
    };
@endphp

<div
    id="{{ $accId }}"
    data-vibe-accordion
    x-data="{
        type: '{{ $type }}',
        collapsible: {{ $collapsible ? 'true' : 'false' }},
        selected: @js($initialSelected),
        variant: '{{ $variant }}',
        size: '{{ $size }}',
        chevron: {{ $chevron ? 'true' : 'false' }},
        chevronPosition: '{{ $chevronPosition }}',
        accordionDisabled: {{ $disabled ? 'true' : 'false' }},

        isOpen(val) {
            if (this.type === 'multiple') {
                return Array.isArray(this.selected) && this.selected.includes(val);
            }
            return this.selected === val;
        },

        toggle(val, itemDisabled = false) {
            if (this.accordionDisabled || itemDisabled) return;

            if (this.type === 'multiple') {
                if (!Array.isArray(this.selected)) {
                    this.selected = this.selected ? [this.selected] : [];
                }
                const idx = this.selected.indexOf(val);
                if (idx > -1) {
                    this.selected.splice(idx, 1);
                } else {
                    this.selected.push(val);
                }
            } else {
                if (this.selected === val) {
                    if (this.collapsible) {
                        this.selected = null;
                    }
                } else {
                    this.selected = val;
                }
            }

            this.$dispatch('accordion-change', { 
                value: this.selected, 
                toggled: val,
                isOpen: this.isOpen(val) 
            });
        }
    }"
    {{ $attributes->twMerge(['class' => 'w-full ' . $variantClasses]) }}
>
    {{ $slot }}
</div>
