<?php

return [
    'title' => 'Struktur Direktori',
    'badge' => 'Dokumentasi',
    'subtitle' => 'Arsitektur & Penataan File',
    'description' => 'Pelajari penataan folder dan arsitektur file Vibe UI dalam proyek Laravel untuk memudahkan kustomisasi komponen Blade, styling Tailwind CSS v4, aset JavaScript, dan lokalisasi multi-bahasa.',

    // Section 1: Overview
    'overview' => [
        'title' => 'Ringkasan Struktur Folder',
        'desc' => 'Setelah menjalankan perintah instalasi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">php artisan vibe:install</code>, file dan aset Vibe UI akan terpasang di lokasi berikut:',
        'tree_title' => 'Struktur Direktori Vibe UI',
        'tree_comments' => [
            'config' => 'Konfigurasi utama Vibe UI (prefix, tema, dll.)',
            'lang_en' => 'File terjemahan komponen (English)',
            'lang_id' => 'File terjemahan komponen (Bahasa Indonesia)',
            'css_app' => 'Token warna semantik, radius, & dark mode',
            'css_variant' => 'Custom variant Tailwind CSS v4 (select:, minified:, dll.)',
            'css_highlight' => 'Tema Syntax Highlighter bawaan',
            'js_highlight' => 'Helper renderer sintaks Highlight.js',
            'js_theme' => 'Theme manager (Dark / Light mode switcher)',
            'views' => 'Seluruh template komponen Blade Vibe UI',
            'routes' => 'File routing modular aplikasi',
        ],
    ],

    // Section 2: Blade Views
    'blade_views' => [
        'title' => '1. Komponen Blade (resources/views/vibe/)',
        'desc' => 'Semua komponen Vibe UI dibangun menggunakan Blade View standar. Setelah di-publish, Anda memiliki kendali 100% untuk memodifikasi struktur HTML, styling Tailwind CSS, atau interaksi Alpine.js langsung dari folder ini.',
        'structure_card' => [
            'title' => 'Struktur Komponen',
            'desc' => 'Tiap komponen memiliki subfolder tersendiri (misal: <code class="font-mono text-foreground">vibe/input/</code>, <code class="font-mono text-foreground">vibe/sheet/</code>). File <code class="font-mono text-foreground">index.blade.php</code> berfungsi sebagai entry point utama komponen.',
        ],
        'props_card' => [
            'title' => 'Konfigurasi Prop Bersih',
            'desc' => 'Seluruh properti dan nilai default dideklarasikan secara ringkas melalui direktif <code class="font-mono text-foreground">@props</code>, termasuk string terjemahan bahasa dinamis bawaan.',
        ],
    ],

    // Section 3: CSS Styling
    'css_styling' => [
        'title' => '2. Styling & Token CSS (resources/css/vibe/)',
        'desc' => 'Folder ini mengelola seluruh token Design System Vibe UI berbasis Tailwind CSS v4:',
        'columns' => [
            'file' => 'File CSS',
            'desc' => 'Fungsi & Kegunaan',
        ],
        'rows' => [
            'app' => 'Mendefinisikan variabel warna CSS (<code class="font-mono text-foreground">--background</code>, <code class="font-mono text-foreground">--primary</code>, dll.), radius (<code class="font-mono text-foreground">--radius-*</code>), dan skema dark mode.',
            'variant' => 'Mendaftarkan variant kustom Tailwind CSS v4 seperti <code class="font-mono text-foreground">select:</code> (untuk item aktif), <code class="font-mono text-foreground">minified:</code>, dan state sheet/sidebar.',
            'highlight' => 'Tema pewarnaan sintaks codeblock bawaan yang otomatis beradaptasi dengan mode terang dan gelap.',
        ],
    ],

    // Section 4: JavaScript Assets
    'js_assets' => [
        'title' => '3. Aset JavaScript (resources/js/vibe/)',
        'desc' => 'Vibe UI mengedepankan performa tinggi tanpa framework JS berat. Skrip pendukung diorganisasi secara modular:',
        'theme_card' => [
            'title' => 'Theme Manager',
            'desc' => 'Mengelola pergantian Dark/Light mode secara instan, menyinkronkan dengan preferensi sistem operasi, dan menyimpan status tema di LocalStorage tanpa FOUC (<i>Flash of Unstyled Content</i>).',
        ],
        'highlight_card' => [
            'title' => 'Syntax Highlighter',
            'desc' => 'Inisialisasi ringan untuk komponen <code class="font-mono text-foreground">&lt;vibe:highlightjs&gt;</code> dan <code class="font-mono text-foreground">&lt;vibe:preview&gt;</code> dengan fitur copy code dan auto-detect bahasa.',
        ],
    ],

    // Section 5: Localization
    'localization' => [
        'title' => '4. Bahasa & Terjemahan (lang/{locale}/vibe/)',
        'desc' => 'Seluruh label dan teks UI pada komponen Vibe UI mendukung multi-bahasa secara native melalui sistem terjemahan Laravel:',
        'card_desc' => 'Struktur file bahasa dipecah per komponen sehingga sangat rapi dan mudah dimodifikasi:',
    ],

    // Section 6: Configuration
    'config' => [
        'title' => '5. File Konfigurasi (config/vibe.php)',
        'desc' => 'File konfigurasi utama untuk mengatur perilaku global Vibe UI dalam aplikasi Anda:',
    ],
];
