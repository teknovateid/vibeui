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

        // Custom default attributes tailored to Vibe UI design tokens
        $this->setComponentWrapperAttributes([
            'class' => 'w-full space-y-4 text-foreground antialiased',
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
                'class' => 'py-3 px-4 font-semibold text-muted-foreground',
            ];
        });

        $this->setTdAttributes(function ($column, $row, $colIndex, $rowIndex) {
            return [
                'class' => 'py-3.5 px-4 align-middle text-foreground',
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
}
