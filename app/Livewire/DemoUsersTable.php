<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;
use Illuminate\Support\Facades\Blade;

class DemoUsersTable extends VibeDataTableComponent
{
    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id');
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

            Column::make('Actions')
                ->label(fn($row) => Blade::render('
                    <vibe:button.group>
                        <vibe:button size="xs" variant="outline" wire:click="edit({{ $row->id }})">Edit</vibe:button>
                        <vibe:button size="xs" variant="danger" wire:click="delete({{ $row->id }})">Delete</vibe:button>
                    </vibe:button.group>
                ', ['row' => $row]))
                ->html(),
        ];
    }
}
