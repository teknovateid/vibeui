<?php

return [
    'title' => 'Dropdown',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen menu dropdown interaktif untuk menampilkan daftar aksi, tautan navigasi, opsi kontekstual, atau submenu bertingkat dengan animasi transisi mulus, penyesuaian posisi otomatis (auto collision adjustment), dukungan navigasi keyboard, dan pemisahan kategori rapi.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown&gt;</code> dengan slot <code class="font-mono text-xs text-foreground">&lt;x-slot:trigger&gt;</code> untuk elemen pemicu, dan <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown.content&gt;</code> yang memuat daftar <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown.item&gt;</code>.',
        'preview_title' => 'Menu Dropdown Standar',
        'trigger_btn' => 'Pilihan Menu',
        'account' => 'Pengaturan Akun',
        'support' => 'Bantuan & Dukungan',
        'license' => 'Lisensi & Syarat',
        'logout' => 'Keluar dari Akun',
    ],

    // Section 2: Items, Icons & Shortcuts
    'items_icons' => [
        'title' => 'Label, Ikon & Pintasan Keyboard',
        'desc' => 'Perkaya item menu dengan ikon SVG, pemisah garis <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown.divider&gt;</code>, header kategori <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown.label&gt;</code>, serta lencana pintasan keyboard (shortcut keys).',
        'preview_title' => 'Menu Lengkap dengan Ikon & Shortcut',
        'trigger_btn' => 'Aksi Cepat',
        'header_general' => 'Umum',
        'header_danger' => 'Zona Berbahaya',
        'new_file' => 'Buat Dokumen Baru',
        'copy_link' => 'Salin Tautan Halaman',
        'share' => 'Bagikan Dokumen',
        'archive' => 'Arsipkan',
        'delete' => 'Hapus Dokumen Permanen',
    ],

    // Section 3: Alignment & Width
    'align_width' => [
        'title' => 'Penyelarasan & Lebar Menu (align & width)',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">align</code> mengontrol posisi kemunculan menu popover (<code class="font-mono text-xs text-foreground">right</code>, <code class="font-mono text-xs text-foreground">left</code>, <code class="font-mono text-xs text-foreground">top</code>, <code class="font-mono text-xs text-foreground">bottom-center</code>, dll.), sedangkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">width</code> mengatur lebar menu (<code class="font-mono text-xs text-foreground">48</code>, <code class="font-mono text-xs text-foreground">56</code>, <code class="font-mono text-xs text-foreground">64</code>, <code class="font-mono text-xs text-foreground">80</code>, atau <code class="font-mono text-xs text-foreground">full</code>).',
        'preview_title' => 'Variasi Posisi Dropdown',
        'align_left' => 'Align Left (Kiri)',
        'align_right' => 'Align Right (Kanan)',
        'align_top' => 'Align Top (Atas)',
    ],

    // Section 4: Nested Sub-menus
    'submenus' => [
        'title' => 'Submenu Bertingkat (Nested Sub)',
        'desc' => 'Buat hierarki menu bertingkat menggunakan subkomponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:dropdown.sub&gt;</code>. Submenu otomatis mendeteksi tepi layar monitor dan bergeser ke kiri jika ruang di sisi kanan tidak mencukupi.',
        'preview_title' => 'Dropdown dengan Submenu Bersarang',
        'trigger_btn' => 'Menu Bertingkat',
        'dashboard' => 'Dashboard Utama',
        'settings' => 'Pengaturan Preferensi',
        'theme' => 'Tema Warna',
        'theme_light' => 'Mode Terang',
        'theme_dark' => 'Mode Gelap',
        'theme_system' => 'Mengikuti Sistem',
        'language' => 'Bahasa Aplikasi',
        'lang_id' => 'Bahasa Indonesia',
        'lang_en' => 'English (US)',
        'notifications' => 'Pusat Notifikasi',
    ],

    // Section 5: Keyboard Navigation
    'keyboard_nav' => [
        'title' => 'Navigasi Keyboard (keyboard)',
        'desc' => 'Aktifkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keyboard</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown&gt;</code> untuk mengaktifkan aksesibilitas keyboard: panah atas/bawah untuk berpindah item, tombol <kbd class="px-1 py-0.5 rounded bg-muted text-xs font-mono text-foreground">Escape</kbd> untuk menutup menu, panah kanan untuk membuka submenu, dan panah kiri untuk menutup submenu.',
        'preview_title' => 'Navigasi Lengkap via Keyboard',
        'trigger_btn' => 'Buka dengan Keyboard',
    ],

    // Section 6: Custom Triggers
    'custom_trigger' => [
        'title' => 'Pemicu Kustom (Avatar & Ikon 3-Titik)',
        'desc' => 'Slot <code class="font-mono text-xs text-foreground">trigger</code> dapat diisi dengan komponen apa pun, seperti <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code> untuk menu profil header navbar, atau tombol aksi ikon tiga titik (<code class="font-mono text-xs text-foreground">size="icon"</code>) untuk menu opsi pada tabel/kartu.',
        'preview_title' => 'Trigger Avatar & Menu Baris Tabel',
        'profile_title' => 'Sarah Jenkins',
        'profile_role' => 'Administrator',
        'view_profile' => 'Lihat Profil',
        'billing' => 'Langganan & Tagihan',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Referensi Props & Subkomponen',
        'desc' => 'Daftar atribut dan subkomponen yang dapat digunakan pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:dropdown&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'slots' => [
        'title' => 'Subkomponen yang Tersedia',
        'columns' => [
            'slot' => 'Subkomponen',
            'desc' => 'Deskripsi & Kegunaan',
        ],
    ],

    'props_items' => [
        'dropdown' => [
            'keyboard' => 'Mengaktifkan navigasi aksesibilitas keyboard (Escape untuk keluar, panah atas/bawah untuk berpindah item, panah kanan/kiri untuk submenu).',
        ],
        'body' => [
            'align' => "Posisi penyejajaran popover: `'right'`, `'left'`, `'top'`, `'top-left'`, `'top-right'`, `'top-center'`, `'bottom'`, `'bottom-left'`, `'bottom-center'`, `'bottom-right'`.",
            'width' => "Lebar container dropdown: `'48'` (12rem), `'56'` (14rem), `'64'` (16rem), `'72'`, `'80'`, `'96'`, `'xl'`, `'2xl'`, `'min'`, atau `'full'`.",
        ],
        'item' => [
            'destructive' => 'Menerapkan gaya aksi berbahaya dengan warna teks merah samar yang menjadi tegas dan berlatar belakang merah lembut saat dihover (`hover:bg-destructive/10`).',
            'variant' => "Pilihan varian item: `'default'` atau `'destructive'`.",
            'href' => 'Jika diisi, item dirender sebagai tautan navigasi `<a>` dengan dukungan `wire:navigate`.',
            'type' => 'Tipe tombol ketika item tidak memiliki atribut `href`.',
        ],
        'sub' => [
            'label' => 'Teks judul pemicu submenu bertingkat.',
            'isOpen' => 'Status terbuka awal dari submenu.',
            'position' => "Gaya penempatan: `'absolute'` (popover horizontal) atau `'relative'` (accordion bertingkat).",
        ],
    ],
];
