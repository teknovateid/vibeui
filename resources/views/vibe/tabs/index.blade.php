@blaze(fold: true)

@props([
    'selected' => null,
    'default' => null,
    'layout' => 'rows', // 'rows' (2 baris: list di atas, panel di bawah) atau 'cols' (2 kolom: list di kiri, panel di kanan)
    'orientation' => null, // alias: 'horizontal' (rows), 'vertical' (cols)
    'variant' => 'pill', // 'pill', 'underline', 'button', 'sidebar'
    'size' => 'md', // 'xs', 'sm', 'md', 'lg', 'xl'
    'persist' => false,
    'id' => null,
    'syncUrl' => false,
    'mobileMode' => 'auto', // 'auto', 'collapsible', 'scroll', 'stack'
])

@php
    $isSidebar = $variant === 'sidebar';
    $isCols = in_array($layout, ['cols', 'columns', '2-cols', 'vertical']) || $orientation === 'vertical' || $isSidebar;
    $normalizedLayout = $isCols ? 'cols' : 'rows';
    $tabId = $id ?? 'tabs-' . substr(md5(($selected ?? $default ?? 'default') . '-' . $variant . '-' . $normalizedLayout), 0, 8);
    $initialTab = $selected ?? $default ?? '';
    
    $resolvedMobileMode = $mobileMode === 'auto' ? ($isCols ? 'collapsible' : 'scroll') : $mobileMode;

$layoutClasses = match(true) {
    $isSidebar => 'flex flex-col md:flex-row w-full items-stretch gap-0',
    $isCols => 'flex flex-col md:flex-row gap-6 w-full items-start',
    default => 'flex flex-col gap-4 w-full',
};  
@endphp

<div 
    x-data="{
        activeTab: {{ $persist ? 'window.VibeTabs?.getActive(' . \Illuminate\Support\Js::from($tabId) . ', ' . \Illuminate\Support\Js::from($initialTab) . ') || ' . \Illuminate\Support\Js::from($initialTab) : \Illuminate\Support\Js::from($initialTab) }},
        tabId: @js($tabId),
        layout: @js($normalizedLayout),
        variant: @js($variant),
        size: @js($size),
        persist: @js((bool) $persist),
        syncUrl: @js(is_string($syncUrl) ? $syncUrl : ($syncUrl ? 'tab' : false)),
        orientation: @js($orientation),
        mobileMode: @js($resolvedMobileMode),
        activeLabel: '',
        activeIconHtml: '',
        activeBadgeHtml: '',
        mobileOpen: false,

        getRootEl() {
            return this.$el.closest('.vibe-tabs-root') || this.$root || this.$el;
        },

        getEnabledTabs() {
            const root = this.getRootEl();
            return Array.from(root.querySelectorAll('[role=tab]')).filter(
                el => el.closest('.vibe-tabs-root') === root && !el.hasAttribute('disabled') && el.getAttribute('aria-disabled') !== 'true'
            );
        },

        isValidTab(name) {
            if (!name) return false;
            return this.getEnabledTabs().some(el => el.dataset.tabName === String(name));
        },

        init() {
            let candidate = null;
            if (this.syncUrl) {
                const urlParams = new URLSearchParams(window.location.search);
                candidate = urlParams.get(this.syncUrl);
            } else if (this.persist && this.tabId) {
                candidate = window.VibeTabs?.getActive(this.tabId);
            }

            this.$nextTick(() => {
                if (candidate && this.isValidTab(candidate)) {
                    this.activeTab = candidate;
                } else if (!this.isValidTab(this.activeTab)) {
                    const first = this.getEnabledTabs()[0];
                    if (first?.dataset?.tabName) {
                        this.activeTab = first.dataset.tabName;
                    }
                }
                this.updateActiveTabMeta();
            });

            this.$watch('activeTab', val => {
                this.updateActiveTabMeta();
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

        selectTab(name, label = null, el = null) {
            if (!el && !this.isValidTab(name)) return;
            this.activeTab = name;
            if (label) this.activeLabel = label;
            if (el) {
                const icon = el.querySelector('.vibe-tab-icon') || el.querySelector('svg');
                if (icon) this.activeIconHtml = icon.outerHTML;
                const badge = el.querySelector('.vibe-tab-badge');
                if (badge) this.activeBadgeHtml = badge.innerHTML;
            }
            this.mobileOpen = false;
            if (el && window.innerWidth < 768 && this.mobileMode === 'scroll') {
                el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        },

        select(name, label = null, el = null) {
            this.selectTab(name, label, el);
        },

        updateActiveTabMeta() {
            const root = this.getRootEl();
            const tabs = Array.from(root.querySelectorAll('[role=tab]')).filter(
                el => el.closest('.vibe-tabs-root') === root
            );
            const currentTabEl = tabs.find(t => t.dataset.tabName === this.activeTab) 
                              || tabs.find(t => t.getAttribute('aria-selected') === 'true');
            if (currentTabEl) {
                const label = currentTabEl.dataset.label || currentTabEl.querySelector('.vibe-tab-label')?.textContent?.trim() || currentTabEl.textContent?.trim();
                if (label) this.activeLabel = label;

                const icon = currentTabEl.querySelector('.vibe-tab-icon') || currentTabEl.querySelector('svg');
                this.activeIconHtml = icon ? icon.outerHTML : '';

                const badge = currentTabEl.querySelector('.vibe-tab-badge');
                this.activeBadgeHtml = badge ? badge.innerHTML : '';
            }
        },

        focusNextTab(event, offset) {
            const tabs = this.getEnabledTabs();
            const activeIndex = tabs.indexOf(document.activeElement);
            if (activeIndex === -1) return;
            const nextIndex = (activeIndex + offset + tabs.length) % tabs.length;
            const nextTab = tabs[nextIndex];
            nextTab.focus();
            if (!nextTab.hasAttribute('href')) {
                nextTab.click();
            }
        },

        focusFirstTab() {
            const tabs = this.getEnabledTabs();
            if (tabs.length) {
                const firstTab = tabs[0];
                firstTab.focus();
                if (!firstTab.hasAttribute('href')) {
                    firstTab.click();
                }
            }
        },

        focusLastTab() {
            const tabs = this.getEnabledTabs();
            if (tabs.length) {
                const lastTab = tabs[tabs.length - 1];
                lastTab.focus();
                if (!lastTab.hasAttribute('href')) {
                    lastTab.click();
                }
            }
        }
    }"
    @select-tab.stop="selectTab($event.detail)"
    @change-tab.window="if (($event.detail?.id && $event.detail.id === tabId) || (!$event.detail?.id && isValidTab($event.detail?.tab || $event.detail))) selectTab($event.detail?.tab || $event.detail)"
    data-variant="{{ $variant }}"
    data-layout="{{ $normalizedLayout }}"
    data-selected="{{ $initialTab }}"
    {{ $attributes->twMerge(['class' => 'vibe-tabs-root ' . $layoutClasses]) }}
>
    {{ $slot }}
</div>
