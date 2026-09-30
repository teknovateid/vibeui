@aware(['tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <div 
        x-cloak 
        x-show="(selectedItems.length > 0 || hideBulkActionsWhenEmpty == false)" 
        class="flex flex-wrap items-center gap-2 w-full sm:w-auto sm:justify-end shrink-0" 
        wire:key="{{ $tableName }}-bulk-actions-toolbar-wrapper"
    >
        @if (method_exists($this, 'isBulkActionsAsDropdown') && $this->isBulkActionsAsDropdown())
            <vibe:dropdown align="right" width="56" keyboard>
                <vibe:dropdown.trigger>
                    <vibe:button variant="outline" size="sm" class="gap-2 shadow-2xs font-medium" aria-haspopup="true" x-bind:aria-expanded="open">
                        <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h10M4 18h7" />
                        </svg>

                        <span>{{ __($localisationPath . 'Bulk Actions') }}<span x-show="selectedItems.length > 0" x-text="' (' + selectedItems.length + ')'"></span></span>

                        <svg class="size-3.5 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 9l-7 6-7-6" />
                        </svg>
                    </vibe:button>
                </vibe:dropdown.trigger>

                <vibe:dropdown.items width="48">
                    @foreach ($this->getBulkActions() as $action => $title)
                        @php
                            $actionLower = strtolower($action);
                            $titleLower = strtolower($title);
                            $isExport = str_contains($actionLower, 'export') || str_contains($titleLower, 'export') || str_contains($titleLower, 'ekspor') || str_contains($titleLower, 'csv');
                            $isDelete = str_contains($actionLower, 'delete') || str_contains($titleLower, 'delete') || str_contains($titleLower, 'hapus') || str_contains($titleLower, 'trash');
                            $deleteClasses = 'text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 hover:bg-red-500/10 dark:hover:bg-red-500/20 focus-visible:bg-red-500/10 focus-visible:text-red-600 dark:focus-visible:text-red-400';
                        @endphp

                        <vibe:dropdown.item wire:click="{{ $action }}" :wire:confirm="$this->hasConfirmationMessage($action) ? $this->getBulkActionConfirmMessage($action) : null" wire:key="{{ $tableName }}-bulk-action-{{ $action }}" @click="close()" class="flex items-center gap-2 {{ $isDelete ? $deleteClasses : '' }}">
                            @if ($isExport)
                                <svg class="size-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7c0-1.886 0-2.828.586-3.414C5.172 3 6.114 3 8 3h6.172a3 3 0 0 1 2.121.879l2.828 2.828A3 3 0 0 1 20 8.828V17c0 1.886 0 2.828-.586 3.414C18.828 21 17.886 21 16 21H8c-1.886 0-2.828 0-3.414-.586C4 19.828 4 18.886 4 17V7z" />
                                    <path d="M8 12h8M8 16h5" />
                                </svg>
                            @elseif($isDelete)
                                <svg class="size-3.5 text-red-600 dark:text-red-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7h16M10 11v6M14 11v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            @else
                                <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M8 12l3 3 5-5" />
                                </svg>
                            @endif
                            <span>{{ $title }}</span>
                        </vibe:dropdown.item>
                    @endforeach
                </vibe:dropdown.items>
            </vibe:dropdown>
        @elseif (method_exists($this, 'bulkActionsView') && ! empty($this->bulkActionsView()))
            {!! \Illuminate\Support\Facades\Blade::render($this->bulkActionsView(), ['table' => $this, 'tableName' => $tableName]) !!}
        @endif
    </div>
@endif


