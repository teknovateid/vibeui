<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFooterTable extends VibeDataTableComponent
{
    public string $tableName = 'footer_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setFooterStatus(true);
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->footer(fn ($rows) => 'Total: ' . $rows->count() . ' User'),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->footer(fn () => 'Ringkasan Halaman'),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),
        ];
    }
}
