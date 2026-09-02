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

            Column::make('Status')
                ->label(fn ($row) => $row->id % 2 === 0
                    ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 border border-emerald-500/20">Active</span>'
                    : '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground border border-border">Inactive</span>'
                )
                ->html(),

            Column::make('Actions')
                ->label(fn ($row) => Blade::render('
                    <vibe:button.group variant="ghost">
                        <vibe:button size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" title="Edit" wire:click="edit({{ $row->id }})">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        </vibe:button>
                        <vibe:button.delete size="icon-xs" variant="ghost" wire:click="delete({{ $row->id }})" />
                    </vibe:button.group>
                ', ['row' => $row]))
                ->html(),
        ];
    }

    public function edit($id): void
    {
        $this->dispatch('alert', [
            'type' => 'info',
            'title' => 'Edit User',
            'message' => "Edit data user ID #{$id}.",
        ]);
    }

    public function delete($id): void
    {
        $this->dispatch('toast', [
            'type' => 'success',
            'title' => 'Berhasil Dihapus',
            'message' => "Data user ID #{$id} telah berhasil dihapus.",
        ]);
    }
}
