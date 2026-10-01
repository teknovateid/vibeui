<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoActionsTable extends VibeDataTableComponent
{
    public string $tableName = 'actions_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
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
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Status')
                ->label(fn ($row) => $row->id % 2 === 0
                    ? Blade::render('<vibe:badge variant="success" size="sm" class="rounded-full">Active</vibe:badge>')
                    : Blade::render('<vibe:badge variant="secondary" size="sm" class="rounded-full">Inactive</vibe:badge>')
                )
                ->html(),

            Column::make('Actions')
                ->label(fn ($row) => Blade::render('
                    <vibe:button.group variant="ghost">
                        <vibe:button.edit size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" wire:click="edit({{ $row->id }})" />
                        <vibe:button.delete size="icon-xs" variant="ghost" wire:click="delete({{ $row->id }})" />
                    </vibe:button.group>
                ', ['row' => $row]))
                ->html(),
        ];
    }

    
    public function edit(string $id): void
    {
        $this->dispatch('alert', [
            'type' => 'info',
            'title' => 'Edit User',
            'message' => "Edit data user ID #{$id}.",
        ]);
    }

    public function delete(string $id): void
    {
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Berhasil Dihapus',
            'message' => "Data user ID #{$id} telah berhasil dihapus.",
        ]);
    }
}
