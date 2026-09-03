<?php

return [
    'title' => 'Avatar',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen avatar untuk menampilkan foto profil pengguna, inisial nama, atau siluet fallback dengan dukungan ragam ukuran (xs hingga 2xl), bentuk (circle, square, rounded), palet warna inisial, indikator status online/busy/away/offline, serta pengelompokan avatar bertumpuk (avatar group) dengan indikator sisa kuota (+N).',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar & Fallback',
        'desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:avatar&gt;</code> mendukung berbagai mode tampilan secara otomatis: gambar foto profil via prop <code class="font-mono text-xs text-foreground">src</code>, inisial nama via prop <code class="font-mono text-xs text-foreground">initials</code>, ikon kustom via slot, atau ikon siluet default saat tidak ada data yang diberikan.',
        'preview_title' => 'Foto, Inisial, Ikon & Siluet Standar',
        'image_label' => 'Gambar Foto Profil',
        'initials_label' => 'Inisial Nama',
        'custom_icon_label' => 'Ikon Kustom (Slot)',
        'fallback_label' => 'Siluet Fallback',
    ],

    // Section 2: Sizes
    'sizes' => [
        'title' => 'Pilihan Ukuran (Sizes)',
        'desc' => 'Tersedia 6 pilihan ukuran proporsional: <code class="font-mono text-xs text-foreground">xs</code> (24px), <code class="font-mono text-xs text-foreground">sm</code> (32px), <code class="font-mono text-xs text-foreground">md</code> (40px, default), <code class="font-mono text-xs text-foreground">lg</code> (48px), <code class="font-mono text-xs text-foreground">xl</code> (56px), dan <code class="font-mono text-xs text-foreground">2xl</code> (64px).',
        'preview_title' => 'Ukuran xs hingga 2xl',
    ],

    // Section 3: Shapes
    'shapes' => [
        'title' => 'Bentuk Sudut (Shapes)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">shape</code> untuk menyesuaikan geometri avatar: <code class="font-mono text-xs text-foreground">circle</code> (default, membulat penuh), <code class="font-mono text-xs text-foreground">rounded</code> (sudut rounded-md), atau <code class="font-mono text-xs text-foreground">square</code> (sudut rounded-lg). Posisi indikator status otomatis menyesuaikan bentuk.',
        'preview_title' => 'Pilihan Bentuk Avatar',
        'circle' => 'Circle (Default)',
        'rounded' => 'Rounded',
        'square' => 'Square',
    ],

    // Section 4: Status Indicator
    'indicators' => [
        'title' => 'Indikator Status Kehadiran (indicator)',
        'desc' => 'Sematkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">indicator</code> untuk menandai status kehadiran pengguna: <code class="font-mono text-xs text-foreground">online</code> (hijau sukses), <code class="font-mono text-xs text-foreground">busy</code> (merah destruktif), <code class="font-mono text-xs text-foreground">away</code> (kuning peringatan), atau <code class="font-mono text-xs text-foreground">offline</code> (abu-abu). Titik status otomatis dilengkapi ring kontras latar belakang.',
        'preview_title' => 'Indikator Kehadiran Pengguna',
        'online' => 'Online',
        'busy' => 'Busy / Jangan Ganggu',
        'away' => 'Sedang Tidak di Tempat',
        'offline' => 'Offline',
    ],

    // Section 5: Initials Colors
    'colors' => [
        'title' => 'Palet Warna Inisial (color)',
        'desc' => 'Untuk avatar berbasis inisial huruf, Anda dapat memilih dari beragam palet warna cerah yang mendukung mode gelap dan terang: <code class="font-mono text-xs text-foreground">blue</code>, <code class="font-mono text-xs text-foreground">green</code>, <code class="font-mono text-xs text-foreground">red</code>, <code class="font-mono text-xs text-foreground">purple</code>, <code class="font-mono text-xs text-foreground">yellow</code>, <code class="font-mono text-xs text-foreground">pink</code>, dan <code class="font-mono text-xs text-foreground">orange</code>.',
        'preview_title' => 'Palet Warna Latar Inisial',
    ],

    // Section 6: Avatar Group
    'group_sec' => [
        'title' => 'Kelompok Avatar Bertumpuk (Avatar Group)',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:avatar.group&gt;</code> untuk menyusun kumpulan avatar anggota tim atau kolaborator secara bertumpuk (overlapping) dengan ring pembatas, kontrol batas tampil (<code class="font-mono text-xs text-foreground">limit</code>), dan counter sisa kuota (<code class="font-mono text-xs text-foreground">+N</code>).',
        'preview_title' => 'Avatar Group & Indikator Counter',
        'sample_team' => 'Tim Proyek Vibe UI',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Referensi Props & Slot',
        'desc' => 'Daftar lengkap atribut prop yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code> dan <code class="font-mono text-xs text-foreground">&lt;vibe:avatar.group&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'slots' => [
        'title' => 'Slot yang Tersedia',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Deskripsi & Kegunaan',
        ],
    ],
];
