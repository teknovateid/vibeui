<?php

return [
    'title' => 'Struktur Direktori',
    'badge' => 'Dokumentasi',
    'subtitle' => 'Arsitektur & Penataan File Vibe UI',
    'description' => 'Pelajari penataan folder dan arsitektur file Vibe UI dalam proyek Laravel untuk memudahkan kustomisasi komponen, styling Tailwind CSS, aset JavaScript, dan lokalisasi multi-bahasa.',

    // Sections
    'overview_title' => 'Ringkasan Struktur',
    'overview_desc' => 'Setelah menjalankan perintah <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">php artisan vibe:install</code>, file dan aset Vibe UI akan terpasang di direktori aplikasi Laravel Anda:',

    'views_title' => '1. Komponen Blade (resources/views/vibe/)',
    'views_desc' => 'Tempat seluruh view template komponen Blade Vibe UI disimpan. Anda memiliki kendali penuh untuk memodifikasi markup, styling Tailwind, dan logika Alpine.js sesuai kebutuhan desain proyek Anda.',

    'css_title' => '2. Styling & Theme Tokens (resources/css/vibe/)',
    'css_desc' => 'Berisi variabel CSS kustom untuk Design System, custom variants Tailwind CSS v4, styling tema Highlight.js, dan token warna semantik.',

    'js_title' => '3. Aset JavaScript (resources/js/vibe/)',
    'js_desc' => 'Skrip interaktif pendukung komponen seperti switcher tema, syntax highlighter, dan helper interaksi frontend.',

    'lang_title' => '4. Bahasa & Terjemahan (lang/{locale}/vibe/)',
    'lang_desc' => 'Struktur terjemahan terpisah per komponen untuk kemudahan lokalisasi (Indonesian & English).',

    'config_title' => '5. Konfigurasi (config/vibe.php)',
    'config_desc' => 'File pengaturan utama untuk mengubah prefix komponen tag, tema default, konfigurasi asset loader, dan behavior komponen.',
];
