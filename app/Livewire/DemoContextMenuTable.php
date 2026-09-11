<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class DemoContextMenuTable extends VibeDataTableComponent
{
    public string $tableName = 'demo_context_menu_table';

    public function configure(): void
    {
        parent::configure();

        $this->setPrimaryKey('id')
            ->setPerPageAccepted([5, 10, 25])
            ->setDefaultPerPage(5);

        // Aktifkan context menu klik-kanan pada seluruh baris tabel
        $this->contextMenu = true;
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

            Column::make(__('docs/context.blade_table.col_name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('docs/context.blade_table.col_email'), 'email')
                ->sortable()
                ->searchable(),

            Column::make(__('docs/context.blade_table.col_status'))
                ->label(fn ($row) => $row->id % 2 === 0
                    ? Blade::render('<vibe:badge variant="success" size="sm" class="rounded-full">' . __('docs/context.blade_table.active') . '</vibe:badge>')
                    : Blade::render('<vibe:badge variant="secondary" size="sm" class="rounded-full">' . __('docs/context.blade_table.inactive') . '</vibe:badge>')
                )
                ->html(),
        ];
    }

    /**
     * Data baris yang dikirim ke Alpine $context.data saat baris diklik kanan.
     */
    public function contextData($row): array
    {
        return [
            'id'    => $row->id,
            'name'  => $row->name,
        ];
    }

    /**
     * Custom Context Menu untuk tabel ini (mirip method placeholder()).
     */
    public function contextMenu(): string
    {
        return <<<'HTML'
            <vibe:context.label>
                <span x-text="$context.data.name"></span>
            </vibe:context.label>
            <vibe:context.divider />

            <vibe:context.item @click="$wire.edit($context.data.id)">
                <svg class="size-4 mr-2 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                {{ __('docs/context.datatable.edit_action') }}
            </vibe:context.item>

            <vibe:context.item :href="'https://github.com/teknovateid/vibeui'" target="_blank">
                <svg class="size-4 mr-2 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                {{ __('docs/context.datatable.preview_action') }}
            </vibe:context.item>

            <vibe:context.divider />

            <vibe:context.item.delete wire:click="delete($context.data.id)" />
        HTML;
    }

    public function edit(string $id): void
    {
        $this->dispatch('alert', [
            'type'    => 'info',
            'title'   => __('docs/context.datatable.edit_action'),
            'message' => __('docs/context.blade_table.toast_edit') . "ID #{$id}",
        ]);
    }

    public function delete(string $id): void
    {
        $this->dispatch('toast', [
            'type'    => 'success',
            'title'   => __('vibe/context.delete'),
            'message' => __('docs/context.blade_table.toast_delete') . "ID #{$id}",
        ]);
    }
}
