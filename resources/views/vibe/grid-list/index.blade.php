@blaze(fold: true)

@props([
    'id' => 'default_page',
    'header' => null,
    'defaultLayout' => 'list',
])

@php
    $gridClasses = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4';
    $listClasses = 'flex flex-col gap-4';
    
    $activeBtnClass = 'bg-background text-foreground shadow-sm';
    $inactiveBtnClass = 'text-muted-foreground hover:text-foreground';
    $baseBtnClass = 'flex items-center gap-2 px-3 py-1.5 text-sm font-medium transition-all duration-200 rounded-md';
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
}" class="w-full mx-auto">
    <div class="flex items-center justify-between mb-6 gap-2">
        <div class="w-full min-w-0">
            {{ $header  }}
        </div>

        <div class="flex p-1 bg-muted border border-border rounded-lg w-max shrink-0">
            <button id="vibe-glb-grid-{{ $id }}" type="button" @click="changeLayout('grid')" 
                    :class="{
                        '{{ $activeBtnClass }}': layout === 'grid',
                        '{{ $inactiveBtnClass }}': layout !== 'grid'
                    }" 
                    class="{{ $baseBtnClass }} {{ $defaultLayout === 'grid' ? $activeBtnClass : $inactiveBtnClass }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span>{{ __('vibe/grid.grid') }}</span>
            </button>

            <button id="vibe-glb-list-{{ $id }}" type="button" @click="changeLayout('list')" 
                    :class="{
                        '{{ $activeBtnClass }}': layout === 'list',
                        '{{ $inactiveBtnClass }}': layout !== 'list'
                    }" 
                    class="{{ $baseBtnClass }} {{ $defaultLayout === 'list' ? $activeBtnClass : $inactiveBtnClass }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span>{{ __('vibe/grid.list') }}</span>
            </button>
        </div>
    </div>

    <div id="vibe-gl-container-{{ $id }}"
         :class="{
            '{{ $gridClasses }}': layout === 'grid',
            '{{ $listClasses }}': layout !== 'grid'
         }" 
         class="{{ $defaultLayout === 'grid' ? $gridClasses : $listClasses }}">
        {{ $slot }}
    </div>
</div>

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
                let baseBtn = '{{ $baseBtnClass }}';
                
                if (layout === 'grid') {
                    if (container) container.className = '{{ $gridClasses }}';
                    if (btnGrid) btnGrid.className = baseBtn + ' {{ $activeBtnClass }}';
                    if (btnList) btnList.className = baseBtn + ' {{ $inactiveBtnClass }}';
                } else {
                    if (container) container.className = '{{ $listClasses }}';
                    if (btnGrid) btnGrid.className = baseBtn + ' {{ $inactiveBtnClass }}';
                    if (btnList) btnList.className = baseBtn + ' {{ $activeBtnClass }}';
                }
            }
        } catch(e) {}
    })();
</script>
