<x-docs.layouts.sidebar>
    <vibe:seo title="Struktur Direktori" description="Panduan struktur direktori dan arsitektur file Vibe UI pada aplikasi Laravel." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Directories', 'url' => '/docs/directories']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Page Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
                        Dokumentasi
                    </span>
                    <span class="text-xs text-muted-foreground">Arsitektur & Penataan File</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">
                    Struktur Direktori
                </h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Pelajari penataan folder dan arsitektur file Vibe UI dalam proyek Laravel untuk memudahkan kustomisasi komponen Blade, styling Tailwind CSS v4, aset JavaScript, dan lokalisasi multi-bahasa.
                </p>
            </div>

            {{-- ─── 1. Ringkasan Pohon Direktori ─── --}}
            <section id="ringkasan-struktur" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Ringkasan Struktur Folder</h2>
                    <p class="text-sm text-muted-foreground">
                        Setelah menjalankan perintah instalasi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">php artisan vibe:install</code>, file dan aset Vibe UI akan terpasang di lokasi berikut:
                    </p>
                </div>

                @php
                    $directoryTree = <<<'TEXT'
vibe-project/
├── config/
│   └── vibe.php                      # Konfigurasi utama Vibe UI (prefix, tema, dll.)
├── lang/
│   ├── en/
│   │   └── vibe/                     # File terjemahan komponen (English)
│   └── id/
│       └── vibe/                     # File terjemahan komponen (Bahasa Indonesia)
├── resources/
│   ├── css/
│   │   └── vibe/
│   │       ├── app.css               # Token warna semantik, radius, & dark mode
│   │       ├── custom-variant.css    # Custom variant Tailwind CSS v4 (select:, minified:, dll.)
│   │       └── highlightjs.css       # Tema Syntax Highlighter bawaan
│   ├── js/
│   │   └── vibe/
│   │       ├── highlightjs.js        # Helper renderer sintaks Highlight.js
│   │       └── theme.js              # Theme manager (Dark / Light mode switcher)
│   └── views/
│       └── vibe/                     # Seluruh template komponen Blade Vibe UI
│           ├── alert/                # Komponen Notifikasi Alert
│           ├── avatar/               # Komponen Gambar Avatar Pengguna
│           ├── button/               # Komponen Tombol Interaktif
│           ├── card/                 # Komponen Kartu Konten
│           ├── datatable/            # Komponen Tabel Dinamis & Filter
│           ├── dropdown/             # Komponen Menu Dropdown
│           ├── header/               # Komponen Header & Navbar
│           ├── highlightjs/          # Komponen Codeblock Highlighter
│           ├── input/                # Komponen Input & Form Controls
│           ├── modal/                # Komponen Dialog Modal
│           ├── nav/                  # Komponen Navigasi, Pinned, & History
│           ├── pagination/           # Komponen Navigasi Halaman
│           ├── preview/              # Komponen Interactive Code Previewer
│           ├── seo/                  # Komponen Meta Tags & Schema SEO
│           ├── sheet/                # Komponen Drawer / Sidebar Sheet
│           ├── toast/                # Komponen Flash Toast Notification
│           └── toc/                  # Komponen Table of Contents Otomatis
└── routes/
    └── docs.php                      # File routing modular aplikasi
TEXT;
                @endphp

                <vibe:highlightjs language="plaintext" title="Struktur Direktori Vibe UI" :code="$directoryTree" />
            </section>

            {{-- ─── 2. Komponen Blade ─── --}}
            <section id="komponen-blade" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Komponen Blade (<code class="font-mono text-base text-foreground">resources/views/vibe/</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Semua komponen Vibe UI dibangun menggunakan Blade View standar. Setelah di-publish, Anda memiliki kendali 100% untuk memodifikasi struktur HTML, styling Tailwind CSS, atau interaksi Alpine.js langsung dari folder ini.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">views/vibe/</span>
                            <span class="text-sm font-semibold text-foreground">Struktur Komponen</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Tiap komponen memiliki subfolder tersendiri (misal: <code class="font-mono text-foreground">vibe/input/</code>, <code class="font-mono text-foreground">vibe/sheet/</code>). File <code class="font-mono text-foreground">index.blade.php</code> berfungsi sebagai entry point utama komponen.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary font-mono text-xs font-bold">@@props([...])</span>
                            <span class="text-sm font-semibold text-foreground">Konfigurasi Prop Bersih</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Seluruh properti dan nilai default dideklarasikan secara ringkas melalui direktif <code class="font-mono text-foreground">@@props</code>, termasuk string terjemahan bahasa dinamis bawaan.
                        </p>
                    </div>
                </div>
            </section>

            {{-- ─── 3. Styling & Token CSS ─── --}}
            <section id="styling-css" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Styling & Token CSS (<code class="font-mono text-base text-foreground">resources/css/vibe/</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Folder ini mengelola seluruh token Design System Vibe UI berbasis Tailwind CSS v4:
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">File CSS</th>
                                <th class="px-4 py-3">Fungsi & Kegunaan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">app.css</td>
                                <td class="px-4 py-3">Mendefinisikan variabel warna CSS (<code class="font-mono text-foreground">--background</code>, <code class="font-mono text-foreground">--primary</code>, dll.), radius (<code class="font-mono text-foreground">--radius-*</code>), dan skema dark mode.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">custom-variant.css</td>
                                <td class="px-4 py-3">Mendaftarkan variant kustom Tailwind CSS v4 seperti <code class="font-mono text-foreground">select:</code> (untuk item aktif), <code class="font-mono text-foreground">minified:</code>, dan state sheet/sidebar.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">highlightjs.css</td>
                                <td class="px-4 py-3">Tema pewarnaan sintaks codeblock bawaan yang otomatis beradaptasi dengan mode terang dan gelap.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- ─── 4. Skrip JavaScript ─── --}}
            <section id="aset-javascript" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Aset JavaScript (<code class="font-mono text-base text-foreground">resources/js/vibe/</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Vibe UI mengedepankan performa tinggi tanpa framework JS berat. Skrip pendukung diorganisasi secara modular:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-muted text-foreground font-mono text-xs font-bold">theme.js</span>
                            <span class="text-sm font-semibold text-foreground">Theme Manager</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Mengelola pergantian Dark/Light mode secara instan, menyinkronkan dengan preferensi sistem operasi, dan menyimpan status tema di LocalStorage tanpa FOUC (*Flash of Unstyled Content*).
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-muted text-foreground font-mono text-xs font-bold">highlightjs.js</span>
                            <span class="text-sm font-semibold text-foreground">Syntax Highlighter</span>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Inisialisasi ringan untuk komponen <code class="font-mono text-foreground">&lt;vibe:highlightjs&gt;</code> dan <code class="font-mono text-foreground">&lt;vibe:preview&gt;</code> dengan fitur copy code dan auto-detect bahasa.
                        </p>
                    </div>
                </div>
            </section>

            {{-- ─── 5. Multi-Bahasa ─── --}}
            <section id="bahasa-dan-terjemahan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Bahasa & Terjemahan (<code class="font-mono text-base text-foreground">lang/{locale}/vibe/</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Seluruh label dan teks UI pada komponen Vibe UI mendukung multi-bahasa secara native melalui sistem terjemahan Laravel:
                    </p>
                </div>

                <div class="p-4 rounded-xl border border-border bg-card text-card-foreground space-y-3">
                    <p class="text-xs text-muted-foreground">
                        Struktur file bahasa dipecah per komponen sehingga sangat rapi dan mudah dimodifikasi:
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
                    <h2 class="text-xl font-bold text-foreground">5. File Konfigurasi (<code class="font-mono text-base text-foreground">config/vibe.php</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        File konfigurasi utama untuk mengatur perilaku global Vibe UI dalam aplikasi Anda:
                    </p>
                </div>

                @php
                    $configSnippet = <<<'PHP'
return [
    /*
    |--------------------------------------------------------------------------
    | Component Tag Prefix
    |--------------------------------------------------------------------------
    | Prefix yang digunakan untuk memanggil komponen Blade.
    | Default 'vibe' menghasilkan tag: <vibe:button>, <vibe:input>, dll.
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
