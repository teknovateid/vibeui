@php
    $catMenu = __('docs/search.categories.menu');
    $catAction = __('docs/search.categories.action');

    $navSections = [
        'start' => __('docs/search.sections.start'),
        'forms' => __('docs/search.sections.forms'),
        'ui' => __('docs/search.sections.ui'),
        'navigation' => __('docs/search.sections.navigation'),
        'layout' => __('docs/search.sections.layout'),
        'data' => __('docs/search.sections.data'),
        'feedback' => __('docs/search.sections.feedback'),
        'extra' => __('docs/search.sections.extra'),
        'dashboard' => __('docs/search.sections.dashboard'),
        'settings' => __('docs/search.sections.settings'),
        'quick_actions' => __('docs/search.sections.quick_actions'),
    ];

    $menuList = [
        // Getting Started
        [
            'id' => 'menu-docs',
            'title' => __('docs/sidebar.nav.docs') ?: __('docs/search.menu_items.docs.title'),
            'subtitle' => __('docs/search.menu_items.docs.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.index'),
            'icon' => 'book',
            'keywords' => 'docs start home guide pengantar panduan',
        ],
        [
            'id' => 'menu-instalation',
            'title' => __('docs/sidebar.nav.instalation') ?: __('docs/search.menu_items.instalation.title'),
            'subtitle' => __('docs/search.menu_items.instalation.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.instalation.index'),
            'icon' => 'download',
            'keywords' => 'install setup instalasi package composer npm',
        ],
        [
            'id' => 'menu-directories',
            'title' => __('docs/sidebar.nav.directories') ?: __('docs/search.menu_items.directories.title'),
            'subtitle' => __('docs/search.menu_items.directories.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['start'],
            'url' => route('docs.directories.index'),
            'icon' => 'folder',
            'keywords' => 'directories struktur folder file architecture',
        ],

        // Components - Forms
        [
            'id' => 'menu-form',
            'title' => __('docs/sidebar.nav.form') ?: __('docs/search.menu_items.form.title'),
            'subtitle' => __('docs/search.menu_items.form.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.form.index'),
            'icon' => 'form',
            'keywords' => 'form validation submit input grouping',
        ],
        [
            'id' => 'menu-input',
            'title' => __('docs/sidebar.nav.input') ?: __('docs/search.menu_items.input.title'),
            'subtitle' => __('docs/search.menu_items.input.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.input.index'),
            'icon' => 'input',
            'keywords' => 'input text password field form control',
        ],
        [
            'id' => 'menu-textarea',
            'title' => __('docs/sidebar.nav.textarea') ?: __('docs/search.menu_items.textarea.title'),
            'subtitle' => __('docs/search.menu_items.textarea.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.textarea.index'),
            'icon' => 'textarea',
            'keywords' => 'textarea multi line text input note',
        ],
        [
            'id' => 'menu-select',
            'title' => __('docs/sidebar.nav.select') ?: __('docs/search.menu_items.select.title'),
            'subtitle' => __('docs/search.menu_items.select.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.select.index'),
            'icon' => 'select',
            'keywords' => 'select dropdown option picker choose multi',
        ],
        [
            'id' => 'menu-checkbox',
            'title' => __('docs/sidebar.nav.checkbox') ?: __('docs/search.menu_items.checkbox.title'),
            'subtitle' => __('docs/search.menu_items.checkbox.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.checkbox.index'),
            'icon' => 'check',
            'keywords' => 'checkbox check toggle multiple boolean',
        ],
        [
            'id' => 'menu-radio',
            'title' => __('docs/sidebar.nav.radio') ?: __('docs/search.menu_items.radio.title'),
            'subtitle' => __('docs/search.menu_items.radio.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.radio.index'),
            'icon' => 'radio',
            'keywords' => 'radio option choice single boolean',
        ],
        [
            'id' => 'menu-switch',
            'title' => __('docs/sidebar.nav.switch') ?: __('docs/search.menu_items.switch.title'),
            'subtitle' => __('docs/search.menu_items.switch.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.switch.index'),
            'icon' => 'toggle',
            'keywords' => 'switch toggle on off status boolean',
        ],
        [
            'id' => 'menu-range',
            'title' => __('docs/sidebar.nav.range') ?: __('docs/search.menu_items.range.title'),
            'subtitle' => __('docs/search.menu_items.range.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.range.index'),
            'icon' => 'slider',
            'keywords' => 'range slider number value control',
        ],
        [
            'id' => 'menu-date-time',
            'title' => __('docs/sidebar.nav.date-time') ?: __('docs/search.menu_items.date_time.title'),
            'subtitle' => __('docs/search.menu_items.date_time.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.date-time.index'),
            'icon' => 'calendar',
            'keywords' => 'date time calendar picker tanggal waktu',
        ],
        [
            'id' => 'menu-dynamic-form',
            'title' => __('docs/sidebar.nav.dynamic-form') ?: 'Dynamic Form',
            'subtitle' => 'Form repeater input bertambah dinamis',
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.dynamic-form.index'),
            'icon' => 'form',
            'keywords' => 'dynamic form repeater input bertambah add more row array',
        ],
        [
            'id' => 'menu-filepond',
            'title' => __('docs/sidebar.nav.filepond') ?: __('docs/search.menu_items.filepond.title'),
            'subtitle' => __('docs/search.menu_items.filepond.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['forms'],
            'url' => route('docs.filepond.index'),
            'icon' => 'upload',
            'keywords' => 'filepond upload file image attachment',
        ],

        // Components - Elements & UI
        [
            'id' => 'menu-button',
            'title' => __('docs/sidebar.nav.button') ?: __('docs/search.menu_items.button.title'),
            'subtitle' => __('docs/search.menu_items.button.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.button.index'),
            'icon' => 'button',
            'keywords' => 'button tombol action click cta',
        ],
        [
            'id' => 'menu-dropdown',
            'title' => __('docs/sidebar.nav.dropdown') ?: __('docs/search.menu_items.dropdown.title'),
            'subtitle' => __('docs/search.menu_items.dropdown.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.dropdown.index'),
            'icon' => 'dropdown',
            'keywords' => 'dropdown menu context popup flyout',
        ],
        [
            'id' => 'menu-badge',
            'title' => __('docs/sidebar.nav.badge') ?: __('docs/search.menu_items.badge.title'),
            'subtitle' => __('docs/search.menu_items.badge.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.badge.index'),
            'icon' => 'badge',
            'keywords' => 'badge tag label status pill indicator',
        ],
        [
            'id' => 'menu-avatar',
            'title' => __('docs/sidebar.nav.avatar') ?: __('docs/search.menu_items.avatar.title'),
            'subtitle' => __('docs/search.menu_items.avatar.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.avatar.index'),
            'icon' => 'user',
            'keywords' => 'avatar profile user image picture initials',
        ],
        [
            'id' => 'menu-image',
            'title' => __('docs/sidebar.nav.image') ?: __('docs/search.menu_items.image.title'),
            'subtitle' => __('docs/search.menu_items.image.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.image.index'),
            'icon' => 'image',
            'keywords' => 'image photo picture media lazyload',
        ],
        [
            'id' => 'menu-card',
            'title' => __('docs/sidebar.nav.card') ?: __('docs/search.menu_items.card.title'),
            'subtitle' => __('docs/search.menu_items.card.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.card.index'),
            'icon' => 'card',
            'keywords' => 'card container box wrapper panel',
        ],
        [
            'id' => 'menu-grid-list',
            'title' => __('docs/sidebar.nav.grid-list') ?: __('docs/search.menu_items.grid_list.title'),
            'subtitle' => __('docs/search.menu_items.grid_list.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['ui'],
            'url' => route('docs.grid-list.index'),
            'icon' => 'grid',
            'keywords' => 'grid list collection items catalog',
        ],
        [
            'id' => 'menu-header',
            'title' => __('docs/sidebar.nav.header') ?: __('docs/search.menu_items.header.title'),
            'subtitle' => __('docs/search.menu_items.header.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.header.index'),
            'icon' => 'header',
            'keywords' => 'header navbar topbar sticky navigation',
        ],
        [
            'id' => 'menu-nav',
            'title' => __('docs/sidebar.nav.nav') ?: __('docs/search.menu_items.nav.title'),
            'subtitle' => __('docs/search.menu_items.nav.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.nav.index'),
            'icon' => 'nav',
            'keywords' => 'nav sidebar menu tree navigation history pinned',
        ],
        [
            'id' => 'menu-breadcrumb',
            'title' => __('docs/sidebar.nav.breadcrumb') ?: __('docs/search.menu_items.breadcrumb.title'),
            'subtitle' => __('docs/search.menu_items.breadcrumb.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.breadcrumb.index'),
            'icon' => 'breadcrumb',
            'keywords' => 'breadcrumb path hierarchy trail remah roti',
        ],
        [
            'id' => 'menu-table',
            'title' => __('docs/sidebar.nav.table') ?: __('docs/search.menu_items.table.title'),
            'subtitle' => __('docs/search.menu_items.table.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['data'],
            'url' => route('docs.table.index'),
            'icon' => 'table',
            'keywords' => 'table tabel tabular row column cell',
        ],
        [
            'id' => 'menu-grid',
            'title' => __('docs/sidebar.nav.grid') ?: __('docs/search.menu_items.grid.title'),
            'subtitle' => __('docs/search.menu_items.grid.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['layout'],
            'url' => route('docs.grid.index'),
            'icon' => 'grid',
            'keywords' => 'grid layout responsive columns flex',
        ],
        [
            'id' => 'menu-datatable',
            'title' => __('docs/sidebar.nav.datatable') ?: __('docs/search.menu_items.datatable.title'),
            'subtitle' => __('docs/search.menu_items.datatable.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['data'],
            'url' => route('docs.datatable.index'),
            'icon' => 'table',
            'keywords' => 'datatable table pagination sorting search livewire user',
        ],
        [
            'id' => 'menu-alert',
            'title' => __('docs/sidebar.nav.alert') ?: __('docs/search.menu_items.alert.title'),
            'subtitle' => __('docs/search.menu_items.alert.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['feedback'],
            'url' => route('docs.alert.index'),
            'icon' => 'alert',
            'keywords' => 'alert notice warning info success danger error',
        ],
        [
            'id' => 'menu-toast',
            'title' => __('docs/sidebar.nav.toast') ?: __('docs/search.menu_items.toast.title'),
            'subtitle' => __('docs/search.menu_items.toast.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['feedback'],
            'url' => route('docs.toast.index'),
            'icon' => 'toast',
            'keywords' => 'toast notification snackbar popup notify',
        ],
        [
            'id' => 'menu-modal',
            'title' => __('docs/sidebar.nav.modal') ?: __('docs/search.menu_items.modal.title'),
            'subtitle' => __('docs/search.menu_items.modal.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['feedback'],
            'url' => route('docs.modal.index'),
            'icon' => 'modal',
            'keywords' => 'modal dialog popup lightbox overlay window',
        ],
        [
            'id' => 'menu-sheet',
            'title' => __('docs/sidebar.nav.sheet') ?: __('docs/search.menu_items.sheet.title'),
            'subtitle' => __('docs/search.menu_items.sheet.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['layout'],
            'url' => route('docs.sheet.index'),
            'icon' => 'sheet',
            'keywords' => 'sheet drawer laci slideover panel side',
        ],
        [
            'id' => 'menu-tabs',
            'title' => __('docs/sidebar.nav.tabs') ?: __('docs/search.menu_items.tabs.title'),
            'subtitle' => __('docs/search.menu_items.tabs.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['navigation'],
            'url' => route('docs.tabs.index'),
            'icon' => 'tabs',
            'keywords' => 'tabs panel pill navigation segmented switch',
        ],
        [
            'id' => 'menu-highlightjs',
            'title' => __('docs/sidebar.nav.highlightjs') ?: __('docs/search.menu_items.highlightjs.title'),
            'subtitle' => __('docs/search.menu_items.highlightjs.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['extra'],
            'url' => route('docs.highlightjs.index'),
            'icon' => 'code',
            'keywords' => 'highlight code syntax prism pre snippet',
        ],
        [
            'id' => 'menu-chart',
            'title' => __('docs/sidebar.nav.chart') ?: __('docs/search.menu_items.chart.title'),
            'subtitle' => __('docs/search.menu_items.chart.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['data'],
            'url' => route('docs.chart.index'),
            'icon' => 'chart',
            'keywords' => 'chart graph bar line donut analytics metrik',
        ],

        // Pages
        [
            'id' => 'menu-dashboard-products',
            'title' => __('docs/search.menu_items.dashboard_products.title'),
            'subtitle' => __('docs/search.menu_items.dashboard_products.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['dashboard'],
            'url' => route('docs.dashboard.show', 'index'),
            'icon' => 'dashboard',
            'keywords' => 'dashboard produk sales analytics metric order pesanan',
        ],
        [
            'id' => 'menu-settings',
            'title' => __('docs/page/settings/index.breadcrumb.settings') ?: __('docs/search.menu_items.settings.title'),
            'subtitle' => __('docs/search.menu_items.settings.subtitle'),
            'category' => $catMenu,
            'section' => $navSections['settings'],
            'url' => route('docs.settings.index'),
            'icon' => 'settings',
            'keywords' => 'settings pengaturan appearance tema custom sidebar header',
        ],
    ];

    $quickActions = [
        [
            'id' => 'action-toggle-theme',
            'title' => __('docs/search.actions.theme_title'),
            'subtitle' => __('docs/search.actions.theme_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'action' => 'toggleTheme',
            'icon' => 'theme',
            'shortcut' => 'Ctrl+D',
            'keywords' => 'theme dark light mode gelap terang malam siang warna',
        ],
        [
            'id' => 'action-switch-language',
            'title' => app()->getLocale() === 'id' ? __('docs/search.actions.switch_lang_en') : __('docs/search.actions.switch_lang_id'),
            'subtitle' => __('docs/search.actions.switch_lang_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'url' => route('locale.switch', app()->getLocale() === 'id' ? 'en' : 'id'),
            'icon' => 'globe',
            'shortcut' => 'Locale',
            'keywords' => 'bahasa language english indonesia locale switch translate',
        ],
        [
            'id' => 'action-open-settings',
            'title' => __('docs/search.actions.settings_title'),
            'subtitle' => __('docs/search.actions.settings_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'url' => route('docs.settings.index'),
            'icon' => 'settings',
            'shortcut' => 'Settings',
            'keywords' => 'appearance settings warna custom sidebar header styling',
        ],
        [
            'id' => 'action-toggle-fullscreen',
            'title' => __('docs/search.actions.fullscreen_title'),
            'subtitle' => __('docs/search.actions.fullscreen_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'action' => 'toggleFullscreen',
            'icon' => 'fullscreen',
            'shortcut' => 'F11',
            'keywords' => 'fullscreen layar penuh window monitor maximize',
        ],
        [
            'id' => 'action-clear-history',
            'title' => __('docs/search.actions.clear_history_title'),
            'subtitle' => __('docs/search.actions.clear_history_subtitle'),
            'category' => $catAction,
            'section' => $navSections['quick_actions'],
            'action' => 'clearHistory',
            'icon' => 'trash',
            'shortcut' => 'Clear',
            'keywords' => 'clear hapus reset history riwayat jejak cache',
        ],
    ];
@endphp

<vibe:modal id="global-search-modal" position="top" maxWidth="2xl" :dismissibleButton="false">
    <div x-data="globalSearchModal({
        menuItems: {{ Js::from($menuList) }},
        actionItems: {{ Js::from($quickActions) }},
        searchApiUrl: '{{ route('docs.search.query') }}'
    })" @open-modal.window="if ($event.detail === 'global-search-modal' || (Array.isArray($event.detail) && $event.detail[0] === 'global-search-modal')) { onModalOpen(); }" @open-search-modal.window="onModalOpen();" class="flex flex-col">
        <vibe:modal.header class="p-0 gap-0 border-b border-border font-normal">
            <div class="relative flex items-center px-4 sm:px-5 py-3 sm:py-3.5 bg-card">
                <vibe:input variant="ghost" size="lg" x-ref="searchInput" x-model="query" @input="onQueryInput()" @keydown.down.prevent="nextItem()" @keydown.up.prevent="prevItem()" @keydown.enter.prevent="selectActiveItem()" @keydown.tab.prevent="cycleFilter()" @keydown.escape.prevent="$dispatch('close-modal', 'global-search-modal')" placeholder="{{ __('docs/search.placeholder') }}" autocomplete="off" spellcheck="false">
                    <x-slot:icon>
                        <template x-if="isLoadingDb">
                            <svg class="size-5 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </template>
                        <template x-if="!isLoadingDb">
                            <svg class="size-5 text-muted-foreground/70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </template>
                    </x-slot:icon>
                    <x-slot:trailingIcon>
                        <button x-show="query.length > 0" x-cloak type="button" @click="clearSearch()" class="p-1 rounded-md text-muted-foreground hover:text-foreground hover:bg-muted transition-colors cursor-pointer" title="{{ __('docs/search.clear_search') }}">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </x-slot:trailingIcon>
                </vibe:input>
            </div>

            {{-- Filter Category Pills --}}
            <div class="flex items-center gap-1.5 px-4 sm:px-5 py-2 border-t border-border/60 overflow-x-auto vibe-scrollbar bg-muted/40 text-xs select-none">
                <template x-for="filter in filterOptions" :key="filter.id">
                    <button type="button" @click="setFilter(filter.id)" class="px-2.5 py-1 rounded-full text-xs font-medium transition-all duration-150 shrink-0 cursor-pointer flex items-center gap-1.5" :class="activeFilter === filter.id ?
                        'bg-primary text-primary-foreground shadow-2xs font-semibold' :
                        'bg-secondary text-secondary-foreground hover:bg-accent hover:text-accent-foreground border border-border/40'">
                        <span x-text="filter.label"></span>
                        <span x-show="filter.count !== null" x-text="filter.count" class="text-[10px] px-1.5 py-0.2 rounded-full font-mono" :class="activeFilter === filter.id ? 'bg-primary-foreground/20 text-primary-foreground' : 'bg-background/80 text-muted-foreground'"></span>
                    </button>
                </template>
            </div>
        </vibe:modal.header>

        {{-- Modal Content: Results List Container --}}
        <vibe:modal.content x-ref="resultsContainer" class="p-2 sm:p-2.5 max-h-96 sm:max-h-104 space-y-1 vibe-scrollbar">
            {{-- When there are items --}}
            <template x-if="filteredItems.length > 0">
                <div class="flex flex-col gap-1">
                    <template x-for="(item, index) in filteredItems" :key="item.id || index">
                        <div :data-index="index" @click="selectItem(item)" @mouseenter="selectedIndex = index" class="flex items-center gap-3 px-3 py-2.5 rounded-xl cursor-pointer transition-all duration-150 group/search-item" :class="selectedIndex === index ?
                            'bg-accent text-accent-foreground shadow-2xs ring-1 ring-border/80' :
                            'text-foreground/80 hover:bg-accent hover:text-foreground'">
                            {{-- Icon container --}}
                            <div class="shrink-0 size-9 rounded-lg flex items-center justify-center transition-colors border" :class="selectedIndex === index ?
                                'bg-primary text-primary-foreground border-primary shadow-2xs' :
                                'bg-muted text-muted-foreground border-border/60 group-hover/search-item:bg-accent group-hover/search-item:text-foreground'">
                                <span x-html="renderIcon(item.icon, item.category)"></span>
                            </div>

                            {{-- Text Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs sm:text-sm font-semibold truncate tracking-tight" :class="selectedIndex === index ? 'text-accent-foreground font-bold' : 'text-foreground'" x-text="item.title"></span>

                                    {{-- Sub category or section tag --}}
                                    <template x-if="item.subCategory || item.section">
                                        <span class="text-[10px] px-1.5 py-0.2 rounded-md font-medium shrink-0 bg-muted text-muted-foreground border border-border/60" x-text="item.subCategory || item.section"></span>
                                    </template>
                                </div>

                                <p x-show="item.subtitle" class="text-[11px] sm:text-xs text-muted-foreground truncate mt-0.5" x-text="item.subtitle"></p>
                            </div>

                            {{-- Category Badge / Shortcut Badge --}}
                            <div class="shrink-0 flex items-center gap-1.5">
                                <template x-if="item.shortcut">
                                    <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-mono text-muted-foreground bg-muted border border-border/80 rounded shadow-2xs" x-text="item.shortcut"></kbd>
                                </template>

                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full uppercase tracking-wider" :class="getCategoryBadgeClass(item.category)" x-text="item.category"></span>

                                {{-- Active Arrow Indicator --}}
                                <svg class="size-4 transition-transform text-primary shrink-0 opacity-0 group-hover/search-item:opacity-100" :class="selectedIndex === index ? 'opacity-100 translate-x-0.5' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            {{-- Empty State --}}
            <template x-if="filteredItems.length === 0">
                <div class="py-12 px-4 text-center flex flex-col items-center justify-center">
                    <div class="size-12 rounded-full bg-muted flex items-center justify-center text-muted-foreground mb-3 shadow-inner border border-border/60">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            <line x1="8" y1="11" x2="14" y2="11"></line>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/search.no_results.title') }}</h3>
                    @if (app()->getLocale() === 'en')
                        <p class="text-xs text-muted-foreground max-w-xs mt-1">
                            No matching results for "<span class="font-medium text-foreground" x-text="query"></span>". Try another search term or switch category filters above.
                        </p>
                    @else
                        <p class="text-xs text-muted-foreground max-w-xs mt-1">
                            Tidak ada kecocokan untuk kata kunci "<span class="font-medium text-foreground" x-text="query"></span>". Coba kata kunci lain atau pilih tab filter di atas.
                        </p>
                    @endif
                </div>
            </template>
        </vibe:modal.content>

        {{-- Modal Footer: Keyboard Controls & Hint --}}
        <vibe:modal.footer class="justify-between px-4 sm:px-5 py-2.5 text-[11px] select-none border-t border-border bg-card">
            <div class="flex items-center gap-3 text-muted-foreground">
                <span class="flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">↑</kbd>
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">↓</kbd>
                    <span>{{ __('docs/search.footer.navigation') }}</span>
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">↵</kbd>
                    <span>{{ __('docs/search.footer.select') }}</span>
                </span>
                <span class="hidden sm:flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">Tab</kbd>
                    <span>{{ __('docs/search.footer.category') }}</span>
                </span>
                <span class="hidden sm:flex items-center gap-1">
                    <kbd class="font-mono bg-muted text-muted-foreground border border-border/70 rounded px-1.5 py-0.5 text-[10px]">ESC</kbd>
                    <span>{{ __('docs/search.footer.close') }}</span>
                </span>
            </div>

            <div class="flex items-center gap-2">
                <span x-text="filteredItems.length + ' {{ __('docs/search.footer.results') }}'"></span>
                <span class="text-border">•</span>
                <span class="font-medium text-foreground/80">{{ __('docs/search.footer.branding') }}</span>
            </div>
        </vibe:modal.footer>
    </div>
</vibe:modal>

<script>
    function globalSearchModal(config) {
        return {
            query: '',
            activeFilter: 'all',
            selectedIndex: 0,
            isLoadingDb: false,
            allMenuItems: config.menuItems || [],
            allActionItems: config.actionItems || [],
            searchApiUrl: config.searchApiUrl || '/docs/search/query',
            dbResults: [],
            historyItems: [],
            pinnedItems: [],
            debounceTimer: null,

            filterOptions: [
                { id: 'all', label: @js(__('docs/search.filters.all')), count: null },
                { id: 'menu', label: @js(__('docs/search.filters.menu')), count: null },
                { id: 'database', label: @js(__('docs/search.filters.database')), count: null },
                { id: 'history', label: @js(__('docs/search.filters.history')), count: null },
                { id: 'pinned', label: @js(__('docs/search.filters.pinned')), count: null },
                { id: 'action', label: @js(__('docs/search.filters.action')), count: null },
            ],

            init() {
                this.loadLocalData();
                window.addEventListener('vibeHistory:updated', () => {
                    this.loadHistory();
                });
            },

            onModalOpen() {
                this.loadLocalData();
                this.selectedIndex = 0;
                this.$nextTick(() => {
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                        this.$refs.searchInput.select();
                    }
                });
            },

            loadLocalData() {
                this.loadHistory();
                this.loadPinned();
            },

            loadHistory() {
                try {
                    const prefix = window.VIBE_PREFIX || 'vibe';
                    const raw = localStorage.getItem(prefix + '-page-history');
                    if (raw) {
                        const parsed = JSON.parse(raw);
                        if (Array.isArray(parsed)) {
                            // Deduplicate
                            const seen = new Set();
                            this.historyItems = parsed
                                .filter(item => {
                                    if (!item || !item.url || seen.has(item.url)) return false;
                                    seen.add(item.url);
                                    return true;
                                })
                                .slice(0, 10)
                                .map((item, idx) => ({
                                    id: 'history-' + idx,
                                    title: item.title || item.url,
                                    subtitle: @js(__('docs/search.history.subtitle', ['url' => ''])) + (item.url || ''),
                                    category: @js(__('docs/search.categories.history')),
                                    section: @js(__('docs/search.sections.recent_pages')),
                                    url: item.url,
                                    icon: 'history',
                                    keywords: (item.title || '') + ' ' + (item.url || ''),
                                }));
                        }
                    } else {
                        this.historyItems = [];
                    }
                } catch (e) {
                    this.historyItems = [];
                }
            },

            loadPinned() {
                try {
                    const prefix = window.VIBE_PREFIX || 'vibe';
                    const raw = localStorage.getItem(prefix + '-nav');
                    let pinnedIds = [];
                    if (raw) {
                        const parsed = JSON.parse(raw);
                        if (Array.isArray(parsed)) {
                            const navData = parsed.find(n => n.id === 'sidebar-menu');
                            if (navData && Array.isArray(navData.pinned)) {
                                pinnedIds = navData.pinned;
                            }
                        }
                    }

                    // Extract items from DOM or match with allMenuItems
                    const pins = [];
                    pinnedIds.forEach((pinId, idx) => {
                        const el = document.querySelector(`[data-nav-pin-id="${pinId}"]`);
                        if (el) {
                            const title = el.getAttribute('data-pin-title') || el.innerText.trim();
                            const href = el.getAttribute('href') || '#';
                            pins.push({
                                id: 'pinned-' + idx,
                                title: title,
                                subtitle: @js(__('docs/search.pinned.subtitle')),
                                category: @js(__('docs/search.categories.pinned')),
                                section: @js(__('docs/search.sections.favorites')),
                                url: href,
                                icon: 'pin',
                                keywords: title + ' ' + href,
                            });
                        }
                    });

                    // Fallback: If no DOM elements found yet, check allMenuItems matching IDs
                    if (pins.length === 0 && pinnedIds.length > 0) {
                        pinnedIds.forEach((pinId, idx) => {
                            pins.push({
                                id: 'pinned-' + idx,
                                title: @js(__('docs/search.pinned.fallback_title', ['id' => ''])) + pinId,
                                subtitle: @js(__('docs/search.pinned.fallback_subtitle')),
                                category: @js(__('docs/search.categories.pinned')),
                                section: @js(__('docs/search.sections.favorites')),
                                url: '#',
                                icon: 'pin',
                                keywords: pinId,
                            });
                        });
                    }

                    this.pinnedItems = pins;
                } catch (e) {
                    this.pinnedItems = [];
                }
            },

            onQueryInput() {
                this.selectedIndex = 0;
                clearTimeout(this.debounceTimer);

                const q = this.query.trim();
                if (q.length >= 1) {
                    this.debounceTimer = setTimeout(() => {
                        this.fetchDatabaseResults(q);
                    }, 250);
                } else {
                    this.dbResults = [];
                    this.isLoadingDb = false;
                }
            },

            fetchDatabaseResults(q) {
                this.isLoadingDb = true;
                const url = new URL(this.searchApiUrl, window.location.origin);
                url.searchParams.set('q', q);

                fetch(url.toString(), {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (Array.isArray(data)) {
                            this.dbResults = data.map(item => ({
                                id: item.id,
                                title: item.title,
                                subtitle: item.subtitle,
                                category: item.category || @js(__('docs/search.categories.database')),
                                subCategory: item.subCategory,
                                url: item.url,
                                icon: item.icon || 'database',
                                keywords: item.title + ' ' + (item.subtitle || ''),
                            }));
                        } else {
                            this.dbResults = [];
                        }
                    })
                    .catch(err => {
                        console.error('Search query failed:', err);
                        this.dbResults = [];
                    })
                    .finally(() => {
                        this.isLoadingDb = false;
                    });
            },

            get filteredItems() {
                const q = this.query.toLowerCase().trim();
                let list = [];

                if (q === '') {
                    // Empty query: provide curated default list
                    if (this.activeFilter === 'menu') {
                        list = this.allMenuItems;
                    } else if (this.activeFilter === 'database') {
                        list = this.dbResults;
                    } else if (this.activeFilter === 'history') {
                        list = this.historyItems;
                    } else if (this.activeFilter === 'pinned') {
                        list = this.pinnedItems;
                    } else if (this.activeFilter === 'action') {
                        list = this.allActionItems;
                    } else {
                        // 'all': blend top history, pinned, recommended menus, and quick actions
                        list = [
                            ...this.pinnedItems.slice(0, 3),
                            ...this.historyItems.slice(0, 3),
                            ...this.allActionItems.slice(0, 3),
                            ...this.allMenuItems.slice(0, 6),
                        ];
                    }
                } else {
                    // Search mode across properties
                    const searchMatch = (item) => {
                        const titleMatch = item.title && item.title.toLowerCase().includes(q);
                        const subtitleMatch = item.subtitle && item.subtitle.toLowerCase().includes(q);
                        const keywordsMatch = item.keywords && item.keywords.toLowerCase().includes(q);
                        const categoryMatch = item.category && item.category.toLowerCase().includes(q);
                        const sectionMatch = item.section && item.section.toLowerCase().includes(q);
                        return titleMatch || subtitleMatch || keywordsMatch || categoryMatch || sectionMatch;
                    };

                    let pool = [];
                    if (this.activeFilter === 'menu') {
                        pool = this.allMenuItems.filter(searchMatch);
                    } else if (this.activeFilter === 'database') {
                        pool = this.dbResults;
                    } else if (this.activeFilter === 'history') {
                        pool = this.historyItems.filter(searchMatch);
                    } else if (this.activeFilter === 'pinned') {
                        pool = this.pinnedItems.filter(searchMatch);
                    } else if (this.activeFilter === 'action') {
                        pool = this.allActionItems.filter(searchMatch);
                    } else {
                        // All sources
                        pool = [
                            ...this.allMenuItems.filter(searchMatch),
                            ...this.dbResults,
                            ...this.historyItems.filter(searchMatch),
                            ...this.pinnedItems.filter(searchMatch),
                            ...this.allActionItems.filter(searchMatch),
                        ];
                    }

                    list = pool;
                }

                // Update filter counts dynamically
                this.updateFilterCounts(q);

                return list;
            },

            updateFilterCounts(q) {
                const countMatch = (item) => {
                    if (!q) return true;
                    return (item.title && item.title.toLowerCase().includes(q)) ||
                        (item.subtitle && item.subtitle.toLowerCase().includes(q)) ||
                        (item.keywords && item.keywords.toLowerCase().includes(q));
                };

                const menuCount = this.allMenuItems.filter(countMatch).length;
                const dbCount = this.dbResults.length;
                const histCount = this.historyItems.filter(countMatch).length;
                const pinCount = this.pinnedItems.filter(countMatch).length;
                const actCount = this.allActionItems.filter(countMatch).length;

                this.filterOptions[1].count = menuCount;
                this.filterOptions[2].count = dbCount;
                this.filterOptions[3].count = histCount;
                this.filterOptions[4].count = pinCount;
                this.filterOptions[5].count = actCount;
            },

            setFilter(filterId) {
                this.activeFilter = filterId;
                this.selectedIndex = 0;
                this.scrollToSelected();
            },

            cycleFilter() {
                const filters = ['all', 'menu', 'database', 'history', 'pinned', 'action'];
                const curIdx = filters.indexOf(this.activeFilter);
                const nextIdx = (curIdx + 1) % filters.length;
                this.setFilter(filters[nextIdx]);
            },

            clearSearch() {
                this.query = '';
                this.dbResults = [];
                this.selectedIndex = 0;
                if (this.$refs.searchInput) {
                    this.$refs.searchInput.focus();
                }
            },

            nextItem() {
                if (this.filteredItems.length === 0) return;
                this.selectedIndex = (this.selectedIndex + 1) % this.filteredItems.length;
                this.scrollToSelected();
            },

            prevItem() {
                if (this.filteredItems.length === 0) return;
                this.selectedIndex = (this.selectedIndex - 1 + this.filteredItems.length) % this.filteredItems.length;
                this.scrollToSelected();
            },

            scrollToSelected() {
                this.$nextTick(() => {
                    if (!this.$refs.resultsContainer) return;
                    const activeEl = this.$refs.resultsContainer.querySelector(`[data-index="${this.selectedIndex}"]`);
                    if (activeEl) {
                        activeEl.scrollIntoView({
                            block: 'nearest',
                            behavior: 'smooth'
                        });
                    }
                });
            },

            selectActiveItem() {
                if (this.filteredItems.length > 0 && this.filteredItems[this.selectedIndex]) {
                    this.selectItem(this.filteredItems[this.selectedIndex]);
                }
            },

            selectItem(item) {
                if (!item) return;

                // Close the modal
                this.$dispatch('close-modal', 'global-search-modal');

                // Execute action if action property exists
                if (item.action) {
                    if (item.action === 'toggleTheme') {
                        if (window.VibeTheme) {
                            window.VibeTheme.toggle();
                        } else {
                            document.documentElement.classList.toggle('dark');
                        }
                    } else if (item.action === 'toggleFullscreen') {
                        if (!document.fullscreenElement) {
                            document.documentElement.requestFullscreen().catch(() => {});
                        } else {
                            document.exitFullscreen().catch(() => {});
                        }
                    } else if (item.action === 'clearHistory') {
                        const prefix = window.VIBE_PREFIX || 'vibe';
                        localStorage.removeItem(prefix + '-page-history');
                        this.historyItems = [];
                        window.dispatchEvent(new CustomEvent('vibeHistory:updated'));
                        if (window.vibeToast) {
                            window.vibeToast({
                                type: 'success',
                                message: @js(__('docs/search.actions.clear_history_toast')),
                            });
                        }
                    }
                    return;
                }

                // If item has a URL, navigate
                if (item.url && item.url !== '#') {
                    if (window.Livewire && window.Livewire.navigate) {
                        window.Livewire.navigate(item.url);
                    } else {
                        window.location.href = item.url;
                    }
                }
            },

            getCategoryBadgeClass(category) {
                switch (category) {
                    case 'Menu':
                        return 'bg-secondary text-secondary-foreground border border-border/60';
                    case 'Database':
                        return 'bg-success/15 text-success border border-success/25';
                    case 'Riwayat':
                    case 'History':
                        return 'bg-warning/15 text-warning border border-warning/25';
                    case 'Disematkan':
                    case 'Pinned':
                        return 'bg-info/15 text-info border border-info/25';
                    case 'Aksi':
                    case 'Action':
                    case 'Actions':
                        return 'bg-primary/10 text-primary border border-primary/20';
                    default:
                        return 'bg-muted text-muted-foreground border border-border/60';
                }
            },

            renderIcon(iconName, category) {
                switch (iconName) {
                    case 'user':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>`;
                    case 'chart':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>`;
                    case 'history':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`;
                    case 'pin':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="17" x2="12" y2="22"/><path d="M5 17h14v-1.76a2 2 0 0 0-1.11-1.79l-1.78-.9A2 2 0 0 1 15 10.76V6h1a2 2 0 0 0 0-4H8a2 2 0 0 0 0 4h1v4.76a2 2 0 0 1-1.11 1.79l-1.78.9A2 2 0 0 0 5 15.24Z"/></svg>`;
                    case 'theme':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>`;
                    case 'globe':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>`;
                    case 'settings':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>`;
                    case 'fullscreen':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/></svg>`;
                    case 'trash':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>`;
                    case 'database':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>`;
                    default:
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>`;
                }
            }
        };
    }
</script>
