<?php

namespace Teknovate\VibeUi\DataTable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

abstract class VibeDataTableComponent extends DataTableComponent
{
    /**
     * Default configurations for Vibe UI tables.
     * Child components can override configure() and call parent::configure()
     * or add custom settings.
     */
    public function configure(): void
    {
        $this->setTheme('tailwind');
        $this->setPrimaryKey('id');
        $this->setSearchDebounce(350);
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setDefaultPerPage(10);
        $this->setLoadingPlaceholderEnabled();
        $this->setHideBulkActionsWhenEmptyEnabled();

        // Custom default attributes tailored to Vibe UI design tokens
        $this->setComponentWrapperAttributes([
            'class' => 'w-full space-y-4 text-foreground antialiased @container',
        ]);

        $this->setTableWrapperAttributes([
            'class' => 'w-full overflow-x-auto rounded-xl border border-border bg-card text-card-foreground shadow-2xs',
        ]);

        $this->setTableAttributes([
            'class' => 'w-full text-left text-sm caption-bottom select-text',
        ]);

        $this->setTheadAttributes([
            'class' => 'border-b border-border bg-muted/40 text-xs font-semibold uppercase tracking-wider text-muted-foreground',
        ]);

        $this->setTbodyAttributes([
            'class' => 'divide-y divide-border text-sm',
        ]);

        $this->setTrAttributes(function ($row, $index) {
            return [
                'class' => 'transition-colors hover:bg-muted/50 dark:hover:bg-muted/30',
            ];
        });

        $this->setThAttributes(function ($column) {
            return [
                'class' => 'py-3 px-4 font-semibold text-muted-foreground whitespace-nowrap',
            ];
        });

        $this->setTdAttributes(function ($column, $row, $colIndex, $rowIndex) {
            return [
                'class' => 'py-3.5 px-4 align-middle text-foreground whitespace-nowrap',
            ];
        });
    }

    protected bool $borderedStatus = false;

    public function setBorderedStatus(bool $status): self
    {
        $this->borderedStatus = $status;

        if ($status) {
            $this->setTableAttributes([
                'class' => 'w-full text-left text-sm caption-bottom select-text border-collapse [&_th]:border [&_th]:border-border [&_td]:border [&_td]:border-border',
            ]);
        }

        return $this;
    }

    public function setBorderedEnabled(): self
    {
        return $this->setBorderedStatus(true);
    }

    public function setBorderedDisabled(): self
    {
        return $this->setBorderedStatus(false);
    }

    /**
     * Default skeleton loading placeholder for Livewire 3 lazy loading.
     * Prevents Cumulative Layout Shift (CLS) and matches Vibe UI table design tokens.
     * Child components can override this method for custom loading states.
     */
    public function placeholder(): string
    {
        return <<<'HTML'
        <div class="vibe-datatable-root">
            <div wire:key="vibe-datatable-loading-skeleton" class="w-full space-y-4 animate-pulse antialiased select-none" aria-hidden="true">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 p-1">
                    <div class="h-9 w-64 bg-muted-foreground/12 dark:bg-muted-foreground/20 rounded-lg border border-border/60"></div>
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-24 bg-muted-foreground/12 dark:bg-muted-foreground/20 rounded-lg border border-border/60"></div>
                        <div class="h-9 w-24 bg-muted-foreground/12 dark:bg-muted-foreground/20 rounded-lg border border-border/60"></div>
                    </div>
                </div>
                <div class="w-full overflow-hidden rounded-xl border border-border bg-card shadow-2xs">
                    <div class="h-10 bg-muted-foreground/8 dark:bg-muted/40 border-b border-border flex items-center px-4 gap-6">
                        <div class="h-3 w-16 bg-muted-foreground/25 dark:bg-muted-foreground/35 rounded"></div>
                        <div class="h-3 w-32 bg-muted-foreground/25 dark:bg-muted-foreground/35 rounded"></div>
                        <div class="h-3 w-40 bg-muted-foreground/25 dark:bg-muted-foreground/35 rounded"></div>
                        <div class="h-3 w-28 bg-muted-foreground/25 dark:bg-muted-foreground/35 rounded"></div>
                    </div>
                    <div class="divide-y divide-border/60">
                        <div class="h-12 flex items-center px-4 gap-6">
                            <div class="h-3.5 w-12 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-28 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-36 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-24 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                        </div>
                        <div class="h-12 flex items-center px-4 gap-6">
                            <div class="h-3.5 w-12 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-32 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-28 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-24 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                        </div>
                        <div class="h-12 flex items-center px-4 gap-6">
                            <div class="h-3.5 w-12 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-24 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-40 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-20 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                        </div>
                        <div class="h-12 flex items-center px-4 gap-6">
                            <div class="h-3.5 w-12 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-36 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-28 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                            <div class="h-3.5 w-24 bg-muted-foreground/15 dark:bg-muted-foreground/20 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }

    /**
     * Context Menu flag.
     * Can be set to true directly ($this->contextMenu = true) or via $this->setContextMenuEnabled().
     */
    public bool $contextMenu = false;

    public string $contextMenuWidth = '48';

    public bool $contextMenuCloseOnClick = true;

    protected bool $contextMenuStatus = false;

    public function setContextMenuWidth(string $width): self
    {
        $this->contextMenuWidth = $width;

        return $this;
    }

    public function setContextMenuCloseOnClick(bool $status): self
    {
        $this->contextMenuCloseOnClick = $status;

        return $this;
    }

    public function setContextMenuStatus(bool $status): self
    {
        $this->contextMenuStatus = $status;

        return $this;
    }

    public function setContextMenuEnabled(): self
    {
        return $this->setContextMenuStatus(true);
    }

    public function setContextMenuDisabled(): self
    {
        return $this->setContextMenuStatus(false);
    }

    public function hasContextMenu(): bool
    {
        return ($this->contextMenu || $this->contextMenuStatus) && ! empty($this->contextMenu());
    }

    /**
     * Data passed from the row to Alpine $context.data on right-click.
     * Can be overridden by child tables to provide additional row fields.
     */
    public function contextData($row): array
    {
        return [
            'id' => $row->{$this->getPrimaryKey()},
        ];
    }

    /**
     * Default context menu template.
     * Can be overridden by child tables (similar to placeholder()).
     */
    public function contextMenu(): ?string
    {
        return <<<'HTML'
            <vibe:context.label>
                <span x-text="$context.data.name"></span>
            </vibe:context.label>
            <vibe:context.divider />
            <vibe:context.item @click="$wire.edit($context.data.id)">
                <svg class="size-4 mr-2 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                Edit
            </vibe:context.item>
            <vibe:context.item.delete wire:click="delete($context.data.id)" />
        HTML;
    }

    /**
     * Custom Bulk Actions template view (Blade HTML string).
     */
    public ?string $bulkActionsView = null;

    /**
     * Whether to render bulk actions as a traditional dropdown instead of button group.
     */
    public bool $bulkActionsAsDropdown = false;

    public function setBulkActionsView(?string $view): self
    {
        $this->bulkActionsView = $view;

        return $this;
    }

    public function setBulkActionsAsDropdown(bool $status = true): self
    {
        $this->bulkActionsAsDropdown = $status;

        return $this;
    }

    public function isBulkActionsAsDropdown(): bool
    {
        return $this->bulkActionsAsDropdown;
    }

    /**
     * Default Bulk Actions template (mirip placeholder() dan contextMenu()).
     * Secara bawaan langsung merender Button Group dengan vibe:button.group dan vibe:button.delete.
     * Dapat di-override oleh child table jika ingin kustomisasi tata letak.
     */
    public function bulkActionsView(): ?string
    {
        if ($this->bulkActionsView !== null) {
            return $this->bulkActionsView;
        }

        return <<<'HTML'
            <div x-cloak x-show="(selectedItems?.length ?? 0) > 0 || hideBulkActionsWhenEmpty == false" class="flex flex-wrap items-center gap-2 w-full sm:w-auto sm:justify-end">
                @foreach ($table->getBulkActions() as $action => $title)
                    @php
                        $actionLower = strtolower($action);
                        $titleLower = strtolower($title);
                        $isExport = str_contains($actionLower, 'export') || str_contains($titleLower, 'export') || str_contains($titleLower, 'ekspor') || str_contains($titleLower, 'csv');
                        $isDelete = str_contains($actionLower, 'delete') || str_contains($titleLower, 'delete') || str_contains($titleLower, 'hapus') || str_contains($titleLower, 'trash');
                    @endphp

                    @if ($isDelete)
                        <vibe:button.delete
                            variant="outline"
                            size="sm"
                            wire:click="{{ $action }}"
                            :message="$table->hasConfirmationMessage($action) ? $table->getBulkActionConfirmMessage($action) : null"
                            wire:key="{{ $table->getTableName() }}-bulk-action-btn-{{ $action }}"
                            wire:loading.attr="disabled"
                            x-bind:disabled="(selectedItems?.length ?? 0) === 0"
                            class="flex-1 sm:flex-none justify-center gap-1.5 font-medium px-3 text-destructive hover:bg-destructive/10 hover:text-destructive shadow-2xs"
                            title="{{ $title }}"
                            aria-label="{{ $title }}"
                        >
                            <svg class="size-3.5 text-destructive shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16M10 11v6M14 11v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            <span class="text-xs">{{ $title }}<span x-show="(selectedItems?.length ?? 0) > 0" x-text="' (' + (selectedItems?.length ?? 0) + ')'"></span></span>
                        </vibe:button.delete>
                    @else
                        <vibe:button
                            type="button"
                            variant="outline"
                            size="sm"
                            wire:click="{{ $action }}"
                            :wire:confirm="$table->hasConfirmationMessage($action) ? $table->getBulkActionConfirmMessage($action) : null"
                            wire:key="{{ $table->getTableName() }}-bulk-action-btn-{{ $action }}"
                            wire:loading.attr="disabled"
                            x-bind:disabled="(selectedItems?.length ?? 0) === 0"
                            class="flex-1 sm:flex-none justify-center gap-1.5 font-medium px-3 shadow-2xs"
                            title="{{ $title }}"
                            aria-label="{{ $title }}"
                        >
                            @if ($isExport)
                                <svg class="size-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7c0-1.886 0-2.828.586-3.414C5.172 3 6.114 3 8 3h6.172a3 3 0 0 1 2.121.879l2.828 2.828A3 3 0 0 1 20 8.828V17c0 1.886 0 2.828-.586 3.414C18.828 21 17.886 21 16 21H8c-1.886 0-2.828 0-3.414-.586C4 19.828 4 18.886 4 17V7z" />
                                    <path d="M8 12h8M8 16h5" />
                                </svg>
                            @else
                                <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M8 12l3 3 5-5" />
                                </svg>
                            @endif
                            <span class="text-xs">{{ $title }}<span x-show="(selectedItems?.length ?? 0) > 0" x-text="' (' + (selectedItems?.length ?? 0) + ')'"></span></span>
                        </vibe:button>
                    @endif
                @endforeach
            </div>
        HTML;
    }

    /**
     * Determine if bulk actions should be considered present.
     */
    public function hasBulkActions(): bool
    {
        if ($this->bulkActionsView !== null) {
            return ! empty($this->bulkActionsView);
        }

        return count($this->bulkActions()) > 0;
    }
}
