@blaze(fold: true)

@props([
    'title',
    'active' => false,
    'open' => false,
])

@php
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:mx-auto data-[collapsed=true]:justify-center data-[collapsed=true]:px-0 group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto';
    $baseClasses = "flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-[width,height,padding,margin] duration-300 w-full relative overflow-hidden group/nav-item cursor-pointer select-none outline-none focus-visible:ring-2 focus-visible:ring-vibe-500 $minifiedClasses";
    $activeClasses = $active 
        ? 'bg-vibe-200 dark:bg-vibe-800'
        : 'text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-black dark:hover:text-white';
@endphp

<div x-data="{ open: {{ $active || $open ? 'true' : 'false' }} }" class="w-full flex flex-col gap-1">
    <button @click="open = !open" 
            x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'"
            type="button" 
            {{ $attributes->twMerge(['class' => "$baseClasses $activeClasses"]) }}>
        
        <!-- Icon -->
        @if (isset($icon))
            <span class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-vibe-900 dark:text-vibe-100' : 'text-vibe-500 group-hover/nav-item:text-vibe-900 dark:text-vibe-400 dark:group-hover/nav-item:text-vibe-200' }}">
                {{ $icon }}
            </span>
        @endif

        
        <div class="flex flex-1 gap-2 w-full items-center justify-between overflow-hidden transition-[max-width,opacity,margin] duration-300 ease-in-out max-w-[100vw] opacity-100 ml-3 group-data-[collapsed=true]/nav-item:max-w-0 group-data-[collapsed=true]/nav-item:opacity-0 group-data-[collapsed=true]/nav-item:ml-0 group-data-[state=minified]/sheet:max-w-0 group-data-[state=minified]/sheet:opacity-0 group-data-[state=minified]/sheet:ml-0">
            <span class="whitespace-nowrap">
                {{ $title }}
            </span>

            <!-- Chevron -->
            <span class="shrink-0 ml-auto transition-transform duration-300 {{ $active || $open ? 'rotate-90' : '' }}" :class="open ? 'rotate-90' : ''">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-vibe-400 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-300">
                    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                </svg> --}}
                <svg class="size-4 text-vibe-400 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5" class="solar solar-alt-arrow-right-outline"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.51192 4.43057C8.82641 4.161 9.29989 4.19743 9.56946 4.51192L15.5695 11.5119C15.8102 11.7928 15.8102 12.2072 15.5695 12.4881L9.56946 19.4881C9.29989 19.8026 8.82641 19.839 8.51192 19.5695C8.19743 19.2999 8.161 18.8264 8.43057 18.5119L14.0122 12L8.43057 5.48811C8.161 5.17361 8.19743 4.70014 8.51192 4.43057Z" fill="currentColor"/></svg>
            </span>
        </div>
    </button>

    
    <div class="grid transition-[grid-template-rows] duration-300 ease-in-out {{ $active || $open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]' }} data-[collapsed=true]:!hidden group-data-[state=minified]/sheet:!hidden" 
         x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'"
         :class="open ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
        <div class="overflow-hidden">
            <div class="flex flex-col gap-1 mt-1">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
