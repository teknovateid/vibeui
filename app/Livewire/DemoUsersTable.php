<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoUsersTable extends VibeDataTableComponent
{
    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setFooterStatus(true)
            ->setBulkActions([
                'exportSelected' => 'Ekspor CSV',
                'deleteSelected' => 'Hapus Terpilih',
            ]);
    }

    public function builder(): Builder
    {
        return User::query();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Domain')
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
                ->sortable()
                ->footer(fn ($rows) => 'Total: ' . $rows->count()),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Created At', 'created_at')
                ->sortable(),

            Column::make('Actions')
                ->label(fn ($row) => Blade::render('
                    <vibe:button.group variant="ghost">
                        <vibe:button size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" title="Edit" wire:click="edit({{ $row->id }})">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        </vibe:button>
                        <vibe:button size="icon-xs" variant="ghost" class="text-destructive/80 hover:text-destructive hover:bg-destructive/10" title="Delete" wire:click="delete({{ $row->id }})">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </vibe:button>
                    </vibe:button.group>
                ', ['row' => $row]))
                ->html(),
        ];
    }

    public function exportSelected(): void
    {
        $this->clearSelected();
    }

    public function deleteSelected(): void
    {
        $this->clearSelected();
    }

    public function edit($id): void
    {
    }

    public function delete($id): void
    {
    }
}
