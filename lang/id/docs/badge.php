<?php

return [
    'title' => 'Badge',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen label/badge serbaguna untuk menampilkan status, hitungan angka, tag, atau penanda kategori dengan beragam varian warna, ukuran (sm sampai xl), indikator status dot dengan animasi pulse, leading & trailing ikon, serta tombol dismiss interaktif.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:badge&gt;</code> untuk membuat badge standar. Secara default, badge menggunakan varian <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> dan ukuran <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>.',
        'preview_title' => 'Badge Standar',
        'default' => 'Badge Standar',
        'primary' => 'Badge Utama',
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol skema warna dan gaya visual badge. Pewarnaan mengintegrasikan token desain Vibe UI (<code class="font-mono text-xs text-foreground">success</code>, <code class="font-mono text-xs text-foreground">warning</code>, <code class="font-mono text-xs text-foreground">info</code>, <code class="font-mono text-xs text-foreground">destructive</code>) untuk konsistensi mode terang dan gelap.',
        'preview_title' => 'Varian Warna Badge',
        'items' => [
            'default' => 'Default',
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'outline' => 'Outline',
            'ghost' => 'Ghost',
            'accent' => 'Accent',
            'destructive' => 'Destruktif',
            'success' => 'Sukses',
            'warning' => 'Peringatan',
            'info' => 'Info',
        ],
    ],

    // Section 3: Sizes
    'sizes' => [
        'title' => 'Pilihan Ukuran (Sizes)',
        'desc' => 'Badge hadir dalam 4 variasi ukuran: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> yang secara proporsional menyesuaikan tinggi, padding, font, dan elemen ikon/dot.',
        'preview_title' => 'Ukuran Badge sm hingga xl',
    ],

    // Section 4: Pill Style
    'pill' => [
        'title' => 'Gaya Membulat Penuh (Pill)',
        'desc' => 'Sesuai panduan desain Vibe UI, gunakan kelas utility Tailwind <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="rounded-full"</code> untuk mengubah sudut badge menjadi membulat penuh tanpa memerlukan atribut tambahan.',
        'preview_title' => 'Badge Pill dengan rounded-full',
    ],

    // Section 5: Dot Status
    'dot' => [
        'title' => 'Indikator Titik (Status Dot & Pulse)',
        'desc' => 'Tambahkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dot</code> untuk menampilkan titik indikator status. Warna titik otomatis selaras dengan varian yang dipilih. Aktifkan juga <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dotPulse</code> untuk efek animasi radar/ping.',
        'preview_title' => 'Status Dot dan Animasi Pulse',
        'online' => 'Online',
        'away' => 'Sedang Sibuk',
        'offline' => 'Offline',
        'maintenance' => 'Pemeliharaan',
    ],

    // Section 6: Icons and Addons
    'icons_addons' => [
        'title' => 'Ikon & Teks Prefix / Suffix',
        'desc' => 'Badge mendukung penambahan ikon di sisi depan (<code class="font-mono text-xs text-foreground">icon</code>), ikon di sisi belakang (<code class="font-mono text-xs text-foreground">trailingIcon</code>), serta teks awalan/akhiran (<code class="font-mono text-xs text-foreground">prefix</code> / <code class="font-mono text-xs text-foreground">suffix</code>).',
        'preview_title' => 'Ikon & Prefix / Suffix',
    ],

    // Section 7: Dismissible
    'dismissible' => [
        'title' => 'Badge Interaktif (Dismissible)',
        'desc' => 'Gunakan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dismissible</code> untuk menampilkan tombol silang (close) yang dapat diklik pengguna untuk menghapus badge dari DOM secara instan.',
        'preview_title' => 'Badge dengan Tombol Tutup',
    ],

    // Section 8: Link Badge
    'link' => [
        'title' => 'Badge Berupa Tautan (href)',
        'desc' => 'Jika prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">href</code> diisi, komponen otomatis dirender sebagai tag hyperlink <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;a wire:navigate&gt;</code> dengan efek hover dan transisi interaktif.',
        'preview_title' => 'Badge sebagai Link',
        'changelog' => 'Lihat Changelog v2.0',
    ],

    // Section 9: Props Table
    'props' => [
        'title' => 'Referensi Props & Slot',
        'desc' => 'Daftar lengkap atribut/properti dan slot yang dapat Anda konfigurasikan pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:badge&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Keterangan',
        ],
    ],
    'slots' => [
        'title' => 'Daftar Slot',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Keterangan',
        ],
    ],

    'props_items' => [
        'variant' => 'Skema warna dan varian visual badge.',
        'size' => 'Ukuran tinggi, padding horizontal, dan ukuran tipografi badge.',
        'icon' => 'Ikon visual yang disisipkan di sisi kiri (leading icon).',
        'trailingIcon' => 'Ikon visual yang disisipkan di sisi kanan (trailing icon).',
        'prefix' => 'Teks awalan sebelum slot utama (misal simbol mata uang).',
        'suffix' => 'Teks akhiran setelah slot utama.',
        'dot' => 'Menampilkan titik indikator status di sisi kiri.',
        'dotPulse' => 'Menambahkan efek animasi ping radar pada status dot.',
        'dismissible' => 'Menampilkan tombol hapus interaktif di sisi kanan badge.',
        'href' => 'Jika diisi, badge otomatis dirender sebagai hyperlink `<a wire:navigate>`.',
        'class' => 'Kelas Tailwind tambahan via `twMerge` (misal `rounded-full` untuk gaya pill).',
    ],
    'slots_items' => [
        'default' => 'Konten teks atau elemen utama di dalam badge.',
        'icon' => 'Slot kustom untuk menyisipkan SVG ikon di sisi kiri.',
        'trailingIcon' => 'Slot kustom untuk menyisipkan SVG ikon di sisi kanan.',
    ],
];
