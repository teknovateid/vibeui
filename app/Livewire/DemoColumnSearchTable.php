<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoColumnSearchTable extends VibeDataTableComponent
{
    public string $searchId = '';
    public string $searchName = '';
    public string $searchEmail = '';

    public string $tableName = 'col_search_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setSecondaryHeaderStatus(true);
    }

    public function builder(): Builder
    {
        return User::query()
            ->when($this->searchId, fn (Builder $q, $val) => $q->whereRaw('CAST(id AS TEXT) LIKE ?', ['%' . trim($val) . '%']))
            ->when($this->searchName, fn (Builder $q, $val) => $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($val)) . '%']))
            ->when($this->searchEmail, fn (Builder $q, $val) => $q->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower(trim($val)) . '%']));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchId" placeholder="ID..." class="w-20" />'))
                ->html(),

            Column::make('Name', 'name')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchName" placeholder="Cari nama..." />'))
                ->html(),

            Column::make('Email', 'email')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<vibe:input size="sm" wire:model.live.debounce.300ms="searchEmail" placeholder="Cari email..." />'))
                ->html(),

            Column::make('Created At', 'created_at')
                ->sortable()
                ->secondaryHeader(fn () => Blade::render('<span class="text-xs text-muted-foreground">-</span>'))
                ->html(),
        ];
    }
}
