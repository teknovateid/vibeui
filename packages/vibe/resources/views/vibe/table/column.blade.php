@blaze(fold: true)

@props([
    'align' => 'left', // left, center, right
    'sortable' => false,
    'sorted' => false,
    'direction' => null, // asc, desc
])

@php
    $alignClasses = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };

    $baseClasses = 'font-semibold text-foreground select-none transition-colors whitespace-nowrap';
    $sortableClasses = $sortable ? 'group/col hover:text-foreground/90 cursor-pointer' : '';

    $compiledClasses = trim("{$baseClasses} {$alignClasses} {$sortableClasses}");
    $initialState = ($sorted && $direction === 'asc') ? 'asc' : (($sorted && $direction === 'desc') ? 'desc' : 'neutral');
@endphp

<th 
    @if ($sortable)
        data-sortable="true"
        @if ($sorted && $direction)
            aria-sort="{{ $direction === 'asc' ? 'ascending' : 'descending' }}"
            data-sort-direction="{{ $direction }}"
        @endif
    @endif
    {{ $attributes->twMerge(['class' => $compiledClasses]) }}
>
    @if ($sortable)
        <button 
            type="button"
            onclick="window.vibeSortTable(this)"
            class="inline-flex items-center gap-1.5 w-full font-semibold text-foreground select-none cursor-pointer group/col hover:text-foreground/90 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring rounded-sm {{ $align === 'center' ? 'justify-center' : ($align === 'right' ? 'justify-end' : 'justify-start') }}"
        >
            <span>{{ $slot }}</span>
            <span class="inline-flex shrink-0">
                {{-- Ascending Icon --}}
                <svg data-sort-icon="asc" @if($initialState !== 'asc') style="display: none;" @endif class="size-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 15l-7-6-7 6"/>
                </svg>

                {{-- Descending Icon --}}
                <svg data-sort-icon="desc" @if($initialState !== 'desc') style="display: none;" @endif class="size-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 9l-7 6-7-6"/>
                </svg>

                {{-- Neutral Sortable Icon --}}
                <svg data-sort-icon="neutral" @if($initialState !== 'neutral') style="display: none;" @endif class="size-3.5 text-muted-foreground/40 group-hover/col:text-muted-foreground transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 9.5l-4-4-4 4M8 14.5l4 4 4-4"/>
                </svg>
            </span>
        </button>
    @else
        {{ $slot }}
    @endif
</th>
