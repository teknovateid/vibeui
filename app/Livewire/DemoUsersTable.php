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
                        <vibe:button.edit size="icon-xs" variant="ghost" class="text-muted-foreground hover:text-foreground" wire:click="edit({{ $row->id }})" />
                        <vibe:button.delete size="icon-xs" variant="ghost" wire:click="delete({{ $row->id }})" />
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
