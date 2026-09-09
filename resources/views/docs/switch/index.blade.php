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
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">secondary</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">success</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">warning</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">danger</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">info</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">accent</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">labelPlacement</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">disabled</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">error</vibe:badge>
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
                        <vibe:switch name="airplane_mode" label="{{ __('docs/switch.basic_usage.airplane_label') }}" description="{{ __('docs/switch.basic_usage.airplane_desc') }}" checked />
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:switch name="airplane_mode" :label="__('docs/switch.basic_usage.airplane_label')" :description="__('docs/switch.basic_usage.airplane_desc')" checked />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Color Variants --}}
            <section id="varian-warna" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.variants.preview_title')">
                    <vibe:preview.code>
                        <vibe:switch variant="primary" label="{{ __('docs/switch.variants.primary_label') }}" checked />
                        <vibe:switch variant="secondary" label="{{ __('docs/switch.variants.secondary_label') }}" checked />
                        <vibe:switch variant="success" label="{{ __('docs/switch.variants.success_label') }}" checked />
                        <vibe:switch variant="warning" label="{{ __('docs/switch.variants.warning_label') }}" checked />
                        <vibe:switch variant="danger" label="{{ __('docs/switch.variants.danger_label') }}" checked />
                        <vibe:switch variant="info" label="{{ __('docs/switch.variants.info_label') }}" checked />
                        <vibe:switch variant="accent" label="{{ __('docs/switch.variants.accent_label') }}" checked />
                    </vibe:preview.code>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full max-w-2xl">
                        <vibe:switch variant="primary" :label="__('docs/switch.variants.primary_label')" checked />
                        <vibe:switch variant="secondary" :label="__('docs/switch.variants.secondary_label')" checked />
                        <vibe:switch variant="success" :label="__('docs/switch.variants.success_label')" checked />
                        <vibe:switch variant="warning" :label="__('docs/switch.variants.warning_label')" checked />
                        <vibe:switch variant="danger" :label="__('docs/switch.variants.danger_label')" checked />
                        <vibe:switch variant="info" :label="__('docs/switch.variants.info_label')" checked />
                        <vibe:switch variant="accent" :label="__('docs/switch.variants.accent_label')" checked />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
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

            {{-- 4. Label Placement (Right, Left & Justify) --}}
            <section id="penempatan-label" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.placement.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.placement.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.placement.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Right Placement (Default) --}}
                        <vibe:switch labelPlacement="right" label="{{ __('docs/switch.placement.right_label') }}" checked />

                        {{-- 2. Left Placement --}}
                        <vibe:switch labelPlacement="left" label="{{ __('docs/switch.placement.left_label') }}" checked />

                        {{-- 3. Justify Placement (Settings Row inside Card) --}}
                        <vibe:card class="w-full max-w-md divide-y divide-border space-y-4">
                            <vibe:switch labelPlacement="justify" name="push_notif" label="{{ __('docs/switch.placement.notif_title') }}" description="{{ __('docs/switch.placement.notif_desc') }}" checked />
                            <div class="pt-4">
                                <vibe:switch labelPlacement="justify" name="auto_dark" variant="success" label="{{ __('docs/switch.placement.dark_title') }}" description="{{ __('docs/switch.placement.dark_desc') }}" />
                            </div>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="flex flex-col gap-5 w-full max-w-md">
                        <vibe:switch labelPlacement="right" :label="__('docs/switch.placement.right_label')" checked />
                        <vibe:switch labelPlacement="left" :label="__('docs/switch.placement.left_label')" checked />

                        <vibe:card class="w-full divide-y divide-border space-y-4">
                            <vibe:switch labelPlacement="justify" name="push_notif_demo" :label="__('docs/switch.placement.notif_title')" :description="__('docs/switch.placement.notif_desc')" checked />
                            <div class="pt-4">
                                <vibe:switch labelPlacement="justify" name="auto_dark_demo" variant="success" :label="__('docs/switch.placement.dark_title')" :description="__('docs/switch.placement.dark_desc')" />
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Thumb Icons (Slot) --}}
            <section id="ikon-thumb" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.icons.preview_title')">
                    <vibe:preview.code>
                        {{-- Switch dengan Ikon Bulan / Gelap --}}
                        <vibe:switch name="theme_mode" size="lg" label="{{ __('docs/switch.icons.theme_label') }}" description="{{ __('docs/switch.icons.theme_desc') }}" checked>
                            <svg class="text-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                            </svg>
                        </vibe:switch>

                        {{-- Switch dengan Ikon Gembok / Keamanan --}}
                        <vibe:switch name="security_pin" size="md" variant="success" label="{{ __('docs/switch.icons.security_label') }}" description="{{ __('docs/switch.icons.security_desc') }}" checked>
                            <svg class="text-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </vibe:switch>
                    </vibe:preview.code>
                    <div class="flex flex-col gap-4 w-full max-w-md">
                        <vibe:switch name="theme_mode_demo" size="lg" :label="__('docs/switch.icons.theme_label')" :description="__('docs/switch.icons.theme_desc')" checked>
                            <svg class="text-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                            </svg>
                        </vibe:switch>

                        <vibe:switch name="security_pin_demo" size="md" variant="success" :label="__('docs/switch.icons.security_label')" :description="__('docs/switch.icons.security_desc')" checked>
                            <svg class="text-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </vibe:switch>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Component States (Disabled & Error) --}}
            <section id="status-komponen" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/switch.states.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/switch.states.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/switch.states.preview_title')">
                    <vibe:preview.code>
                        {{-- Disabled (OFF) --}}
                        <vibe:switch disabled label="{{ __('docs/switch.states.disabled_off_label') }}" description="{{ __('docs/switch.states.disabled_off_desc') }}" />

                        {{-- Disabled (ON) --}}
                        <vibe:switch disabled checked label="{{ __('docs/switch.states.disabled_on_label') }}" description="{{ __('docs/switch.states.disabled_on_desc') }}" />

                        {{-- Error State --}}
                        <vibe:switch name="terms_agreement" :error="__('docs/switch.states.error_message')" label="{{ __('docs/switch.states.error_label') }}" description="{{ __('docs/switch.states.error_desc') }}" />
                    </vibe:preview.code>
                    <div class="flex flex-col gap-4 w-full max-w-md">
                        <vibe:switch disabled :label="__('docs/switch.states.disabled_off_label')" :description="__('docs/switch.states.disabled_off_desc')" />
                        <vibe:switch disabled checked :label="__('docs/switch.states.disabled_on_label')" :description="__('docs/switch.states.disabled_on_desc')" />
                        <vibe:switch name="terms_agreement_demo" :error="__('docs/switch.states.error_message')" :label="__('docs/switch.states.error_label')" :description="__('docs/switch.states.error_desc')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Form Testing ($request->all()) --}}
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
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                            @csrf
                            <vibe:card>
                                <vibe:card.header>
                                    <h3 class="text-sm sm:text-base font-semibold text-foreground">Pengaturan Akun & Notifikasi</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">Uji coba pengiriman nilai boolean toggle switch langsung ke backend controller.</p>
                                </vibe:card.header>

                                <vibe:card.content class="space-y-6">
                                    <vibe:switch name="push_notifications" labelPlacement="justify" label="Notifikasi Push" description="Terima pembaruan penting secara real-time" checked />
                                    <vibe:switch name="auto_backup" labelPlacement="justify" label="Pencadangan Otomatis" description="Sinkronisasi data ke cloud setiap 24 jam" variant="success" checked />
                                    <vibe:switch name="security_alerts" labelPlacement="justify" label="Peringatan Keamanan Kritis" description="Kirim SMS darurat saat terdeteksi login baru" variant="danger" checked />
                                    <vibe:switch name="marketing_emails" labelPlacement="justify" label="Email Promo & Buletin" description="Dapatkan tips mingguan dan info penawaran menarik" variant="accent" />
                                </vibe:card.content>

                                <vibe:card.footer>
                                    <vibe:button class="w-full" type="submit" variant="primary">
                                        Kirim Form & Uji $request->all()
                                    </vibe:button>
                                </vibe:card.footer>
                            </vibe:card>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">Pengaturan Akun & Notifikasi</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Uji coba pengiriman nilai boolean toggle switch langsung ke backend controller.</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-6">
                                <vibe:switch name="push_notifications" labelPlacement="justify" label="Notifikasi Push" description="Terima pembaruan penting secara real-time" checked />
                                <vibe:switch name="auto_backup" labelPlacement="justify" label="Pencadangan Otomatis" description="Sinkronisasi data ke cloud setiap 24 jam" variant="success" checked />
                                <vibe:switch name="security_alerts" labelPlacement="justify" label="Peringatan Keamanan Kritis" description="Kirim SMS darurat saat terdeteksi login baru" variant="danger" checked />
                                <vibe:switch name="marketing_emails" labelPlacement="justify" label="Email Promo & Buletin" description="Dapatkan tips mingguan dan info penawaran menarik" variant="accent" />
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    Kirim Form & Uji $request->all()
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>

                </vibe:preview>
            </section>

            {{-- 8. Props Reference --}}
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
                            $switchProps = [['name', 'string', 'null', __('docs/switch.props.items.name')], ['id', 'string', 'auto', __('docs/switch.props.items.id')], ['value', 'string', "'1'", __('docs/switch.props.items.value')], ['label', 'string', 'null', __('docs/switch.props.items.label')], ['description', 'string', 'null', __('docs/switch.props.items.description')], ['checked', 'bool', 'false', __('docs/switch.props.items.checked')], ['size', "'sm'|'md'|'lg'", "'md'", __('docs/switch.props.items.size')], ['variant', "'primary'|'secondary'|'success'|'warning'|'danger'|'info'|'accent'", "'primary'", __('docs/switch.props.items.variant')], ['labelPlacement', "'right'|'left'|'justify'", "'right'", __('docs/switch.props.items.labelPlacement')], ['error', 'string|bool', 'null', __('docs/switch.props.items.error')], ['errorName', 'string', 'null', __('docs/switch.props.items.errorName')], ['disabled', 'bool', 'false', __('docs/switch.props.items.disabled')], ['wrapperClass', 'string', 'null', __('docs/switch.props.items.wrapperClass')]];
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
