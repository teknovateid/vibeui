@blaze

@props([
    'href' => null,
    'depth' => 1, // 1 for h2, 2 for h3, 3 for h4
    'active' => false,
])

@php
    $targetId = ltrim($href ?? '', '#');
    $depthClasses = match ((int)$depth) {
        2 => 'pl-5 text-[11.5px]',
        3 => 'pl-8 text-[11px]',
        default => 'pl-3 text-xs',
    };
@endphp

<li class="relative">
    <a 
        href="{{ $href }}" 
        data-toc-href="{{ $targetId }}"
        @click="scrollTo('{{ $targetId }}', $event)"
        :class="activeId === '{{ $targetId }}' 
            ? 'text-card-foreground font-semibold border-primary' 
            : 'text-muted-foreground hover:text-card-foreground hover:border-border border-transparent'"
        {{ $attributes->twMerge(['class' => 'group flex items-center py-1 transition-all duration-150 border-l-2 -ml-px ' . $depthClasses . ($active ? ' text-card-foreground font-semibold border-primary' : ' text-muted-foreground border-transparent')]) }}
    >
        <span class="truncate leading-relaxed">{{ $slot }}</span>
    </a>
</li>
