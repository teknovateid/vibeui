<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoBulkTable extends VibeDataTableComponent
{
    public string $tableName = 'bulk_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setBulkActions([
                'exportSelected' => 'Ekspor Data (CSV)',
                'deleteSelected' => 'Hapus Terpilih',
            ])
            ->setPerPageAccepted([5, 10, 25])
            ->setDefaultPerPage(5);
    }

    public function exportSelected(): void
    {
        $selectedIds = $this->getSelected();
        $this->clearSelected();
    }

    public function deleteSelected(): void
    {
        $selectedIds = $this->getSelected();
        $this->clearSelected();
    }

    public function builder(): Builder
    {
        return User::query()->select(['id', 'name', 'email', 'created_at']);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Name', 'name')->sortable()->searchable(),
            Column::make('Email', 'email')->sortable()->searchable(),
            Column::make('Created At', 'created_at')->sortable(),
        ];
    }
}
