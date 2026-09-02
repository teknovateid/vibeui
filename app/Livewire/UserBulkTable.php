<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class UserBulkTable extends VibeDataTableComponent
{
    public function configure(): void
    {
        parent::configure();
        
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        // return \App\Models\YourModel::query();
        throw new \Exception('Please return an Eloquent query builder in ' . __METHOD__);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            // Column::make('Name', 'name')
            //     ->sortable()
            //     ->searchable(),
        ];
    }
}
