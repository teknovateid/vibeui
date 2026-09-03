<?php

return [
    'title' => 'Header',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen header halaman serbaguna yang dirancang untuk membungkus judul halaman, deskripsi atau metadata ringkas, serta kelompok tombol aksi. Mendukung penyesuaian ukuran padding (sm, default, lg), mode sticky yang menempel di bagian atas saat digulir, serta integrasi harmonis dengan breadcrumb, badge, avatar, dan dropdown.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header&gt;</code> bersama subkomponen semantik <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header.heading&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header.subheading&gt;</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header.actions&gt;</code>.',
        'preview_title' => 'Header Halaman Standar',
        'heading' => 'Manajemen Pengguna',
        'subheading' => 'Kelola akun anggota tim, hak akses sistem, dan peran otorisasi.',
        'export_btn' => 'Ekspor CSV',
        'create_btn' => 'Tambah Anggota Baru',
    ],

    // Section 2: Sizes
    'sizes' => [
        'title' => 'Pilihan Ukuran (size)',
        'desc' => 'Tersedia 3 pilihan ukuran padding vertikal dan horizontal melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">size</code>: <code class="font-mono text-xs text-foreground">\'sm\'</code> (ringkas untuk modal atau sub-panel), <code class="font-mono text-xs text-foreground">\'default\'</code> (standar halaman), dan <code class="font-mono text-xs text-foreground">\'lg\'</code> (leluasa untuk landing page atau halaman sambutan).',
        'preview_title' => 'Variasi Ukuran Header (sm, default, lg)',
        'small_title' => 'Ukuran Kecil (sm)',
        'small_sub' => 'Ideal untuk panel dialog modal atau container kecil.',
        'default_title' => 'Ukuran Standar (default)',
        'default_sub' => 'Ukuran bawaan yang pas untuk layout konten aplikasi.',
        'large_title' => 'Ukuran Besar (lg)',
        'large_sub' => 'Padding leluasa cocok untuk dashboard overview utama.',
    ],

    // Section 3: Sticky Header
    'sticky' => [
        'title' => 'Header Menempel (variant="sticky")',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="sticky"</code> untuk mempertahankan header tetap menempel di bagian paling atas layar (<code class="font-mono text-xs text-foreground">sticky top-0 z-50</code>) saat pengguna menggulir halaman panjang.',
        'preview_title' => 'Demonstrasi Header Sticky',
        'sticky_heading' => 'Detail Transaksi Pembayaran',
        'sticky_sub' => 'ID Transaksi: TRX-2026-981023',
        'save_btn' => 'Simpan Perubahan',
        'hint' => 'Pada halaman aplikasi sesungguhnya, header dengan variant="sticky" akan tetap terlihat di bagian atas saat halaman di-scroll ke bawah.',
    ],

    // Section 4: Rich Composition
    'rich_composition' => [
        'title' => 'Komposisi Lengkap (Avatar, Badge, & Breadcrumb)',
        'desc' => 'Kombinasikan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:header&gt;</code> dengan komponen Vibe UI lainnya seperti Breadcrumb di atas judul, Avatar pengguna, dan Badge status.',
        'preview_title' => 'Header Profil Pengguna Lanjutan',
        'user_name' => 'Sarah Jenkins',
        'user_role' => 'Lead Product Designer &bull; Divisi Desain Teknovate',
        'status' => 'Aktif',
        'edit_profile' => 'Ubah Profil',
        'settings' => 'Pengaturan',
    ],

    // Section 5: Props Reference
    'props' => [
        'title' => 'Referensi Props & Subkomponen',
        'desc' => 'Daftar atribut dan subkomponen yang disediakan oleh ekosistem <code class="font-mono text-xs text-foreground">&lt;vibe:header&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'subcomponents' => [
        'title' => 'Subkomponen',
        'columns' => [
            'component' => 'Komponen',
            'tag' => 'Tag HTML',
            'desc' => 'Fungsi & Peran',
        ],
    ],
];
