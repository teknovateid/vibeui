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
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/toast.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/toast.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/toast.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/toast.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['success', 'error', 'warning', 'info'] as $t)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $t }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['bottom-right', 'bottom-left', 'top-right', 'top-left', 'top-center', 'bottom-center'] as $p)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $p }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sound', 'timeout', 'stacked', 'hover-expand'] as $f)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $f }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.basic_usage_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.basic_usage_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Basic Toast Types">
                    <vibe:preview.code>
@verbatim
{{-- 1. Info Toast --}}
<vibe:button variant="info" size="sm" onclick="vibeToast({
    type: 'info',
    title: 'Pemberitahuan Sistem',
    message: 'Sinkronisasi data cloud sedang berjalan di latar belakang.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="16" x2="12" y2="12" />
        <line x1="12" y1="8" x2="12.01" y2="8" />
    </svg>
    Info Toast
</vibe:button>

{{-- 2. Success Toast --}}
<vibe:button variant="success" size="sm" onclick="vibeToast({
    type: 'success',
    title: 'Berhasil Disimpan',
    message: 'Perubahan pada profil pengguna telah berhasil disimpan.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
        <polyline points="22 4 12 14.01 9 11.01" />
    </svg>
    Success Toast
</vibe:button>

{{-- 3. Warning Toast --}}
<vibe:button variant="warning" size="sm" onclick="vibeToast({
    type: 'warning',
    title: 'Peringatan Kapasitas',
    message: 'Kapasitas penyimpanan server Anda saat ini tersisa 15%.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
        <line x1="12" y1="9" x2="12" y2="13" />
        <line x1="12" y1="17" x2="12.01" y2="17" />
    </svg>
    Warning Toast
</vibe:button>

{{-- 4. Error Toast --}}
<vibe:button variant="destructive" size="sm" onclick="vibeToast({
    type: 'error',
    title: 'Gagal Memproses',
    message: 'Terjadi kesalahan saat mengunggah berkas ke server.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="15" y1="9" x2="9" y2="15" />
        <line x1="9" y1="9" x2="15" y2="15" />
    </svg>
    Error Toast
</vibe:button>
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="info" size="sm" onclick="vibeToast({
                                type: 'info',
                                title: 'Pemberitahuan Sistem',
                                message: 'Sinkronisasi data cloud sedang berjalan di latar belakang.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                            </svg>
                            Info Toast
                        </vibe:button>

                        <vibe:button variant="success" size="sm" onclick="vibeToast({
                                type: 'success',
                                title: 'Berhasil Disimpan',
                                message: 'Perubahan pada profil pengguna telah berhasil disimpan.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            Success Toast
                        </vibe:button>

                        <vibe:button variant="warning" size="sm" onclick="vibeToast({
                                type: 'warning',
                                title: 'Peringatan Kapasitas',
                                message: 'Kapasitas penyimpanan server Anda saat ini tersisa 15%.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <line x1="12" y1="9" x2="12" y2="13" />
                                <line x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                            Warning Toast
                        </vibe:button>

                        <vibe:button variant="destructive" size="sm" onclick="vibeToast({
                                type: 'error',
                                title: 'Gagal Memproses',
                                message: 'Terjadi kesalahan saat mengunggah berkas ke server.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="15" y1="9" x2="9" y2="15" />
                                <line x1="9" y1="9" x2="15" y2="15" />
                            </svg>
                            Error Toast
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Stacked & Hover Interaction --}}
            <section id="penumpukan-berlapis" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.stacked_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.stacked_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Stacked Toasts & Hover Interaction">
                    <vibe:preview.code>
@verbatim
{{-- Memicu beberapa toast berturut-turut untuk melihat tumpukan bertingkat --}}
<vibe:button variant="primary" onclick="
    vibeToast({ type: 'info', title: 'Notifikasi 1', message: 'Tugas pertama mulai diproses.' });
    setTimeout(() => vibeToast({ type: 'warning', title: 'Notifikasi 2', message: 'Memeriksa berkas dependensi...' }), 200);
    setTimeout(() => vibeToast({ type: 'success', title: 'Notifikasi 3', message: 'Seluruh proses selesai dengan sukses!' }), 400);
">
    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect width="18" height="18" x="3" y="3" rx="2" />
        <path d="M3 9h18" />
        <path d="M9 21V9" />
    </svg>
    Uji Tumpukan Toast (Stacked Demo)
</vibe:button>
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <vibe:button variant="primary" onclick="
                            vibeToast({ type: 'info', title: 'Notifikasi 1', message: 'Tugas pertama mulai diproses.' });
                            setTimeout(() => vibeToast({ type: 'warning', title: 'Notifikasi 2', message: 'Memeriksa berkas dependensi...' }), 200);
                            setTimeout(() => vibeToast({ type: 'success', title: 'Notifikasi 3', message: 'Seluruh proses selesai dengan sukses!' }), 400);
                        ">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2" />
                                <path d="M3 9h18" />
                                <path d="M9 21V9" />
                            </svg>
                            Uji Tumpukan Toast (Stacked Demo)
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Placement Positions --}}
            <section id="pilihan-posisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.positions_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.positions_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Toast Placement Positions">
                    <vibe:preview.code>
@verbatim
{{-- Pilihan Posisi Toast --}}
vibeToast({ position: 'top-right', type: 'info', message: 'Toast di sudut kanan atas.' });
vibeToast({ position: 'top-center', type: 'info', message: 'Toast di bagian tengah atas.' });
vibeToast({ position: 'top-left', type: 'info', message: 'Toast di sudut kiri atas.' });
vibeToast({ position: 'bottom-right', type: 'info', message: 'Toast di sudut kanan bawah (default).' });
vibeToast({ position: 'bottom-center', type: 'info', message: 'Toast di bagian tengah bawah.' });
vibeToast({ position: 'bottom-left', type: 'info', message: 'Toast di sudut kiri bawah.' });
@endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto grid grid-cols-3 gap-2">
                        <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: 'top-left', type: 'info', title: 'Top Left', message: 'Toast berada di sudut kiri atas layar.' })">
                            Top Left
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: 'top-center', type: 'info', title: 'Top Center', message: 'Toast berada di bagian tengah atas layar.' })">
                            Top Center
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: 'top-right', type: 'info', title: 'Top Right', message: 'Toast berada di sudut kanan atas layar.' })">
                            Top Right
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: 'bottom-left', type: 'info', title: 'Bottom Left', message: 'Toast berada di sudut kiri bawah layar.' })">
                            Bottom Left
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: 'bottom-center', type: 'info', title: 'Bottom Center', message: 'Toast berada di bagian tengah bawah layar.' })">
                            Bottom Center
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeToast({ position: 'bottom-right', type: 'info', title: 'Bottom Right', message: 'Toast berada di sudut kanan bawah layar.' })">
                            Bottom Right
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Sound & Duration Control --}}
            <section id="audio-dan-durasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.sound_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.sound_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Toast Audio Feedback & Duration">
                    <vibe:preview.code>
@verbatim
{{-- 1. Toast dengan Nada Suara Sintesis --}}
<vibe:button variant="outline" onclick="vibeToast({
    type: 'success',
    title: 'Audio Beep Berhasil',
    message: 'Nada audio dihasilkan via Web Audio API browser secara instan.',
    sound: true
})">
    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" />
        <path d="M15.54 8.46a5 5 0 0 1 0 7.07" />
        <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
    </svg>
    Uji Efek Suara (Sound: true)
</vibe:button>

{{-- 2. Toast Persisten (Tanpa Auto-dismiss) --}}
<vibe:button variant="outline" onclick="vibeToast({
    type: 'warning',
    title: 'Pemberitahuan Persisten',
    message: 'Toast ini memiliki timeout: false dan tetap tampil hingga tombol close diklik.',
    timeout: false
})">
    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="10" y1="15" x2="10" y2="9" />
        <line x1="14" y1="15" x2="14" y2="9" />
    </svg>
    Toast Persisten (timeout: false)
</vibe:button>

{{-- 3. Durasi Kustom (6 Detik) --}}
<vibe:button variant="outline" onclick="vibeToast({
    type: 'info',
    title: 'Durasi Panjang',
    message: 'Toast ini tampil selama 6000 milidetik (6 detik).',
    timeout: 6000
})">
    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <polyline points="12 6 12 12 16 14" />
    </svg>
    Durasi Kustom (6 Detik)
</vibe:button>
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="outline" onclick="vibeToast({
                                type: 'success',
                                title: 'Audio Beep Berhasil',
                                message: 'Nada audio dihasilkan via Web Audio API browser secara instan.',
                                sound: true
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5" />
                                <path d="M15.54 8.46a5 5 0 0 1 0 7.07" />
                                <path d="M19.07 4.93a10 10 0 0 1 0 14.14" />
                            </svg>
                            Uji Efek Suara (Sound: true)
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeToast({
                                type: 'warning',
                                title: 'Pemberitahuan Persisten',
                                message: 'Toast ini memiliki timeout: false dan tetap tampil hingga tombol close diklik.',
                                timeout: false
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="10" y1="15" x2="10" y2="9" />
                                <line x1="14" y1="15" x2="14" y2="9" />
                            </svg>
                            Toast Persisten (timeout: false)
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeToast({
                                type: 'info',
                                title: 'Durasi Panjang',
                                message: 'Toast ini tampil selama 6000 milidetik (6 detik).',
                                timeout: 6000
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Durasi Kustom (6 Detik)
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Trigger Methods --}}
            <section id="metode-pemanggilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.integration_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.integration_desc') !!}
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
                        <p class="text-xs text-muted-foreground">Panggil fungsi global dari script murni, handler klik, atau asynchronous fetch.</p>
                        <vibe:highlightjs language="javascript" :lineNumbers="false" :code="$jsHelperSnippet" />
                    </div>

                    {{-- 2. Alpine.js Dispatch --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">2</span>
                            <span class="text-sm font-semibold text-foreground">Alpine.js $dispatch</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Gunakan event Alpine.js dari dalam template Blade secara deklaratif.</p>
                        <vibe:highlightjs language="html" :lineNumbers="false" :code="$alpineSnippet" />
                    </div>

                    {{-- 3. Laravel Flash Session --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">3</span>
                            <span class="text-sm font-semibold text-foreground">Laravel Flash Session</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Kirim flash session dari Controller setelah aksi redirect (otomatis tampil pada page reload).</p>
                        <vibe:highlightjs language="php" :lineNumbers="false" :code="$laravelSnippet" />
                    </div>

                    {{-- 4. Livewire Event Dispatch --}}
                    <div class="space-y-2 p-4 rounded-xl border border-border bg-card">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">4</span>
                            <span class="text-sm font-semibold text-foreground">Livewire Component</span>
                        </div>
                        <p class="text-xs text-muted-foreground">Pancarkan event dari method PHP Livewire tanpa reload halaman.</p>
                        <vibe:highlightjs language="php" :lineNumbers="false" :code="$livewireSnippet" />
                    </div>
                </div>
            </section>

            {{-- 6. Props & Payload Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/toast.props_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/toast.props_desc') !!}
                    </p>
                </div>

                {{-- Container Props --}}
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:toast&gt; (Container Tag Props)</p>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.table_prop') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.table_type') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.table_default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/toast.table_desc') }}</th>
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
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.table_prop') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.table_type') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/toast.table_default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/toast.table_desc') }}</th>
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
