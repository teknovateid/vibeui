<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/switch.title')" :description="__('docs/switch.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/switch.title'), 'url' => '/docs/switch']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/switch.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/switch.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/switch.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/switch.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">sm</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">md (default)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">lg</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">primary</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">success</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">accent</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">labelPlacement: right</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">labelPlacement: justify</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:switch 
    name="airplane_mode" 
    label="{{ __('docs/switch.basic_usage.airplane_label') }}" 
    description="{{ __('docs/switch.basic_usage.airplane_desc') }}" 
    checked 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:switch 
                            name="airplane_mode" 
                            :label="__('docs/switch.basic_usage.airplane_label')" 
                            :description="__('docs/switch.basic_usage.airplane_desc')" 
                            checked 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.sizes.preview_title')">
                    <vibe:preview.code>
<vibe:switch size="sm" label="{{ __('docs/switch.sizes.sm') }}" checked />
<vibe:switch size="md" label="{{ __('docs/switch.sizes.md') }}" checked />
<vibe:switch size="lg" label="{{ __('docs/switch.sizes.lg') }}" checked />
                    </vibe:preview.code>
                    <div class="flex flex-col gap-3">
                        <vibe:switch size="sm" :label="__('docs/switch.sizes.sm')" checked />
                        <vibe:switch size="md" :label="__('docs/switch.sizes.md')" checked />
                        <vibe:switch size="lg" :label="__('docs/switch.sizes.lg')" checked />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Settings Row (labelPlacement="justify") --}}
            <section id="baris-pengaturan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.placement.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.placement.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.placement.preview_title')">
                    <vibe:preview.code>
<div class="w-full max-w-md divide-y divide-border rounded-xl border border-border bg-card p-4 space-y-4">
    <vibe:switch 
        labelPlacement="justify" 
        name="push_notif" 
        label="{{ __('docs/switch.placement.notif_title') }}" 
        description="{{ __('docs/switch.placement.notif_desc') }}" 
        checked 
    />
    <div class="pt-4">
        <vibe:switch 
            labelPlacement="justify" 
            name="auto_dark" 
            variant="success" 
            label="{{ __('docs/switch.placement.dark_title') }}" 
            description="{{ __('docs/switch.placement.dark_desc') }}" 
        />
    </div>
</div>
                    </vibe:preview.code>
                    <div class="w-full max-w-md divide-y divide-border rounded-xl border border-border bg-card p-4 space-y-4 shadow-2xs">
                        <vibe:switch 
                            labelPlacement="justify" 
                            name="push_notif_live" 
                            :label="__('docs/switch.placement.notif_title')" 
                            :description="__('docs/switch.placement.notif_desc')" 
                            checked 
                        />
                        <div class="pt-4">
                            <vibe:switch 
                                labelPlacement="justify" 
                                name="auto_dark_live" 
                                variant="success" 
                                :label="__('docs/switch.placement.dark_title')" 
                                :description="__('docs/switch.placement.dark_desc')" 
                            />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Form Testing ($request->all()) --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">Pengujian Form ($request->all())</h2>
                        <vibe:badge variant="primary" size="sm">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Uji coba pengiriman nilai switch (boolean toggle & pengaturan fitur) langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Saat disubmit, modal otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code>.
                    </p>
                </div>

                <vibe:preview title="Form Testing Sandbox">
                    <vibe:preview.code>
<vibe:form action="{{ route('docs.form.store') }}" method="POST" class="space-y-5 max-w-lg mx-auto">
    @csrf

    <vibe:switch 
        name="push_notifications" 
        label="Notifikasi Push" 
        description="Terima pembaruan penting secara real-time"
        checked 
    />

    <vibe:switch 
        name="auto_backup" 
        label="Pencadangan Otomatis" 
        description="Sinkronisasi data ke cloud setiap 24 jam"
        variant="success"
        labelPlacement="justify"
        checked 
    />

    <vibe:switch 
        name="marketing_emails" 
        label="Email Promo & Buletin" 
        description="Dapatkan tips mingguan dan info penawaran menarik"
        variant="accent"
        labelPlacement="justify"
    />

    <div class="pt-2 flex items-center gap-3">
        <vibe:button type="submit" variant="primary">
            Kirim Form & Uji $request->all()
        </vibe:button>
    </div>
</vibe:form>
                    </vibe:preview.code>
                    <div class="max-w-lg mx-auto p-4">
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <vibe:switch 
                                name="push_notifications" 
                                label="Notifikasi Push" 
                                description="Terima pembaruan penting secara real-time"
                                checked 
                            />

                            <vibe:switch 
                                name="auto_backup" 
                                label="Pencadangan Otomatis" 
                                description="Sinkronisasi data ke cloud setiap 24 jam"
                                variant="success"
                                labelPlacement="justify"
                                checked 
                            />

                            <vibe:switch 
                                name="marketing_emails" 
                                label="Email Promo & Buletin" 
                                description="Dapatkan tips mingguan dan info penawaran menarik"
                                variant="accent"
                                labelPlacement="justify"
                            />

                            <div class="pt-2 flex items-center gap-3">
                                <vibe:button type="submit" variant="primary">
                                    Kirim Form & Uji $request->all()
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
                @include('docs.partials.form-result-banner')
            </section>

            {{-- 5. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/switch.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/switch.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/switch.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/switch.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $switchProps = [
                                ['name', 'string', 'null', __('docs/switch.props.items.name')],
                                ['id', 'string', 'auto', __('docs/switch.props.items.id')],
                                ['value', 'string', "'1'", __('docs/switch.props.items.value')],
                                ['label', 'string', 'null', __('docs/switch.props.items.label')],
                                ['description', 'string', 'null', __('docs/switch.props.items.description')],
                                ['checked', 'bool', 'false', __('docs/switch.props.items.checked')],
                                ['size', "'sm'|'md'|'lg'", "'md'", __('docs/switch.props.items.size')],
                                ['variant', "'primary'|'success'|'accent'", "'primary'", __('docs/switch.props.items.variant')],
                                ['labelPlacement', "'right'|'left'|'justify'", "'right'", __('docs/switch.props.items.labelPlacement')],
                                ['error', 'string|bool', 'null', __('docs/switch.props.items.error')],
                                ['errorName', 'string', 'null', __('docs/switch.props.items.errorName')],
                                ['disabled', 'bool', 'false', __('docs/switch.props.items.disabled')],
                                ['wrapperClass', 'string', 'null', __('docs/switch.props.items.wrapperClass')],
                            ];
                        @endphp
                        @foreach ($switchProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Slots Table --}}
                <div class="space-y-3 pt-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-foreground">{{ __('docs/switch.slots.title') }}</h3>
                        <p class="text-sm text-muted-foreground">
                            {!! __('docs/switch.slots.desc') !!}
                        </p>
                    </div>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/switch.slots.columns.slot') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/switch.slots.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">default ($slot)</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! __('docs/switch.slots.items.default') !!}</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
