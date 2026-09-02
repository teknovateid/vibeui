<?php

return [
    'title' => 'Button',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen tombol serbaguna dengan beragam varian warna, 9 ukuran (termasuk icon-only), indikator loading spinner bawaan, dukungan navigasi link otomatis dengan wire:navigate, serta integrasi penuh dengan Livewire.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button&gt;</code> untuk membuat tombol standar. Secara default, tombol menggunakan varian <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> dan ukuran <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>.',
        'preview_title' => 'Tombol Dasar',
        'default_btn' => 'Tombol Standar',
        'primary_btn' => 'Tombol Utama',
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol skema warna dan hierarki visual tombol. Tersedia 12 varian yang siap digunakan untuk berbagai kebutuhan antarmuka.',
        'preview_title' => 'Varian Tampilan Tombol',
        'items' => [
            'default' => 'Default',
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'outline' => 'Outline',
            'ghost' => 'Ghost',
            'surface' => 'Surface',
            'accent' => 'Accent',
            'destructive' => 'Destruktif',
            'success' => 'Sukses',
            'warning' => 'Peringatan',
            'info' => 'Info',
            'link' => 'Link',
        ],
    ],

    // Section 3: Sizes
    'sizes' => [
        'title' => 'Ukuran (Sizes)',
        'desc' => 'Tersedia 5 pilihan ukuran standar berbasis teks: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xs</code> (28px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Ukuran Tombol Berbasis Teks',
    ],

    // Section 4: Icon Buttons
    'icons' => [
        'title' => 'Tombol Ikon & Posisi Ikon',
        'desc' => 'Ikon SVG dapat disisipkan langsung ke dalam slot sebagai awalan atau akhiran teks. Untuk tombol yang hanya memuat ikon (icon-only), gunakan salah satu ukuran ikon khusus: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-xs</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-md</code>, atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-lg</code>.',
        'preview_title' => 'Tombol dengan Ikon',
        'download' => 'Unduh Berkas',
        'continue' => 'Lanjutkan',
        'filter' => 'Filter Data',
    ],

    // Section 5: Pill
    'pill' => [
        'title' => 'Gaya Membulat (Pill)',
        'desc' => 'Gunakan class Tailwind <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> untuk membuat tombol dengan radius sudut membulat penuh, ideal untuk filter chips, badge action, atau tombol melingkar.',
        'preview_title' => 'Tombol Gaya Membulat Penuh',
        'popular' => 'Kategori Populer',
        'explore' => 'Jelajahi',
    ],

    // Section 6: Loading State
    'loading' => [
        'title' => 'Status Loading',
        'desc' => 'Gunakan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">loading</code> untuk menampilkan animasi spinner otomatis di sisi kiri teks dan secara langsung menonaktifkan interaksi klik pengguna.',
        'preview_title' => 'Status Loading Spinner',
        'saving' => 'Menyimpan Data...',
        'deleting' => 'Menghapus...',
    ],

    // Section 7: Status Disabled & Type
    'status' => [
        'title' => 'Status Disabled & Tipe Tombol',
        'desc' => 'Atribut HTML standar seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> didukung secara penuh dengan visual pengurangan opasitas dan pemblokiran pointer event. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type</code> untuk menentukan aksi form (<code class="font-mono text-xs text-foreground">submit</code>, <code class="font-mono text-xs text-foreground">button</code>, <code class="font-mono text-xs text-foreground">reset</code>).',
        'preview_title' => 'Status Disabled & Form Actions',
        'disabled' => 'Tombol Nonaktif',
        'submit' => 'Kirim Formulir',
        'reset' => 'Reset Form',
    ],

    // Section 8: Button as Link
    'link' => [
        'title' => 'Tombol Sebagai Link (href)',
        'desc' => 'Jika Anda meneruskan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">href</code>, komponen akan dirender sebagai tag hyperlink <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;a wire:navigate&gt;</code> dengan gaya tombol penuh, mempertahankan navigasi SPA instan.',
        'preview_title' => 'Tombol Berfungsi Sebagai Link',
        'docs' => 'Menuju Panduan Instalasi',
    ],

    // Section 9: Livewire Integration
    'livewire' => [
        'title' => 'Integrasi Livewire',
        'desc' => 'Komponen Button mendukung seluruh direktif aksi Livewire secara mulus seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:click</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:loading.attr="disabled"</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:target</code>.',
        'preview_title' => 'Aksi Livewire dengan Target Loading',
        'sync' => 'Sinkronisasi Aksi Livewire',
    ],

    // Section 10: Button Group
    'button_group' => [
        'title' => 'Button Group',
        'desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.group&gt;</code> menggabungkan beberapa tombol menjadi satu kesatuan visual yang kohesif. Sudut-sudut tombol di bagian tengah otomatis dibuat siku, border antar tombol tidak bertumpuk (border collapse), dan tombol yang di-hover atau di-fokus akan otomatis naik ke layer teratas (*z-index*).',
        'preview_attached_title' => 'Grup Tombol Terhubung (Attached)',
        'preview_padded_title' => 'Grup Tombol dengan Padding (Padded Container)',
        'preview_split_title' => 'Split Button dengan Dropdown',
        'preview_pill_title' => 'Grup Tombol Membulat (Pill)',
        'preview_vertical_title' => 'Grup Tombol Vertikal',
        'padded_active' => 'Aktif',
        'padded_pending' => 'Tertunda',
        'padded_completed' => 'Selesai',
        'segmented' => [
            'daily' => 'Harian',
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan',
        ],
        'split' => [
            'save' => 'Simpan Data',
            'save_draft' => 'Simpan sebagai Draf',
            'save_publish' => 'Simpan & Publikasikan',
        ],
        'vertical' => [
            'overview' => 'Ringkasan',
            'analytics' => 'Analitik',
            'reports' => 'Laporan',
        ],
        'props_title' => 'Props <vibe:button.group>',
        'props_desc' => 'Daftar atribut dan properti yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:button.group&gt;</code>.',
    ],

    // Section 11: Props Reference
    'props' => [
        'title' => 'Referensi Props',
        'desc' => 'Daftar atribut dan properti yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:button&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    // Section 11: Slots Reference
    'slots' => [
        'title' => 'Slots',
        'desc' => 'Daftar slot yang diterima oleh komponen.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Deskripsi',
        ],
    ],
];
