@blaze(fold: true)

@props([
    'selected' => null,
    'default' => null,
    'layout' => 'rows', // 'rows' (2 baris: list di atas, panel di bawah) atau 'cols' (2 kolom: list di kiri, panel di kanan)
    'orientation' => null, // alias: 'horizontal' (rows), 'vertical' (cols)
    'variant' => 'pill', // 'pill', 'underline', 'button'
    'size' => 'md', // 'sm', 'md', 'lg'
    'persist' => false,
    'id' => null,
    'syncUrl' => false,
])

@php
    $isCols = in_array($layout, ['cols', 'columns', '2-cols', 'vertical']) || $orientation === 'vertical';
    $normalizedLayout = $isCols ? 'cols' : 'rows';
    $tabId = $id ?? uniqid('tabs-');
    $initialTab = $selected ?? $default ?? '';
    
    $layoutClasses = $isCols 
        ? 'flex flex-col md:flex-row gap-6 w-full items-start' 
        : 'flex flex-col gap-4 w-full';
@endphp

<div 
    x-data="{
        activeTab: {{ $persist ? "window.VibeTabs?.getActive('{$tabId}', '{$initialTab}') || '{$initialTab}'" : "'{$initialTab}'" }},
        tabId: '{{ $tabId }}',
        layout: '{{ $normalizedLayout }}',
        variant: '{{ $variant }}',
        size: '{{ $size }}',
        persist: {{ $persist ? 'true' : 'false' }},
        syncUrl: {{ is_string($syncUrl) ? "'{$syncUrl}'" : ($syncUrl ? "'tab'" : 'false') }},

        init() {
            if (this.syncUrl) {
                const urlParams = new URLSearchParams(window.location.search);
                const urlTab = urlParams.get(this.syncUrl);
                if (urlTab) this.activeTab = urlTab;
            } else if (this.persist && this.tabId) {
                const stored = window.VibeTabs?.getActive(this.tabId);
                if (stored) this.activeTab = stored;
            }

            if (!this.activeTab) {
                this.$nextTick(() => {
                    let first = this.$el.querySelector('[role=tab]:not([disabled])');
                    if (first && first.dataset.tabName) {
                        this.activeTab = first.dataset.tabName;
                    }
                });
            }

            this.$watch('activeTab', val => {
                if (this.persist && this.tabId) {
                    if (window.Alpine && Alpine.store && Alpine.store('vibeTabs')) {
                        Alpine.store('vibeTabs').setActive(this.tabId, val);
                    } else if (window.VibeTabs) {
                        window.VibeTabs.setActive(this.tabId, val);
                    }
                }
                if (this.syncUrl) {
                    const url = new URL(window.location);
                    url.searchParams.set(this.syncUrl, val);
                    window.history.replaceState({}, '', url);
                }
                this.$dispatch('tab-changed', { id: this.tabId, tab: val });
            });
        },

        select(name) {
            this.activeTab = name;
        },

        focusNextTab(event, offset) {
            const tabs = Array.from(this.$el.querySelectorAll('[role=tab]:not([disabled])'));
            const activeIndex = tabs.findIndex(t => t === document.activeElement);
            if (activeIndex === -1) return;
            const nextIndex = (activeIndex + offset + tabs.length) % tabs.length;
            tabs[nextIndex].focus();
            tabs[nextIndex].click();
        },

        focusFirstTab() {
            const tabs = Array.from(this.$el.querySelectorAll('[role=tab]:not([disabled])'));
            if (tabs.length) {
                tabs[0].focus();
                tabs[0].click();
            }
        },

        focusLastTab() {
            const tabs = Array.from(this.$el.querySelectorAll('[role=tab]:not([disabled])'));
            if (tabs.length) {
                tabs[tabs.length - 1].focus();
                tabs[tabs.length - 1].click();
            }
        }
    }"
    @select-tab="select($event.detail)"
    @change-tab.window="if ($event.detail?.id === tabId || !$event.detail?.id) activeTab = $event.detail?.tab || $event.detail"
    {{ $attributes->twMerge(['class' => 'vibe-tabs-root ' . $layoutClasses]) }}
>
    {{ $slot }}
</div>
