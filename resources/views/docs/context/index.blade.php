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
                    $contextTags = ['<vibe:context>', '<vibe:context.menu>', '<vibe:context.item>', '<vibe:context.item.delete>', '<vibe:context.label>', '<vibe:context.divider>', '<vibe:context.sub>'];
                @endphp
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach ($contextTags as $tag)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $tag }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.basic_usage.desc') !!}</p>
                </div>

                <vibe:preview :title="__('docs/context.basic_usage.preview_title')" minHeight="220px">
                    <vibe:preview.code>
@verbatim
<vibe:context menu="basic-card-menu">
    <vibe:card class="cursor-context-menu select-none">
        <div class="p-6 text-center space-y-2">
            <svg class="size-8 mx-auto text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            <p class="text-sm text-muted-foreground">Klik kanan di mana saja pada card ini</p>
        </div>
    </vibe:card>
</vibe:context>

<vibe:context.menu id="basic-card-menu">
    <vibe:context.item>
        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
        Edit
    </vibe:context.item>
    <vibe:context.item>
        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
        Duplicate
    </vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item variant="destructive">
        <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
        Delete
    </vibe:context.item>
</vibe:context.menu>
@endverbatim
                    </vibe:preview.code>
                    <div class="w-full flex justify-center items-center p-10">
                        <div class="w-72">
                            <vibe:context menu="basic-card-menu-demo">
                                <vibe:card class="cursor-context-menu select-none">
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

                <vibe:context.menu id="basic-card-menu-demo">
                    <vibe:context.item>
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        {{ __('docs/context.basic_usage.edit') }}
                    </vibe:context.item>
                    <vibe:context.item>
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        {{ __('docs/context.basic_usage.duplicate') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item variant="destructive">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        {{ __('docs/context.basic_usage.delete') }}
                    </vibe:context.item>
                </vibe:context.menu>
            </section>

            {{-- 2. Datatable Integration --}}
            <section id="datatable" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.datatable.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.datatable.desc') !!}</p>
                </div>

                @php
                    $demoRows = [
                        ['id' => 1, 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'role' => 'Admin'],
                        ['id' => 2, 'name' => 'Bob Martinez', 'email' => 'bob@example.com', 'role' => 'Editor'],
                        ['id' => 3, 'name' => 'Carol White', 'email' => 'carol@example.com', 'role' => 'Viewer'],
                        ['id' => 4, 'name' => 'David Kim', 'email' => 'david@example.com', 'role' => 'Editor'],
                        ['id' => 5, 'name' => 'Eva Chen', 'email' => 'eva@example.com', 'role' => 'Admin'],
                    ];
                @endphp

                <vibe:preview :title="__('docs/context.datatable.preview_title')" minHeight="300px">
                    <vibe:preview.code>
@verbatim
@@php
    $rows = [...]; // Data dari DB / Livewire
@@endphp

<table class="w-full text-sm">
    <tbody>
        @@foreach ($rows as $row)
            <tr class="cursor-context-menu border-b border-border hover:bg-muted/40 transition-colors"
                @contextmenu.prevent="$dispatch('open-context', {
                    menu: 'dt-row-menu',
                    x: $event.clientX,
                    y: $event.clientY,
                    data: @@js(['id' => $row['id'], 'name' => $row['name']])
                })">
                <td class="px-4 py-3">{{ $row['name'] }}</td>
                <td class="px-4 py-3 text-muted-foreground">{{ $row['email'] }}</td>
            </tr>
        @@endforeach
    </tbody>
</table>

{{-- SATU menu untuk semua row --}}
<vibe:context.menu id="dt-row-menu">
    <vibe:context.label>
        <span x-text="$context.data.name ?? 'Row'"></span>
    </vibe:context.label>
    <vibe:context.divider />
    <vibe:context.item @click="$vibe.toast.info('Edit: ' + $context.data.name)">
        Edit
    </vibe:context.item>
    <vibe:context.item.delete wire:click="delete($context.data.id)" />
</vibe:context.menu>
@endverbatim
                    </vibe:preview.code>
                    <div class="w-full p-4">
                        <vibe:card>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-border bg-muted/50">
                                            <th class="text-left px-4 py-3 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.datatable.col_name') }}</th>
                                            <th class="text-left px-4 py-3 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.datatable.col_email') }}</th>
                                            <th class="text-left px-4 py-3 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.datatable.col_role') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($demoRows as $row)
                                            <tr class="cursor-context-menu border-b border-border hover:bg-accent/50 transition-colors"
                                                @contextmenu.prevent="$dispatch('open-context', {
                                                    menu: 'docs-dt-menu',
                                                    x: $event.clientX,
                                                    y: $event.clientY,
                                                    data: @js($row)
                                                })">
                                                <td class="px-4 py-3 font-medium text-foreground">{{ $row['name'] }}</td>
                                                <td class="px-4 py-3 text-muted-foreground">{{ $row['email'] }}</td>
                                                <td class="px-4 py-3">
                                                    <vibe:badge variant="{{ $row['role'] === 'Admin' ? 'default' : ($row['role'] === 'Editor' ? 'secondary' : 'outline') }}" size="sm" class="rounded-full">{{ $row['role'] }}</vibe:badge>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </vibe:card>
                        <p class="text-xs text-muted-foreground mt-2 text-center">{{ __('docs/context.datatable.preview_title') }}</p>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="docs-dt-menu">
                    <vibe:context.label>
                        <span x-text="$context.data?.name ?? 'Row'"></span>
                    </vibe:context.label>
                    <vibe:context.divider />
                    <vibe:context.item @click="$vibe.toast.info('Edit: ' + $context.data.name, 'Context Menu'); $vibe.contexts.close()">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        {{ __('docs/context.datatable.edit_row') }}
                    </vibe:context.item>
                    <vibe:context.item @click="$vibe.toast.info('View: ' + $context.data.name, 'Context Menu'); $vibe.contexts.close()">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                        {{ __('docs/context.datatable.view_row') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item variant="destructive" @click="$vibe.alert.confirm({ title: 'Hapus ' + $context.data.name + '?', message: 'Data tidak bisa dikembalikan.', confirmButton: { text: 'Hapus', action: () => $vibe.toast.success('Dihapus!') } }); $vibe.contexts.close()">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        {{ __('docs/context.datatable.delete_row') }}
                    </vibe:context.item>
                </vibe:context.menu>
            </section>

            {{-- 3. With Submenu --}}
            <section id="dengan-submenu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.with_submenu.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.with_submenu.desc') !!}</p>
                </div>

                <vibe:preview :title="__('docs/context.with_submenu.preview_title')" minHeight="240px">
                    <vibe:preview.code>
@verbatim
<vibe:context menu="submenu-demo-menu">
    <div class="w-full h-32 rounded-lg border-2 border-dashed border-border flex items-center justify-center cursor-context-menu">
        <span class="text-muted-foreground text-sm">Klik kanan di sini</span>
    </div>
</vibe:context>

<vibe:context.menu id="submenu-demo-menu">
    <vibe:context.item>Buka</vibe:context.item>
    <vibe:context.sub label="Bagikan ke...">
        <vibe:context.item>Email</vibe:context.item>
        <vibe:context.item>Slack</vibe:context.item>
        <vibe:context.item>Microsoft Teams</vibe:context.item>
    </vibe:context.sub>
    <vibe:context.item>Ganti Nama</vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item variant="destructive">Hapus</vibe:context.item>
</vibe:context.menu>
@endverbatim
                    </vibe:preview.code>
                    <div class="w-full p-8">
                        <vibe:context menu="submenu-demo-menu-live">
                            <div class="w-full h-36 rounded-xl border-2 border-dashed border-border flex flex-col items-center justify-center gap-2 cursor-context-menu hover:border-primary/50 hover:bg-accent/30 transition-colors">
                                <svg class="size-6 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 9h.01"/><path d="M9 12h6"/><path d="M9 15h4"/></svg>
                                <span class="text-sm text-muted-foreground">{{ __('docs/context.with_submenu.area_text') }}</span>
                            </div>
                        </vibe:context>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="submenu-demo-menu-live">
                    <vibe:context.item @click="$vibe.toast.info('Membuka...')">
                        {{ __('docs/context.with_submenu.open') }}
                    </vibe:context.item>
                    <vibe:context.sub label="{{ __('docs/context.with_submenu.share') }}">
                        <vibe:context.item @click="$vibe.toast.info('Dibagikan via Email')">{{ __('docs/context.with_submenu.share_email') }}</vibe:context.item>
                        <vibe:context.item @click="$vibe.toast.info('Dibagikan via Slack')">{{ __('docs/context.with_submenu.share_slack') }}</vibe:context.item>
                        <vibe:context.item @click="$vibe.toast.info('Dibagikan via Teams')">{{ __('docs/context.with_submenu.share_teams') }}</vibe:context.item>
                    </vibe:context.sub>
                    <vibe:context.item @click="$vibe.toast.info('Ganti nama...')">{{ __('docs/context.with_submenu.rename') }}</vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item variant="destructive" @click="$vibe.toast.error('Dihapus!')">{{ __('docs/context.with_submenu.delete') }}</vibe:context.item>
                </vibe:context.menu>
            </section>

            {{-- 4. Programmatic Control --}}
            <section id="kontrol-programatik" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.programmatic.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.programmatic.desc') !!}</p>
                </div>

                <vibe:preview :title="__('docs/context.programmatic.preview_title')" minHeight="200px">
                    <vibe:preview.code>
@verbatim
{{-- Instance style --}}
<vibe:button @click="$vibe.context('prog-menu').show($event.clientX, $event.clientY, { id: 1, name: 'Item Demo' })">
    Buka Context Menu
</vibe:button>

<vibe:button variant="outline" @click="$vibe.contexts.close()">
    Tutup Semua
</vibe:button>

<vibe:context.menu id="prog-menu">
    <vibe:context.label>
        <span x-text="$context.data?.name ?? 'Menu'"></span>
    </vibe:context.label>
    <vibe:context.divider />
    <vibe:context.item>Edit</vibe:context.item>
    <vibe:context.item>Duplicate</vibe:context.item>
    <vibe:context.divider />
    <vibe:context.item variant="destructive">Delete</vibe:context.item>
</vibe:context.menu>
@endverbatim
                    </vibe:preview.code>
                    <div class="w-full flex items-center justify-center gap-3 p-8">
                        <vibe:button
                            id="ctx-open-btn"
                            variant="primary"
                            @click="$vibe.context('prog-menu-demo').show($event.clientX, $event.clientY, { id: 99, name: 'Demo Item' })"
                        >
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 9h.01"/><path d="M9 12h6"/><path d="M9 15h4"/></svg>
                            {{ __('docs/context.programmatic.open_btn') }}
                        </vibe:button>
                        <vibe:button id="ctx-close-btn" variant="outline" @click="$vibe.contexts.close()">
                            {{ __('docs/context.programmatic.close_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>

                <vibe:context.menu id="prog-menu-demo">
                    <vibe:context.label>
                        <span x-text="$context.data?.name ?? 'Menu'"></span>
                    </vibe:context.label>
                    <vibe:context.divider />
                    <vibe:context.item @click="$vibe.toast.info('Edit item #' + $context.data.id)">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        {{ __('docs/context.programmatic.edit') }}
                    </vibe:context.item>
                    <vibe:context.item @click="$vibe.toast.info('Duplikat item #' + $context.data.id)">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        {{ __('docs/context.programmatic.duplicate') }}
                    </vibe:context.item>
                    <vibe:context.divider />
                    <vibe:context.item variant="destructive" @click="$vibe.toast.error('Hapus item #' + $context.data.id)">
                        <svg class="size-4 mr-2 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        {{ __('docs/context.programmatic.delete') }}
                    </vibe:context.item>
                </vibe:context.menu>
            </section>

            {{-- 5. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/context.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/context.props.desc') !!}</p>
                </div>

                {{-- Props Tables --}}
                @php
                    $propsData = [
                        ['component' => '<vibe:context>', 'key' => 'context', 'props' => [
                            ['name' => 'menu', 'type' => 'string', 'default' => 'null', 'desc' => __('docs/context.props_items.context.menu')],
                        ]],
                        ['component' => '<vibe:context.menu>', 'key' => 'menu', 'props' => [
                            ['name' => 'id', 'type' => 'string', 'default' => 'uniqid()', 'desc' => __('docs/context.props_items.menu.id')],
                        ]],
                        ['component' => '<vibe:context.item>', 'key' => 'item', 'props' => [
                            ['name' => 'href', 'type' => 'string|null', 'default' => 'null', 'desc' => __('docs/context.props_items.item.href')],
                            ['name' => 'variant', 'type' => 'string', 'default' => "'default'", 'desc' => __('docs/context.props_items.item.variant')],
                            ['name' => 'disabled', 'type' => 'boolean', 'default' => 'false', 'desc' => __('docs/context.props_items.item.disabled')],
                        ]],
                        ['component' => '<vibe:context.item.delete>', 'key' => 'item_delete', 'props' => [
                            ['name' => 'title', 'type' => 'string', 'default' => "__('vibe/button.delete_title')", 'desc' => __('docs/context.props_items.item_delete.title')],
                            ['name' => 'message', 'type' => 'string', 'default' => "__('vibe/button.delete_message')", 'desc' => __('docs/context.props_items.item_delete.message')],
                            ['name' => 'confirmText', 'type' => 'string', 'default' => "__('vibe/button.delete_confirm')", 'desc' => __('docs/context.props_items.item_delete.confirmText')],
                            ['name' => 'cancelText', 'type' => 'string', 'default' => "__('vibe/button.delete_cancel')", 'desc' => __('docs/context.props_items.item_delete.cancelText')],
                            ['name' => 'url', 'type' => 'string|null', 'default' => 'null', 'desc' => __('docs/context.props_items.item_delete.url')],
                            ['name' => 'wire:click', 'type' => '—', 'default' => '—', 'desc' => __('docs/context.props_items.item_delete.wire:click')],
                        ]],
                        ['component' => '<vibe:context.sub>', 'key' => 'sub', 'props' => [
                            ['name' => 'label', 'type' => 'string', 'default' => "''", 'desc' => __('docs/context.props_items.sub.label')],
                            ['name' => 'align', 'type' => 'string', 'default' => "'right'", 'desc' => __('docs/context.props_items.sub.align')],
                            ['name' => 'width', 'type' => 'string', 'default' => "'48'", 'desc' => __('docs/context.props_items.sub.width')],
                        ]],
                    ];
                @endphp

                @foreach ($propsData as $group)
                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground font-mono">{{ $group['component'] }}</h3>
                        <div class="overflow-x-auto rounded-lg border border-border">
                            <table class="w-full text-sm">
                                <thead class="bg-muted/50">
                                    <tr>
                                        <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.columns.prop') }}</th>
                                        <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.columns.type') }}</th>
                                        <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.columns.default') }}</th>
                                        <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.columns.desc') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border">
                                    @foreach ($group['props'] as $prop)
                                        <tr class="hover:bg-muted/30">
                                            <td class="px-4 py-3 font-mono text-xs text-foreground">{{ $prop['name'] }}</td>
                                            <td class="px-4 py-3 font-mono text-xs text-primary">{{ $prop['type'] }}</td>
                                            <td class="px-4 py-3 font-mono text-xs text-muted-foreground">{{ $prop['default'] }}</td>
                                            <td class="px-4 py-3 text-xs text-muted-foreground">{!! $prop['desc'] !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                {{-- Events & $vibe Reference --}}
                <div class="space-y-2 pt-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/context.props.events_title') }}</h3>
                    <p class="text-xs text-muted-foreground">{!! __('docs/context.props.events_desc') !!}</p>
                    <div class="overflow-x-auto rounded-lg border border-border">
                        <table class="w-full text-sm">
                            <thead class="bg-muted/50">
                                <tr>
                                    <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.th_event') }}</th>
                                    <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.th_payload') }}</th>
                                    <th class="text-left px-4 py-2.5 font-medium text-muted-foreground text-xs uppercase tracking-wider">{{ __('docs/context.props.th_event_desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                @foreach (__('docs/context.props.events') as $event)
                                    <tr class="hover:bg-muted/30">
                                        <td class="px-4 py-3 font-mono text-xs text-foreground whitespace-nowrap">{{ $event['name'] }}</td>
                                        <td class="px-4 py-3 font-mono text-xs text-primary">{{ $event['payload'] }}</td>
                                        <td class="px-4 py-3 text-xs text-muted-foreground">{{ $event['desc'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

        {{-- TOC --}}
        <div class="col-span-12 order-1 md:order-2 md:col-span-3">
            <vibe:toc>
                <vibe:toc.item href="#penggunaan-dasar">{{ __('docs/context.basic_usage.title') }}</vibe:toc.item>
                <vibe:toc.item href="#datatable">{{ __('docs/context.datatable.title') }}</vibe:toc.item>
                <vibe:toc.item href="#dengan-submenu">{{ __('docs/context.with_submenu.title') }}</vibe:toc.item>
                <vibe:toc.item href="#kontrol-programatik">{{ __('docs/context.programmatic.title') }}</vibe:toc.item>
                <vibe:toc.item href="#referensi-props">{{ __('docs/context.props.title') }}</vibe:toc.item>
            </vibe:toc>
        </div>

    </div>
</x-docs.layouts.sidebar>
