<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/context.title')" :description="__('docs/context.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/context.title'), 'url' => '/docs/context']
    ]" />


    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/context.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/context.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/context.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/context.description') }}
                </p>

                {{-- Quick Subcomponents Strip --}}
                @php
                    $contextTags = ['&lt;vibe:context&gt;', '&lt;vibe:context.menu&gt;', '&lt;vibe:context.item&gt;', '&lt;vibe:context.item.delete&gt;', '&lt;vibe:context.label&gt;', '&lt;vibe:context.divider&gt;', '&lt;vibe:context.sub&gt;'];
                @endphp
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach ($contextTags as $tag)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{!! $tag !!}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.basic_usage.desc') !!}</p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/context.basic_usage.preview_title')" minHeight="220px">
                    <vibe:preview.code>
<vibe:context menu="basic-card-menu">
    <vibe:card class="cursor-context-menu select-none">
        <div class="p-6 text-center space-y-2">
            <svg class="size-8 mx-auto text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            <p class="text-sm text-muted-foreground">{{ __('docs/context.basic_usage.card_hint') }}</p>
        </div>
    </vibe:card>
</vibe:context>

<vibe:context.menu id="basic-card-menu" width="48">
    <vibe:context.item>
        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
        {{ __('docs/context.basic_usage.edit') }}
    </vibe:context.item>
    <vibe:context.item>
        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
        {{ __('docs/context.basic_usage.duplicate') }}
    </vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item.delete />
</vibe:context.menu>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center items-center p-10">
                        <div class="w-72">
                            <vibe:context menu="basic-card-menu-demo">
                                <vibe:card class="cursor-context-menu select-none border-dashed hover:border-primary/50 transition-colors">
                                    <div class="p-8 text-center space-y-3">
                                        <div class="size-12 rounded-full bg-primary/10 flex items-center justify-center mx-auto">
                                            <svg class="size-6 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-foreground">{{ __('docs/context.basic_usage.card_text') }}</p>
                                            <p class="text-xs text-muted-foreground mt-1">{{ __('docs/context.basic_usage.card_hint') }}</p>
                                        </div>
                                    </div>
                                </vibe:card>
                            </vibe:context>
                        </div>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="basic-card-menu-demo" width="48">
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.basic_usage.toast_edit') }}')">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        {{ __('docs/context.basic_usage.edit') }}
                    </vibe:context.item>
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.basic_usage.toast_duplicate') }}')">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        {{ __('docs/context.basic_usage.duplicate') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item.delete x-on:click.stop="vibeConfirmDelete($el, () => { $vibe.toast.success('{{ __('docs/context.basic_usage.toast_delete') }}') })" />
                </vibe:context.menu>
            </section>

            {{-- 2. Blade Table Integration (<vibe:table>) --}}
            <section id="penerapan-vibe-table" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.blade_table.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.blade_table.desc') !!}</p>
                </div>

                @php
                    $sampleUsers = [
                        ['id' => 1, 'name' => 'Alex Morgan', 'email' => 'alex@example.com', 'role' => __('docs/context.blade_table.role_admin'), 'status' => 'active'],
                        ['id' => 2, 'name' => 'Sarah Connor', 'email' => 'sarah@example.com', 'role' => __('docs/context.blade_table.role_manager'), 'status' => 'active'],
                        ['id' => 3, 'name' => 'John Doe', 'email' => 'john@example.com', 'role' => __('docs/context.blade_table.role_developer'), 'status' => 'inactive'],
                    ];
                @endphp

                <vibe:preview data-toc-ignore :title="__('docs/context.blade_table.preview_title')" minHeight="240px">
                    <vibe:preview.code>
@if (app()->getLocale() === 'id')
@verbatim
{{-- Instans context menu global tunggal di luar tabel --}}
<vibe:context.menu id="table-row-menu" width="52">
    <vibe:context.label>
        <span x-text="$context.data?.name ?? 'User'"></span>
    </vibe:context.label>
    <vibe:context.divider />
    <vibe:context.item @click="editUser($context.data.id)">
        <svg class="size-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        Edit Pengguna
    </vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item.delete @click="deleteUser($context.data.id)" />
</vibe:context.menu>

<vibe:table>
    <vibe:table.header>
        <vibe:table.column>ID</vibe:table.column>
        <vibe:table.column>Nama Pengguna</vibe:table.column>
        <vibe:table.column>Email</vibe:table.column>
        <vibe:table.column>Peran</vibe:table.column>
    </vibe:table.header>
    <vibe:table.rows>
        @foreach ($users as $user)
            {{-- Setiap baris memancarkan event open-context dengan payload data baris --}}
            <vibe:table.row
                class="cursor-context-menu select-none"
                @contextmenu.prevent="$dispatch('open-context', {
                    menu: 'table-row-menu',
                    x: $event.clientX,
                    y: $event.clientY,
                    data: {{ json_encode(['id' => $user->id, 'name' => $user->name]) }}
                })"
            >
                <vibe:table.cell>{{ $user->id }}</vibe:table.cell>
                <vibe:table.cell>{{ $user->name }}</vibe:table.cell>
                <vibe:table.cell>{{ $user->email }}</vibe:table.cell>
                <vibe:table.cell>{{ $user->role }}</vibe:table.cell>
            </vibe:table.row>
        @endforeach
    </vibe:table.rows>
</vibe:table>
@endverbatim
@else
@verbatim
{{-- Single global context menu instance placed outside the table --}}
<vibe:context.menu id="table-row-menu" width="52">
    <vibe:context.label>
        <span x-text="$context.data?.name ?? 'User'"></span>
    </vibe:context.label>
    <vibe:context.divider />
    <vibe:context.item @click="editUser($context.data.id)">
        <svg class="size-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        Edit User
    </vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item.delete @click="deleteUser($context.data.id)" />
</vibe:context.menu>

<vibe:table>
    <vibe:table.header>
        <vibe:table.column>ID</vibe:table.column>
        <vibe:table.column>User Name</vibe:table.column>
        <vibe:table.column>Email</vibe:table.column>
        <vibe:table.column>Role</vibe:table.column>
    </vibe:table.header>
    <vibe:table.rows>
        @foreach ($users as $user)
            {{-- Each row dispatches open-context event with row data payload --}}
            <vibe:table.row
                class="cursor-context-menu select-none"
                @contextmenu.prevent="$dispatch('open-context', {
                    menu: 'table-row-menu',
                    x: $event.clientX,
                    y: $event.clientY,
                    data: {{ json_encode(['id' => $user->id, 'name' => $user->name]) }}
                })"
            >
                <vibe:table.cell>{{ $user->id }}</vibe:table.cell>
                <vibe:table.cell>{{ $user->name }}</vibe:table.cell>
                <vibe:table.cell>{{ $user->email }}</vibe:table.cell>
                <vibe:table.cell>{{ $user->role }}</vibe:table.cell>
            </vibe:table.row>
        @endforeach
    </vibe:table.rows>
</vibe:table>
@endverbatim
@endif
                    </vibe:preview.code>
                    <div class="w-full p-4 overflow-x-auto">
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column class="w-16">{{ __('docs/context.blade_table.col_id') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/context.blade_table.col_name') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/context.blade_table.col_email') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/context.blade_table.col_role') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/context.blade_table.col_status') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @foreach ($sampleUsers as $user)
                                    <vibe:table.row
                                        class="cursor-context-menu select-none hover:bg-muted/50"
                                        @contextmenu.prevent="$dispatch('open-context', {
                                            menu: 'blade-table-context-menu',
                                            x: $event.clientX,
                                            y: $event.clientY,
                                            data: {{ json_encode($user) }}
                                        })"
                                    >
                                        <vibe:table.cell class="font-mono text-xs">{{ $user['id'] }}</vibe:table.cell>
                                        <vibe:table.cell class="font-medium text-foreground">{{ $user['name'] }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{{ $user['email'] }}</vibe:table.cell>
                                        <vibe:table.cell><vibe:badge variant="outline" size="sm">{{ $user['role'] }}</vibe:badge></vibe:table.cell>
                                        <vibe:table.cell>
                                            <vibe:badge :variant="$user['status'] === 'active' ? 'success' : 'secondary'" size="sm" class="rounded-full">
                                                {{ $user['status'] === 'active' ? __('docs/context.blade_table.active') : __('docs/context.blade_table.inactive') }}
                                            </vibe:badge>
                                        </vibe:table.cell>
                                    </vibe:table.row>
                                @endforeach
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                </vibe:preview>

                {{-- Single Global Menu for Blade Table Demo --}}
                <vibe:context.menu id="blade-table-context-menu" width="52">
                    <vibe:context.label>
                        <span x-text="$context.data?.name ?? 'User'"></span>
                    </vibe:context.label>
                    <vibe:context.divider />
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.blade_table.toast_edit') }}' + ($context.data?.name || ''))">
                        <svg class="size-4 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        {{ __('docs/context.blade_table.edit') }}
                    </vibe:context.item>
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.blade_table.toast_profile') }}' + ($context.data?.email || ''))">
                        <svg class="size-4 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ __('docs/context.blade_table.view_profile') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item.delete x-on:click.stop="vibeConfirmDelete($el, () => { $vibe.toast.error('{{ __('docs/context.blade_table.toast_delete') }}' + ($context.data?.name || '')) })" />
                </vibe:context.menu>
            </section>

            {{-- 3. Livewire DataTable Integration --}}
            <section id="integrasi-livewire-datatable" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.datatable.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.datatable.desc') !!}</p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/context.datatable.preview_title')" minHeight="280px">
                    <vibe:preview.code language="php">
@if (app()->getLocale() === 'id')
@verbatim
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class UserTable extends VibeDataTableComponent
{
    public function configure(): void
    {
        parent::configure();
        $this->setPrimaryKey('id');

        // 1. Aktifkan context menu baris otomatis
        $this->contextMenu = true;

        // 2. (Opsional) Sesuaikan lebar dropdown menu (default: 48)
        $this->contextMenuWidth = '52';
    }

    // 3. Payload data yang dikirim ke Alpine $context.data saat baris diklik kanan
    public function contextData($row): array
    {
        return [
            'id'   => $row->id,
            'name' => $row->name,
        ];
    }

    // 4. Struktur menu kontekstual baris
    public function contextMenu(): string
    {
        return <<<'HTML'
            <vibe:context.label>
                <span x-text="$context.data.name"></span>
            </vibe:context.label>
            <vibe:context.divider />

            <vibe:context.item @click="$wire.edit($context.data.id)">
                <svg class="size-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Data
            </vibe:context.item>

            <vibe:context.item :href="'https://github.com/teknovateid/vibeui'" target="_blank">
                <svg class="size-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Buka Pratinjau
            </vibe:context.item>

            <vibe:context.divider />

            <vibe:context.item.delete wire:click="delete($context.data.id)" />
        HTML;
    }
}
@endverbatim
@else
@verbatim
use Rappasoft\LaravelLivewireTables\Views\Column;
use Teknovate\VibeUi\DataTable\VibeDataTableComponent;

class UserTable extends VibeDataTableComponent
{
    public function configure(): void
    {
        parent::configure();
        $this->setPrimaryKey('id');

        // 1. Enable automatic row context menu
        $this->contextMenu = true;

        // 2. (Optional) Customize menu dropdown width (default: 48)
        $this->contextMenuWidth = '52';
    }

    // 3. Payload sent to Alpine $context.data when right-clicking a row
    public function contextData($row): array
    {
        return [
            'id'   => $row->id,
            'name' => $row->name,
        ];
    }

    // 4. Custom context menu structure
    public function contextMenu(): string
    {
        return <<<'HTML'
            <vibe:context.label>
                <span x-text="$context.data.name"></span>
            </vibe:context.label>
            <vibe:context.divider />

            <vibe:context.item @click="$wire.edit($context.data.id)">
                <svg class="size-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Data
            </vibe:context.item>

            <vibe:context.item :href="'https://github.com/teknovateid/vibeui'" target="_blank">
                <svg class="size-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Preview Link
            </vibe:context.item>

            <vibe:context.divider />

            <vibe:context.item.delete wire:click="delete($context.data.id)" />
        HTML;
    }
}
@endverbatim
@endif
                    </vibe:preview.code>
                    <div class="w-full p-4">
                        <livewire:demo-context-menu-table />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. With Submenu --}}
            <section id="dengan-submenu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.with_submenu.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.with_submenu.desc') !!}</p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/context.with_submenu.preview_title')" minHeight="240px">
                    <vibe:preview.code>
<vibe:context menu="submenu-demo-menu">
    <div class="p-10 border border-dashed border-border rounded-xl text-center cursor-context-menu select-none">
        <p class="text-sm text-muted-foreground">{{ __('docs/context.with_submenu.click_hint') }}</p>
    </div>
</vibe:context>

<vibe:context.menu id="submenu-demo-menu" width="52">
    <vibe:context.item>
        <svg class="size-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        {{ __('docs/context.with_submenu.open') }}
    </vibe:context.item>

    {{-- Submenu --}}
    <vibe:context.sub label="{{ __('docs/context.with_submenu.share') }}" width="48">
        <vibe:context.item>{{ __('docs/context.with_submenu.share_email') }}</vibe:context.item>
        <vibe:context.item>{{ __('docs/context.with_submenu.share_slack') }}</vibe:context.item>
        <vibe:context.item>{{ __('docs/context.with_submenu.share_teams') }}</vibe:context.item>
    </vibe:context.sub>

    <vibe:context.divider />
    <vibe:context.item.delete />
</vibe:context.menu>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center items-center p-10">
                        <div class="w-80">
                            <vibe:context menu="submenu-demo-menu-live">
                                <vibe:card class="cursor-context-menu select-none border-dashed hover:border-primary/50 transition-colors">
                                    <div class="p-8 text-center space-y-2">
                                        <svg class="size-8 mx-auto text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 15 6 6m-6-6v4.8m0-4.8h4.8"/><path d="M9 19.4V15a2 2 0 0 0-2-2H2.6"/><path d="M15 9V4.6a2 2 0 0 0-2-2H8.6"/><path d="M9 4.6V9a2 2 0 0 1-2 2H2.6"/></svg>
                                        <p class="text-sm font-medium text-foreground">{{ __('docs/context.with_submenu.area_text') }}</p>
                                    </div>
                                </vibe:card>
                            </vibe:context>
                        </div>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="submenu-demo-menu-live" width="52">
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.with_submenu.toast_open') }}')">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                        {{ __('docs/context.with_submenu.open') }}
                    </vibe:context.item>

                    <vibe:context.sub :label="__('docs/context.with_submenu.share')" width="48">
                        <vibe:context.item @click="$vibe.toast.success('{{ __('docs/context.with_submenu.toast_share_email') }}')">
                            {{ __('docs/context.with_submenu.share_email') }}
                        </vibe:context.item>
                        <vibe:context.item @click="$vibe.toast.success('{{ __('docs/context.with_submenu.toast_share_slack') }}')">
                            {{ __('docs/context.with_submenu.share_slack') }}
                        </vibe:context.item>
                        <vibe:context.item @click="$vibe.toast.success('{{ __('docs/context.with_submenu.toast_share_teams') }}')">
                            {{ __('docs/context.with_submenu.share_teams') }}
                        </vibe:context.item>
                    </vibe:context.sub>

                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.with_submenu.toast_rename') }}')">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        {{ __('docs/context.with_submenu.rename') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item.delete x-on:click.stop="vibeConfirmDelete($el, () => { $vibe.toast.error('{{ __('docs/context.with_submenu.toast_delete') }}') })" />
                </vibe:context.menu>
            </section>

            {{-- 5. Destructive Action Item --}}
            <section id="aksi-destructive" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.destructive.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.destructive.desc') !!}</p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/context.destructive.preview_title')" minHeight="200px">
                    <vibe:preview.code>
<vibe:context menu="destructive-demo-menu">
    <div class="p-8 border border-destructive/30 bg-destructive/5 rounded-xl text-center cursor-context-menu select-none">
        <p class="text-sm font-medium text-destructive">{{ __('docs/context.destructive.click_hint') }}</p>
    </div>
</vibe:context>

<vibe:context.menu id="destructive-demo-menu" width="48">
    <vibe:context.item>
        <svg class="size-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        {{ __('docs/context.destructive.edit') }}
    </vibe:context.item>
    <vibe:context.divider />

    <vibe:context.item.delete wire:click="delete(1)" />
</vibe:context.menu>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center items-center p-8">
                        <div class="w-80">
                            <vibe:context menu="destructive-demo-menu-live">
                                <div class="p-8 border border-dashed border-destructive/40 bg-destructive/5 rounded-xl text-center cursor-context-menu select-none hover:bg-destructive/10 transition-colors">
                                    <svg class="size-8 mx-auto text-destructive mb-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    <p class="text-sm font-medium text-destructive">{{ __('docs/context.destructive.box_text') }}</p>
                                </div>
                            </vibe:context>
                        </div>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="destructive-demo-menu-live" width="48">
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.destructive.toast_edit') }}')">
                        <svg class="size-4 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        {{ __('docs/context.destructive.edit') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item.delete x-on:click.stop="vibeConfirmDelete($el, () => { $vibe.toast.error('{{ __('docs/context.destructive.toast_delete') }}') })" />
                </vibe:context.menu>
            </section>

            {{-- 6. Programmatic Control --}}
            <section id="kontrol-programatik" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.programmatic.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.programmatic.desc') !!}</p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/context.programmatic.preview_title')" minHeight="200px">
                    <vibe:preview.code>
<div class="flex gap-3">
    <vibe:button variant="outline" @click="$vibe.context('prog-menu').show($event.clientX, $event.clientY, { id: 99, name: '{{ __('docs/context.programmatic.sample_item_name') }}' })">
        {{ __('docs/context.programmatic.open_btn') }}
    </vibe:button>
    <vibe:button variant="ghost" @click="$vibe.contexts.close()">
        {{ __('docs/context.programmatic.close_btn') }}
    </vibe:button>
</div>

<vibe:context.menu id="prog-menu" width="48">
    <vibe:context.label>
        <span x-text="$context.data?.name ?? 'Menu'"></span>
    </vibe:context.label>
    <vibe:context.divider />
    <vibe:context.item @click="$vibe.toast.info('ID: ' + $context.data?.id)">
        {{ __('docs/context.programmatic.edit') }}
    </vibe:context.item>
</vibe:context.menu>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center items-center gap-3 p-10">
                        <vibe:button
                            variant="primary"
                            @click="$vibe.context('prog-menu-demo').show($event.clientX, $event.clientY, { id: 42, name: '{{ __('docs/context.programmatic.sample_item_name') }}' })"
                        >
                            {{ __('docs/context.programmatic.open_btn') }}
                        </vibe:button>
                        <vibe:button
                            variant="outline"
                            @click="$vibe.contexts.close()"
                        >
                            {{ __('docs/context.programmatic.close_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="prog-menu-demo" width="48">
                    <vibe:context.label>
                        <span x-text="$context.data?.name ?? 'Menu'"></span>
                    </vibe:context.label>
                    <vibe:context.divider />
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.programmatic.toast_edit') }}' + ($context.data?.id ?? ''))">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        {{ __('docs/context.programmatic.edit') }}
                    </vibe:context.item>
                    <vibe:context.item @click="$vibe.toast.info('{{ __('docs/context.programmatic.toast_duplicate') }}' + ($context.data?.id ?? ''))">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        {{ __('docs/context.programmatic.duplicate') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item.delete x-on:click.stop="vibeConfirmDelete($el, () => { $vibe.toast.error('{{ __('docs/context.programmatic.toast_delete') }}') })" />
                </vibe:context.menu>
            </section>

            {{-- 7. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.props.desc') !!}</p>
                </div>

                @php
                    $propsSections = [
                        [
                            'title' => '&lt;vibe:context&gt;',
                            'props' => [
                                ['menu', 'string', 'null', __('docs/context.props_items.context.menu')],
                            ]
                        ],
                        [
                            'title' => '&lt;vibe:context.menu&gt;',
                            'props' => [
                                ['id', 'string', 'uniqid()', __('docs/context.props_items.menu.id')],
                                ['width', 'string', "'48'", __('docs/context.props_items.menu.width')],
                                ['closeOnClick', 'boolean', 'true', __('docs/context.props_items.menu.closeOnClick')],
                            ]
                        ],
                        [
                            'title' => '&lt;vibe:context.item&gt;',
                            'props' => [
                                ['href', 'string|null', 'null', __('docs/context.props_items.item.href')],
                                ['variant', 'string', "'default'", __('docs/context.props_items.item.variant')],
                                ['disabled', 'boolean', 'false', __('docs/context.props_items.item.disabled')],
                                ['closeOnClick', 'boolean', 'true', __('docs/context.props_items.item.closeOnClick')],
                            ]
                        ],
                        [
                            'title' => '&lt;vibe:context.item.delete&gt;',
                            'props' => [
                                ['label', 'string|null', "'" . __('vibe/context.delete') . "'", __('docs/context.props_items.item_delete.label')],
                                ['variant', 'string', "'ghost'", __('docs/context.props_items.item_delete.variant')],
                                ['title', 'string', "__('vibe/context.delete_title')", __('docs/context.props_items.item_delete.title')],
                                ['message', 'string', "__('vibe/context.delete_message')", __('docs/context.props_items.item_delete.message')],
                                ['confirmText', 'string', "__('vibe/context.delete_confirm')", __('docs/context.props_items.item_delete.confirmText')],
                                ['cancelText', 'string', "__('vibe/context.delete_cancel')", __('docs/context.props_items.item_delete.cancelText')],
                                ['action', 'string|null', 'null', __('docs/context.props_items.item_delete.action')],
                                ['url', 'string|null', 'null', __('docs/context.props_items.item_delete.url')],
                                ['wire:click', '—', '—', __('docs/context.props_items.item_delete.wire:click')],
                                ['closeOnClick', 'boolean', 'true', __('docs/context.props_items.item_delete.closeOnClick')],
                            ]
                        ],
                        [
                            'title' => '&lt;vibe:context.sub&gt;',
                            'props' => [
                                ['label', 'string', "''", __('docs/context.props_items.sub.label')],
                                ['align', 'string', "'right'", __('docs/context.props_items.sub.align')],
                                ['width', 'string', "'48'", __('docs/context.props_items.sub.width')],
                            ]
                        ],
                    ];
                @endphp

                @foreach ($propsSections as $section)
                    <div class="space-y-3">
                        <h3 class="text-base font-semibold font-mono text-foreground">{!! $section['title'] !!}</h3>
                        <vibe:table>
                            <vibe:table.header>
                                <vibe:table.column class="whitespace-nowrap">{{ __('docs/context.props.columns.prop') }}</vibe:table.column>
                                <vibe:table.column class="whitespace-nowrap">{{ __('docs/context.props.columns.type') }}</vibe:table.column>
                                <vibe:table.column class="whitespace-nowrap">{{ __('docs/context.props.columns.default') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/context.props.columns.desc') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @foreach ($section['props'] as [$prop, $type, $default, $desc])
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                                    </vibe:table.row>
                                @endforeach
                            </vibe:table.rows>
                        </vibe:table>
                    </div>
                @endforeach

                {{-- Events & Helpers --}}
                <div class="space-y-3 pt-4">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/context.props.events_title') }}</h3>
                    <p class="text-xs text-muted-foreground">{{ __('docs/context.props.events_desc') }}</p>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/context.props.th_event') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/context.props.th_payload') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/context.props.th_event_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/context.props.events') as $event)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $event['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground text-xs whitespace-nowrap">{{ $event['payload'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $event['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
