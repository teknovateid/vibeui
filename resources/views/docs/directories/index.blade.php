<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/directories.title')" :description="__('docs/directories.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => __('docs/directories.title'), 'url' => '/docs/directories']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Page Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
                        {{ __('docs/directories.badge') }}
                    </span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/directories.subtitle') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">
                    {{ __('docs/directories.title') }}
                </h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/directories.description') }}
                </p>
            </div>

            {{-- ─── 1. Ringkasan Pohon Direktori ─── --}}
            <section id="ringkasan-struktur" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/directories.overview_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/directories.overview_desc') !!}
                    </p>
                </div>

                @php
                    $directoryTree = "vibe-project/\n"
                        . "├── config/\n"
                        . "│   └── vibe.php                      # " . __('docs/directories.tree_comment_config') . "\n"
                        . "├── lang/\n"
                        . "│   ├── en/\n"
                        . "│   │   └── vibe/                     # " . __('docs/directories.tree_comment_lang_en') . "\n"
                        . "│   └── id/\n"
                        . "│       └── vibe/                     # " . __('docs/directories.tree_comment_lang_id') . "\n"
                        . "├── resources/\n"
                        . "│   ├── css/\n"
                        . "│   │   └── vibe/\n"
                        . "│   │       ├── app.css               # " . __('docs/directories.tree_comment_css_app') . "\n"
                        . "│   │       ├── custom-variant.css    # " . __('docs/directories.tree_comment_css_variant') . "\n"
                        . "│   │       └── highlightjs.css       # " . __('docs/directories.tree_comment_css_highlight') . "\n"
                        . "│   ├── js/\n"
                        . "│   │   └── vibe/\n"
                        . "│   │       ├── highlightjs.js        # " . __('docs/directories.tree_comment_js_highlight') . "\n"
                        . "│   │       └── theme.js              # " . __('docs/directories.tree_comment_js_theme') . "\n"
                        . "│   └── views/\n"
                        . "│       └── vibe/                     # " . __('docs/directories.tree_comment_views') . "\n"
                        . "│           ├── alert/                \n"
                        . "│           ├── avatar/               \n"
                        . "│           ├── button/               \n"
                        . "│           ├── card/                 \n"
                        . "│           ├── datatable/            \n"
                        . "│           ├── dropdown/             \n"
                        . "│           ├── header/               \n"
                        . "│           ├── highlightjs/          \n"
                        . "│           ├── input/                \n"
                        . "│           ├── modal/                \n"
                        . "│           ├── nav/                  \n"
                        . "│           ├── pagination/           \n"
                        . "│           ├── preview/              \n"
                        . "│           ├── seo/                  \n"
                        . "│           ├── sheet/                \n"
                        . "│           ├── toast/                \n"
                        . "│           └── toc/                  \n"
                        . "└── routes/\n"
                        . "    └── docs.php                      # " . __('docs/directories.tree_comment_routes');
                @endphp

                <vibe:highlightjs language="plaintext" :title="__('docs/directories.tree_title')" :code="$directoryTree" />
            </section>

            {{-- ─── 2. Komponen Blade ─── --}}
            <section id="komponen-blade" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/directories.views_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/directories.views_desc') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">views/vibe/</span>
                            <span class="text-sm font-semibold text-foreground">{{ __('docs/directories.views_card_structure_title') }}</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/directories.views_card_structure_desc') !!}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">@@props([...])</span>
                            <span class="text-sm font-semibold text-foreground">{{ __('docs/directories.views_card_props_title') }}</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/directories.views_card_props_desc') !!}
                        </p>
                    </div>
                </div>
            </section>

            {{-- ─── 3. Styling & Token CSS ─── --}}
            <section id="styling-css" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/directories.css_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/directories.css_desc') }}
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/directories.css_th_file') }}</th>
                                <th class="px-4 py-3">{{ __('docs/directories.css_th_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">app.css</td>
                                <td class="px-4 py-3">{!! __('docs/directories.css_row_app') !!}</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">custom-variant.css</td>
                                <td class="px-4 py-3">{!! __('docs/directories.css_row_variant') !!}</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">highlightjs.css</td>
                                <td class="px-4 py-3">{!! __('docs/directories.css_row_highlight') !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ─── 4. Skrip JavaScript ─── --}}
            <section id="aset-javascript" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/directories.js_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/directories.js_desc') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-muted text-foreground font-mono text-xs font-bold">theme.js</span>
                            <span class="text-sm font-semibold text-foreground">{{ __('docs/directories.js_card_theme_title') }}</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/directories.js_card_theme_desc') !!}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-muted text-foreground font-mono text-xs font-bold">highlightjs.js</span>
                            <span class="text-sm font-semibold text-foreground">{{ __('docs/directories.js_card_highlight_title') }}</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {!! __('docs/directories.js_card_highlight_desc') !!}
                        </p>
                    </div>
                </div>
            </section>

            {{-- ─── 5. Multi-Bahasa ─── --}}
            <section id="bahasa-dan-terjemahan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/directories.lang_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/directories.lang_desc') }}
                    </p>
                </div>

                <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-3">
                    <p class="text-xs text-muted-foreground">
                        {{ __('docs/directories.lang_card_desc') }}
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs font-mono">
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/alert.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/datatable.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/modal.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/nav.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/pagination.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/preview.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/sheet.php</span>
                        <span class="p-2 rounded-lg bg-muted border border-border text-foreground">vibe/toast.php</span>
                    </div>
                </div>
            </section>

            {{-- ─── 6. File Konfigurasi ─── --}}
            <section id="file-konfigurasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/directories.config_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/directories.config_desc') }}
                    </p>
                </div>

                @php
                    $configSnippet = <<<'PHP'
return [
    /*
    |--------------------------------------------------------------------------
    | Component Tag Prefix
    |--------------------------------------------------------------------------
    | Prefix used for referencing Blade components.
    | Default 'vibe' yields tags: <vibe:button>, <vibe:input>, etc.
    */
    'prefix' => 'vibe',

    /*
    |--------------------------------------------------------------------------
    | Default Color Theme
    |--------------------------------------------------------------------------
    */
    'theme' => 'default',
];
PHP;
                @endphp

                <vibe:highlightjs language="php" title="config/vibe.php" :code="$configSnippet" />
            </section>

        </div>

        {{-- Aside Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
