@aware(['tableName', 'isTailwind', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'localisationPath'])

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    <div x-cloak x-show="(selectedItems.length > 0 || hideBulkActionsWhenEmpty == false)" class="w-full md:w-auto" wire:key="{{ $tableName }}-bulk-actions-toolbar-wrapper">
        <vibe:dropdown align="right" width="56" keyboard>
            <vibe:dropdown.trigger>
                <vibe:button variant="outline" size="md" class="gap-2 w-full md:w-auto shadow-2xs font-medium" aria-haspopup="true" x-bind:aria-expanded="open">
                    <svg class="size-3.5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 7 3 3 3-3" />
                        <path d="M6 10V3" />
                        <path d="M10 3h11" />
                        <path d="M10 7h11" />
                        <path d="M10 11h11" />
                        <path d="M3 15h18" />
                        <path d="M3 19h18" />
                    </svg>

                    <span>{{ __($localisationPath . 'Bulk Actions') }}</span>

                    <vibe:badge variant="primary" size="sm" class="rounded-full min-w-5 h-5 px-1.5 font-bold text-[10px]" x-show="selectedItems.length > 0" x-text="selectedItems.length"></vibe:badge>

                    <svg class="size-3.5 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
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

                    @if ($this->hasConfirmationMessage($action))
                        <vibe:dropdown.item wire:click="{{ $action }}" wire:confirm="{{ $this->getBulkActionConfirmMessage($action) }}" wire:key="{{ $tableName }}-bulk-action-{{ $action }}" @click="close()" class="flex items-center gap-2 {{ $isDelete ? $deleteClasses : '' }}">
                            @if ($isExport)
                                <svg class="size-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                    <path d="M8 13h2" />
                                    <path d="M8 17h2" />
                                    <path d="M14 13h2" />
                                    <path d="M14 17h2" />
                                </svg>
                            @elseif($isDelete)
                                <svg class="size-3.5 text-red-600 dark:text-red-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    <line x1="10" x2="10" y1="11" y2="17" />
                                    <line x1="14" x2="14" y1="11" y2="17" />
                                </svg>
                            @else
                                <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 11 12 14 22 4" />
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                </svg>
                            @endif
                            <span>{{ $title }}</span>
                        </vibe:dropdown.item>
                    @else
                        <vibe:dropdown.item  wire:click="{{ $action }}" wire:key="{{ $tableName }}-bulk-action-{{ $action }}" @click="close()" class="flex items-center gap-2 {{ $isDelete ? $deleteClasses : '' }}">
                            @if ($isExport)
                                <svg class="size-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                    <path d="M8 13h2" />
                                    <path d="M8 17h2" />
                                    <path d="M14 13h2" />
                                    <path d="M14 17h2" />
                                </svg>
                            @elseif($isDelete)
                                <svg class="size-3.5 text-red-600 dark:text-red-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    <line x1="10" x2="10" y1="11" y2="17" />
                                    <line x1="14" x2="14" y1="11" y2="17" />
                                </svg>
                            @else
                                <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 11 12 14 22 4" />
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                </svg>
                            @endif
                            <span>{{ $title }}</span>
                        </vibe:dropdown.item>
                    @endif
                @endforeach
            </vibe:dropdown.items>
        </vibe:dropdown>
    </div>
@endif
