@props(['title', 'active' => false, 'open' => false, 'persist' => false, 'id' => null, 'pinnable' => false])

@php
    $groupId = $id ?? Str::slug($title);
    $gridId = 'nav-group-grid-' . Str::random(6);
    $chevronId = 'nav-group-chevron-' . Str::random(6);
    $defaultOpenState = ($active || $open) ? true : false;
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:mx-auto data-[collapsed=true]:justify-center data-[collapsed=true]:px-0 group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto group-data-[state=minified]/sheet:overflow-visible';
    $baseClasses = "flex items-center min-h-9 px-3 py-2 rounded-lg text-sm font-medium w-full relative overflow-hidden group/nav-item cursor-pointer select-none outline-none focus-visible:ring-2 focus-visible:ring-vibe-500 $minifiedClasses";
    $activeClasses = $active ? 'bg-vibe-200 dark:bg-vibe-800 text-vibe-950 dark:text-vibe-50' : 'text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-vibe-950 dark:hover:text-vibe-50';
@endphp

<div 
    x-data="{
        open: $el.dataset.pinnedShortcutFor ? false : {{ $defaultOpenState ? 'true' : 'false' }},
        ready: false,
        isGroupChild: true,
        init() {
            if (this.$el.dataset.pinnedShortcutFor) {
                this.open = false;
                this.$nextTick(() => { this.ready = true; });
                return;
            }
            @if ($persist)
                let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                let navEl = this.$el.closest('nav');
                let navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                
                try {
                    let stored = localStorage.getItem(key);
                    if (stored) {
                        let data = JSON.parse(stored);
                        if (Array.isArray(data)) {
                            let item = data.find(i => i.id === navId);
                            if (item && item.groups && item.groups['{{ $groupId }}'] !== undefined && !{{ $active ? 'true' : 'false' }}) {
                                this.open = Boolean(item.groups['{{ $groupId }}']);
                            }
                        }
                    }
                } catch(e) {}

                let saveGroup = (val) => {
                    try {
                        let stored = localStorage.getItem(key);
                        let data = stored ? JSON.parse(stored) : [];
                        if (!Array.isArray(data)) data = [];
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
                    } catch(e) {}
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
    }" 
    data-nav-pin-id="{{ $groupId }}" 
    data-pin-type="group" 
    data-pin-title="{{ $title }}" 
    class="w-full flex flex-col gap-1 relative group/group-wrapper"
>
    <button 
        @click="open = !open" 
        data-nav-group-trigger
        data-pin-title="{{ $title }}" 
        x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" 
        type="button" 
        :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[width,height,padding,margin] duration-300'" 
        {{ $attributes->twMerge(['class' => "$baseClasses $activeClasses"]) }}
    >
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
                    @click.stop.prevent="if(typeof togglePin !== 'undefined') togglePin('{{ $groupId }}')" 
                    class="inline-flex items-center justify-center size-6 rounded hover:bg-vibe-200 dark:hover:bg-vibe-800 transition-colors cursor-pointer text-vibe-400 opacity-0 group-hover/nav-item:opacity-100 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-400 data-[pinned=true]:text-vibe-900 dark:data-[pinned=true]:text-vibe-100 data-[pinned=true]:opacity-100" 
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

                <!-- Chevron -->
                <svg 
                    id="{{ $chevronId }}" 
                    class="size-3.5 shrink-0 text-vibe-400 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-300" 
                    :class="ready ? 'transition-transform duration-300' : ''" 
                    style="transform: {{ $defaultOpenState ? 'none' : 'rotate(-90deg)' }};" 
                    x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`"
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2.5" 
                    stroke-linecap="round" 
                    stroke-linejoin="round"
                >
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
        </div>
    </button>

    <div 
        id="{{ $gridId }}" 
        class="grid data-[collapsed=true]:hidden! group-data-[state=minified]/sheet:hidden!" 
        :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" 
        x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" 
        :style="{ gridTemplateRows: open ? '1fr' : '0fr' }"
        style="{{ $defaultOpenState ? 'grid-template-rows: 1fr;' : 'grid-template-rows: 0fr;' }}"
    >
        <div class="overflow-hidden min-h-0">
            <div class="flex flex-col gap-1 mt-1">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Hidden Template for Flyout Dropdown Panel when Minified on Hover -->
    <div data-nav-group-flyout-content class="hidden">
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
                        var grid = document.getElementById('{{ $gridId }}');
                        var chevron = document.getElementById('{{ $chevronId }}');
                        if (saved === false && !{{ $active ? 'true' : 'false' }}) {
                            if (grid) grid.style.gridTemplateRows = '0fr';
                            if (chevron) chevron.style.transform = 'rotate(-90deg)';
                        } else if (saved === true) {
                            if (grid) grid.style.gridTemplateRows = '1fr';
                            if (chevron) chevron.style.transform = 'none';
                        }
                    }
                }
            }
        } catch(e) {}
    })();
</script>
@endif
