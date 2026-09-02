@aware(['tableName', 'isTailwind', 'isBootstrap', 'localisationPath'])
@php
    $customAttributes = $this->hasBulkActionsThAttributes ? $this->getBulkActionsThAttributes : $this->getAllThAttributes($this->getBulkActionsColumn())['customAttributes'];
    $bulkActionsThCheckboxAttributes = $this->getBulkActionsThCheckboxAttributes();
@endphp

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <th 
        scope="col" 
        wire:key="{{ $tableName }}-thead-bulk-actions"
        class="w-14 px-2 py-3 text-center align-middle border-b border-border bg-muted/40 text-muted-foreground font-medium text-xs select-none"
    >
        <div
            x-data="{
                menuOpen: false,
                indeterminateCheckbox: false,
                bulkActionHeaderChecked: false,
                init() {
                    this.$watch('selectedItems', value => {
                        this.indeterminateCheckbox = (!this.selectAllStatus && value.length > 0 && value.length < this.paginationTotalItemCount);
                    });
                    this.$watch('indeterminateCheckbox', value => {
                        this.$refs.checkbox.indeterminate = value;
                    });
                }
            }"
            x-cloak 
            x-show="currentlyReorderingStatus !== true"
            class="relative inline-flex items-center justify-center gap-1"
        >
            {{-- Checkbox Utama --}}
            <input
                x-ref="checkbox"
                type="checkbox"
                aria-label="{{ __($localisationPath.'Select All') }}"
                :checked="selectAllStatus || (selectedItems.length > 0 && selectedItems.length >= paginationCurrentCount)"
                x-on:click="
                    if (selectAllStatus || selectedItems.length > 0) {
                        $el.indeterminate = false;
                        clearSelected();
                        bulkActionHeaderChecked = false;
                    } else {
                        bulkActionHeaderChecked = true;
                        $el.indeterminate = false;
                        selectAllOnPage();
                    }
                "
                class="h-4 w-4 rounded border-border text-primary focus:ring-primary bg-background transition-colors cursor-pointer shadow-2xs"
            />

            {{-- Dropdown Trigger untuk Pilihan Halaman vs Semua --}}
            <button
                type="button"
                @click.stop="menuOpen = !menuOpen"
                class="flex items-center justify-center size-4 rounded text-muted-foreground hover:text-foreground hover:bg-accent/60 transition-colors focus-visible:outline-none cursor-pointer"
                title="Pilih halaman ini atau semua data"
                aria-label="Pilih halaman ini atau semua data"
            >
                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>

            {{-- Dropdown Menu Pilihan --}}
            <div
                x-show="menuOpen"
                @click.away="menuOpen = false"
                @keydown.escape.window="menuOpen = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute left-0 top-full mt-1.5 z-50 min-w-44 rounded-lg border border-border bg-popover p-1 shadow-md text-popover-foreground text-left focus:outline-none"
                style="display: none;"
            >
                {{-- Opsi 1: Pilih 1 Halaman yang Kelihatan Saja --}}
                <button
                    type="button"
                    @click="selectAllOnPage(); menuOpen = false"
                    class="w-full flex items-center justify-between gap-2 px-2.5 py-1.5 text-xs rounded-md hover:bg-accent hover:text-accent-foreground transition-colors cursor-pointer"
                >
                    <span class="flex items-center gap-1.5 font-medium">
                        <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2"/>
                            <path d="M9 12h6"/>
                        </svg>
                        Pilih halaman ini
                    </span>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-muted text-muted-foreground" x-text="paginationCurrentCount"></span>
                </button>

                {{-- Opsi 2: Pilih Semua Data di Seluruh Halaman --}}
                <button
                    type="button"
                    @click="setAllSelected(); menuOpen = false"
                    class="w-full flex items-center justify-between gap-2 px-2.5 py-1.5 text-xs rounded-md hover:bg-accent hover:text-accent-foreground transition-colors cursor-pointer"
                >
                    <span class="flex items-center gap-1.5 font-medium">
                        <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                        Pilih semua
                    </span>
                    <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-muted text-muted-foreground" x-text="paginationTotalItemCount"></span>
                </button>

                {{-- Opsi 3: Batalkan Pilihan --}}
                <template x-if="selectedItems.length > 0 || selectAllStatus">
                    <div>
                        <div class="my-1 border-t border-border"></div>
                        <button
                            type="button"
                            @click="clearSelected(); menuOpen = false"
                            class="w-full flex items-center gap-1.5 px-2.5 py-1.5 text-xs rounded-md hover:bg-destructive/10 text-destructive transition-colors cursor-pointer font-medium"
                        >
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="m15 9-6 6"/>
                                <path d="m9 9 6 6"/>
                            </svg>
                            Batalkan pilihan
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </th>
@endif
