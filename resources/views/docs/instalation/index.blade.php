<x-docs.layouts.sidebar>
    <vibe:seo title="Instalasi" description="Panduan instalasi dan integrasi Vibe UI di proyek Laravel dengan Tailwind CSS v4." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Installation', 'url' => '/docs/instalation']
    ]" />

    <div class="mx-auto max-w-6xl space-y-10">
        <!-- Page Header -->
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-vibe-200 dark:bg-vibe-800 text-vibe-800 dark:text-vibe-200">
                    Dokumentasi
                </span>
                <span class="text-xs text-vibe-500 dark:text-vibe-400">Laravel 11+ / 12+ / 13+ & Tailwind CSS v4</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-vibe-950 dark:text-vibe-50">
                Instalasi Vibe UI
            </h1>
            <p class="text-base text-vibe-600 dark:text-vibe-400 leading-relaxed">
                Pelajari cara menginstal dan mengintegrasikan Vibe UI ke dalam aplikasi Laravel Anda untuk mempercepat pengembangan antarmuka yang modern dan elegan.
            </p>
        </div>

        <!-- Step 1: Install Package -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-vibe-950 dark:bg-vibe-50 text-white dark:text-vibe-950 text-xs font-bold shrink-0">
                    1
                </div>
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Instalasi Package via Composer
                </h2>
            </div>
            <p class="text-sm text-vibe-600 dark:text-vibe-400">
                Jalankan perintah Composer di terminal untuk menambahkan library Vibe UI ke dalam proyek Anda:
            </p>
            <vibe:highlightjs language="bash" title="Terminal" code="composer require teknovate/vibe-ui" />
        </section>

        <!-- Step 2: Publish Assets & Config -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-vibe-950 dark:bg-vibe-50 text-white dark:text-vibe-950 text-xs font-bold shrink-0">
                    2
                </div>
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Publikasikan Aset & Konfigurasi
                </h2>
            </div>
            <p class="text-sm text-vibe-600 dark:text-vibe-400">
                Gunakan perintah Artisan bawaan Vibe UI untuk mempublikasikan konfigurasi, CSS custom variants, dan skrip pendukung:
            </p>
            <vibe:highlightjs>
                php artisan vibe:install
            </vibe:highlightjs>
        </section>

        <!-- Step 3: Configure Tailwind CSS -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-vibe-950 dark:bg-vibe-50 text-white dark:text-vibe-950 text-xs font-bold shrink-0">
                    3
                </div>
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Konfigurasi Tailwind CSS v4
                </h2>
            </div>
            <p class="text-sm text-vibe-600 dark:text-vibe-400">
                Pastikan file CSS utama Anda mengimpor Tailwind CSS dan custom variant Vibe UI:
            </p>
            <vibe:highlightjs language="css" title="resources/css/app.css" :lineNumbers="true">
                @import "tailwindcss";
                @import "./vibe/custom-variant.css";
            </vibe:highlightjs>
        </section>

        <!-- Step 4: Setup Base Layout -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-vibe-950 dark:bg-vibe-50 text-white dark:text-vibe-950 text-xs font-bold shrink-0">
                    4
                </div>
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Konfigurasi Template Layout Dasar
                </h2>
            </div>
            <p class="text-sm text-vibe-600 dark:text-vibe-400">
                Sertakan direktif <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">@vibeStyles</code> pada bagian <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">&lt;head&gt;</code> untuk inisialisasi tema dark mode anti-FOUC:
            </p>
            @php
                $baseLayoutCode = <<<'HTML'
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('seo')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vibeStyles
    @livewireStyles
    @stack('head')
</head>

<body class="bg-vibe-50 dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 vibe-scrollbar font-medium font-sans antialiased">
    {{ $slot }}

    <vibe:alert position="top-right" />
    <vibe:toast position="top-right" />
    @livewireScripts
    @stack('body')
</body>

</html>
HTML;
            @endphp
            <vibe:highlightjs language="html" title="resources/views/components/layouts/base.blade.php" :lineNumbers="true" :code="$baseLayoutCode" />
        </section>

        <!-- Step 5: Ready to Use Components -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="flex size-7 items-center justify-center rounded-lg bg-vibe-950 dark:bg-vibe-50 text-white dark:text-vibe-950 text-xs font-bold shrink-0">
                    5
                </div>
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Mulai Menggunakan Komponen
                </h2>
            </div>
            <p class="text-sm text-vibe-600 dark:text-vibe-400">
                Panggil komponen Vibe UI menggunakan sintaks tag ringkas <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">&lt;vibe:...&gt;</code> langsung di dalam file Blade Anda:
            </p>
            @php
                $componentsExampleCode = <<<'HTML'
<div class="p-6 space-y-4">
    <!-- Tombol Primer -->
    <vibe:button variant="primary">
        Simpan Data
    </vibe:button>

    <!-- Tombol Outline -->
    <vibe:button variant="outline">
        Batal
    </vibe:button>

    <!-- Syntax Highlighter -->
    <vibe:highlightjs language="php" title="Controller.php">
        public function index()
        {
            return view('dashboard');
        }
    </vibe:highlightjs>
</div>
HTML;
            @endphp
            <vibe:highlightjs language="html" title="resources/views/example.blade.php" :lineNumbers="true" :code="$componentsExampleCode" />
        </section>
    </div>
</x-docs.layouts.sidebar>
