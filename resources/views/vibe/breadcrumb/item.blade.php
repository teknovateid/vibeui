@blaze(fold: true)

@aware([
    'separator' => 'chevron',
])

@props([
    'href' => null,
    'active' => false,
    'wrapperClass' => null,
    'separator' => null,
])

@php
    $linkClasses = 'inline-flex items-center gap-1.5 transition-colors hover:text-foreground focus:outline-none focus:underline ' . ($active ? 'text-foreground font-semibold' : '');
    $spanClasses = 'inline-flex items-center gap-1.5 ' . ($active ? 'text-foreground font-semibold' : 'text-muted-foreground');

    $isSeparatorSlot = isset($separator) && $separator instanceof \Illuminate\View\ComponentSlot && $separator->isNotEmpty();
    $separatorType = is_string($separator) ? trim($separator) : 'chevron';
@endphp

<li @class(['inline-flex items-center gap-2 sm:gap-2.5 group shrink-0 whitespace-nowrap', $wrapperClass])>
    <span class="breadcrumb-separator text-muted-foreground/60 shrink-0 group-first:hidden flex items-center justify-center" aria-hidden="true">
        @if ($isSeparatorSlot)
            {{ $separator }}
        @elseif ($separatorType === 'slash' || $separatorType === '/')
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 rtl:-scale-x-100"><path d="m16 4-8 16"/></svg>
        @elseif ($separatorType === 'arrow' || $separatorType === '->' || $separatorType === '-->')
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 rtl:rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        @elseif ($separatorType === 'dot' || $separatorType === 'bullet' || $separatorType === '•')
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="w-1.5 h-1.5"><circle cx="12" cy="12" r="4"/></svg>
        @elseif (str_starts_with($separatorType, '<'))
            {!! $separator !!}
        @elseif ($separatorType === 'chevron' || $separatorType === '>')
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 rtl:rotate-180"><path d="m9 18 6-6-6-6"/></svg>
        @else
            <span class="text-xs select-none leading-none">{{ $separator }}</span>
        @endif
    </span>

    @if($href)
        <a wire:navigate href="{{ $href }}" @if($active) aria-current="page" @endif {{ $attributes->twMerge(['class' => $linkClasses]) }}>
            {{ $slot }}
        </a>
    @else
        <span @if($active) aria-current="page" @endif {{ $attributes->twMerge(['class' => $spanClasses]) }}>
            {{ $slot }}
        </span>
    @endif
</li>
