<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoPerformanceTable extends VibeDataTableComponent
{
    public string $tableName = 'perf_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setPerPageAccepted([25, 50, 100, 250])
            ->setSearchDebounce(300)
            ->setFooterStatus(true);
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
                ->footer(fn ($rows) => 'Halaman: ' . $rows->count()),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->footer(fn () => 'Total: ' . number_format(User::count()) . ' Data'),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->format(fn ($val) => $val ? $val->format('d M Y H:i') : '-'),
        ];
    }
}
