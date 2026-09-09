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
            <vibe:checkbox
                x-ref="checkbox"
                aria-label="{{ __($localisationPath.'Select All') }}"
                x-bind:checked="selectAllStatus || (selectedItems.length > 0 && selectedItems.length >= paginationCurrentCount)"
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
            />

            {{-- Dropdown Trigger untuk Pilihan Halaman vs Semua --}}
            <vibe:dropdown align="left" width="48">
                <vibe:dropdown.trigger>
                    <button
                        type="button"
                        class="flex items-center justify-center size-4 rounded text-muted-foreground hover:text-foreground hover:bg-accent/60 transition-colors focus-visible:outline-none cursor-pointer"
                        title="{{ __('vibe/datatable.select_page_or_all') }}"
                        aria-label="{{ __('vibe/datatable.select_page_or_all') }}"
                    >
                        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                </vibe:dropdown.trigger>

                <vibe:dropdown.items align="left" width="48">
                    {{-- Opsi 1: Pilih 1 Halaman yang Kelihatan Saja --}}
                    <vibe:dropdown.item @click="selectAllOnPage(); close()" class="justify-between text-xs">
                        <span class="flex items-center gap-1.5 font-medium">
                            <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2"/>
                                <path d="M9 12h6"/>
                            </svg>
                            <span>{{ __('vibe/datatable.select_this_page') }}</span>
                        </span>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-muted text-muted-foreground" x-text="paginationCurrentCount"></span>
                    </vibe:dropdown.item>

                    {{-- Opsi 2: Pilih Semua Data di Seluruh Halaman --}}
                    <vibe:dropdown.item @click="setAllSelected(); close()" class="justify-between text-xs">
                        <span class="flex items-center gap-1.5 font-medium">
                            <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                            <span>{{ __('vibe/datatable.select_all') }}</span>
                        </span>
                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded bg-muted text-muted-foreground" x-text="paginationTotalItemCount"></span>
                    </vibe:dropdown.item>

                    {{-- Opsi 3: Batalkan Pilihan --}}
                    <template x-if="selectedItems.length > 0 || selectAllStatus">
                        <div>
                            <vibe:dropdown.divider />
                            <vibe:dropdown.item @click="clearSelected(); close()" destructive class="text-xs font-medium gap-1.5">
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="m15 9-6 6"/>
                                    <path d="m9 9 6 6"/>
                                </svg>
                                <span>{{ __('vibe/datatable.deselect_all') }}</span>
                            </vibe:dropdown.item>
                        </div>
                    </template>
                </vibe:dropdown.items>
            </vibe:dropdown>
        </div>
    </th>
@endif
