<?php

return [
    'title' => 'Breadcrumb',
    'badge' => 'Komponen',
    'group' => 'Navigasi',
    'description' => 'Komponen navigasi hierarki halaman (remah roti) yang membantu pengguna memahami lokasi mereka saat ini dalam struktur aplikasi, dilengkapi judul halaman bawaan, slot tombol aksi cepat, dukungan wire:navigate, dan pemisah SVG otomatis.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb&gt;</code> sebagai pembungkus dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb.item&gt;</code> untuk setiap tautan remah roti.',
        'preview_title' => 'Breadcrumb Standar',
        'home' => 'Beranda',
        'products' => 'Produk',
        'category' => 'Elektronik',
        'item' => 'Smartphone Pro',
    ],

    // Section 2: Page Title
    'title_prop' => [
        'title' => 'Judul Halaman (title)',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">title</code> menampilkan judul halaman yang tebal di atas daftar breadcrumb. Berikan string untuk judul kustom, atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:title="false"</code> jika Anda hanya menginginkan remah roti tanpa judul.',
        'preview_title' => 'Pengaturan Judul Halaman',
        'custom_title' => 'Manajemen Pengguna',
        'settings' => 'Pengaturan',
        'users' => 'Daftar Pengguna',
    ],

    // Section 3: Action Button
    'button_slot' => [
        'title' => 'Slot Tombol Aksi (button)',
        'desc' => 'Gunakan slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:button&gt;</code> untuk menyematkan tombol aksi cepat di sisi kanan header, seperti tombol "Tambah Baru" atau "Simpan".',
        'preview_title' => 'Breadcrumb dengan Tombol Aksi',
        'add_user' => 'Tambah Pengguna Baru',
        'export' => 'Ekspor Data',
    ],

    // Section 4: With Icons
    'icons' => [
        'title' => 'Ikon pada Item',
        'desc' => 'Setiap <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:breadcrumb.item&gt;</code> dapat menyertakan ikon SVG di samping teks tautan untuk memperjelas representasi visual navigasi.',
        'preview_title' => 'Breadcrumb Berikon',
        'home' => 'Beranda',
        'orders' => 'Pesanan',
        'invoice' => 'Faktur #INV-2026',
    ],

    // Section 5: Props & Slots
    'props' => [
        'title' => 'Referensi Props & Slot',
        'desc' => 'Daftar lengkap atribut dan slot yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb&gt;</code> dan <code class="font-mono text-xs text-foreground">&lt;vibe:breadcrumb.item&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Keterangan',
        ],
    ],
    'item_props' => [
        'title' => 'Props <vibe:breadcrumb.item>',
    ],
    'slots' => [
        'title' => 'Daftar Slot',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Keterangan',
        ],
    ],
];
