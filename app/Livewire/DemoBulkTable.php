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
            ->setDefaultSort('id', 'asc')
            ->setHideBulkActionsWhenEmptyStatus(false)
            ->setBulkActions([
                'exportSelected' => 'Ekspor CSV',
                'deleteSelected' => 'Hapus Terpilih',
            ]);
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),
        ];
    }

    public function exportSelected(): void
    {
        $count = count($this->getSelected());
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Ekspor Berhasil',
            'message' => "{$count} data terpilih telah berhasil diekspor.",
        ]);
        $this->clearSelected();
    }

    public function deleteSelected(): void
    {
        $count = count($this->getSelected());
        $this->dispatch('alert', [
            'type' => 'info',
            'title' => 'Hapus Massal',
            'message' => "Aksi hapus massal untuk {$count} data dipanggil.",
        ]);
        $this->clearSelected();
    }
}
