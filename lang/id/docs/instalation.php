<?php

return [
    'title' => 'Instalasi Vibe UI',
    'badge' => 'Dokumentasi',
    'subtitle' => 'Laravel 11+ / 12+ / 13+ & Tailwind CSS v4',
    'description' => 'Pelajari cara menginstal dan mengintegrasikan Vibe UI ke dalam aplikasi Laravel Anda untuk mempercepat pengembangan antarmuka yang modern dan elegan.',

    'steps' => [
        'step_1' => [
            'title' => 'Instalasi Package via Composer',
            'desc' => 'Jalankan perintah Composer di terminal untuk menambahkan library Vibe UI ke dalam proyek Anda:',
        ],
        'step_2' => [
            'title' => 'Publikasikan Aset & Konfigurasi',
            'desc' => 'Gunakan perintah Artisan bawaan Vibe UI untuk mempublikasikan konfigurasi, CSS custom variants, dan skrip pendukung:',
        ],
        'step_3' => [
            'title' => 'Konfigurasi Tailwind CSS v4',
            'desc' => 'Pastikan file CSS utama Anda mengimpor Tailwind CSS dan custom variant Vibe UI:',
        ],
        'step_4' => [
            'title' => 'Konfigurasi Template Layout Dasar',
            'desc' => 'Sertakan direktif <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">@vibeStyles</code> pada bagian <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;head&gt;</code> untuk inisialisasi tema dark mode anti-FOUC:',
        ],
        'step_5' => [
            'title' => 'Mulai Menggunakan Komponen',
            'desc' => 'Panggil komponen Vibe UI menggunakan sintaks tag ringkas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:...&gt;</code> langsung di dalam file Blade Anda:',
            'btn_save' => 'Simpan Perubahan',
            'btn_cancel' => 'Batal',
        ],
    ],
];
