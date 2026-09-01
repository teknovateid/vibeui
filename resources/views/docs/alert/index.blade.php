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
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/alert.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/alert.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/alert.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/alert.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['success', 'error', 'warning', 'info', 'confirm'] as $t)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $t }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['center', 'top-right', 'top-left', 'bottom-right', 'bottom-left', 'top-center', 'bottom-center'] as $p)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $p }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['blocking', 'sound', 'timeout', 'buttonLayout'] as $f)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $f }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.basic_usage_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.basic_usage_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Basic Alert Types">
                    <vibe:preview.code>
@verbatim
{{-- 1. Info Alert --}}
<vibe:button variant="info" size="sm" onclick="vibeAlert({
    type: 'info',
    title: 'Informasi Sistem',
    message: 'Pembaruan data selesai dilakukan secara otomatis.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="12" y1="16" x2="12" y2="12" />
        <line x1="12" y1="8" x2="12.01" y2="8" />
    </svg>
    Info Alert
</vibe:button>

{{-- 2. Success Alert --}}
<vibe:button variant="success" size="sm" onclick="vibeAlert({
    type: 'success',
    title: 'Transaksi Sukses',
    message: 'Pesanan #VB-9821 telah berhasil diverifikasi dan diproses.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
        <polyline points="22 4 12 14.01 9 11.01" />
    </svg>
    Success Alert
</vibe:button>

{{-- 3. Warning Alert --}}
<vibe:button variant="warning" size="sm" onclick="vibeAlert({
    type: 'warning',
    title: 'Peringatan Kapasitas',
    message: 'Kapasitas penyimpanan server Anda saat ini tersisa 15%.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
        <line x1="12" y1="9" x2="12" y2="13" />
        <line x1="12" y1="17" x2="12.01" y2="17" />
    </svg>
    Warning Alert
</vibe:button>

{{-- 4. Error Alert --}}
<vibe:button variant="destructive" size="sm" onclick="vibeAlert({
    type: 'error',
    title: 'Terjadi Kesalahan',
    message: 'Gagal terhubung ke database. Silakan periksa koneksi Anda.'
})">
    <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10" />
        <line x1="15" y1="9" x2="9" y2="15" />
        <line x1="9" y1="9" x2="15" y2="15" />
    </svg>
    Error Alert
</vibe:button>
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="info" size="sm" onclick="vibeAlert({
                                type: 'info',
                                title: 'Informasi Sistem',
                                message: 'Pembaruan data selesai dilakukan secara otomatis.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                            </svg>
                            Info Alert
                        </vibe:button>

                        <vibe:button variant="success" size="sm" onclick="vibeAlert({
                                type: 'success',
                                title: 'Transaksi Sukses',
                                message: 'Pesanan #VB-9821 telah berhasil diverifikasi dan diproses.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            Success Alert
                        </vibe:button>

                        <vibe:button variant="warning" size="sm" onclick="vibeAlert({
                                type: 'warning',
                                title: 'Peringatan Kapasitas',
                                message: 'Kapasitas penyimpanan server Anda saat ini tersisa 15%.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <line x1="12" y1="9" x2="12" y2="13" />
                                <line x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                            Warning Alert
                        </vibe:button>

                        <vibe:button variant="destructive" size="sm" onclick="vibeAlert({
                                type: 'error',
                                title: 'Terjadi Kesalahan',
                                message: 'Gagal terhubung ke database. Silakan periksa koneksi Anda.'
                            })">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="15" y1="9" x2="9" y2="15" />
                                <line x1="9" y1="9" x2="15" y2="15" />
                            </svg>
                            Error Alert
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Confirmation Dialog --}}
            <section id="dialog-konfirmasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.confirm_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.confirm_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Confirmation Modal Dialog">
                    <vibe:preview.code>
@verbatim
{{-- Destructive Confirm --}}
<vibe:button variant="destructive" onclick="vibeAlert({
    type: 'confirm',
    title: 'Hapus Akun Pengguna?',
    message: 'Semua data transaksi dan riwayat pengguna akan dihapus permanen dari server.',
    confirmButton: {
        text: 'Ya, Hapus Akun',
        class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
        action: () => {
            vibeAlert({
                type: 'success',
                title: 'Akun Dihapus',
                message: 'Akun pengguna telah dinonaktifkan secara permanen.'
            });
        }
    },
    closeButton: {
        text: 'Batal'
    }
})">
    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18" />
        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
        <line x1="10" y1="11" x2="10" y2="17" />
        <line x1="14" y1="11" x2="14" y2="17" />
    </svg>
    Hapus Akun (Destructive Confirm)
</vibe:button>

{{-- Standard Confirm --}}
<vibe:button variant="outline" onclick="vibeAlert({
    type: 'confirm',
    title: 'Publikasikan Artikel?',
    message: 'Artikel ini akan dapat diakses oleh publik di website resmi.',
    confirmButton: {
        text: 'Publikasikan Sekarang',
        action: () => {
            vibeAlert({
                type: 'success',
                title: 'Berhasil Dipublikasikan',
                message: 'Artikel Anda sudah aktif dan dapat dibaca publik.'
            });
        }
    },
    closeButton: {
        text: 'Simpan Draf'
    }
})">
    <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
        <polyline points="16 6 12 2 8 6" />
        <line x1="12" y1="2" x2="12" y2="15" />
    </svg>
    Publikasikan (Standard Confirm)
</vibe:button>
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <vibe:button variant="destructive" onclick="vibeAlert({
                                type: 'confirm',
                                title: 'Hapus Akun Pengguna?',
                                message: 'Semua data transaksi dan riwayat pengguna akan dihapus permanen dari server.',
                                confirmButton: {
                                    text: 'Ya, Hapus Akun',
                                    class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
                                    action: () => {
                                        vibeAlert({
                                            type: 'success',
                                            title: 'Akun Dihapus',
                                            message: 'Akun pengguna telah dinonaktifkan secara permanen.'
                                        });
                                    }
                                },
                                closeButton: {
                                    text: 'Batal'
                                }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                            </svg>
                            Hapus Akun (Destructive Confirm)
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeAlert({
                                type: 'confirm',
                                title: 'Publikasikan Artikel?',
                                message: 'Artikel ini akan dapat diakses oleh publik di website resmi.',
                                confirmButton: {
                                    text: 'Publikasikan Sekarang',
                                    action: () => {
                                        vibeAlert({
                                            type: 'success',
                                            title: 'Berhasil Dipublikasikan',
                                            message: 'Artikel Anda sudah aktif dan dapat dibaca publik.'
                                        });
                                    }
                                },
                                closeButton: {
                                    text: 'Simpan Draf'
                                }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                <polyline points="16 6 12 2 8 6" />
                                <line x1="12" y1="2" x2="12" y2="15" />
                            </svg>
                            Publikasikan (Standard Confirm)
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Positions --}}
            <section id="pilihan-posisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.positions_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.positions_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Alert Placement Positions">
                    <vibe:preview.code>
@verbatim
{{-- Pilihan Posisi Alert --}}
vibeAlert({ position: 'top-right', type: 'info', message: 'Muncul di pojok kanan atas.' });
vibeAlert({ position: 'top-center', type: 'info', message: 'Muncul di bagian tengah atas.' });
vibeAlert({ position: 'top-left', type: 'info', message: 'Muncul di pojok kiri atas.' });
vibeAlert({ position: 'center', type: 'info', message: 'Muncul di tengah layar (default).' });
vibeAlert({ position: 'bottom-right', type: 'info', message: 'Muncul di pojok kanan bawah.' });
vibeAlert({ position: 'bottom-center', type: 'info', message: 'Muncul di bagian tengah bawah.' });
vibeAlert({ position: 'bottom-left', type: 'info', message: 'Muncul di pojok kiri bawah.' });
@endverbatim
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto grid grid-cols-3 gap-2">
                        <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: 'top-left', type: 'info', title: 'Top Left', message: 'Alert berada di sudut kiri atas layar.' })">
                            Top Left
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: 'top-center', type: 'info', title: 'Top Center', message: 'Alert berada di bagian tengah atas layar.' })">
                            Top Center
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: 'top-right', type: 'info', title: 'Top Right', message: 'Alert berada di sudut kanan atas layar.' })">
                            Top Right
                        </vibe:button>

                        <div></div>

                        <vibe:button size="sm" variant="primary" onclick="vibeAlert({ position: 'center', type: 'info', title: 'Center', message: 'Alert berada di tengah layar secara terpusat.' })">
                            Center
                        </vibe:button>

                        <div></div>

                        <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: 'bottom-left', type: 'info', title: 'Bottom Left', message: 'Alert berada di sudut kiri bawah layar.' })">
                            Bottom Left
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: 'bottom-center', type: 'info', title: 'Bottom Center', message: 'Alert berada di bagian tengah bawah layar.' })">
                            Bottom Center
                        </vibe:button>

                        <vibe:button size="sm" variant="outline" onclick="vibeAlert({ position: 'bottom-right', type: 'info', title: 'Bottom Right', message: 'Alert berada di sudut kanan bawah layar.' })">
                            Bottom Right
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Custom Buttons & Layout --}}
            <section id="kustomisasi-tombol" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.buttons_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.buttons_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Button Layouts & Styling">
                    <vibe:preview.code>
@verbatim
{{-- 1. Tata Letak Tombol Bertumpuk Vertikal (Column) --}}
vibeAlert({
    type: 'info',
    title: 'Tingkatkan Paket Langganan',
    message: 'Dapatkan akses tak terbatas ke semua template dan komponen premium.',
    buttonLayout: 'col',
    confirmButton: {
        text: 'Upgrade ke Paket Pro ($19/bln)',
        class: 'bg-primary text-primary-foreground hover:bg-primary/90'
    },
    closeButton: {
        text: 'Lanjutkan dengan Paket Gratis',
        class: 'border-transparent bg-transparent hover:bg-muted text-muted-foreground shadow-none'
    }
});

{{-- 2. Tata Letak Tombol Berdampingan (Row) --}}
vibeAlert({
    type: 'warning',
    title: 'Simpan Perubahan?',
    message: 'Terdapat perubahan dokumen yang belum tersimpan di server.',
    buttonLayout: 'row',
    confirmButton: { text: 'Simpan Dokumen' },
    closeButton: { text: 'Abaikan' }
});
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'info',
                                title: 'Tingkatkan Paket Langganan',
                                message: 'Dapatkan akses tak terbatas ke seluruh koleksi komponen, layout, dan template premium Vibe UI.',
                                buttonLayout: 'col',
                                confirmButton: {
                                    text: 'Upgrade ke Paket Pro ($19/bln)',
                                    class: 'bg-primary text-primary-foreground hover:bg-primary/90 py-2 text-sm'
                                },
                                closeButton: {
                                    text: 'Lanjutkan dengan Paket Gratis',
                                    class: 'border-transparent bg-transparent hover:bg-muted text-muted-foreground shadow-none hover:underline text-xs'
                                }
                            })">
                            Tata Letak Tombol Column (Stacked)
                        </vibe:button>

                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'warning',
                                title: 'Simpan Perubahan?',
                                message: 'Terdapat perubahan formulir yang belum disimpan ke database.',
                                buttonLayout: 'row',
                                confirmButton: { text: 'Simpan Formulir' },
                                closeButton: { text: 'Abaikan' }
                            })">
                            Tata Letak Tombol Row (Side-by-side)
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Sound & Timeout --}}
            <section id="audio-dan-durasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.sound_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.sound_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Audio Feedback & Timeout Control">
                    <vibe:preview.code>
@verbatim
{{-- 1. Alert dengan Audio Sintesis Bawaan --}}
vibeAlert({
    type: 'success',
    title: 'Berhasil dengan Suara',
    message: 'Alert ini berbunyi menggunakan Web Audio API tanpa file tambahan.',
    sound: true
});

{{-- 2. Alert Persisten (Tanpa Auto-dismiss) --}}
vibeAlert({
    type: 'warning',
    title: 'Pemberitahuan Wajib Baca',
    message: 'Alert ini tidak akan tertutup otomatis sampai tombol diklik.',
    timeout: false,
    confirmButton: { text: 'Saya Mengerti' }
});

{{-- 3. Durasi Kustom (6 Detik) --}}
vibeAlert({
    type: 'info',
    title: 'Durasi Panjang',
    message: 'Alert ini tampil selama 6000 milidetik (6 detik).',
    timeout: 6000
});
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="outline" onclick="vibeAlert({
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

                        <vibe:button variant="outline" onclick="vibeAlert({
                                type: 'warning',
                                title: 'Peringatan Persisten',
                                message: 'Alert ini memiliki timeout: false dan hanya akan tertutup saat tombol diklik.',
                                timeout: false,
                                confirmButton: { text: 'Tutup Alert' }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            Alert Persisten (Timeout: false)
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Background Blur Options --}}
            <section id="background-blur" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.blur_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.blur_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Backdrop Blur Intensity Options">
                    <vibe:preview.code>
@verbatim
{{-- 1. Backdrop Blur Sedang (blur: 'md') --}}
vibeAlert({
    type: 'info',
    title: 'Backdrop Blur Sedang (MD)',
    message: 'Latar belakang diburamkan dengan efek blur sedang (backdrop-blur-md).',
    blur: 'md',
    timeout: 5000,
    confirmButton: { text: 'Tutup' }
});

{{-- 2. Backdrop Blur Kuat (blur: 'lg') --}}
vibeAlert({
    type: 'confirm',
    title: 'Backdrop Blur Kuat (LG)',
    message: 'Latar belakang diburamkan secara intensif untuk dialog konfirmasi penting.',
    blur: 'lg',
    confirmButton: { text: 'Lanjutkan' },
    closeButton: { text: 'Batal' }
});

{{-- 3. Tanpa Efek Blur (blur: false) --}}
vibeAlert({
    type: 'confirm',
    title: 'Tanpa Blur (None)',
    message: 'Backdrop overlay gelap standar tanpa filter blur.',
    blur: false,
    confirmButton: { text: 'Oke' },
    closeButton: { text: 'Batal' }
});
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'info',
                                title: 'Backdrop Blur Sedang (MD)',
                                message: 'Latar belakang diburamkan dengan efek blur sedang (backdrop-blur-md).',
                                blur: 'md',
                                timeout: 5000,
                                position:'center',
                                confirmButton: { text: 'Tutup' }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m4.93 4.93 4.24 4.24" />
                                <path d="m14.83 9.17 4.24-4.24" />
                                <path d="m14.83 14.83 4.24 4.24" />
                                <path d="m9.17 14.83-4.24 4.24" />
                            </svg>
                            Blur Sedang (blur: 'md')
                        </vibe:button>

                        <vibe:button variant="secondary" onclick="vibeAlert({
                                type: 'confirm',
                                title: 'Backdrop Blur Kuat (LG)',
                                message: 'Latar belakang diburamkan secara intensif untuk dialog konfirmasi penting.',
                                blur: 'lg',
                                confirmButton: { text: 'Lanjutkan' },
                                closeButton: { text: 'Batal' }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="4" />
                            </svg>
                            Blur Kuat (blur: 'lg')
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeAlert({
                                type: 'confirm',
                                title: 'Tanpa Blur (None)',
                                message: 'Backdrop overlay gelap standar tanpa filter blur.',
                                blur: false,
                                confirmButton: { text: 'Oke' },
                                closeButton: { text: 'Batal' }
                            })">
                            Tanpa Blur (blur: false)
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Persist Option --}}
            <section id="persistensi-alert" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.persist_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.persist_desc') !!}
                    </p>
                </div>

                <vibe:preview title="Alert Persistence & Don't Show Again">
                    <vibe:preview.code>
@verbatim
{{-- 1. Alert Pengumuman Sekali Tampil (Disimpan ke localStorage) --}}
vibeAlert({
    id: 'promo-ramadhan',
    persist: true,
    type: 'info',
    title: 'Promo Spesial Ramadhan',
    message: 'Gunakan voucher VIBE50 untuk potongan harga 50%. Jika ditutup, alert ini tidak akan muncul lagi.',
    confirmButton: { text: 'Klaim Promo' },
    closeButton: { text: 'Tutup' }
});

{{-- 2. Menggunakan Key String Langsung --}}
vibeAlert({
    persist: 'onboarding-tour-v2',
    type: 'success',
    title: 'Fitur Baru Tersedia!',
    message: 'Kini Anda dapat mengatur tema warna kustom langsung dari dashboard.'
});

{{-- 3. Reset Status Persist (Untuk Keperluan Testing) --}}
vibeAlert.reset('promo-ramadhan'); // Reset alert tertentu
vibeAlert.reset();                 // Reset seluruh alert
@endverbatim
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <vibe:button variant="secondary" onclick="vibeAlert({
                                id: 'demo-persist-banner',
                                persist: true,
                                type: 'info',
                                title: 'Pengumuman Penting (Persist)',
                                message: 'Status alert disimpan sebagai open di storage. Coba refresh halaman (F5), alert ini akan tetap tampil kembali sampai Anda menutupnya!',
                                timeout: false,
                                confirmButton: { text: 'Tutup Alert' }
                            })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Tampilkan Alert (Persist: true)
                        </vibe:button>

                        <vibe:button variant="outline" onclick="vibeAlert.reset('demo-persist-banner'); vibeAlert({ type: 'success', title: 'Status Direset!', message: 'Penyimpanan untuk demo-persist-banner telah dihapus. Silakan klik tombol pertama lagi.' })">
                            <svg class="size-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8" />
                                <path d="M21 3v5h-5" />
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16" />
                                <path d="M8 16H3v5" />
                            </svg>
                            Reset Status Persist
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Integration Methods --}}
            <section id="metode-pemanggilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.integration_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.integration_desc') !!}
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

                    {{-- Method 1: JavaScript vibeAlert --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">1. JavaScript Function (vibeAlert)</p>
                        <vibe:highlightjs language="javascript" title="app.js / script" :code="$jsSnippet" />
                    </div>

                    {{-- Method 2: Blade Directive (@vibeAlert) --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">2. Blade Directive (&#64;vibeAlert)</p>
                        <vibe:highlightjs language="html" title="resources/views/pages/dashboard.blade.php" :code="$bladeSnippet" />
                    </div>

                    {{-- Method 3: Livewire Component Dispatch --}}
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-muted-foreground mb-2">3. Livewire Component Event Dispatch</p>
                        <vibe:highlightjs language="php" title="app/Livewire/UserManager.php" :code="$livewireSnippet" />
                    </div>
                </div>
            </section>

            {{-- 7. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/alert.props_title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/alert.props_desc') !!}
                    </p>
                </div>

                {{-- Container Props --}}
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-foreground">&lt;vibe:alert&gt; (Container Tag Props)</p>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/alert.table_prop') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/alert.table_type') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/alert.table_default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/alert.table_desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border text-muted-foreground">
                                @php
                                    $containerProps = [['position', "'center'|'top-right'|'top-left'|'bottom-right'|'bottom-left'|'top-center'|'bottom-center'", "'center'", 'Posisi penempatan default container notifikasi alert pada layar.'], ['align', "'start'|'center'|'end'", "'center'", 'Perataan konten teks dan ikon di dalam bodi alert.'], ['timeout', 'int|false', '3000', 'Waktu tunda auto-dismiss dalam milidetik (atau false untuk alert persisten).'], ['sound', 'bool|string', 'false', 'Memutar nada audio sintesis Web Audio API (true) atau file audio eksternal (string URL).'], ['blur', "'xs'|'sm'|'md'|'lg'|'xl'|bool", 'false', 'Efek blur backdrop latar belakang bawaan container (misal: "md", "lg", atau true).'], ['closeOnOutside', 'bool|null', 'null (auto)', 'Menutup alert saat menekan area di luar alert (default: true untuk alert biasa, false untuk confirm).']];
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
                    <p class="text-sm font-semibold text-foreground">vibeAlert(payload) & $dispatch('alert', payload)</p>
                    <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                                <tr>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/alert.table_prop') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/alert.table_type') }}</th>
                                    <th class="px-4 py-3 whitespace-nowrap">{{ __('docs/alert.table_default') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/alert.table_desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border text-muted-foreground">
                                @php
                                    $payloadParams = [['type', "'success'|'error'|'warning'|'info'|'confirm'", "'info'", 'Jenis status alert yang menentukan palet warna latar, border aksen, dan ikon otomatis.'], ['title', 'string', 'null', 'Judul utama notifikasi alert.'], ['message', 'string', '""', 'Pesan deskripsi lengkap yang ingin disampaikan kepada pengguna.'], ['icon', 'string (HTML/SVG)', 'null', 'Kustomisasi elemen SVG ikon untuk menggantikan ikon default status.'], ['position', 'string', 'Inherit', 'Menimpa posisi penempatan container khusus untuk alert ini.'], ['align', "'start'|'center'|'end'", 'Inherit', 'Menimpa perataan horizontal konten teks dan ikon khusus alert ini.'], ['timeout', 'int|false', 'Inherit (false for confirm)', 'Menimpa durasi auto-dismiss (false agar alert tetap terbuka hingga tombol ditekan).'], ['blocking', 'bool', 'false (true for confirm)', 'Menampilkan backdrop gelap (overlay) dengan efek blur di belakang alert.'], ['blur', "'xs'|'sm'|'md'|'lg'|'xl'|bool", 'Inherit (false)', 'Menampilkan backdrop dengan intensitas blur latar belakang tertentu ("sm", "md", "lg", "xl", true, false).'], ['sound', 'bool|string', 'false', 'Menimpa preferensi efek suara saat alert muncul.'], ['confirmButton', 'string|object', "{ text: 'Tutup' }", 'Konfigurasi tombol konfirmasi: teks string atau objek { text, action, class }.'], ['closeButton', 'string|object', "null ('Batal' for confirm)", 'Konfigurasi tombol penutup/batal: teks string atau objek { text, action, class }.'], ['buttonLayout', "'row'|'col'", 'null', 'Tata letak susunan tombol: "col" untuk bertumpuk vertikal atau "row" berdampingan.'], ['closeOnOutside', 'bool', 'true (false for confirm)', 'Menentukan apakah alert dapat ditutup saat pengguna menekan area di luar alert.'], ['id', 'string', 'null', 'ID unik alert. Wajib disertakan jika menggunakan opsi persist: true.'], ['persist', 'bool|string', 'false', 'Menyimpan status penutupan alert agar tidak muncul lagi: true, key string, atau "session".']];
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
