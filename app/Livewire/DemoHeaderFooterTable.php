<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoHeaderFooterTable extends VibeDataTableComponent
{
    public string $tableName = 'header_footer_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setFooterStatus(true)
            ->setUseHeaderAsFooterStatus(true)
            ->setPerPageAccepted([5, 10, 25])
            ->setDefaultPerPage(5);
    }

    public function builder(): Builder
    {
        return User::query()->select(['id', 'name', 'email', 'created_at']);
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
                ->footer(fn () => 'Summary'),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),
        ];
    }
}
