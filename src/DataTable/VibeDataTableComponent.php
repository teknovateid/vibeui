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
}
