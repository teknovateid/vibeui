@blaze(fold: true)

@props([
    'href' => '#',
    'active' => false,
    'badge' => null,
    'badgeColor' => 'vibe',
    'collapsed' => false,
])

@php
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:px-0 data-[collapsed=true]:justify-center data-[collapsed=true]:mx-auto group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto';
    $baseClasses = "flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-[width,height,padding,margin] duration-300 w-full relative overflow-hidden group/nav-item $minifiedClasses";
    $activeClasses = $active 
        ? 'bg-vibe-200 dark:bg-vibe-800' 
        : 'text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-black dark:hover:text-white';

    $badgeClasses = match($badgeColor) {
        'green' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
        'blue' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
        'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
        'yellow' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
        default => 'bg-vibe-100 text-vibe-700 dark:bg-vibe-800 dark:text-vibe-300',
    };
@endphp

<a wire:navigate href="{{ $href }}" 
   @if($collapsed) data-collapsed="true" @endif 
   x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'"
   {{ $attributes->twMerge(['class' => "$baseClasses $activeClasses"]) }}>
    
    <!-- Icon -->
    @if (isset($icon))
        <span class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-vibe-900 dark:text-vibe-100' : 'text-vibe-500 group-hover/nav-item:text-vibe-900 dark:text-vibe-400 dark:group-hover/nav-item:text-vibe-200' }}">
            {{ $icon }}
        </span>
    @endif

    <!-- Animated Wrapper for Label & Badge -->
    <div class="flex flex-1 w-full items-center justify-between overflow-hidden transition-[max-width,opacity,margin] duration-300 ease-in-out {{ $collapsed ? 'max-w-0 opacity-0 ml-0' : 'max-w-[100vw] opacity-100 ml-3' }} group-data-[collapsed=true]/nav-item:max-w-0 group-data-[collapsed=true]/nav-item:opacity-0 group-data-[collapsed=true]/nav-item:ml-0 group-data-[state=minified]/sheet:max-w-0 group-data-[state=minified]/sheet:opacity-0 group-data-[state=minified]/sheet:ml-0">
        <!-- Label -->
        <span class="whitespace-nowrap">
            {{ $slot }}
        </span>

        <!-- Badge -->
        @if ($badge)
            <span class="shrink-0 ml-2 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-semibold rounded {{ $badgeClasses }}">
                {{ $badge }}
            </span>
        @endif
    </div>
</a>
