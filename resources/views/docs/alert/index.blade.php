<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/alert.title')" :description="__('docs/alert.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Feedback', 'url' => '/docs'],
        ['name' => __('docs/alert.title'), 'url' => '/docs/alert']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/alert.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/alert.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/alert.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/alert.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['success', 'error', 'warning', 'info', 'confirm'] as $t)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $t }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['center', 'top-right', 'top-left', 'bottom-right', 'bottom-left', 'top-center', 'bottom-center'] as $p)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $p }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['blocking', 'sound', 'timeout', 'buttonLayout'] as $f)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $f }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.basic_usage.preview_title')">
                    <vibe:preview.code>
{{-- 1. Info Alert --}}
<vibe:button variant="info" size="sm" onclick="vibeAlert({
    type: 'info',
    title: '{{ __('docs/alert.basic_usage.types.info.title') }}',
    message: '{{ __('docs/alert.basic_usage.types.info.msg') }}'
})">
    {{ __('docs/alert.basic_usage.types.info.btn') }}
</vibe:button>

{{-- 2. Success Alert --}}
<vibe:button variant="success" size="sm" onclick="vibeAlert({
    type: 'success',
    title: '{{ __('docs/alert.basic_usage.types.success.title') }}',
    message: '{{ __('docs/alert.basic_usage.types.success.msg') }}'
})">
    {{ __('docs/alert.basic_usage.types.success.btn') }}
</vibe:button>

{{-- 3. Warning Alert --}}
<vibe:button variant="warning" size="sm" onclick="vibeAlert({
    type: 'warning',
    title: '{{ __('docs/alert.basic_usage.types.warning.title') }}',
    message: '{{ __('docs/alert.basic_usage.types.warning.msg') }}'
})">
    {{ __('docs/alert.basic_usage.types.warning.btn') }}
</vibe:button>

{{-- 4. Error Alert --}}
<vibe:button variant="destructive" size="sm" onclick="vibeAlert({
    type: 'error',
    title: '{{ __('docs/alert.basic_usage.types.error.title') }}',
    message: '{{ __('docs/alert.basic_usage.types.error.msg') }}'
})">
    {{ __('docs/alert.basic_usage.types.error.btn') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="info" size="sm" onclick="vibeAlert({
                                type: 'info',
                                title: '{{ __('docs/alert.basic_usage.types.info.title') }}',
                                message: '{{ __('docs/alert.basic_usage.types.info.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                            </svg>
                            {{ __('docs/alert.basic_usage.types.info.btn') }}
                        </vibe:button>

                        <vibe:button variant="success" size="sm" onclick="vibeAlert({
                                type: 'success',
                                title: '{{ __('docs/alert.basic_usage.types.success.title') }}',
                                message: '{{ __('docs/alert.basic_usage.types.success.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            {{ __('docs/alert.basic_usage.types.success.btn') }}
                        </vibe:button>

                        <vibe:button variant="warning" size="sm" onclick="vibeAlert({
                                type: 'warning',
                                title: '{{ __('docs/alert.basic_usage.types.warning.title') }}',
                                message: '{{ __('docs/alert.basic_usage.types.warning.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <line x1="12" y1="9" x2="12" y2="13" />
                                <line x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                            {{ __('docs/alert.basic_usage.types.warning.btn') }}
                        </vibe:button>

                        <vibe:button variant="destructive" size="sm" onclick="vibeAlert({
                                type: 'error',
                                title: '{{ __('docs/alert.basic_usage.types.error.title') }}',
                                message: '{{ __('docs/alert.basic_usage.types.error.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="15" y1="9" x2="9" y2="15" />
                                <line x1="9" y1="9" x2="15" y2="15" />
                            </svg>
                            {{ __('docs/alert.basic_usage.types.error.btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Confirmation Dialog --}}
            <section id="dialog-konfirmasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.confirm.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.confirm.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.confirm.preview_title')">
                    <vibe:preview.code>
<vibe:button variant="destructive" onclick="vibeAlert({
    type: 'confirm',
    title: '{{ __('docs/alert.confirm.dialog_title') }}',
    message: '{{ __('docs/alert.confirm.dialog_msg') }}',
    confirmButton: {
        text: '{{ __('docs/alert.confirm.yes_btn') }}',
        class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
        action: () => {
            vibeAlert({
                type: 'success',
                title: '{{ __('docs/alert.confirm.confirmed_title') }}',
                message: '{{ __('docs/alert.confirm.confirmed_msg') }}'
            });
        }
    },
    closeButton: {
        text: '{{ __('docs/alert.confirm.cancel_btn') }}'
    }
})">
    {{ __('docs/alert.confirm.open_btn') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <vibe:button variant="destructive" onclick="vibeAlert({
                                type: 'confirm',
                                title: '{{ __('docs/alert.confirm.dialog_title') }}',
                                message: '{{ __('docs/alert.confirm.dialog_msg') }}',
                                confirmButton: {
                                    text: '{{ __('docs/alert.confirm.yes_btn') }}',
                                    class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
                                    action: () => {
                                        vibeAlert({
                                            type: 'success',
                                            title: '{{ __('docs/alert.confirm.confirmed_title') }}',
                                            message: '{{ __('docs/alert.confirm.confirmed_msg') }}'
                                        });
                                    }
                                },
                                closeButton: {
                                    text: '{{ __('docs/alert.confirm.cancel_btn') }}'
                                }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                            </svg>
                            {{ __('docs/alert.confirm.open_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Positions --}}
            <section id="pilihan-posisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.positions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.positions.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.positions.preview_title')">
                    <vibe:preview.code>
vibeAlert({ position: 'top-right', type: 'info', message: 'Alert di pojok kanan atas.' });
vibeAlert({ position: 'center', type: 'info', message: 'Alert di tengah layar.' });
vibeAlert({ position: 'bottom-right', type: 'info', message: 'Alert di pojok kanan bawah.' });
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto grid grid-cols-3 gap-2">
                        @foreach (['top-left' => 'top_left', 'top-center' => 'top_center', 'top-right' => 'top_right', 'center' => 'center', 'bottom-left' => 'bottom_left', 'bottom-center' => 'bottom_center', 'bottom-right' => 'bottom_right'] as $pos => $key)
                            @if ($pos === 'center')
                                <div></div>
                                <vibe:button size="sm" variant="primary" onclick="vibeAlert({ position: 'center', type: 'info', title: '{{ __('docs/alert.positions.demo_title') }}', message: '{{ __('docs/alert.positions.demo_msg', ['position' => 'Center']) }}' })">
                                    {{ __('docs/alert.positions.items.center') }}
                                </vibe:button>
                                <div></div>
                            @else
                                <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: '{{ $pos }}', type: 'info', title: '{{ __('docs/alert.positions.demo_title') }}', message: '{{ __('docs/alert.positions.demo_msg', ['position' => $pos]) }}' })">
                                    {{ __('docs/alert.positions.items.' . $key) }}
                                </vibe:button>
                            @endif
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Custom Buttons & Layout --}}
            <section id="kustomisasi-tombol" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.buttons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.buttons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.buttons.preview_title')">
                    <vibe:preview.code>
{{-- Layout Row --}}
vibeAlert({
    type: 'warning',
    title: '{{ __('docs/alert.buttons.row_title') }}',
    message: '{{ __('docs/alert.buttons.row_msg') }}',
    buttonLayout: 'row',
    confirmButton: { text: 'OK' }
});

{{-- Layout Column --}}
vibeAlert({
    type: 'info',
    title: '{{ __('docs/alert.buttons.col_title') }}',
    message: '{{ __('docs/alert.buttons.col_msg') }}',
    buttonLayout: 'col',
    confirmButton: { text: 'Action 1' },
    closeButton: { text: 'Action 2' }
});
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'warning',
                                title: '{{ __('docs/alert.buttons.row_title') }}',
                                message: '{{ __('docs/alert.buttons.row_msg') }}',
                                buttonLayout: 'row',
                                confirmButton: { text: 'OK' }
                            })">
                            {{ __('docs/alert.buttons.row_btn') }}
                        </vibe:button>

                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'info',
                                title: '{{ __('docs/alert.buttons.col_title') }}',
                                message: '{{ __('docs/alert.buttons.col_msg') }}',
                                buttonLayout: 'col',
                                confirmButton: { text: 'Action 1' },
                                closeButton: { text: 'Action 2' }
                            })">
                            {{ __('docs/alert.buttons.col_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Sound & Timeout --}}
            <section id="audio-dan-durasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.sound_timeout.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.sound_timeout.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.sound_timeout.preview_title')">
                    <vibe:preview.code>
vibeAlert({ type: 'success', title: 'Audio Beep', message: 'Sound played.', sound: '{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}' });
vibeAlert({ type: 'warning', title: 'Sticky Alert', message: 'Persistent alert.', timeout: false });
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="outline" onclick="vibeAlert({
                                type: 'success',
                                title: 'Audio Beep',
                                message: 'Sound played via Web Audio API.',
                                sound: '{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}'
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" />
                                <path d="M15.54 8.46a5 5 0 0 1 0 7.07" />
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
                            </svg>
                            {{ __('docs/alert.sound_timeout.sound_btn') }}
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeAlert({
                                type: 'warning',
                                title: 'Sticky Alert',
                                message: 'Alert persistent timeout: false.',
                                timeout: false,
                                confirmButton: { text: 'Close' }
                            })">
                            {{ __('docs/alert.sound_timeout.timeout_sticky_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Background Blur Options --}}
            <section id="background-blur" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.blur.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.blur.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.blur.preview_title')">
                    <vibe:preview.code>
vibeAlert({
    type: 'confirm',
    title: '{{ __('docs/alert.blur.dialog_title') }}',
    message: '{{ __('docs/alert.blur.dialog_msg') }}',
    blur: 'lg'
});
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'confirm',
                                title: '{{ __('docs/alert.blur.dialog_title') }}',
                                message: '{{ __('docs/alert.blur.dialog_msg') }}',
                                blur: 'lg',
                                confirmButton: { text: 'OK' }
                            })">
                            {{ __('docs/alert.blur.open_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Persist Option --}}
            <section id="persistensi-alert" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.persist.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.persist.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/alert.persist.preview_title')">
                    <vibe:preview.code>
vibeAlert({
    id: 'demo-persist-alert',
    persist: true,
    type: 'info',
    title: '{{ __('docs/alert.persist.dialog_title') }}',
    message: '{{ __('docs/alert.persist.dialog_msg') }}'
});
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="secondary" onclick="vibeAlert({
                                id: 'demo-persist-alert',
                                persist: true,
                                type: 'info',
                                title: '{{ __('docs/alert.persist.dialog_title') }}',
                                message: '{{ __('docs/alert.persist.dialog_msg') }}',
                                timeout: false,
                                confirmButton: { text: 'OK' }
                            })">
                            {{ __('docs/alert.persist.open_btn') }}
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeAlert.reset('demo-persist-alert'); vibeAlert({ type: 'success', title: 'Reset', message: 'Storage reset.' })">
                            {{ __('docs/alert.persist.reset_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Integration Methods --}}
            <section id="metode-pemanggilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.integration.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.integration.desc') !!}
                    </p>
                </div>

                <div class="space-y-6">
                    @php
                        $jsSnippet = <<<'JS'
                        // Pemanggilan fungsi global vibeAlert dari mana saja (tanpa prefix window.)
                        vibeAlert({
                            type: 'success',
                            title: 'Operasi Berhasil',
                            message: 'Data formulir telah berhasil dikirim dan diproses.'
                        });

                        // Shorthand teks cepat
                        vibeAlert('Pembaruan data selesai disimpan.');
                        JS;

                        $bladeSnippet = <<<'HTML'
                        {{-- Tampilkan alert saat halaman pertama kali dimuat --}}
                        @vibeAlert([
                            'type' => 'info',
                            'title' => 'Selamat Datang!',
                            'message' => 'Silakan lengkapi informasi profil akun Anda.',
                        ])

                        {{-- Atau dengan kondisi Blade tertentu --}}
                        @if ($errors->any())
                        @vibeAlert([
                            'type' => 'error',
                            'title' => 'Validasi Gagal',
                            'message' => 'Silakan periksa kembali isian formulir Anda.',
                        ])
                        @endif
                        HTML;

                        $livewireSnippet = <<<'PHP'
                        use Livewire\Component;

                        class UserManager extends Component
                        {
                            public function save()
                            {
                                // Logika simpan data...

                                // Dispatch event alert ke antarmuka frontend
                                $this->dispatch('alert', [
                                    'type' => 'success',
                                    'title' => 'Tersimpan!',
                                    'message' => 'Data pengguna berhasil diperbarui.'
                                ]);
                            }
                        }
                        PHP;
                    @endphp

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">1. JavaScript Function (vibeAlert)</p>
                        <vibe:highlightjs language="javascript" title="app.js / script" :code="$jsSnippet" />
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">2. Blade Directive (&#64;vibeAlert)</p>
                        <vibe:highlightjs language="html" title="resources/views/pages/dashboard.blade.php" :code="$bladeSnippet" />
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">3. Livewire Component Event Dispatch</p>
                        <vibe:highlightjs language="php" title="app/Livewire/UserManager.php" :code="$livewireSnippet" />
                    </div>
                </div>
            </section>

            {{-- 7. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.props.desc') !!}
                    </p>
                </div>

                {{-- Container Props --}}
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:alert&gt; (Container Tag Props)</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/alert.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/alert.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/alert.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/alert.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $containerProps = [
                                    ['position', "'center'|'top-right'|'top-left'|'bottom-right'|'bottom-left'|'top-center'|'bottom-center'", "'center'", __('docs/alert.props_items.container.position')],
                                    ['align', "'start'|'center'|'end'", "'center'", __('docs/alert.props_items.container.align')],
                                    ['timeout', 'int|false', '3000', __('docs/alert.props_items.container.timeout')],
                                    ['sound', 'bool|string', 'false', __('docs/alert.props_items.container.sound')],
                                    ['blur', "'xs'|'sm'|'md'|'lg'|'xl'|bool", 'false', __('docs/alert.props_items.container.blur')],
                                    ['closeOnOutside', 'bool|null', 'null (auto)', __('docs/alert.props_items.container.closeOnOutside')]
                                ];
                            @endphp
                            @foreach ($containerProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Payload Parameters --}}
                <div class="space-y-2 pt-2">
                    <p class="text-sm font-semibold text-foreground">vibeAlert(payload) & $dispatch('alert', payload)</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/alert.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/alert.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/alert.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/alert.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $payloadParams = [
                                    ['type', "'success'|'error'|'warning'|'info'|'confirm'", "'info'", __('docs/alert.props_items.payload.type')],
                                    ['title', 'string', 'null', __('docs/alert.props_items.payload.title')],
                                    ['message', 'string', '""', __('docs/alert.props_items.payload.message')],
                                    ['icon', 'string (HTML/SVG)', 'null', __('docs/alert.props_items.payload.icon')],
                                    ['position', 'string', 'Inherit', __('docs/alert.props_items.payload.position')],
                                    ['align', "'start'|'center'|'end'", 'Inherit', __('docs/alert.props_items.payload.align')],
                                    ['timeout', 'int|false', 'Inherit (false for confirm)', __('docs/alert.props_items.payload.timeout')],
                                    ['blocking', 'bool', 'false (true for confirm)', __('docs/alert.props_items.payload.blocking')],
                                    ['blur', "'xs'|'sm'|'md'|'lg'|'xl'|bool", 'Inherit (false)', __('docs/alert.props_items.payload.blur')],
                                    ['sound', 'bool|string', 'false', __('docs/alert.props_items.payload.sound')],
                                    ['confirmButton', 'string|object', "{ text: 'Tutup' }", __('docs/alert.props_items.payload.confirmButton')],
                                    ['closeButton', 'string|object', "null ('Batal' for confirm)", __('docs/alert.props_items.payload.closeButton')],
                                    ['buttonLayout', "'row'|'col'", 'null', __('docs/alert.props_items.payload.buttonLayout')],
                                    ['closeOnOutside', 'bool', 'true (false for confirm)', __('docs/alert.props_items.payload.closeOnOutside')],
                                    ['id', 'string', 'null', __('docs/alert.props_items.payload.id')],
                                    ['persist', 'bool|string', 'false', __('docs/alert.props_items.payload.persist')]
                                ];
                            @endphp
                            @foreach ($payloadParams as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $desc }}</vibe:table.cell>
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
