<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/toast.title')" :description="__('docs/toast.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Feedback', 'url' => '/docs'],
        ['name' => __('docs/toast.title'), 'url' => '/docs/toast']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/toast.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/toast.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/toast.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/toast.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['success', 'error', 'warning', 'info'] as $t)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $t }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['bottom-right', 'bottom-left', 'top-right', 'top-left', 'top-center', 'bottom-center'] as $p)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $p }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sound', 'timeout', 'stacked', 'hover-expand'] as $f)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $f }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/toast.basic_usage.preview_title')">
                    <vibe:preview.code>
{{-- 1. Info Toast --}}
<vibe:button variant="info" size="sm" onclick="vibeToast({
    type: 'info',
    title: '{{ __('docs/toast.basic_usage.types.info.title') }}',
    message: '{{ __('docs/toast.basic_usage.types.info.msg') }}'
})">
    {{ __('docs/toast.basic_usage.types.info.btn') }}
</vibe:button>

{{-- 2. Success Toast --}}
<vibe:button variant="success" size="sm" onclick="vibeToast({
    type: 'success',
    title: '{{ __('docs/toast.basic_usage.types.success.title') }}',
    message: '{{ __('docs/toast.basic_usage.types.success.msg') }}'
})">
    {{ __('docs/toast.basic_usage.types.success.btn') }}
</vibe:button>

{{-- 3. Warning Toast --}}
<vibe:button variant="warning" size="sm" onclick="vibeToast({
    type: 'warning',
    title: '{{ __('docs/toast.basic_usage.types.warning.title') }}',
    message: '{{ __('docs/toast.basic_usage.types.warning.msg') }}'
})">
    {{ __('docs/toast.basic_usage.types.warning.btn') }}
</vibe:button>

{{-- 4. Error Toast --}}
<vibe:button variant="destructive" size="sm" onclick="vibeToast({
    type: 'error',
    title: '{{ __('docs/toast.basic_usage.types.error.title') }}',
    message: '{{ __('docs/toast.basic_usage.types.error.msg') }}'
})">
    {{ __('docs/toast.basic_usage.types.error.btn') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="info" size="sm" onclick="vibeToast({
                                type: 'info',
                                title: '{{ __('docs/toast.basic_usage.types.info.title') }}',
                                message: '{{ __('docs/toast.basic_usage.types.info.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                            </svg>
                            {{ __('docs/toast.basic_usage.types.info.btn') }}
                        </vibe:button>

                        <vibe:button variant="success" size="sm" onclick="vibeToast({
                                type: 'success',
                                title: '{{ __('docs/toast.basic_usage.types.success.title') }}',
                                message: '{{ __('docs/toast.basic_usage.types.success.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            {{ __('docs/toast.basic_usage.types.success.btn') }}
                        </vibe:button>

                        <vibe:button variant="warning" size="sm" onclick="vibeToast({
                                type: 'warning',
                                title: '{{ __('docs/toast.basic_usage.types.warning.title') }}',
                                message: '{{ __('docs/toast.basic_usage.types.warning.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <line x1="12" y1="9" x2="12" y2="13" />
                                <line x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                            {{ __('docs/toast.basic_usage.types.warning.btn') }}
                        </vibe:button>

                        <vibe:button variant="destructive" size="sm" onclick="vibeToast({
                                type: 'error',
                                title: '{{ __('docs/toast.basic_usage.types.error.title') }}',
                                message: '{{ __('docs/toast.basic_usage.types.error.msg') }}'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="15" y1="9" x2="9" y2="15" />
                                <line x1="9" y1="9" x2="15" y2="15" />
                            </svg>
                            {{ __('docs/toast.basic_usage.types.error.btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Stacked & Hover Interaction --}}
            <section id="penumpukan-berlapis" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.stacked.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.stacked.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/toast.stacked.preview_title')">
                    <vibe:preview.code>
<vibe:button variant="primary" onclick="
    vibeToast({ type: 'info', title: '{{ __('docs/toast.stacked.toast_1.title') }}', message: '{{ __('docs/toast.stacked.toast_1.msg') }}' });
    setTimeout(() => vibeToast({ type: 'warning', title: '{{ __('docs/toast.stacked.toast_2.title') }}', message: '{{ __('docs/toast.stacked.toast_2.msg') }}' }), 200);
    setTimeout(() => vibeToast({ type: 'success', title: '{{ __('docs/toast.stacked.toast_3.title') }}', message: '{{ __('docs/toast.stacked.toast_3.msg') }}' }), 400);
">
    {{ __('docs/toast.stacked.trigger_btn') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <vibe:button variant="primary" onclick="
                            vibeToast({ type: 'info', title: '{{ __('docs/toast.stacked.toast_1.title') }}', message: '{{ __('docs/toast.stacked.toast_1.msg') }}' });
                            setTimeout(() => vibeToast({ type: 'warning', title: '{{ __('docs/toast.stacked.toast_2.title') }}', message: '{{ __('docs/toast.stacked.toast_2.msg') }}' }), 200);
                            setTimeout(() => vibeToast({ type: 'success', title: '{{ __('docs/toast.stacked.toast_3.title') }}', message: '{{ __('docs/toast.stacked.toast_3.msg') }}' }), 400);
                        ">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2" />
                                <path d="M3 9h18" />
                                <path d="M9 21V9" />
                            </svg>
                            {{ __('docs/toast.stacked.trigger_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Placement Positions --}}
            <section id="pilihan-posisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.positions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.positions.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/toast.positions.preview_title')">
                    <vibe:preview.code>
vibeToast({ position: 'top-right', type: 'info', message: '{{ __('docs/toast.positions.demo_msg', ['position' => 'Top Right']) }}' });
vibeToast({ position: 'top-center', type: 'info', message: '{{ __('docs/toast.positions.demo_msg', ['position' => 'Top Center']) }}' });
vibeToast({ position: 'top-left', type: 'info', message: '{{ __('docs/toast.positions.demo_msg', ['position' => 'Top Left']) }}' });
vibeToast({ position: 'bottom-right', type: 'info', message: '{{ __('docs/toast.positions.demo_msg', ['position' => 'Bottom Right']) }}' });
vibeToast({ position: 'bottom-center', type: 'info', message: '{{ __('docs/toast.positions.demo_msg', ['position' => 'Bottom Center']) }}' });
vibeToast({ position: 'bottom-left', type: 'info', message: '{{ __('docs/toast.positions.demo_msg', ['position' => 'Bottom Left']) }}' });
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto grid grid-cols-3 gap-2">
                        @foreach (['top-left' => 'top_left', 'top-center' => 'top_center', 'top-right' => 'top_right', 'bottom-left' => 'bottom_left', 'bottom-center' => 'bottom_center', 'bottom-right' => 'bottom_right'] as $pos => $key)
                            <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: '{{ $pos }}', type: 'info', title: '{{ __('docs/toast.positions.demo_title') }}', message: '{{ __('docs/toast.positions.demo_msg', ['position' => $pos]) }}' })">
                                {{ __('docs/toast.positions.items.' . $key) }}
                            </vibe:button>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Sound & Duration Control --}}
            <section id="audio-dan-durasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.sound_timeout.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.sound_timeout.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/toast.sound_timeout.sound_preview')">
                    <vibe:preview.code>
<vibe:button variant="outline" onclick="vibeToast({ type: 'success', title: 'Audio Chime', message: 'Audio notification tone.', sound: '{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}' })">
    {{ __('docs/toast.sound_timeout.chime_btn') }}
</vibe:button>

<vibe:button variant="outline" onclick="vibeToast({ type: 'warning', title: 'Sticky Toast', message: 'Sticky notification.', timeout: false })">
    {{ __('docs/toast.sound_timeout.sticky_btn') }}
</vibe:button>

<vibe:button variant="outline" onclick="vibeToast({ type: 'info', title: 'Fast Toast', message: '2 seconds duration.', timeout: 2000 })">
    {{ __('docs/toast.sound_timeout.fast_btn') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="outline" onclick="vibeToast({
                                type: 'success',
                                title: 'Audio Chime',
                                message: 'Audio notification chime.',
                                sound: '{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}'
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" />
                                <path d="M15.54 8.46a5 5 0 0 1 0 7.07" />
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
                            </svg>
                            {{ __('docs/toast.sound_timeout.chime_btn') }}
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeToast({
                                type: 'warning',
                                title: 'Sticky Toast',
                                message: 'Toast persistent.',
                                timeout: false
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="10" y1="15" x2="10" y2="9" />
                                <line x1="14" y1="15" x2="14" y2="9" />
                            </svg>
                            {{ __('docs/toast.sound_timeout.sticky_btn') }}
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeToast({
                                type: 'info',
                                title: 'Fast Toast',
                                message: '2 seconds auto-dismiss.',
                                timeout: 2000
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ __('docs/toast.sound_timeout.fast_btn') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Trigger Methods --}}
            <section id="metode-pemanggilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.integration.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.integration.desc') !!}
                    </p>
                </div>

                @php
                    $jsHelperSnippet = <<<'JS'
                    // Format Objek Lengkap
                    vibeToast({
                        type: 'success',
                        title: 'Tersimpan',
                        message: 'Data profil berhasil disimpan.'
                    });

                    // Shorthand String Cepat
                    vibeToast('Operasi berhasil dilakukan!');
                    JS;

                    $alpineSnippet = <<<'HTML'
                    <vibe:button @click="$dispatch('toast', {
                        type: 'success',
                        title: 'Disalin',
                        message: 'Teks berhasil disalin ke clipboard.'
                    })">
                        Salin Teks
                    </vibe:button>
                    HTML;

                    $laravelSnippet = <<<'PHP'
                    // Di dalam Laravel Controller
                    return redirect()->route('dashboard')->with(
                        'toast_success',
                        'Artikel baru berhasil diterbitkan.'
                    );
                    PHP;

                    $livewireSnippet = <<<'PHP'
                    // Di dalam Livewire Component class
                    public function save()
                    {
                        // logika penyimpanan...
                        $this->dispatch('toast', [
                            'type' => 'success',
                            'title' => 'Data Disimpan',
                            'message' => 'Perubahan data berhasil diterapkan.'
                        ]);
                    }
                    PHP;
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- 1. JavaScript Helper --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">1</span>
                            <span class="text-sm font-semibold text-foreground">JavaScript vibeToast</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Global function invocation.</p>
                        <vibe:highlightjs language="javascript" :lineNumbers="false" :code="$jsHelperSnippet" />
                    </div>

                    {{-- 2. Alpine.js Dispatch --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">2</span>
                            <span class="text-sm font-semibold text-foreground">Alpine.js $dispatch</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Alpine event dispatch.</p>
                        <vibe:highlightjs language="html" :lineNumbers="false" :code="$alpineSnippet" />
                    </div>

                    {{-- 3. Laravel Flash Session --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">3</span>
                            <span class="text-sm font-semibold text-foreground">Laravel Flash Session</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Controller session flash.</p>
                        <vibe:highlightjs language="php" :lineNumbers="false" :code="$laravelSnippet" />
                    </div>

                    {{-- 4. Livewire Event Dispatch --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">4</span>
                            <span class="text-sm font-semibold text-foreground">Livewire Component</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Livewire event dispatch.</p>
                        <vibe:highlightjs language="php" :lineNumbers="false" :code="$livewireSnippet" />
                    </div>
                </div>
            </section>

            {{-- 6. Props & Payload Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.props.desc') !!}
                    </p>
                </div>

                {{-- Container Props --}}
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:toast&gt; (Container Tag Props)</p>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.props.columns.prop') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.props.columns.type') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.props.columns.default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/toast.props.columns.desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border text-muted-foreground">
                                @php
                                    $containerProps = [
                                        ['position', "'bottom-right'|'bottom-left'|'top-right'|'top-left'|'top-center'|'bottom-center'", "'bottom-right'", 'Posisi penempatan default container tumpukan toast pada layar.'],
                                        ['timeout', 'int|false', '3000', 'Waktu tunda auto-dismiss dalam milidetik (atau false untuk toast persisten).'],
                                        ['sound', 'bool|string', 'false', 'Memutar nada audio sintesis Web Audio API (true) atau file audio eksternal (string URL).']
                                    ];
                                @endphp
                                @foreach ($containerProps as [$prop, $type, $default, $desc])
                                    <tr class="hover:bg-accent/40 transition-colors">
                                        <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</td>
                                        <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</td>
                                        <td class="px-4 py-3 font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</td>
                                        <td class="px-4 py-3 text-muted-foreground">{{ $desc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Payload Parameters --}}
                <div class="space-y-2 pt-2">
                    <p class="text-sm font-semibold text-foreground">vibeToast(payload) & $dispatch('toast', payload)</p>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.props.columns.prop') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.props.columns.type') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.props.columns.default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/toast.props.columns.desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border text-muted-foreground">
                                @php
                                    $payloadParams = [
                                        ['type', "'success'|'error'|'warning'|'info'", "'info'", 'Jenis status notifikasi toast yang menentukan palet warna, badge, dan ikon otomatis.'],
                                        ['title', 'string', 'null', 'Judul utama notifikasi toast (opsional).'],
                                        ['message', 'string', '""', 'Pesan deskripsi lengkap toast yang ingin disampaikan kepada pengguna.'],
                                        ['icon', 'string (HTML/SVG)', 'null', 'Kustomisasi elemen SVG ikon untuk menggantikan ikon bawaan status.'],
                                        ['timeout', 'int|false', 'Inherit (3000)', 'Menimpa durasi auto-dismiss (false agar toast tetap terbuka hingga tombol close diklik).'],
                                        ['sound', 'bool|string', 'Inherit (false)', 'Menimpa preferensi efek suara saat toast muncul (true atau URL string audio).']
                                    ];
                                @endphp
                                @foreach ($payloadParams as [$prop, $type, $default, $desc])
                                    <tr class="hover:bg-accent/40 transition-colors">
                                        <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</td>
                                        <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</td>
                                        <td class="px-4 py-3 font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</td>
                                        <td class="px-4 py-3 text-muted-foreground">{{ $desc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
