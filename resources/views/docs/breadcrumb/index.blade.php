<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/breadcrumb.title')" :description="__('docs/breadcrumb.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/breadcrumb.title'), 'url' => '/docs/breadcrumb']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/breadcrumb.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/breadcrumb.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/breadcrumb.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/breadcrumb.description') }}
                </p>

                {{-- Quick Tags Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:breadcrumb&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:breadcrumb.item&gt;</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">wire:navigate</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/breadcrumb.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/breadcrumb.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/breadcrumb.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:breadcrumb>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.products') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.category') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.basic_usage.item') }}</vibe:breadcrumb.item>
                        </vibe:breadcrumb>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:breadcrumb>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.products') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.category') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.basic_usage.item') }}</vibe:breadcrumb.item>
                        </vibe:breadcrumb>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Page Title --}}
            <section id="judul-halaman" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/breadcrumb.title_prop.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/breadcrumb.title_prop.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/breadcrumb.title_prop.preview_title')">
                    <vibe:preview.code>
                        {{-- Dengan judul halaman kustom --}}
                        <vibe:breadcrumb title="{{ __('docs/breadcrumb.title_prop.custom_title') }}">
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.title_prop.settings') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.title_prop.users') }}</vibe:breadcrumb.item>
                        </vibe:breadcrumb>

                        {{-- Tanpa judul halaman (:title="false") --}}
                        <vibe:breadcrumb :title="false">
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.title_prop.settings') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.title_prop.users') }}</vibe:breadcrumb.item>
                        </vibe:breadcrumb>
                    </vibe:preview.code>
                    <div class="w-full space-y-6">
                        <div class="p-4">
                            <vibe:breadcrumb :title="__('docs/breadcrumb.title_prop.custom_title')">
                                <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                                <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.title_prop.settings') }}</vibe:breadcrumb.item>
                                <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.title_prop.users') }}</vibe:breadcrumb.item>
                            </vibe:breadcrumb>
                        </div>
                        <div class="p-4">
                            <vibe:breadcrumb :title="false">
                                <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                                <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.title_prop.settings') }}</vibe:breadcrumb.item>
                                <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.title_prop.users') }}</vibe:breadcrumb.item>
                            </vibe:breadcrumb>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Action Button Slot --}}
            <section id="tombol-aksi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/breadcrumb.button_slot.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/breadcrumb.button_slot.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/breadcrumb.button_slot.preview_title')">
                    <vibe:preview.code>
                        <vibe:breadcrumb title="{{ __('docs/breadcrumb.title_prop.custom_title') }}">
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.title_prop.settings') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.title_prop.users') }}</vibe:breadcrumb.item>

                            <x-slot:button>
                                <div class="flex items-center gap-2">
                                    <vibe:button variant="outline" size="sm">
                                        {{ __('docs/breadcrumb.button_slot.export') }}
                                    </vibe:button>
                                    <vibe:button variant="primary" size="sm">
                                        {{ __('docs/breadcrumb.button_slot.add_user') }}
                                    </vibe:button>
                                </div>
                            </x-slot:button>
                        </vibe:breadcrumb>
                    </vibe:preview.code>
                    <div class="w-full p-4 rounded-xl">
                        <vibe:breadcrumb :title="__('docs/breadcrumb.title_prop.custom_title')">
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.basic_usage.home') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item href="/docs">{{ __('docs/breadcrumb.title_prop.settings') }}</vibe:breadcrumb.item>
                            <vibe:breadcrumb.item active>{{ __('docs/breadcrumb.title_prop.users') }}</vibe:breadcrumb.item>

                            <x-slot:button>
                                <div class="flex items-center gap-2">
                                    <vibe:button variant="outline" size="sm">
                                        {{ __('docs/breadcrumb.button_slot.export') }}
                                    </vibe:button>
                                    <vibe:button variant="primary" size="sm">
                                        {{ __('docs/breadcrumb.button_slot.add_user') }}
                                    </vibe:button>
                                </div>
                            </x-slot:button>
                        </vibe:breadcrumb>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. With Icons --}}
            <section id="item-dengan-ikon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/breadcrumb.icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/breadcrumb.icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/breadcrumb.icons.preview_title')">
                    <vibe:preview.code>
                        <vibe:breadcrumb :title="false">
                            <vibe:breadcrumb.item href="/docs">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                {{ __('docs/breadcrumb.icons.home') }}
                            </vibe:breadcrumb.item>

                            <vibe:breadcrumb.item href="/docs">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="8" cy="21" r="1" />
                                    <circle cx="19" cy="21" r="1" />
                                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                </svg>
                                {{ __('docs/breadcrumb.icons.orders') }}
                            </vibe:breadcrumb.item>

                            <vibe:breadcrumb.item active>
                                {{ __('docs/breadcrumb.icons.invoice') }}
                            </vibe:breadcrumb.item>
                        </vibe:breadcrumb>
                    </vibe:preview.code>
                    <div class="w-full">
                        <vibe:breadcrumb :title="false">
                            <vibe:breadcrumb.item href="/docs">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                {{ __('docs/breadcrumb.icons.home') }}
                            </vibe:breadcrumb.item>

                            <vibe:breadcrumb.item href="/docs">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="8" cy="21" r="1" />
                                    <circle cx="19" cy="21" r="1" />
                                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                </svg>
                                {{ __('docs/breadcrumb.icons.orders') }}
                            </vibe:breadcrumb.item>

                            <vibe:breadcrumb.item active>
                                {{ __('docs/breadcrumb.icons.invoice') }}
                            </vibe:breadcrumb.item>
                        </vibe:breadcrumb>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Props & Slots Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/breadcrumb.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/breadcrumb.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:breadcrumb Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:breadcrumb&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/breadcrumb.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/breadcrumb.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/breadcrumb.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/breadcrumb.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $breadcrumbProps = [
                                ['title', 'string|bool', "config('app.name')", __('docs/breadcrumb.props_items.breadcrumb.title')],
                                ['class', 'string|null', 'null', __('docs/breadcrumb.props_items.breadcrumb.class')],
                            ];
                        @endphp
                        @foreach ($breadcrumbProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:breadcrumb.item Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:breadcrumb.item&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/breadcrumb.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/breadcrumb.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/breadcrumb.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/breadcrumb.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $itemProps = [
                                ['href', 'string|null', 'null', __('docs/breadcrumb.props_items.item.href')],
                                ['active', 'bool', 'false', __('docs/breadcrumb.props_items.item.active')],
                            ];
                        @endphp
                        @foreach ($itemProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Slots Table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/breadcrumb.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/breadcrumb.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/breadcrumb.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">default ($slot)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Elemen daftar <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb.item&gt;</code> untuk <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb&gt;</code>, atau teks/ikon untuk <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb.item&gt;</code>.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">button</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Slot opsional pada <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb&gt;</code> untuk menyematkan tombol aksi di sisi kanan.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
