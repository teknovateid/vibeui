@blaze(fold: true)

@props([
    'id' => 'default_page',
    'title' => null,
    'description' => null,
    'badge' => null,
    'badgeVariant' => 'secondary',
    'header' => null,
    'actions' => null,
    'defaultLayout' => 'list',
    'gridClasses' => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4',
    'listClasses' => 'flex flex-col gap-4',
    'showSwitcher' => true,
])

@php
    $activeBtnClass = 'bg-background text-foreground shadow-xs font-semibold ring-1 ring-border/80';
    $inactiveBtnClass = 'text-foreground/70 hover:text-foreground hover:bg-background/50 font-medium';
    $baseBtnClass = 'inline-flex items-center gap-1.5 px-3 py-1.5 text-xs transition-all duration-200 rounded-md';
    $hasHeaderContent = $header || $title || $description || $badge;
@endphp

<div x-data="{
    layout: '{{ $defaultLayout }}',
    id: '{{ $id }}',
    storageKey: (window.VIBE_PREFIX || 'vibe') + '-grid-list',

    init() {
        try {
            let stored = localStorage.getItem(this.storageKey);
            if (stored) {
                let parsed = JSON.parse(stored);
                if (Array.isArray(parsed)) {
                    let item = parsed.find(i => i.id === this.id);
                    if (item && item.mode) {
                        this.layout = item.mode;
                        return;
                    }
                }
            }
        } catch (e) {}
        this.layout = '{{ $defaultLayout }}';
    },

    changeLayout(view) {
        this.layout = view;
        try {
            let stored = localStorage.getItem(this.storageKey);
            let data = [];
            if (stored) {
                let parsed = JSON.parse(stored);
                if (Array.isArray(parsed)) {
                    data = parsed;
                }
            }
            let index = data.findIndex(i => i.id === this.id);
            let newItem = { id: this.id, mode: view };

            if (index !== -1) {
                data[index] = newItem;
            } else {
                data.push(newItem);
            }
            localStorage.setItem(this.storageKey, JSON.stringify(data));
        } catch (e) {}
    }
}" {{ $attributes->twMerge(['class' => 'w-full mx-auto']) }}>
    @if ($hasHeaderContent || $showSwitcher || $actions)
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-3">
            <div class="w-full min-w-0">
                @if ($header)
                    {{ $header }}
                @elseif ($title || $description || $badge)
                    <div class="space-y-1 min-w-0">
                        <div class="flex items-center gap-2">
                            @if ($title)
                                <h3 class="text-base sm:text-lg font-semibold text-foreground tracking-tight">{{ $title }}</h3>
                            @endif
                            @if ($badge)
                                <vibe:badge :variant="$badgeVariant" size="sm" class="rounded-full">{{ $badge }}</vibe:badge>
                            @endif
                        </div>
                        @if ($description)
                            <p class="text-xs sm:text-sm text-muted-foreground">{{ $description }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-2 shrink-0 sm:ml-auto">
                @if ($actions)
                    <div class="flex items-center gap-2">
                        {{ $actions }}
                    </div>
                @endif

                @if ($showSwitcher)
                    <div class="inline-flex items-center p-1 bg-muted border border-border rounded-lg shrink-0 gap-1 select-none shadow-2xs">
                        <vibe:button id="vibe-glb-grid-{{ $id }}" type="button" size="sm" variant="plain" @click="changeLayout('grid')" x-bind:class="{
                            '{{ $activeBtnClass }}': layout === 'grid',
                            '{{ $inactiveBtnClass }}': layout !== 'grid'
                        }" class="{{ $baseBtnClass }} {{ $defaultLayout === 'grid' ? $activeBtnClass : $inactiveBtnClass }}">
                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>{{ __('vibe/grid.grid') }}</span>
                        </vibe:button>

                        <vibe:button id="vibe-glb-list-{{ $id }}" type="button" size="sm" variant="plain" @click="changeLayout('list')" x-bind:class="{
                            '{{ $activeBtnClass }}': layout === 'list',
                            '{{ $inactiveBtnClass }}': layout !== 'list'
                        }" class="{{ $baseBtnClass }} {{ $defaultLayout === 'list' ? $activeBtnClass : $inactiveBtnClass }}">
                            <svg class="size-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <span>{{ __('vibe/grid.list') }}</span>
                        </vibe:button>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div id="vibe-gl-container-{{ $id }}" x-bind:class="{
        '{{ $gridClasses }}': layout === 'grid',
        '{{ $listClasses }}': layout !== 'grid'
    }" class="{{ $defaultLayout === 'grid' ? $gridClasses : $listClasses }}">
        {{ $slot }}
    </div>
</div>


@pushOnce('body', 'gl-container')
    <script>
        (function() {
            try {
                let id = '{{ $id }}';
                let layout = '{{ $defaultLayout }}';
                let key = (window.VIBE_PREFIX || 'vibe') + '-grid-list';
                let stored = localStorage.getItem(key);
                if (stored) {
                    let parsed = JSON.parse(stored);
                    if (Array.isArray(parsed)) {
                        let item = parsed.find(i => i.id === id);
                        if (item && item.mode) layout = item.mode;
                    }
                }
                if (layout !== '{{ $defaultLayout }}') {
                    let container = document.getElementById('vibe-gl-container-' + id);
                    let btnGrid = document.getElementById('vibe-glb-grid-' + id);
                    let btnList = document.getElementById('vibe-glb-list-' + id);
                    let active = '{{ $activeBtnClass }}'.split(' ');
                    let inactive = '{{ $inactiveBtnClass }}'.split(' ');

                    if (layout === 'grid') {
                        if (container) container.className = '{{ $gridClasses }}';
                        if (btnGrid) {
                            btnGrid.classList.remove(...inactive);
                            btnGrid.classList.add(...active);
                        }
                        if (btnList) {
                            btnList.classList.remove(...active);
                            btnList.classList.add(...inactive);
                        }
                    } else {
                        if (container) container.className = '{{ $listClasses }}';
                        if (btnGrid) {
                            btnGrid.classList.remove(...active);
                            btnGrid.classList.add(...inactive);
                        }
                        if (btnList) {
                            btnList.classList.remove(...inactive);
                            btnList.classList.add(...active);
                        }
                    }
                }
            } catch (e) {}
        })
        ();
    </script>
@endPushOnce
