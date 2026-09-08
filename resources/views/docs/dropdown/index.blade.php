<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/dropdown.title')" :description="__('docs/dropdown.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/dropdown.title'), 'url' => '/docs/dropdown']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/dropdown.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/dropdown.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/dropdown.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/dropdown.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['right', 'left', 'top', 'bottom-center'] as $a)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">align:{{ $a }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['48', '56', '64', '80', 'full'] as $w)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">w:{{ $w }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">keyboard</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:dropdown.sub&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dropdown.basic_usage.preview_title')" minHeight="240px">
                    <vibe:preview.code>
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="outline">
            <span>{{ __('docs/dropdown.basic_usage.trigger_btn') }}</span>
            <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </vibe:button>
    </x-slot:trigger>

    <vibe:dropdown.body align="right" width="56">
        <vibe:dropdown.item href="/profile">
            {{ __('docs/dropdown.basic_usage.account') }}
        </vibe:dropdown.item>
        <vibe:dropdown.item href="/support">
            {{ __('docs/dropdown.basic_usage.support') }}
        </vibe:dropdown.item>
        <vibe:dropdown.item href="/license">
            {{ __('docs/dropdown.basic_usage.license') }}
        </vibe:dropdown.item>
        <vibe:dropdown.divider />
        <vibe:dropdown.item destructive>
            {{ __('docs/dropdown.basic_usage.logout') }}
        </vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-6">
                        <vibe:dropdown>
                            <x-slot:trigger>
                                <vibe:button variant="outline">
                                    <span>{{ __('docs/dropdown.basic_usage.trigger_btn') }}</span>
                                    <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </vibe:button>
                            </x-slot:trigger>

                            <vibe:dropdown.body align="right" width="56">
                                <vibe:dropdown.item href="javascript:void(0)">
                                    {{ __('docs/dropdown.basic_usage.account') }}
                                </vibe:dropdown.item>
                                <vibe:dropdown.item href="javascript:void(0)">
                                    {{ __('docs/dropdown.basic_usage.support') }}
                                </vibe:dropdown.item>
                                <vibe:dropdown.item href="javascript:void(0)">
                                    {{ __('docs/dropdown.basic_usage.license') }}
                                </vibe:dropdown.item>
                                <vibe:dropdown.divider />
                                <vibe:dropdown.item destructive>
                                    {{ __('docs/dropdown.basic_usage.logout') }}
                                </vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Items, Icons & Shortcuts --}}
            <section id="label-ikon-shortcut" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.items_icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.items_icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dropdown.items_icons.preview_title')" minHeight="300px">
                    <vibe:preview.code>
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="primary">
            <span>{{ __('docs/dropdown.items_icons.trigger_btn') }}</span>
            <svg class="size-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
        </vibe:button>
    </x-slot:trigger>

    <vibe:dropdown.body align="right" width="64">
        <vibe:dropdown.label>{{ __('docs/dropdown.items_icons.header_general') }}</vibe:dropdown.label>

        <vibe:dropdown.item>
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-2">
                    <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                    <span>{{ __('docs/dropdown.items_icons.new_file') }}</span>
                </div>
                <kbd class="text-[10px] font-mono text-muted-foreground px-1 py-0.5 rounded bg-muted border border-border">⌘N</kbd>
            </div>
        </vibe:dropdown.item>

        <vibe:dropdown.item>
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-2">
                    <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    <span>{{ __('docs/dropdown.items_icons.copy_link') }}</span>
                </div>
                <kbd class="text-[10px] font-mono text-muted-foreground px-1 py-0.5 rounded bg-muted border border-border">⌘C</kbd>
            </div>
        </vibe:dropdown.item>

        <vibe:dropdown.item>
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-2">
                    <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                    <span>{{ __('docs/dropdown.items_icons.share') }}</span>
                </div>
            </div>
        </vibe:dropdown.item>

        <vibe:dropdown.divider />
        <vibe:dropdown.label>{{ __('docs/dropdown.items_icons.header_danger') }}</vibe:dropdown.label>

        <vibe:dropdown.item destructive>
            <div class="flex items-center gap-2">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                <span>{{ __('docs/dropdown.items_icons.delete') }}</span>
            </div>
        </vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-6">
                        <vibe:dropdown>
                            <x-slot:trigger>
                                <vibe:button variant="primary">
                                    <span>{{ __('docs/dropdown.items_icons.trigger_btn') }}</span>
                                    <svg class="size-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                                </vibe:button>
                            </x-slot:trigger>

                            <vibe:dropdown.body align="right" width="64">
                                <vibe:dropdown.label>{{ __('docs/dropdown.items_icons.header_general') }}</vibe:dropdown.label>

                                <vibe:dropdown.item>
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex items-center gap-2">
                                            <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                                            <span>{{ __('docs/dropdown.items_icons.new_file') }}</span>
                                        </div>
                                        <kbd class="text-[10px] font-mono text-muted-foreground px-1 py-0.5 rounded bg-muted border border-border">⌘N</kbd>
                                    </div>
                                </vibe:dropdown.item>

                                <vibe:dropdown.item>
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex items-center gap-2">
                                            <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                            <span>{{ __('docs/dropdown.items_icons.copy_link') }}</span>
                                        </div>
                                        <kbd class="text-[10px] font-mono text-muted-foreground px-1 py-0.5 rounded bg-muted border border-border">⌘C</kbd>
                                    </div>
                                </vibe:dropdown.item>

                                <vibe:dropdown.item>
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex items-center gap-2">
                                            <svg class="size-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                                            <span>{{ __('docs/dropdown.items_icons.share') }}</span>
                                        </div>
                                    </div>
                                </vibe:dropdown.item>

                                <vibe:dropdown.divider />
                                <vibe:dropdown.label>{{ __('docs/dropdown.items_icons.header_danger') }}</vibe:dropdown.label>

                                <vibe:dropdown.item destructive>
                                    <div class="flex items-center gap-2">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                        <span>{{ __('docs/dropdown.items_icons.delete') }}</span>
                                    </div>
                                </vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Alignment & Width --}}
            <section id="penyelarasan-lebar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.align_width.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.align_width.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dropdown.align_width.preview_title')" minHeight="260px">
                    <vibe:preview.code>
{{-- 1. Align Left --}}
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="outline">{{ __('docs/dropdown.align_width.align_left') }}</vibe:button>
    </x-slot:trigger>
    <vibe:dropdown.body align="left" width="56">
        <vibe:dropdown.item>Menu 1</vibe:dropdown.item>
        <vibe:dropdown.item>Menu 2</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>

{{-- 2. Align Right (Default) --}}
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="outline">{{ __('docs/dropdown.align_width.align_right') }}</vibe:button>
    </x-slot:trigger>
    <vibe:dropdown.body align="right" width="56">
        <vibe:dropdown.item>Menu 1</vibe:dropdown.item>
        <vibe:dropdown.item>Menu 2</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>

{{-- 3. Align Top --}}
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="outline">{{ __('docs/dropdown.align_width.align_top') }}</vibe:button>
    </x-slot:trigger>
    <vibe:dropdown.body align="top" width="56">
        <vibe:dropdown.item>Menu 1</vibe:dropdown.item>
        <vibe:dropdown.item>Menu 2</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-center justify-center gap-6 p-6">
                        {{-- Align Left --}}
                        <vibe:dropdown>
                            <x-slot:trigger>
                                <vibe:button variant="outline">
                                    <span>{{ __('docs/dropdown.align_width.align_left') }}</span>
                                    <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                                </vibe:button>
                            </x-slot:trigger>
                            <vibe:dropdown.body align="left" width="56">
                                <vibe:dropdown.item>Opsi Kiri A</vibe:dropdown.item>
                                <vibe:dropdown.item>Opsi Kiri B</vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>

                        {{-- Align Right --}}
                        <vibe:dropdown>
                            <x-slot:trigger>
                                <vibe:button variant="outline">
                                    <span>{{ __('docs/dropdown.align_width.align_right') }}</span>
                                    <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                                </vibe:button>
                            </x-slot:trigger>
                            <vibe:dropdown.body align="right" width="56">
                                <vibe:dropdown.item>Opsi Kanan A</vibe:dropdown.item>
                                <vibe:dropdown.item>Opsi Kanan B</vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>

                        {{-- Align Top --}}
                        <vibe:dropdown>
                            <x-slot:trigger>
                                <vibe:button variant="outline">
                                    <span>{{ __('docs/dropdown.align_width.align_top') }}</span>
                                    <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 15-6-6-6 6"/></svg>
                                </vibe:button>
                            </x-slot:trigger>
                            <vibe:dropdown.body align="top" width="56">
                                <vibe:dropdown.item>Opsi Atas A</vibe:dropdown.item>
                                <vibe:dropdown.item>Opsi Atas B</vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Nested Submenus --}}
            <section id="submenu-bertingkat" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.submenus.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.submenus.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dropdown.submenus.preview_title')" minHeight="280px">
                    <vibe:preview.code>
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="outline">
            <span>{{ __('docs/dropdown.submenus.trigger_btn') }}</span>
            <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
        </vibe:button>
    </x-slot:trigger>

    <vibe:dropdown.body align="right" width="56">
        <vibe:dropdown.item>{{ __('docs/dropdown.submenus.dashboard') }}</vibe:dropdown.item>

        {{-- Submenu 1: Theme --}}
        <vibe:dropdown.sub label="{{ __('docs/dropdown.submenus.theme') }}">
            <vibe:dropdown.item>{{ __('docs/dropdown.submenus.theme_light') }}</vibe:dropdown.item>
            <vibe:dropdown.item>{{ __('docs/dropdown.submenus.theme_dark') }}</vibe:dropdown.item>
            <vibe:dropdown.item>{{ __('docs/dropdown.submenus.theme_system') }}</vibe:dropdown.item>
        </vibe:dropdown.sub>

        {{-- Submenu 2: Language --}}
        <vibe:dropdown.sub label="{{ __('docs/dropdown.submenus.language') }}">
            <vibe:dropdown.item>{{ __('docs/dropdown.submenus.lang_id') }}</vibe:dropdown.item>
            <vibe:dropdown.item>{{ __('docs/dropdown.submenus.lang_en') }}</vibe:dropdown.item>
        </vibe:dropdown.sub>

        <vibe:dropdown.divider />
        <vibe:dropdown.item>{{ __('docs/dropdown.submenus.notifications') }}</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-6">
                        <vibe:dropdown>
                            <x-slot:trigger>
                                <vibe:button variant="outline">
                                    <span>{{ __('docs/dropdown.submenus.trigger_btn') }}</span>
                                    <svg class="size-4 ml-1 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                                </vibe:button>
                            </x-slot:trigger>

                            <vibe:dropdown.body align="right" width="56">
                                <vibe:dropdown.item>{{ __('docs/dropdown.submenus.dashboard') }}</vibe:dropdown.item>

                                <vibe:dropdown.sub label="{{ __('docs/dropdown.submenus.theme') }}">
                                    <vibe:dropdown.item>{{ __('docs/dropdown.submenus.theme_light') }}</vibe:dropdown.item>
                                    <vibe:dropdown.item>{{ __('docs/dropdown.submenus.theme_dark') }}</vibe:dropdown.item>
                                    <vibe:dropdown.item>{{ __('docs/dropdown.submenus.theme_system') }}</vibe:dropdown.item>
                                </vibe:dropdown.sub>

                                <vibe:dropdown.sub label="{{ __('docs/dropdown.submenus.language') }}">
                                    <vibe:dropdown.item>{{ __('docs/dropdown.submenus.lang_id') }}</vibe:dropdown.item>
                                    <vibe:dropdown.item>{{ __('docs/dropdown.submenus.lang_en') }}</vibe:dropdown.item>
                                </vibe:dropdown.sub>

                                <vibe:dropdown.divider />
                                <vibe:dropdown.item>{{ __('docs/dropdown.submenus.notifications') }}</vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Keyboard Navigation --}}
            <section id="navigasi-keyboard" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.keyboard_nav.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.keyboard_nav.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dropdown.keyboard_nav.preview_title')" minHeight="240px">
                    <vibe:preview.code>
<vibe:dropdown keyboard>
    <x-slot:trigger>
        <vibe:button variant="outline">
            <span>{{ __('docs/dropdown.keyboard_nav.trigger_btn') }}</span>
            <vibe:badge size="sm" variant="secondary" class="ml-1">keyboard</vibe:badge>
        </vibe:button>
    </x-slot:trigger>

    <vibe:dropdown.body align="right" width="56">
        <vibe:dropdown.item>Item 1 (Tekan Arrow Down)</vibe:dropdown.item>
        <vibe:dropdown.item>Item 2</vibe:dropdown.item>
        <vibe:dropdown.item>Item 3</vibe:dropdown.item>
        <vibe:dropdown.divider />
        <vibe:dropdown.item>Tutup (Tekan Escape)</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>
                    </vibe:preview.code>
                    <div class="w-full flex justify-center p-6">
                        <vibe:dropdown keyboard>
                            <x-slot:trigger>
                                <vibe:button variant="outline">
                                    <span>{{ __('docs/dropdown.keyboard_nav.trigger_btn') }}</span>
                                    <vibe:badge size="sm" variant="secondary" class="ml-1">keyboard</vibe:badge>
                                </vibe:button>
                            </x-slot:trigger>

                            <vibe:dropdown.body align="right" width="56">
                                <vibe:dropdown.item>Item 1 (Tekan Arrow Down)</vibe:dropdown.item>
                                <vibe:dropdown.item>Item 2</vibe:dropdown.item>
                                <vibe:dropdown.item>Item 3</vibe:dropdown.item>
                                <vibe:dropdown.divider />
                                <vibe:dropdown.item>Tutup (Tekan Escape)</vibe:dropdown.item>
                            </vibe:dropdown.body>
                        </vibe:dropdown>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Custom Triggers --}}
            <section id="pemicu-kustom" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.custom_trigger.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.custom_trigger.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dropdown.custom_trigger.preview_title')" minHeight="260px">
                    <vibe:preview.code>
{{-- 1. Trigger Avatar Pengguna --}}
<vibe:dropdown>
    <x-slot:trigger>
        <div class="flex items-center gap-2 cursor-pointer p-1 rounded-full hover:ring-2 hover:ring-ring transition-all">
            <vibe:avatar
                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80"
                alt="Sarah"
                indicator="online"
            />
        </div>
    </x-slot:trigger>

    <vibe:dropdown.body align="right" width="56">
        <div class="px-3 py-2 border-b border-border mb-1">
            <p class="text-sm font-semibold text-foreground">{{ __('docs/dropdown.custom_trigger.profile_title') }}</p>
            <p class="text-xs text-muted-foreground">{{ __('docs/dropdown.custom_trigger.profile_role') }}</p>
        </div>
        <vibe:dropdown.item>{{ __('docs/dropdown.custom_trigger.view_profile') }}</vibe:dropdown.item>
        <vibe:dropdown.item>{{ __('docs/dropdown.custom_trigger.billing') }}</vibe:dropdown.item>
        <vibe:dropdown.divider />
        <vibe:dropdown.item destructive>{{ __('docs/dropdown.basic_usage.logout') }}</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>

{{-- 2. Trigger Ikon 3-Titik (Table Row Actions) --}}
<vibe:dropdown>
    <x-slot:trigger>
        <vibe:button variant="outline" size="icon" class="size-9 rounded-lg" aria-label="Action Menu">
            <svg class="size-4 text-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
        </vibe:button>
    </x-slot:trigger>

    <vibe:dropdown.body align="right" width="48">
        <vibe:dropdown.item>Detail</vibe:dropdown.item>
        <vibe:dropdown.item>Edit Data</vibe:dropdown.item>
        <vibe:dropdown.divider />
        <vibe:dropdown.item destructive>Hapus</vibe:dropdown.item>
    </vibe:dropdown.body>
</vibe:dropdown>
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-center justify-around gap-12 p-8">
                        {{-- Avatar Profile Trigger --}}
                        <div class="flex flex-col items-center gap-2">
                            <vibe:dropdown>
                                <x-slot:trigger>
                                    <div class="flex items-center gap-2 cursor-pointer p-0.5 rounded-full hover:ring-2 hover:ring-ring transition-all">
                                        <vibe:avatar
                                            src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80"
                                            alt="Sarah"
                                            indicator="online"
                                        />
                                    </div>
                                </x-slot:trigger>

                                <vibe:dropdown.body align="left" width="56">
                                    <div class="px-3 py-2 border-b border-border mb-1">
                                        <p class="text-sm font-semibold text-foreground">{{ __('docs/dropdown.custom_trigger.profile_title') }}</p>
                                        <p class="text-xs text-muted-foreground">{{ __('docs/dropdown.custom_trigger.profile_role') }}</p>
                                    </div>
                                    <vibe:dropdown.item>{{ __('docs/dropdown.custom_trigger.view_profile') }}</vibe:dropdown.item>
                                    <vibe:dropdown.item>{{ __('docs/dropdown.custom_trigger.billing') }}</vibe:dropdown.item>
                                    <vibe:dropdown.divider />
                                    <vibe:dropdown.item destructive>{{ __('docs/dropdown.basic_usage.logout') }}</vibe:dropdown.item>
                                </vibe:dropdown.body>
                            </vibe:dropdown>
                            <span class="text-xs text-muted-foreground">Avatar Trigger</span>
                        </div>

                        {{-- 3-Dot Icon Trigger --}}
                        <div class="flex flex-col items-center gap-2">
                            <vibe:dropdown>
                                <x-slot:trigger>
                                    <vibe:button variant="outline" size="icon" class="size-9 rounded-lg" aria-label="Action Menu">
                                        <svg class="size-4 text-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                                    </vibe:button>
                                </x-slot:trigger>

                                <vibe:dropdown.body align="right" width="48">
                                    <vibe:dropdown.item>Lihat Detail</vibe:dropdown.item>
                                    <vibe:dropdown.item>Edit Data</vibe:dropdown.item>
                                    <vibe:dropdown.divider />
                                    <vibe:dropdown.item destructive>Hapus Data</vibe:dropdown.item>
                                </vibe:dropdown.body>
                            </vibe:dropdown>
                            <span class="text-xs text-muted-foreground">3-Dot Action Button</span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dropdown.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dropdown.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:dropdown Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:dropdown&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/dropdown.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $dropdownProps = [
                                ['keyboard', 'bool', 'false', 'Mengaktifkan navigasi aksesibilitas keyboard (Escape untuk keluar, panah atas/bawah untuk berpindah item, panah kanan/kiri untuk submenu).'],
                            ];
                        @endphp
                        @foreach ($dropdownProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:dropdown.body Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:dropdown.body&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/dropdown.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $bodyProps = [
                                ['align', 'string', "'right'", "Posisi penyejajaran popover: `'right'`, `'left'`, `'top'`, `'top-left'`, `'top-right'`, `'top-center'`, `'bottom'`, `'bottom-left'`, `'bottom-center'`, `'bottom-right'`."],
                                ['width', 'string', "'48'", "Lebar container dropdown: `'48'` (12rem), `'56'` (14rem), `'64'` (16rem), `'72'`, `'80'`, `'96'`, `'xl'`, `'2xl'`, `'min'`, atau `'full'`."],
                            ];
                        @endphp
                        @foreach ($bodyProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:dropdown.item Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:dropdown.item&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/dropdown.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $itemProps = [
                                ['destructive', 'bool', 'false', 'Menerapkan gaya aksi berbahaya dengan warna teks merah samar yang menjadi tegas dan berlatar belakang merah lembut saat dihover (`hover:bg-destructive/10`).'],
                                ['variant', 'string', "'default'", "Pilihan varian item: `'default'` atau `'destructive'`."],
                                ['href', 'string|null', 'null', 'Jika diisi, item dirender sebagai tautan navigasi `<a>` dengan dukungan `wire:navigate`.'],
                                ['type', 'string', "'button'", 'Tipe tombol ketika item tidak memiliki atribut `href`.'],
                            ];
                        @endphp
                        @foreach ($itemProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:dropdown.sub Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:dropdown.sub&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/dropdown.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/dropdown.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $subProps = [
                                ['label', 'string', "''", 'Teks judul pemicu submenu bertingkat.'],
                                ['isOpen', 'bool', 'false', 'Status terbuka awal dari submenu.'],
                                ['position', 'string', "'absolute'", "Gaya penempatan: `'absolute'` (popover horizontal) atau `'relative'` (accordion bertingkat)."],
                            ];
                        @endphp
                        @foreach ($subProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Subcomponents List --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/dropdown.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/dropdown.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/dropdown.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;x-slot:trigger&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Slot untuk menyematkan elemen pemicu terbukanya menu dropdown (tombol, avatar, teks, dll.).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:dropdown.body&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Kontainer popover yang memuat daftar item menu, dilengkapi bayangan, border, dan transisi animasi.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:dropdown.label&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Elemen judul / penanda kategori di dalam daftar menu dropdown.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:dropdown.item&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Elemen baris aksi individual yang interaktif dan dapat diklik.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:dropdown.divider&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Garis pemisah horizontal tipis untuk mengelompokkan blok menu.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">&lt;vibe:dropdown.sub&gt;</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Subkomponen untuk menyematkan submenu bersarang di dalam item dropdown.</vibe:table.cell>
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
