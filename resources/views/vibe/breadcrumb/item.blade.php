@blaze(fold: true)

@props([
    'href' => null,
    'active' => false,
])

<li class="inline-flex items-center gap-2 sm:gap-2.5 group">
    <span class="breadcrumb-separator text-muted-foreground/60 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 rtl:rotate-180"><path d="m9 18 6-6-6-6"/></svg>
    </span>

    @if($href)
        <a wire:navigate href="{{ $href }}" class="inline-flex items-center gap-1.5 transition-colors hover:text-foreground focus:outline-none focus:underline {{ $active ? 'text-foreground font-semibold' : '' }}">
            {{ $slot }}
        </a>
    @else
        <span class="inline-flex items-center gap-1.5 {{ $active ? 'text-foreground font-semibold' : 'text-muted-foreground' }}">
            {{ $slot }}
        </span>
    @endif
</li>
