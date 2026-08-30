@blaze(fold: true)

@props([
    'href' => '#',
    'active' => false,
    'badge' => null,
    'badgeColor' => 'vibe',
    'collapsed' => false,
    'pinnable' => false,
    'id' => null,
])

@php
    $itemId = $id ?? Str::slug(strip_tags($slot));
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:px-0 data-[collapsed=true]:justify-center data-[collapsed=true]:mx-auto group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto group-data-[state=minified]/sheet:overflow-visible';
    $baseClasses = "flex items-center min-h-9 px-3 py-2 rounded-lg text-sm font-medium w-full relative group/nav-item $minifiedClasses";
    $activeClasses = $active ? 'bg-accent text-accent-foreground font-semibold' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground';

    $badgeClasses = match ($badgeColor) {
        'green', 'success' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20',
        'blue', 'info' => 'bg-sky-500/15 text-sky-700 dark:text-sky-400 border border-sky-500/20',
        'red', 'danger', 'destructive' => 'bg-red-500/15 text-red-700 dark:text-red-400 border border-red-500/20',
        'yellow', 'warning' => 'bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/20',
        'accent' => 'bg-accent text-accent-foreground border border-accent-foreground/20 font-semibold',
        default => 'bg-secondary text-secondary-foreground',
    };
@endphp

<a wire:navigate href="{{ $href }}" @click="if ($event.target.closest('[data-nav-pin-btn]')) { $event.preventDefault(); $event.stopPropagation(); return false; }" @if ($collapsed) data-collapsed="true" @endif data-nav-pin-id="{{ $itemId }}" data-pin-type="item" data-pin-title="{{ strip_tags($slot) }}" data-pin-href="{{ $href }}" x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[width,height,padding,margin] duration-300'" {{ $attributes->twMerge(['class' => "$baseClasses $activeClasses"]) }}>

    <!-- Icon -->
    @if (isset($icon))
        <span data-pin-icon class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-foreground' : 'text-muted-foreground group-hover/nav-item:text-foreground' }}">
            {{ $icon }}
        </span>
    @endif

    <!-- Animated Wrapper for Label & Badge -->
    <div :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[max-width,opacity,margin] duration-300 ease-in-out'" class="flex flex-1 min-w-0 w-full items-center justify-between overflow-hidden {{ $collapsed ? 'max-w-0 opacity-0 ml-0 hidden' : 'max-w-[100vw] opacity-100 ml-3' }} group-data-[collapsed=true]/nav-item:hidden group-data-[state=minified]/sheet:hidden">
        <!-- Label -->
        <span class="whitespace-nowrap truncate">
            {{ $slot }}
        </span>

        <div class="flex items-center gap-2 shrink-0 ml-auto">
            <!-- Badge -->
            @if ($badge)
                <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-semibold rounded {{ $badgeClasses }}">
                    {{ $badge }}
                </span>
            @endif

            {{-- Pin button: visible when parent nav has pinnable OR this item has pinnable prop, but NEVER when inside a group --}}
            <div 
                data-nav-pin-btn
                data-pinned="false"
                :data-pinned="typeof isPinned !== 'undefined' && isPinned('{{ $itemId }}') ? 'true' : 'false'"
                x-show="(! (typeof isGroupChild !== 'undefined' && isGroupChild)) && ((typeof pinnable !== 'undefined' && pinnable) || {{ $pinnable ? 'true' : 'false' }})" 
                @click.stop.prevent="if(typeof togglePin !== 'undefined') togglePin('{{ $itemId }}')" 
                class="inline-flex items-center justify-center size-6 rounded hover:bg-accent hover:text-accent-foreground transition-colors cursor-pointer text-muted-foreground opacity-0 group-hover/nav-item:opacity-100 group-hover/nav-item:text-foreground data-[pinned=true]:text-foreground data-[pinned=true]:opacity-100" 
                style="display:none" 
                title="Pin"
            >
                <!-- Pinned Icon -->
                <svg class="size-3 pin-icon-pinned pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                    <path d="M0 0h16v16H0z" fill="none" />
                    <path fill="currentColor" d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479c-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A6 6 0 0 1 5 6.708V2.277a3 3 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354" />
                </svg>

                <!-- Unpinned Icon -->
                <svg class="size-3 pin-icon-unpinned pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                    <path d="M0 0h16v16H0z" fill="none" />
                    <path fill="currentColor" d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479c-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A6 6 0 0 1 5 6.708V2.277a3 3 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354m1.58 1.408l-.002-.001zm-.002-.001l.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007l-.054.03a5 5 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a5 5 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458a1.8 1.8 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14q.091.15.214.271a1.8 1.8 0 0 0 .37.282" />
                </svg>
            </div>
        </div>
    </div>
</a>
