<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoFilterTable extends VibeDataTableComponent
{
    public string $tableName = 'filter_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc');
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Domain Email')
                ->options([
                    '' => 'Semua Domain',
                    'example.com' => '@example.com',
                    'test.com' => '@test.com',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if (! empty($value)) {
                        $builder->where('email', 'like', '%' . $value);
                    }
                }),
        ];
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
}
