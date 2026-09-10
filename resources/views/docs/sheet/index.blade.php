<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/sheet.title')" :description="__('docs/sheet.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Overlay & Navigasi', 'url' => '/docs'],
        ['name' => __('docs/sheet.title'), 'url' => '/docs/sheet']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/sheet.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/sheet.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/sheet.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/sheet.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['layout', 'position', 'behavior', 'resizable', 'defaultSize', 'showToggle', 'persist', 'closeOnOutsideClick'] as $p)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $p }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['left', 'right', 'top', 'bottom'] as $pos)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $pos }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['static', 'collapsible', 'minify'] as $b)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $b }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['open-sheet', 'close-sheet', 'toggle-sheet'] as $ev)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $ev }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.basic_usage.preview_title')">
                    <vibe:preview.code>
                        {{-- Tombol pemicu toggle sheet --}}
                        <vibe:button @click="$dispatch('toggle-sheet', 'demo-sheet-basic')" variant="primary" size="sm">
                            {{ __('docs/sheet.basic_usage.btn_toggle') }}
                        </vibe:button>

                        {{-- Komponen Sheet --}}
                        <vibe:sheet id="demo-sheet-basic" position="right" behavior="collapsible" :defaultSize="320">
                            <vibe:sheet.header class="flex items-center justify-between">
                                <h3 class="font-semibold text-foreground text-sm">{{ __('docs/sheet.basic_usage.header_title') }}</h3>
                                <vibe:sheet.close />
                            </vibe:sheet.header>

                            <vibe:sheet.content class="space-y-3">
                                <p class="text-sm text-muted-foreground">
                                    {!! __('docs/sheet.basic_usage.body_text') !!}
                                </p>
                            </vibe:sheet.content>

                            <vibe:sheet.footer class="flex items-center justify-end gap-2">
                                <vibe:button type="button" variant="outline" size="sm" @click="close">
                                    {{ __('docs/sheet.basic_usage.footer_cancel') }}
                                </vibe:button>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">
                                    {{ __('docs/sheet.basic_usage.footer_save') }}
                                </vibe:button>
                            </vibe:sheet.footer>
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="relative h-96 w-full overflow-hidden border border-border rounded-xl bg-muted/10 flex">
                        <div class="flex-1 flex flex-col items-center justify-center p-6 text-center space-y-3 min-w-0">
                            <div class="p-3 rounded-full bg-primary/10 text-primary">
                                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M15 3v18" />
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-sm font-semibold text-foreground">Main App Workspace</h4>
                                <p class="text-xs text-muted-foreground max-w-xs">
                                    {{ __('docs/sheet.interactive.main_content_flexible') }}
                                </p>
                            </div>
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-sheet-basic')" variant="primary" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h6v6" />
                                    <path d="M10 14 21 3" />
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                                </svg>
                                {{ __('docs/sheet.basic_usage.btn_toggle') }}
                            </vibe:button>
                        </div>

                        <vibe:sheet id="demo-sheet-basic" position="right" behavior="collapsible" :defaultSize="320">
                            <vibe:sheet.header class="flex items-center justify-between">
                                <div class="space-y-0.5">
                                    <h3 class="font-semibold text-foreground text-sm">{{ __('docs/sheet.basic_usage.header_title') }}</h3>
                                    <p class="text-xs text-muted-foreground">Subkomponen Header</p>
                                </div>
                                <vibe:sheet.close />
                            </vibe:sheet.header>

                            <vibe:sheet.content class="space-y-3">
                                <p class="text-sm text-muted-foreground leading-relaxed">
                                    {!! __('docs/sheet.basic_usage.body_text') !!}
                                </p>
                                <div class="p-3 rounded-lg bg-muted/40 border border-border text-xs text-muted-foreground space-y-1">
                                    <span class="font-semibold text-foreground">💡 Fleksibilitas Tinggi:</span>
                                    <p>Anda dapat meletakkan formulir, daftar navigasi, rincian filter data, atau menu pengaturan di sini.</p>
                                </div>
                            </vibe:sheet.content>

                            <vibe:sheet.footer class="flex items-center justify-end gap-2">
                                <vibe:button type="button" variant="outline" size="sm" @click="close">
                                    {{ __('docs/sheet.basic_usage.footer_cancel') }}
                                </vibe:button>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">
                                    {{ __('docs/sheet.basic_usage.footer_save') }}
                                </vibe:button>
                            </vibe:sheet.footer>
                        </vibe:sheet>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Positions --}}
            <section id="pilihan-posisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.positions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.positions.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.positions.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Sisi Kiri (Left) --}}
                        <vibe:sheet id="sheet-pos-left" position="left" behavior="collapsible" :defaultSize="260">
                            ...
                        </vibe:sheet>

                        {{-- 2. Sisi Kanan (Right) --}}
                        <vibe:sheet id="sheet-pos-right" position="right" behavior="collapsible" :defaultSize="260">
                            ...
                        </vibe:sheet>

                        {{-- 3. Sisi Atas (Top) --}}
                        <vibe:sheet id="sheet-pos-top" position="top" behavior="collapsible" :defaultSize="160">
                            ...
                        </vibe:sheet>

                        {{-- 4. Sisi Bawah (Bottom) --}}
                        <vibe:sheet id="sheet-pos-bottom" position="bottom" behavior="collapsible" :defaultSize="160">
                            ...
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="space-y-4 w-full">
                        <div class="flex flex-wrap items-center justify-center gap-2 p-2">
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-pos-left')" variant="outline" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H5M12 19l-7-7 7-7" />
                                </svg>
                                {{ __('docs/sheet.positions.btn_left') }}
                            </vibe:button>
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-pos-right')" variant="outline" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                                {{ __('docs/sheet.positions.btn_right') }}
                            </vibe:button>
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-pos-top')" variant="outline" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 19V5M5 12l7-7 7 7" />
                                </svg>
                                {{ __('docs/sheet.positions.btn_top') }}
                            </vibe:button>
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-pos-bottom')" variant="outline" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14M19 12l-7 7-7-7" />
                                </svg>
                                {{ __('docs/sheet.positions.btn_bottom') }}
                            </vibe:button>
                        </div>

                        {{-- Sandbox Container --}}
                        <div class="relative h-90 w-full overflow-hidden border border-border rounded-xl bg-muted/15 flex flex-col">
                            {{-- Top Sheet --}}
                            <vibe:sheet id="demo-pos-top" position="top" behavior="collapsible" defaultState="collapsed" :defaultSize="120">
                                <div class="p-3 flex items-center justify-between w-full">
                                    <span class="text-xs font-semibold text-foreground">{{ __('docs/sheet.positions.sheet_title', ['pos' => 'Top']) }}</span>
                                    <vibe:sheet.close />
                                </div>
                            </vibe:sheet>

                            <div class="flex-1 flex min-h-0 w-full overflow-hidden">
                                {{-- Left Sheet --}}
                                <vibe:sheet id="demo-pos-left" position="left" behavior="collapsible" defaultState="collapsed" :defaultSize="220">
                                    <div class="p-3 flex items-center justify-between w-full">
                                        <span class="text-xs font-semibold text-foreground">{{ __('docs/sheet.positions.sheet_title', ['pos' => 'Left']) }}</span>
                                        <vibe:sheet.close />
                                    </div>
                                </vibe:sheet>

                                {{-- Main Center --}}
                                <div class="flex-1 flex items-center justify-center p-4 text-center text-xs text-muted-foreground">
                                    {{ __('docs/sheet.interactive.click_position_hint') }}
                                </div>

                                {{-- Right Sheet --}}
                                <vibe:sheet id="demo-pos-right" position="right" behavior="collapsible" defaultState="collapsed" :defaultSize="220">
                                    <div class="p-3 flex items-center justify-between w-full">
                                        <span class="text-xs font-semibold text-foreground">{{ __('docs/sheet.positions.sheet_title', ['pos' => 'Right']) }}</span>
                                        <vibe:sheet.close />
                                    </div>
                                </vibe:sheet>
                            </div>

                            {{-- Bottom Sheet --}}
                            <vibe:sheet id="demo-pos-bottom" position="bottom" behavior="collapsible" defaultState="collapsed" :defaultSize="120">
                                <div class="p-3 flex items-center justify-between w-full">
                                    <span class="text-xs font-semibold text-foreground">{{ __('docs/sheet.positions.sheet_title', ['pos' => 'Bottom']) }}</span>
                                    <vibe:sheet.close />
                                </div>
                            </vibe:sheet>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Resizable (Interactive Drag) --}}
            <section id="resize-interaktif" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.resizable.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.resizable.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.resizable.preview_title')">
                    <vibe:preview.code>
                        <vibe:sheet id="resizable-sheet-demo" position="left" :resizable="true" :defaultSize="280" :minSize="180" :maxSize="480">
                            <vibe:sheet.header class="flex items-center justify-between">
                                <h3 class="font-semibold text-sm">{{ __('docs/sheet.resizable.sheet_title') }}</h3>
                            </vibe:sheet.header>

                            <vibe:sheet.content>
                                <p class="text-xs text-muted-foreground">
                                    {{ __('docs/sheet.resizable.sheet_desc') }}
                                </p>
                            </vibe:sheet.content>
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="space-y-2 w-full">
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary/10 text-primary text-xs font-medium">
                            <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m8 3 4 8 5-5 5 15H2L8 3z" />
                            </svg>
                            {{ __('docs/sheet.resizable.hint') }}
                        </div>

                        <div class="relative h-80 w-full overflow-hidden border border-border rounded-xl bg-muted/10 flex">
                            {{-- Resizable Sheet --}}
                            <vibe:sheet id="demo-sheet-resizable" position="left" :resizable="true" :defaultSize="260" :minSize="180" :maxSize="420">
                                <vibe:sheet.header class="flex items-center justify-between">
                                    <span class="font-semibold text-xs text-foreground">{{ __('docs/sheet.resizable.sheet_title') }}</span>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-primary/10 text-primary">min:180 / max:420</span>
                                </vibe:sheet.header>

                                <vibe:sheet.content class="space-y-2">
                                    <p class="text-xs text-muted-foreground leading-relaxed">
                                        {{ __('docs/sheet.resizable.sheet_desc') }}
                                    </p>
                                    <div class="p-2.5 rounded bg-muted/50 border border-border text-[11px] font-mono text-muted-foreground">
                                        ↔️ Hover tepi kanan panel ini untuk melihat kursor col-resize.
                                    </div>
                                </vibe:sheet.content>
                            </vibe:sheet>

                            {{-- Workspace --}}
                            <div class="flex-1 flex flex-col items-center justify-center p-6 text-center text-xs text-muted-foreground">
                                <span>{{ __('docs/sheet.interactive.left_panel_flexible') }}</span>
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Mobile Bottom Sheet (Resizable & Rounded-T) --}}
            <section id="mobile-bottom-sheet" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.bottom_sheet.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.bottom_sheet.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.bottom_sheet.preview_title')">
                    <vibe:preview.code>
                        {{-- Mobile Bottom Sheet: Resizable, rounded-t-3xl, position="bottom" --}}
                        <vibe:sheet id="mobile-bottom-sheet-demo" position="bottom" layout="absolute" behavior="collapsible" defaultState="expanded" :resizable="true" :defaultSize="260" :minSize="140" :maxSize="380" class="rounded-t-3xl border-t border-x border-border shadow-2xl bg-card">
                            {{-- Drag Handle Bar Pill (Indikator Tarik) --}}
                            <div class="pt-2.5 pb-1 flex justify-center cursor-row-resize touch-none">
                                <div class="w-12 h-1.5 rounded-full bg-muted-foreground/30 hover:bg-muted-foreground/60 transition-colors"></div>
                            </div>

                            <vibe:sheet.header class="px-5 py-2 flex items-center justify-between border-b-0">
                                <div class="space-y-0.5">
                                    <h4 class="font-bold text-sm text-foreground">{{ __('docs/sheet.bottom_sheet.sheet_title') }}</h4>
                                    <p class="text-[11px] text-muted-foreground">{{ __('docs/sheet.bottom_sheet.sheet_desc') }}</p>
                                </div>
                                <vibe:sheet.close />
                            </vibe:sheet.header>

                            <vibe:sheet.content class="px-5 py-2 space-y-1">
                                <button type="button" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-muted/60 text-xs text-foreground font-medium transition-colors text-left">
                                    <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                        <polyline points="16 6 12 2 8 6" />
                                        <line x1="12" y1="2" x2="12" y2="15" />
                                    </svg>
                                    <span>{{ __('docs/sheet.bottom_sheet.item_share') }}</span>
                                </button>
                                <button type="button" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-muted/60 text-xs text-foreground font-medium transition-colors text-left">
                                    <svg class="size-4 text-info shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7 10 12 15 17 10" />
                                        <line x1="12" y1="15" x2="12" y2="3" />
                                    </svg>
                                    <span>{{ __('docs/sheet.bottom_sheet.item_download') }}</span>
                                </button>
                                <button type="button" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-muted/60 text-xs text-foreground font-medium transition-colors text-left">
                                    <svg class="size-4 text-warning shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                                    </svg>
                                    <span>{{ __('docs/sheet.bottom_sheet.item_bookmark') }}</span>
                                </button>
                                <button type="button" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-destructive/10 text-xs text-destructive font-medium transition-colors text-left">
                                    <svg class="size-4 text-destructive shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18" />
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    </svg>
                                    <span>{{ __('docs/sheet.bottom_sheet.item_delete') }}</span>
                                </button>
                            </vibe:sheet.content>

                            <vibe:sheet.footer class="px-5 py-3 flex items-center justify-center">
                                <vibe:button type="button" variant="outline" size="sm" class="w-full rounded-full" @click="close">
                                    {{ __('docs/sheet.bottom_sheet.btn_cancel') }}
                                </vibe:button>
                            </vibe:sheet.footer>
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="space-y-4">
                        <div class="flex items-center justify-center">
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-mobile-sheet')" variant="primary" size="sm" class="rounded-full">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                                    <path d="M12 18h.01" />
                                </svg>
                                {{ __('docs/sheet.bottom_sheet.btn_toggle') }}
                            </vibe:button>
                        </div>

                        {{-- Mobile Smartphone Mockup Frame --}}
                        <div class="max-w-xs mx-auto h-115 rounded-[2.5rem] border-4 border-muted-foreground/25 shadow-2xl bg-muted/20 relative overflow-hidden flex flex-col">
                            {{-- Phone Notch / Dynamic Island & Status Bar --}}
                            <div class="h-10 shrink-0 px-6 flex items-center justify-between z-30 select-none pointer-events-none">
                                <span class="text-[11px] font-semibold text-foreground">9:41</span>
                                <div class="w-20 h-4 bg-foreground/90 rounded-full"></div>
                                <div class="flex items-center gap-1.5 text-foreground">
                                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 3c-4.97 0-9 4.03-9 9 0 2.12.74 4.07 1.97 5.61L12 22l7.03-4.39C20.26 16.07 21 14.12 21 12c0-4.97-4.03-9-9-9z" />
                                    </svg>
                                    <div class="w-4 h-2 rounded-xs border border-current flex items-center p-0.5">
                                        <div class="w-full h-full bg-current"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Mobile App Background Content --}}
                            <div class="flex-1 p-4 space-y-3 overflow-y-auto">
                                <div class="h-32 rounded-2xl bg-linear-to-br from-primary/15 via-accent/20 to-primary/5 border border-border p-4 flex flex-col justify-end">
                                    <span class="text-xs font-bold text-foreground">Mobile App Feed</span>
                                    <span class="text-[10px] text-muted-foreground">Antarmuka Aplikasi Smartphone</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-10 rounded-xl bg-card border border-border/80 flex items-center px-3 gap-2">
                                        <div class="size-5 rounded-full bg-muted"></div>
                                        <div class="h-2.5 w-24 bg-muted rounded-full"></div>
                                    </div>
                                    <div class="h-10 rounded-xl bg-card border border-border/80 flex items-center px-3 gap-2">
                                        <div class="size-5 rounded-full bg-muted"></div>
                                        <div class="h-2.5 w-32 bg-muted rounded-full"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Mobile Bottom Sheet (Resizable with rounded-t-3xl) --}}
                            <vibe:sheet id="demo-mobile-sheet" position="bottom" layout="absolute" behavior="collapsible" defaultState="expanded" :resizable="true" :defaultSize="260" :minSize="140" :maxSize="390" class="rounded-t-3xl border-t border-x border-border shadow-2xl bg-card">
                                {{-- Drag Handle Bar Pill --}}
                                <div class="pt-2.5 pb-1 flex justify-center cursor-row-resize touch-none">
                                    <div class="w-12 h-1.5 rounded-full bg-muted-foreground/30 hover:bg-muted-foreground/60 transition-colors"></div>
                                </div>

                                <vibe:sheet.header class="px-5 py-2 flex items-center justify-between border-b-0">
                                    <div class="space-y-0.5">
                                        <h4 class="font-bold text-xs text-foreground">{{ __('docs/sheet.bottom_sheet.sheet_title') }}</h4>
                                        <p class="text-[10px] text-muted-foreground">{{ __('docs/sheet.bottom_sheet.sheet_desc') }}</p>
                                    </div>
                                    <vibe:sheet.close />
                                </vibe:sheet.header>

                                <vibe:sheet.content class="px-5 py-1 space-y-1">
                                    <button type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-muted/60 text-xs text-foreground font-medium transition-colors text-left">
                                        <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                            <polyline points="16 6 12 2 8 6" />
                                            <line x1="12" y1="2" x2="12" y2="15" />
                                        </svg>
                                        <span>{{ __('docs/sheet.bottom_sheet.item_share') }}</span>
                                    </button>
                                    <button type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-muted/60 text-xs text-foreground font-medium transition-colors text-left">
                                        <svg class="size-4 text-info shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                            <polyline points="7 10 12 15 17 10" />
                                            <line x1="12" y1="15" x2="12" y2="3" />
                                        </svg>
                                        <span>{{ __('docs/sheet.bottom_sheet.item_download') }}</span>
                                    </button>
                                    <button type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-muted/60 text-xs text-foreground font-medium transition-colors text-left">
                                        <svg class="size-4 text-warning shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                                        </svg>
                                        <span>{{ __('docs/sheet.bottom_sheet.item_bookmark') }}</span>
                                    </button>
                                    <button type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-destructive/10 text-xs text-destructive font-medium transition-colors text-left">
                                        <svg class="size-4 text-destructive shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18" />
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        </svg>
                                        <span>{{ __('docs/sheet.bottom_sheet.item_delete') }}</span>
                                    </button>
                                </vibe:sheet.content>

                                <vibe:sheet.footer class="px-5 py-3 flex items-center justify-center">
                                    <vibe:button type="button" variant="outline" size="sm" class="w-full rounded-full" @click="close">
                                        {{ __('docs/sheet.bottom_sheet.btn_cancel') }}
                                    </vibe:button>
                                </vibe:sheet.footer>
                            </vibe:sheet>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Behaviors: Minify & Collapsible --}}
            <section id="mode-perilaku" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.behaviors.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.behaviors.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.behaviors.preview_title')">
                    <vibe:preview.code>
                        {{-- Sheet dengan behavior="minify" --}}
                        <vibe:sheet id="minify-sidebar-demo" position="left" behavior="minify" :defaultSize="240" :minifiedSize="64">
                            <vibe:sheet.header class="flex items-center justify-between">
                                <span class="font-bold text-sm group-data-[state=minified]/sheet:hidden">Vibe Admin</span>
                                <vibe:sheet.close class="group-data-[state=minified]/sheet:hidden" />
                            </vibe:sheet.header>

                            <vibe:sheet.content class="space-y-1 p-2">
                                <a href="#" class="flex items-center gap-3 p-2 rounded-lg hover:bg-muted text-sm text-foreground">
                                    <svg class="size-5 shrink-0" ...></svg>
                                    <span class="group-data-[state=minified]/sheet:hidden">{{ __('docs/sheet.behaviors.nav_dashboard') }}</span>
                                </a>
                            </vibe:sheet.content>
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="space-y-3 w-full">
                        <div class="flex items-center justify-center">
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-sheet-minify')" variant="outline" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M9 3v18" />
                                </svg>
                                {{ __('docs/sheet.behaviors.btn_minify') }}
                            </vibe:button>
                        </div>

                        <div class="relative h-80 w-full overflow-hidden border border-border rounded-xl bg-muted/10 flex">
                            {{-- Minify Sheet --}}
                            <vibe:sheet id="demo-sheet-minify" position="left" behavior="minify" :defaultSize="220" :minifiedSize="64">
                                <vibe:sheet.header class="flex items-center justify-between px-3 py-3">
                                    <div class="flex items-center gap-2 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:w-full">
                                        <div class="size-7 rounded-lg bg-primary text-primary-foreground flex items-center justify-center font-bold text-xs shrink-0">
                                            V
                                        </div>
                                        <span class="font-bold text-sm text-foreground group-data-[state=minified]/sheet:hidden">Vibe App</span>
                                    </div>
                                </vibe:sheet.header>

                                <vibe:sheet.content class="space-y-1 p-2">
                                    <a href="#mode-perilaku" class="flex items-center gap-3 p-2 rounded-lg bg-muted/60 text-foreground font-medium text-xs group-data-[state=minified]/sheet:justify-center">
                                        <svg class="size-4 shrink-0 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                            <polyline points="9 22 9 12 15 12 15 22" />
                                        </svg>
                                        <span class="group-data-[state=minified]/sheet:hidden">{{ __('docs/sheet.behaviors.nav_dashboard') }}</span>
                                    </a>
                                    <a href="#mode-perilaku" class="flex items-center gap-3 p-2 rounded-lg hover:bg-muted/40 text-muted-foreground text-xs group-data-[state=minified]/sheet:justify-center">
                                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                        <span class="group-data-[state=minified]/sheet:hidden">{{ __('docs/sheet.behaviors.nav_users') }}</span>
                                    </a>
                                    <a href="#mode-perilaku" class="flex items-center gap-3 p-2 rounded-lg hover:bg-muted/40 text-muted-foreground text-xs group-data-[state=minified]/sheet:justify-center">
                                        <svg class="size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <span class="group-data-[state=minified]/sheet:hidden">{{ __('docs/sheet.behaviors.nav_settings') }}</span>
                                    </a>
                                </vibe:sheet.content>
                            </vibe:sheet>

                            {{-- Content --}}
                            <div class="flex-1 flex items-center justify-center p-6 text-center text-xs text-muted-foreground">
                                {{ __('docs/sheet.interactive.toggle_minify_hint') }}
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Built-in Toggle Button --}}
            <section id="tombol-toggle" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.toggle.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.toggle.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.toggle.preview_title')">
                    <vibe:preview.code>
                        {{-- Sheet dengan tombol toggle bawaan --}}
                        <vibe:sheet id="sheet-with-toggle" position="left" behavior="collapsible" :showToggle="true" :defaultSize="260">
                            <vibe:sheet.header>
                                <h3 class="font-semibold text-sm">{{ __('docs/sheet.toggle.sheet_title') }}</h3>
                            </vibe:sheet.header>
                            <vibe:sheet.content>
                                <p class="text-xs text-muted-foreground">{{ __('docs/sheet.toggle.sheet_desc') }}</p>
                            </vibe:sheet.content>
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="relative h-80 w-full overflow-hidden border border-border rounded-xl bg-muted/10 flex">
                        {{-- Sheet with Show Toggle --}}
                        <vibe:sheet id="demo-sheet-toggle" position="left" behavior="collapsible" :showToggle="true" :defaultSize="260">
                            <vibe:sheet.header>
                                <span class="font-semibold text-xs text-foreground">{{ __('docs/sheet.toggle.sheet_title') }}</span>
                            </vibe:sheet.header>
                            <vibe:sheet.content>
                                <p class="text-xs text-muted-foreground leading-relaxed">
                                    {{ __('docs/sheet.toggle.sheet_desc') }}
                                </p>
                            </vibe:sheet.content>
                        </vibe:sheet>

                        <div class="flex-1 flex items-center justify-center p-6 text-center text-xs text-muted-foreground">
                            Perhatikan tombol panah bulat di tepi pembatas panel. Klik tombol tersebut untuk melipat atau membukanya kembali.
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Overlay Drawer vs Relative --}}
            <section id="mode-layout" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.layouts.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.layouts.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.layouts.preview_title')">
                    <vibe:preview.code>
                        {{-- Drawer dengan layout="absolute" & closeOnOutsideClick="true" --}}
                        <vibe:sheet id="overlay-drawer-demo" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="320">
                            <vibe:sheet.header class="flex items-center justify-between">
                                <h3 class="font-semibold text-sm">{{ __('docs/sheet.layouts.drawer_title') }}</h3>
                                <vibe:sheet.close />
                            </vibe:sheet.header>
                            <vibe:sheet.content>
                                <p class="text-xs text-muted-foreground">{{ __('docs/sheet.layouts.drawer_desc') }}</p>
                            </vibe:sheet.content>
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="space-y-3 w-full">
                        <div class="flex items-center justify-center">
                            <vibe:button @click.stop="$dispatch('toggle-sheet', 'demo-sheet-overlay')" variant="primary" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M15 3v18" />
                                </svg>
                                {{ __('docs/sheet.layouts.btn_open') }}
                            </vibe:button>
                        </div>

                        <div class="relative h-80 w-full overflow-hidden border border-border rounded-xl bg-card flex">
                            {{-- Konten Latar Belakang --}}
                            <div class="flex-1 flex flex-col items-center justify-center p-6 text-center space-y-2">
                                <span class="text-xs font-semibold text-foreground">Konten Dasar Halaman</span>
                                <p class="text-xs text-muted-foreground max-w-sm">
                                    Saat drawer overlay dibuka, konten ini tidak tergeser melainkan tertutup rapi oleh panel di atasnya.
                                </p>
                            </div>

                            {{-- Overlay Sheet --}}
                            <vibe:sheet id="demo-sheet-overlay" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="300" class="shadow-2xl">
                                <vibe:sheet.header class="flex items-center justify-between">
                                    <span class="font-semibold text-xs text-foreground">{{ __('docs/sheet.layouts.drawer_title') }}</span>
                                    <vibe:sheet.close />
                                </vibe:sheet.header>
                                <vibe:sheet.content class="space-y-2">
                                    <p class="text-xs text-muted-foreground leading-relaxed">
                                        {{ __('docs/sheet.layouts.drawer_desc') }}
                                    </p>
                                    <div class="p-2.5 rounded bg-muted/50 border border-border text-[11px] text-muted-foreground">
                                        {{ __('docs/sheet.interactive.click_outside_tip') }}
                                    </div>
                                </vibe:sheet.content>
                                <vibe:sheet.footer class="flex justify-end">
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        Tutup Drawer
                                    </vibe:button>
                                </vibe:sheet.footer>
                            </vibe:sheet>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Close on Outside Click & Backdrop --}}
            <section id="tutup-klik-luar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.outside_click.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.outside_click.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.outside_click.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Panel Klik Luar Tanpa Backdrop --}}
                        <vibe:button @click.stop="$dispatch('open-sheet', 'demo-outside-clean')" variant="outline" size="sm">
                            {{ __('docs/sheet.outside_click.btn_open_clean') }}
                        </vibe:button>

                        <vibe:sheet id="demo-outside-clean" position="right" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="280">
                            <vibe:sheet.header class="flex items-center justify-between">
                                <h3 class="font-semibold text-sm">{{ __('docs/sheet.outside_click.panel_title') }}</h3>
                                <vibe:sheet.close />
                            </vibe:sheet.header>
                            <vibe:sheet.content class="space-y-2">
                                <p class="text-xs text-muted-foreground">{!! __('docs/sheet.outside_click.panel_desc') !!}</p>
                            </vibe:sheet.content>
                        </vibe:sheet>

                        {{-- 2. Drawer dengan Backdrop Overlay Blur --}}
                        <div x-data="{ openDrawer: false }">
                            <vibe:button @click.stop="openDrawer = true; $dispatch('open-sheet', 'demo-outside-backdrop')" variant="primary" size="sm">
                                {{ __('docs/sheet.outside_click.btn_open_backdrop') }}
                            </vibe:button>

                            {{-- Backdrop Gelap Transparan --}}
                            <div x-show="openDrawer" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-xs z-30" @click="openDrawer = false; $dispatch('close-sheet', 'demo-outside-backdrop')"></div>

                            <vibe:sheet id="demo-outside-backdrop" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="320" @close-sheet.window="openDrawer = false">
                                ...
                            </vibe:sheet>
                        </div>
                    </vibe:preview.code>

                    <div class="space-y-4 w-full" x-data="{ backdropOpen: false }">
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <vibe:button @click.stop="$dispatch('toggle-sheet', 'demo-outside-clean')" variant="outline" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" />
                                    <path d="M15 3v18" />
                                </svg>
                                {{ __('docs/sheet.outside_click.btn_open_clean') }}
                            </vibe:button>

                            <vibe:button @click.stop="backdropOpen = true; $dispatch('open-sheet', 'demo-outside-backdrop')" variant="primary" size="sm">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12h20M12 2a10 10 0 0 1 10 10M12 22a10 10 0 0 1-10-10" />
                                </svg>
                                {{ __('docs/sheet.outside_click.btn_open_backdrop') }}
                            </vibe:button>
                        </div>

                        {{-- Sandbox Container --}}
                        <div class="relative h-88 w-full overflow-hidden border border-border rounded-xl bg-card flex">
                            {{-- Area Luar (Content) yang memicu tutup saat diklik --}}
                            <div class="flex-1 flex flex-col items-center justify-center p-6 text-center space-y-2 cursor-pointer select-none bg-muted/10 hover:bg-muted/20 transition-colors" title="{{ __('docs/sheet.outside_click.outside_instruction') }}">
                                <div class="px-3 py-1.5 rounded-full bg-muted border border-border text-xs text-muted-foreground font-medium flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-success animate-pulse"></span>
                                    {{ __('docs/sheet.outside_click.outside_instruction') }}
                                </div>
                                <p class="text-xs text-muted-foreground/80 max-w-sm">
                                    Buka sheet menggunakan tombol di atas, lalu klik di mana saja pada kotak ini. Sheet akan otomatis menutup berkat prop <code>:closeOnOutsideClick="true"</code>.
                                </p>
                            </div>

                            {{-- Sheet 1: Tanpa backdrop (relative flow) --}}
                            <vibe:sheet id="demo-outside-clean" position="right" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="280" class="shadow-xl">
                                <vibe:sheet.header class="flex items-center justify-between">
                                    <span class="font-semibold text-xs text-foreground">{{ __('docs/sheet.outside_click.panel_title') }}</span>
                                    <vibe:sheet.close />
                                </vibe:sheet.header>
                                <vibe:sheet.content class="space-y-2">
                                    <p class="text-xs text-muted-foreground leading-relaxed">
                                        {!! __('docs/sheet.outside_click.panel_desc') !!}
                                    </p>
                                    <div class="p-2.5 rounded-lg bg-success/10 border border-success/20 text-success text-[11px] space-y-1">
                                        <p class="font-semibold">✓ Fitur Aktif</p>
                                        <p>{{ __('docs/sheet.interactive.click_outside_fold') }}</p>
                                    </div>
                                </vibe:sheet.content>
                                <vibe:sheet.footer class="flex justify-end">
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/sheet.outside_click.btn_close') }}
                                    </vibe:button>
                                </vibe:sheet.footer>
                            </vibe:sheet>

                            {{-- Backdrop Overlay Simulation --}}
                            <div x-show="backdropOpen" x-transition.opacity class="absolute inset-0 bg-black/50 backdrop-blur-xs z-30 flex items-center justify-center p-4 cursor-pointer" @click="backdropOpen = false; $dispatch('close-sheet', 'demo-outside-backdrop')">
                                <div class="px-3 py-1 rounded-full bg-black/60 text-white text-xs backdrop-blur-md border border-white/20 select-none pointer-events-none">
                                    {{ __('docs/sheet.outside_click.backdrop_instruction') }}
                                </div>
                            </div>

                            {{-- Sheet 2: Dengan backdrop (absolute overlay) --}}
                            <vibe:sheet id="demo-outside-backdrop" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="300" class="shadow-2xl z-40" @close-sheet.window="backdropOpen = false">
                                <vibe:sheet.header class="flex items-center justify-between">
                                    <span class="font-semibold text-xs text-foreground">{{ __('docs/sheet.outside_click.drawer_title') }}</span>
                                    <vibe:sheet.close @click="backdropOpen = false" />
                                </vibe:sheet.header>
                                <vibe:sheet.content class="space-y-2">
                                    <p class="text-xs text-muted-foreground leading-relaxed">
                                        {{ __('docs/sheet.outside_click.drawer_desc') }}
                                    </p>
                                    <div class="p-2.5 rounded-lg bg-primary/10 border border-primary/20 text-primary text-[11px]">
                                        {{ __('docs/sheet.interactive.click_backdrop_tip') }}
                                    </div>
                                </vibe:sheet.content>
                                <vibe:sheet.footer class="flex justify-end">
                                    <vibe:button type="button" variant="outline" size="sm" @click="backdropOpen = false; close()">
                                        {{ __('docs/sheet.outside_click.btn_close') }}
                                    </vibe:button>
                                </vibe:sheet.footer>
                            </vibe:sheet>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. LocalStorage Persistence --}}
            <section id="persistensi-storage" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.persist.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.persist.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/sheet.persist.preview_title')">
                    <vibe:preview.code>
                        {{-- Sheet dengan persist="true" --}}
                        <vibe:sheet id="custom-persist-sheet" position="left" behavior="collapsible" :resizable="true" :persist="true" :defaultSize="280">
                            ...
                        </vibe:sheet>
                    </vibe:preview.code>

                    <div class="space-y-3 w-full" x-data="{
                        clearStorage() {
                            let prefix = 'vibe';
                            localStorage.removeItem(`${prefix}-sheet`);
                            if (typeof vibeToast === 'function') {
                                vibeToast({
                                    type: 'success',
                                    title: '{{ __('docs/sheet.persist.reset_btn') }}',
                                    message: '{{ __('docs/sheet.persist.reset_toast') }}'
                                });
                            }
                        }
                    }">
                        <div class="flex flex-wrap items-center justify-center gap-2">
                            <vibe:button @click="$dispatch('toggle-sheet', 'demo-sheet-persist')" variant="outline" size="sm">
                                {{ __('docs/sheet.persist.btn_toggle') }}
                            </vibe:button>
                            <vibe:button @click="clearStorage" variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                </svg>
                                {{ __('docs/sheet.persist.reset_btn') }}
                            </vibe:button>
                        </div>

                        <div class="relative h-80 w-full overflow-hidden border border-border rounded-xl bg-muted/10 flex">
                            <vibe:sheet id="demo-sheet-persist" position="left" behavior="collapsible" :resizable="true" :persist="true" :defaultSize="260" :minSize="180" :maxSize="400">
                                <vibe:sheet.header class="flex items-center justify-between">
                                    <span class="font-semibold text-xs text-foreground">{{ __('docs/sheet.persist.sheet_title') }}</span>
                                    <vibe:sheet.close />
                                </vibe:sheet.header>
                                <vibe:sheet.content class="space-y-2">
                                    <p class="text-xs text-muted-foreground leading-relaxed">
                                        {{ __('docs/sheet.persist.sheet_desc') }}
                                    </p>
                                    <div class="p-2.5 rounded bg-muted/50 border border-border text-[11px] text-muted-foreground">
                                        💾 Status ukuran & keterbukaan disimpan di key <code>vibe-sheet</code> pada LocalStorage.
                                    </div>
                                </vibe:sheet.content>
                            </vibe:sheet>

                            <div class="flex-1 flex items-center justify-center p-6 text-center text-xs text-muted-foreground">
                                Ubah ukuran panel ini atau tutup, kemudian muat ulang halaman ini untuk melihat statusnya bertahan.
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. API Reference Table --}}
            <section id="referensi-api" class="space-y-8">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/sheet.api.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/sheet.api.desc') !!}
                    </p>
                </div>

                {{-- Subcomponents Anatomy Table --}}
                <div class="space-y-2">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/sheet.api.subcomponents_title') }}</h3>
                    <p class="text-sm text-muted-foreground">{{ __('docs/sheet.api.subcomponents_desc') }}</p>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/sheet.api.th_sub') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/sheet.api.th_sub_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/sheet.api.subcomponents') as $sub)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $sub['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $sub['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Props Table --}}
                <div class="space-y-2">
                    <h3 class="text-base font-semibold text-foreground">Daftar Properti (Props)</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/sheet.api.th_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/sheet.api.th_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/sheet.api.th_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/sheet.api.th_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/sheet.api.props') as $item)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $item['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $item['type'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $item['default'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $item['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Window Events Table --}}
                <div class="space-y-2">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/sheet.api.events_title') }}</h3>
                    <p class="text-sm text-muted-foreground">{{ __('docs/sheet.api.events_desc') }}</p>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/sheet.api.th_event') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/sheet.api.th_payload') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/sheet.api.th_event_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/sheet.api.events') as $ev)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $ev['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground text-xs whitespace-nowrap">{{ $ev['payload'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $ev['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
