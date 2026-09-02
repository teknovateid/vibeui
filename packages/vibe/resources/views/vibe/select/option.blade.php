@blaze(fold: true)

@props([
    'value',
    'label' => null,
    'description' => null,
    'icon' => null,
    'avatar' => null,
    'disabled' => false,
])

@php
    $slotContent = $slot->isNotEmpty() ? trim($slot) : null;
    $cleanSlot = $slotContent ? trim(preg_replace('/blaze_placeholder_\d+_?/', '', strip_tags($slotContent))) : null;
    $effectiveLabel = $label ?? ($cleanSlot ?: (string)$value);
@endphp

<div
    role="option"
    tabindex="-1"
    data-select-option="true"
    data-value="{{ $value }}"
    data-label="{{ $effectiveLabel }}"
    data-avatar="{{ $avatar ?? '' }}"
    data-icon="{{ $icon ?? '' }}"
    data-description="{{ $description ?? '' }}"
    x-show="!search || $el.innerText.toLowerCase().includes(search.toLowerCase().trim()) || '{{ strtolower(addslashes($value)) }}'.includes(search.toLowerCase().trim())"
    @if(!$disabled)
        @click="select('{{ addslashes($value) }}', '{{ addslashes($effectiveLabel) }}', '{{ addslashes($avatar ?? '') }}', '{{ addslashes($icon ?? '') }}', '{{ addslashes($description ?? '') }}')"
        @keydown.enter.prevent="select('{{ addslashes($value) }}', '{{ addslashes($effectiveLabel) }}', '{{ addslashes($avatar ?? '') }}', '{{ addslashes($icon ?? '') }}', '{{ addslashes($description ?? '') }}')"
        @keydown.space.prevent="select('{{ addslashes($value) }}', '{{ addslashes($effectiveLabel) }}', '{{ addslashes($avatar ?? '') }}', '{{ addslashes($icon ?? '') }}', '{{ addslashes($description ?? '') }}')"
    @endif
    :aria-selected="value == '{{ addslashes($value) }}'"
    @class([
        'relative flex items-center gap-2.5 w-full px-2.5 py-1.5 text-xs rounded-lg select-none transition-colors group focus:outline-none',
        'opacity-40 cursor-not-allowed pointer-events-none' => $disabled,
        'cursor-pointer focus:bg-accent focus:text-accent-foreground' => !$disabled,
    ])
    :class="{
        'bg-accent text-accent-foreground font-medium': value == '{{ addslashes($value) }}',
        'text-popover-foreground hover:bg-muted/60': value != '{{ addslashes($value) }}' && !{{ $disabled ? 'true' : 'false' }}
    }"
>
    {{-- Left Avatar or Icon --}}
    @if ($avatar)
        <img 
            src="{{ $avatar }}" 
            class="size-6 rounded-full object-cover shrink-0 border border-border/60" 
            alt="{{ $effectiveLabel }}"
        />
    @elseif ($icon)
        <span class="size-4 shrink-0 flex items-center justify-center [&>svg]:size-4 text-muted-foreground group-hover:text-foreground transition-colors">
            {!! $icon !!}
        </span>
    @endif

    {{-- Center Content: Title & Description --}}
    <div class="flex-1 min-w-0 text-left">
        <span class="block truncate font-medium">
            {{ $slotContent ? $slot : $effectiveLabel }}
        </span>

        @if ($description)
            <span class="block text-[11px] text-muted-foreground font-normal leading-snug truncate">
                {{ $description }}
            </span>
        @endif
    </div>

    {{-- Right Checkmark Indicator --}}
    <div 
        x-cloak 
        x-show="value == '{{ addslashes($value) }}'" 
        class="shrink-0 text-primary flex items-center"
    >
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12" />
        </svg>
    </div>
</div>
