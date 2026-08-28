@blaze(fold: true)

@props(['title', 'active' => false, 'open' => false, 'persist' => false, 'id' => null, 'pinnable' => false])

@php
    $groupId = $id ?? Str::slug($title);
    $gridId = 'nav-group-grid-' . Str::random(6);
    $chevronId = 'nav-group-chevron-' . Str::random(6);
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:mx-auto data-[collapsed=true]:justify-center data-[collapsed=true]:px-0 group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto group-data-[state=minified]/sheet:overflow-visible';
    $baseClasses = "flex items-center px-3 py-2 rounded-lg text-sm font-medium w-full relative overflow-hidden group/nav-item cursor-pointer select-none outline-none focus-visible:ring-2 focus-visible:ring-vibe-500 $minifiedClasses";
    $activeClasses = $active ? 'bg-vibe-200 dark:bg-vibe-800 text-vibe-950 dark:text-vibe-50' : 'text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-vibe-950 dark:hover:text-vibe-50';
@endphp

<div x-data="(function() {
    var defaultOpen = {{ $active || $open ? 'true' : 'false' }};
    @if ($persist) try {
             var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
             var stored = localStorage.getItem(key);
             if (stored) {
                 var data = JSON.parse(stored);
                 if (Array.isArray(data)) {
                     var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                     var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                     var navItem = data.find(i => i.id === navId);
                     if (navItem && navItem.groups && navItem.groups['{{ $groupId }}'] !== undefined && !{{ $active ? 'true' : 'false' }}) {
                         defaultOpen = navItem.groups['{{ $groupId }}'];
                     }
                 }
             }
         } catch(e) {} @endif
    return {
        open: defaultOpen,
        ready: false,
        isGroupChild: true,
        init() {
            @if ($persist) 
                 let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                 let saveGroup = (val) => {
                     let stored = localStorage.getItem(key);
                     let data = [];
                     if (stored) {
                         try {
                             let parsed = JSON.parse(stored);
                             if (Array.isArray(parsed)) data = parsed;
                         } catch (e) {}
                     }
                     let navEl = this.$el.closest('nav');
                     let navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                     let index = data.findIndex(i => i.id === navId);
                     let existing = index !== -1 ? data[index] : { id: navId, pinned: [], groups: {}, labels: {} };
                     if (!existing.groups) existing.groups = {};
                     existing.groups['{{ $groupId }}'] = val;
                     if (index !== -1) {
                         data[index] = existing;
                     } else {
                         data.push(existing);
                     }
                     localStorage.setItem(key, JSON.stringify(data));
                 };
                 if ({{ $active ? 'true' : 'false' }}) {
                     saveGroup(true);
                 }
                 this.$watch('open', val => {
                     saveGroup(val);
                 }); 
            @endif
            this.$nextTick(() => { this.ready = true; });
        }
    };
})()" data-nav-pin-id="{{ $groupId }}" data-pin-type="group" data-pin-title="{{ $title }}" class="w-full flex flex-col gap-1 relative group/group-wrapper">
    <button @click="open = !open" x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" type="button" :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[width,height,padding,margin] duration-300'" {{ $attributes->twMerge(['class' => "$baseClasses $activeClasses"]) }}>

        <!-- Icon -->
        @if (isset($icon))
            <span data-pin-icon class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-vibe-900 dark:text-vibe-100' : 'text-vibe-500 group-hover/nav-item:text-vibe-900 dark:text-vibe-400 dark:group-hover/nav-item:text-vibe-200' }}">
                {{ $icon }}
            </span>
        @endif


        <div :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[max-width,opacity,margin] duration-300 ease-in-out'" class="flex flex-1 min-w-0 gap-2 w-full items-center justify-between overflow-hidden max-w-[100vw] opacity-100 ml-3 group-data-[collapsed=true]/nav-item:hidden group-data-[state=minified]/sheet:hidden">
            <span class="whitespace-nowrap">
                {{ $title }}
            </span>

            <div class="flex items-center gap-1 shrink-0 ml-auto">
                {{-- Pin button: visible when parent nav has pinnable OR this group has pinnable prop --}}
                <div 
                    data-nav-pin-btn
                    data-pinned="false"
                    :data-pinned="typeof isPinned !== 'undefined' && isPinned('{{ $groupId }}') ? 'true' : 'false'"
                    x-show="(typeof pinnable !== 'undefined' && pinnable) || {{ $pinnable ? 'true' : 'false' }}" 
                    @click.stop="if(typeof togglePin !== 'undefined') togglePin('{{ $groupId }}')" 
                    class="p-1 rounded hover:bg-vibe-200 dark:hover:bg-vibe-800 transition-colors cursor-pointer text-vibe-400 opacity-0 group-hover/nav-item:opacity-100 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-400 data-[pinned=true]:text-vibe-900 dark:data-[pinned=true]:text-vibe-100 data-[pinned=true]:opacity-100" 
                    style="display:none" 
                    title="Pin"
                >
                    <!-- Pinned Icon -->
                    <svg class="size-3 pin-icon-pinned" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                        <path d="M0 0h16v16H0z" fill="none" />
                        <path fill="currentColor" d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479c-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A6 6 0 0 1 5 6.708V2.277a3 3 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354" />
                    </svg>

                    <!-- Unpinned Icon -->
                    <svg class="size-3 pin-icon-unpinned" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
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

    <!-- Flyout Dropdown Panel when Minified on Hover -->
    <div class="hidden group-data-[state=minified]/sheet:block opacity-0 invisible group-hover/group-wrapper:opacity-100 group-hover/group-wrapper:visible absolute left-full top-0 ml-2 z-50 w-52 p-1.5 rounded-xl bg-vibe-50 dark:bg-vibe-900 border border-vibe-200 dark:border-vibe-800 shadow-xl transition-all duration-150 before:absolute before:-left-3 before:top-0 before:bottom-0 before:w-3 before:content-[''] group-data-[state=minified]/sheet:[&_.group\/nav-item]:w-full group-data-[state=minified]/sheet:[&_.group\/nav-item]:h-auto group-data-[state=minified]/sheet:[&_.group\/nav-item]:px-3 group-data-[state=minified]/sheet:[&_.group\/nav-item]:py-2 group-data-[state=minified]/sheet:[&_.group\/nav-item]:justify-start group-data-[state=minified]/sheet:[&_.group\/nav-item]:mx-0 group-data-[state=minified]/sheet:[&_.group\/nav-item>div]:max-w-[100vw] group-data-[state=minified]/sheet:[&_.group\/nav-item>div]:opacity-100 group-data-[state=minified]/sheet:[&_.group\/nav-item>div]:ml-3">
        <div class="px-3 py-1.5 text-xs font-semibold text-vibe-700 dark:text-vibe-300 border-b border-vibe-200 dark:border-vibe-800 mb-1 flex items-center justify-between">
            <span>{{ $title }}</span>
        </div>
        <div class="flex flex-col gap-0.5">
            {{ $slot }}
        </div>
    </div>

</div>

@if ($persist)
<script>
    (function() {
        try {
            var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
            var stored = localStorage.getItem(key);
            if (stored) {
                var data = JSON.parse(stored);
                if (Array.isArray(data)) {
                    var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                    var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                    var navItem = data.find(i => i.id === navId);
                    if (navItem && navItem.groups && navItem.groups['{{ $groupId }}'] !== undefined) {
                        var saved = navItem.groups['{{ $groupId }}'];
                        if (saved === false && !{{ $active ? 'true' : 'false' }}) {
                            document.getElementById('{{ $gridId }}').style.gridTemplateRows = '0fr';
                            var chevron = document.getElementById('{{ $chevronId }}');
                            if (chevron) chevron.style.transform = 'none';
                        } else if (saved === true) {
                            document.getElementById('{{ $gridId }}').style.gridTemplateRows = '1fr';
                            var chevron = document.getElementById('{{ $chevronId }}');
                            if (chevron) chevron.style.transform = 'rotate(90deg)';
                        }
                    }
                }
            }
        } catch(e) {}
    })();
</script>
@endif
