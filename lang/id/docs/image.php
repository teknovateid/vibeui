<?php

return [
    'title' => 'Image',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen gambar semantik berbasis figure dan img yang dioptimalkan untuk performa web modern. Dilengkapi efek animasi shimmer skeleton pemuat awal untuk mencegah pergeseran tata letak (Cumulative Layout Shift / CLS), dukungan lazy loading native, optimasi LCP hero image via rel="preload", penanganan gambar rusak (fallback), dan keterangan caption otomatis.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:image&gt;</code> dengan memberikan prop <code class="font-mono text-xs text-foreground">src</code> dan <code class="font-mono text-xs text-foreground">alt</code>. Komponen secara otomatis membungkus gambar dengan tag semantik <code class="font-mono text-xs text-foreground">&lt;figure&gt;</code> serta menerapkan transisi fade-in halus saat gambar selesai dimuat.',
        'preview_title' => 'Contoh Tampilan Gambar Standar',
        'alt_text' => 'Pemandangan alam pegunungan berkabut',
    ],

    // Section 2: Shimmer Skeleton
    'skeleton' => [
        'title' => 'Animasi Skeleton (Pencegahan CLS)',
        'desc' => 'Secara default, prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">skeleton="true"</code> aktif. Komponen menampilkan placeholder berdenyut (*shimmer pulse*) seukuran kontainer selama gambar diunduh oleh browser, sehingga mencegah pergeseran layout mendadak (*Cumulative Layout Shift*). Anda dapat menonaktifkannya dengan <code class="font-mono text-xs text-foreground">:skeleton="false"</code>.',
        'preview_title' => 'Gambar dengan Shimmer Skeleton Aktif',
        'alt_text' => 'Arsitektur modern minimalis',
    ],

    // Section 3: LCP & Priority
    'priority' => [
        'title' => 'Optimasi LCP & Prioritas Tinggi (priority)',
        'desc' => 'Untuk gambar utama di atas lipatan layar (*above-the-fold*) seperti banner hero landing page, gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">priority="true"</code>. Komponen akan otomatis menyisipkan tag <code class="font-mono text-xs text-foreground">&lt;link rel="preload" as="image"&gt;</code> ke dalam tag <code class="font-mono text-xs text-foreground">&lt;head&gt;</code>, menonaktifkan lazy loading, dan mengatur <code class="font-mono text-xs text-foreground">fetchpriority="high"</code> untuk skor Web Vitals (LCP) terbaik.',
        'preview_title' => 'Banner Utama dengan Prioritas Preload Tinggi',
        'alt_text' => 'Hero banner workstation kerja produktif',
        'caption' => 'Hero Banner: Dimuat seketika dengan fetchpriority="high" dan preload head otomatis.',
    ],

    // Section 4: Fallback & Broken Image
    'fallback' => [
        'title' => 'Penanganan Gambar Rusak (fallback)',
        'desc' => 'Jika URL gambar mengalami galat (404 atau koneksi terputus), komponen otomatis menangani event error tanpa merusak layout. Anda dapat menentukan gambar cadangan melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">fallback</code>, atau membiarkannya menampilkan UI placeholder elegan dengan ikon dan pesan peringatan.',
        'preview_title' => 'Status Gambar Gagal Dimuat & Gambar Cadangan (Fallback)',
        'broken_label' => 'UI Galat Bawaan (Tanpa Fallback)',
        'fallback_label' => 'Gambar Cadangan Pengganti (Dengan Fallback)',
        'broken_alt' => 'Gambar produk tidak ditemukan',
    ],

    // Section 5: Caption
    'caption' => [
        'title' => 'Keterangan Gambar (caption / figcaption)',
        'desc' => 'Tambahkan teks penjelasan di bawah gambar menggunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">caption="..."</code> atau sematkan konten bebas di dalam <code class="font-mono text-xs text-foreground">$slot</code> komponen. Teks akan dirender secara semantik di dalam tag <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code>.',
        'preview_title' => 'Gambar dengan Figcaption Semantik',
        'caption_text' => 'Foto dokumentasi peluncuran sistem Vibe UI generasi terbaru oleh tim Teknovate.',
    ],

    // Section 6: Aspect Ratios
    'aspect_ratios' => [
        'title' => 'Rasio Aspek & Penyesuaian Ukuran',
        'desc' => 'Terapkan rasio aspek menggunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">aspect="video"</code> (16:9), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">aspect="square"</code> (1:1), atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">aspect="4/3"</code>, maupun langsung melalui class utility Tailwind seperti <code class="font-mono text-xs text-foreground">class="aspect-video"</code> atau <code class="font-mono text-xs text-foreground">class="aspect-square"</code>. Komponen secara otomatis mengunci rasio gambar dan membungkus gambar secara presisi dengan <code class="font-mono text-xs text-foreground">object-cover</code>.',
        'preview_title' => 'Variasi Rasio Aspek (16:9, 1:1, 4:3)',
        'ratio_16_9' => 'Rasio 16:9 (aspect-video)',
        'ratio_1_1' => 'Rasio 1:1 (aspect-square)',
        'ratio_4_3' => 'Rasio 4:3 (aspect-4/3)',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Referensi Props & Parameter',
        'desc' => 'Daftar atribut dan konfigurasi lengkap yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],
];
