<vibe:modal id="global-search-modal" position="top" maxWidth="2xl" :dismissibleButton="false">
    <div x-data="vibeSearchModal()" 
         @keydown.window.prevent.cmd.k="onModalOpen()" 
         @keydown.window.prevent.ctrl.k="onModalOpen()" 
         @open-modal.window="if ($event.detail === 'global-search-modal' || (Array.isArray($event.detail) && $event.detail[0] === 'global-search-modal')) { onModalOpen(); }" 
         @open-search-modal.window="onModalOpen();" 
         class="flex flex-col">

        {{-- Search Input Header --}}
        <vibe:modal.header class="p-0 border-b border-border/60">
            <div class="relative flex items-center px-4 sm:px-5 py-3.5">
                <vibe:input variant="ghost" size="lg" x-ref="searchInput" x-model="query" @input="onQueryInput()" @keydown.down.prevent="nextItem()" @keydown.up.prevent="prevItem()" @keydown.enter.prevent="selectActiveItem()" @keydown.escape.prevent="$dispatch('close-modal', 'global-search-modal')" placeholder="Type a command or search..." autocomplete="off" spellcheck="false">
                    <x-slot:leadingIcon>
                        <svg class="size-5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </x-slot:leadingIcon>

                    <x-slot:trailingIcon>
                        <button type="button" x-show="query.length > 0" @click="clearSearch()" class="text-muted-foreground hover:text-foreground cursor-pointer transition-colors p-1" style="display: none;">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </x-slot:trailingIcon>
                </vibe:input>
            </div>
        </vibe:modal.header>

        {{-- Results List --}}
        <vibe:modal.content x-ref="resultsContainer" class="p-2 sm:p-2.5 max-h-80 space-y-1 vibe-scrollbar">
            <template x-if="filteredItems.length > 0">
                <div class="flex flex-col gap-1">
                    <template x-for="(item, index) in filteredItems" :key="item.id || index">
                        <div :data-index="index" @click="selectItem(item)" @mouseenter="selectedIndex = index" class="flex items-center gap-3 px-3 py-2.5 rounded-xl cursor-pointer transition-all duration-150 group/search-item" :class="selectedIndex === index ? 'bg-accent/80 text-accent-foreground shadow-2xs ring-1 ring-border/80' : 'text-foreground/80 hover:bg-accent/40 hover:text-foreground'">
                            <div class="shrink-0 size-8 rounded-lg flex items-center justify-center transition-colors border" :class="selectedIndex === index ? 'bg-primary/15 text-primary border-primary/25' : 'bg-muted/60 text-muted-foreground border-border/40'">
                                <span x-html="renderIcon(item.icon)"></span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs sm:text-sm font-semibold truncate tracking-tight" x-text="item.title"></span>
                                    <template x-if="item.section">
                                        <span class="text-[10px] px-1.5 py-0.2 rounded-md font-medium shrink-0 bg-muted/80 text-muted-foreground border border-border/50" x-text="item.section"></span>
                                    </template>
                                </div>
                                <p x-show="item.subtitle" class="text-[11px] text-muted-foreground truncate mt-0.5" x-text="item.subtitle"></p>
                            </div>

                            <div class="shrink-0 flex items-center gap-1.5">
                                <template x-if="item.shortcut">
                                    <kbd class="hidden sm:inline-flex items-center px-1.5 py-0.5 text-[10px] font-mono text-muted-foreground bg-muted border border-border/80 rounded" x-text="item.shortcut"></kbd>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            {{-- Empty State --}}
            <template x-if="filteredItems.length === 0">
                <div class="py-10 text-center flex flex-col items-center justify-center gap-2 text-muted-foreground">
                    <svg class="size-8 stroke-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                    <p class="text-xs">No results found for "<span class="font-medium text-foreground" x-text="query"></span>"</p>
                </div>
            </template>
        </vibe:modal.content>

        {{-- Footer --}}
        <vibe:modal.footer class="px-4 py-2.5 bg-muted/30 border-t border-border/60 flex items-center justify-between text-[11px] text-muted-foreground select-none">
            <div class="flex items-center gap-3">
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 bg-muted rounded border border-border/80 text-[10px] font-mono">↑</kbd>
                    <kbd class="px-1.5 py-0.5 bg-muted rounded border border-border/80 text-[10px] font-mono">↓</kbd>
                    <span>navigate</span>
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 bg-muted rounded border border-border/80 text-[10px] font-mono">↵</kbd>
                    <span>select</span>
                </span>
                <span class="flex items-center gap-1">
                    <kbd class="px-1.5 py-0.5 bg-muted rounded border border-border/80 text-[10px] font-mono">esc</kbd>
                    <span>close</span>
                </span>
            </div>
            <div>
                <span x-text="filteredItems.length"></span> commands
            </div>
        </vibe:modal.footer>
    </div>
</vibe:modal>

<script>
    function vibeSearchModal() {
        return {
            query: '',
            selectedIndex: 0,
            items: [
                { id: 'dashboard', title: 'Dashboard', subtitle: 'Go to dashboard overview', section: 'Navigation', url: '/', icon: 'chart', keywords: 'home dashboard' },
                { id: 'profile', title: 'Profile Settings', subtitle: 'Manage your personal account', section: 'Settings', url: '#', icon: 'user', keywords: 'profile account user' },
                { id: 'fullscreen', title: 'Toggle Fullscreen', subtitle: 'Toggle browser fullscreen view', section: 'Actions', action: 'fullscreen', icon: 'fullscreen', keywords: 'screen maximize' },
                { id: 'theme', title: 'Toggle Dark Mode', subtitle: 'Switch between light and dark theme', section: 'Actions', action: 'theme', icon: 'theme', keywords: 'dark light mode' },
            ],

            get filteredItems() {
                if (!this.query.trim()) return this.items;
                const q = this.query.toLowerCase().trim();
                return this.items.filter(item => {
                    return item.title.toLowerCase().includes(q) ||
                           (item.subtitle && item.subtitle.toLowerCase().includes(q)) ||
                           (item.keywords && item.keywords.toLowerCase().includes(q));
                });
            },

            onModalOpen() {
                this.$dispatch('open-modal', 'global-search-modal');
                this.query = '';
                this.selectedIndex = 0;
                this.$nextTick(() => {
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.focus();
                    }
                });
            },

            onQueryInput() {
                this.selectedIndex = 0;
            },

            clearSearch() {
                this.query = '';
                this.selectedIndex = 0;
                this.$refs.searchInput.focus();
            },

            nextItem() {
                if (this.filteredItems.length === 0) return;
                this.selectedIndex = (this.selectedIndex + 1) % this.filteredItems.length;
            },

            prevItem() {
                if (this.filteredItems.length === 0) return;
                this.selectedIndex = (this.selectedIndex - 1 + this.filteredItems.length) % this.filteredItems.length;
            },

            selectActiveItem() {
                if (this.filteredItems.length > 0 && this.filteredItems[this.selectedIndex]) {
                    this.selectItem(this.filteredItems[this.selectedIndex]);
                }
            },

            selectItem(item) {
                this.$dispatch('close-modal', 'global-search-modal');

                if (item.action) {
                    if (item.action === 'fullscreen') {
                        if (!document.fullscreenElement) {
                            document.documentElement.requestFullscreen().catch(() => {});
                        } else {
                            document.exitFullscreen().catch(() => {});
                        }
                    } else if (item.action === 'theme') {
                        document.documentElement.classList.toggle('dark');
                    }
                    return;
                }

                if (item.url && item.url !== '#') {
                    if (window.Livewire && window.Livewire.navigate) {
                        window.Livewire.navigate(item.url);
                    } else {
                        window.location.href = item.url;
                    }
                }
            },

            renderIcon(iconName) {
                switch (iconName) {
                    case 'user':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>`;
                    case 'chart':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>`;
                    case 'fullscreen':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/></svg>`;
                    case 'theme':
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>`;
                    default:
                        return `<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>`;
                }
            }
        };
    }
</script>
