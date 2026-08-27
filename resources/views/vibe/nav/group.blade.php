@blaze(fold: true)

@props(['title', 'active' => false, 'open' => false, 'persist' => false, 'id' => null, 'pinnable' => false])

@php
    $groupId = $id ?? Str::slug($title);
    $gridId = 'nav-group-grid-' . Str::random(6);
    $chevronId = 'nav-group-chevron-' . Str::random(6);
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:mx-auto data-[collapsed=true]:justify-center data-[collapsed=true]:px-0 group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto';
    $baseClasses = "flex items-center px-3 py-2 rounded-lg text-sm font-medium w-full relative overflow-hidden group/nav-item cursor-pointer select-none outline-none focus-visible:ring-2 focus-visible:ring-vibe-500 $minifiedClasses";
    $activeClasses = $active ? 'bg-vibe-200 dark:bg-vibe-800' : 'text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-black dark:hover:text-white';
@endphp

<div x-data="(function() {
    var defaultOpen = {{ $active || $open ? 'true' : 'false' }};
    @if ($persist) try {
             var navKey = (window.VIBE_PREFIX || 'vibe') + '-nav';
             var state = JSON.parse(localStorage.getItem(navKey) || '{}');
             var groups = state.groups || {};
             if (groups['{{ $groupId }}'] !== undefined && !{{ $active ? 'true' : 'false' }}) {
                 defaultOpen = groups['{{ $groupId }}'];
             }
         } catch(e) {} @endif
    return {
        open: defaultOpen,
        ready: false,
        isGroupChild: true,
        init() {
            @if ($persist) 
                 let navKey = (window.VIBE_PREFIX || 'vibe') + '-nav';
                 if ({{ $active ? 'true' : 'false' }}) {
                     let state = JSON.parse(localStorage.getItem(navKey) || '{}');
                     if (!state.groups) state.groups = {};
                     state.groups['{{ $groupId }}'] = true;
                     localStorage.setItem(navKey, JSON.stringify(state));
                 }
                 this.$watch('open', val => {
                     let state = JSON.parse(localStorage.getItem(navKey) || '{}');
                     if (!state.groups) state.groups = {};
                     state.groups['{{ $groupId }}'] = val;
                     localStorage.setItem(navKey, JSON.stringify(state));
                 }); 
            @endif
            this.$nextTick(() => { this.ready = true; });
        }
    };
})()" data-nav-pin-id="{{ $groupId }}" data-pin-type="group" data-pin-title="{{ $title }}" class="w-full flex flex-col gap-1">
    <button @click="open = !open" x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" type="button" :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[width,height,padding,margin] duration-300'" {{ $attributes->twMerge(['class' => "$baseClasses $activeClasses"]) }}>

        <!-- Icon -->
        @if (isset($icon))
            <span data-pin-icon class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-vibe-900 dark:text-vibe-100' : 'text-vibe-500 group-hover/nav-item:text-vibe-900 dark:text-vibe-400 dark:group-hover/nav-item:text-vibe-200' }}">
                {{ $icon }}
            </span>
        @endif


        <div :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[max-width,opacity,margin] duration-300 ease-in-out'" class="flex flex-1 gap-2 w-full items-center justify-between overflow-hidden max-w-[100vw] opacity-100 ml-3 group-data-[collapsed=true]/nav-item:max-w-0 group-data-[collapsed=true]/nav-item:opacity-0 group-data-[collapsed=true]/nav-item:ml-0 group-data-[state=minified]/sheet:max-w-0 group-data-[state=minified]/sheet:opacity-0 group-data-[state=minified]/sheet:ml-0">
            <span class="whitespace-nowrap">
                {{ $title }}
            </span>

            <div class="flex items-center gap-1 shrink-0 ml-auto">
                {{-- Pin button: visible when parent nav has pinnable OR this group has pinnable prop --}}
                <div x-show="(typeof pinnable !== 'undefined' && pinnable) || {{ $pinnable ? 'true' : 'false' }}" @click.stop="if(typeof togglePin !== 'undefined') togglePin('{{ $groupId }}')" class="p-1 rounded hover:bg-black/10 dark:hover:bg-white/10 transition-all duration-150" :class="typeof isPinned !== 'undefined' && isPinned('{{ $groupId }}') ?
                    'text-vibe-900 dark:text-vibe-100 opacity-100' :
                    'text-vibe-400 opacity-0 group-hover/nav-item:opacity-100 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-400'" style="display:none" title="Pin">
                    
                    <!-- Pinned Icon: hidden by default, shown by Alpine when pinned -->
                    <svg x-show="typeof isPinned !== 'undefined' && isPinned('{{ $groupId }}')" style="display:none" class="size-3 xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                        <path d="M0 0h16v16H0z" fill="none" />
                        <path fill="currentColor" d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479c-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A6 6 0 0 1 5 6.708V2.277a3 3 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354" />
                    </svg>

                    <!-- Unpinned Icon: visible by default -->
                    <svg x-show="!(typeof isPinned !== 'undefined' && isPinned('{{ $groupId }}'))" class="size-3 xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                        <path d="M0 0h16v16H0z" fill="none" />
                        <path fill="currentColor" d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479c-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A6 6 0 0 1 5 6.708V2.277a3 3 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354m1.58 1.408l-.002-.001zm-.002-.001l.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007l-.054.03a5 5 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a5 5 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458a1.8 1.8 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14q.091.15.214.271a1.8 1.8 0 0 0 .37.282" />
                    </svg>

                </div>

                <!-- Chevron -->
                <span id="{{ $chevronId }}" :class="ready ? 'transition-transform duration-300' : ''" style="transform: {{ $active || $open ? 'rotate(90deg)' : 'none' }};" x-bind:style="`transform: ${open ? 'rotate(90deg)' : 'none'}`">
                    <svg class="size-4 text-vibe-400 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5" class="solar solar-alt-arrow-right-outline">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.51192 4.43057C8.82641 4.161 9.29989 4.19743 9.56946 4.51192L15.5695 11.5119C15.8102 11.7928 15.8102 12.2072 15.5695 12.4881L9.56946 19.4881C9.29989 19.8026 8.82641 19.839 8.51192 19.5695C8.19743 19.2999 8.161 18.8264 8.43057 18.5119L14.0122 12L8.43057 5.48811C8.161 5.17361 8.19743 4.70014 8.51192 4.43057Z" fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>
    </button>


    <div id="{{ $gridId }}" class="grid data-[collapsed=true]:hidden! group-data-[state=minified]/sheet:hidden!" :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" style="grid-template-rows: {{ $active || $open ? '1fr' : '0fr' }};" x-bind:style="`grid-template-rows: ${open ? '1fr' : '0fr'}`">
        <div class="overflow-hidden min-h-0">
            <div class="flex flex-col gap-1 mt-1">
                {{ $slot }}
            </div>
        </div>
    </div>

</div>

@if ($persist)
<script>
    (function() {
        try {
            var navKey = (window.VIBE_PREFIX || 'vibe') + '-nav';
            var state = JSON.parse(localStorage.getItem(navKey) || '{}');
            var groups = state.groups || {};
            var saved = groups['{{ $groupId }}'];
            
            if (saved === false && !{{ $active ? 'true' : 'false' }}) {
                document.getElementById('{{ $gridId }}').style.gridTemplateRows = '0fr';
                var chevron = document.getElementById('{{ $chevronId }}');
                if (chevron) chevron.style.transform = 'none';
            } else if (saved === true) {
                document.getElementById('{{ $gridId }}').style.gridTemplateRows = '1fr';
                var chevron = document.getElementById('{{ $chevronId }}');
                if (chevron) chevron.style.transform = 'rotate(90deg)';
            }
        } catch(e) {}
    })();
</script>
@endif
