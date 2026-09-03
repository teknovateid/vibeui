<?php

return [
    'title' => 'Nav',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Sistem navigasi sidebar yang komprehensif dan modular. Dilengkapi dukungan menu bertingkat (accordion collapsible group), pemisah kategori (section label), sistem pin favorit dinamis dengan persistensi localStorage, pelacak riwayat rute terkini (history), serta integrasi sempurna dengan mode minified sheet lengkap dengan floating flyout tooltip otomatis.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen pembungkus <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav&gt;</code> bersama item link <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.item&gt;</code>. Setiap item mendukung slot ikon <code class="font-mono text-xs text-foreground">&lt;x-slot:icon&gt;</code>, status aktif melalui <code class="font-mono text-xs text-foreground">:active="true"</code>, serta badge notifikasi atau counter.',
        'preview_title' => 'Menu Navigasi Sederhana',
        'dashboard' => 'Dashboard',
        'analytics' => 'Analitik',
        'messages' => 'Pesan Masuk',
        'notifications' => 'Notifikasi',
    ],

    // Section 2: Groups
    'groups' => [
        'title' => 'Kelompok Menu Bertingkat (vibe:nav.group)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.group&gt;</code> untuk menyusun sub-menu accordion yang dapat diciutkan. Kelompok ini memiliki animasi rotasi chevron halus, otomatis membuka jika salah satu child aktif (<code class="font-mono text-xs text-foreground">:active="true"</code>), dan mendukung persistensi status buka/tutup ke browser menggunakan <code class="font-mono text-xs text-foreground">:persist="true"</code>.',
        'preview_title' => 'Menu Accordion dengan Sub-item',
        'ecommerce' => 'E-Commerce',
        'products' => 'Semua Produk',
        'orders' => 'Pesanan Pelanggan',
        'customers' => 'Daftar Pembeli',
        'content' => 'Manajemen Konten',
        'articles' => 'Artikel Blog',
        'categories' => 'Kategori Post',
    ],

    // Section 3: Labels
    'labels' => [
        'title' => 'Pemisah Bagian Kategori (vibe:nav.label)',
        'desc' => 'Bagi struktur navigasi Anda ke dalam kelompok hierarki yang jelas menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.label&gt;</code>. Label ini memiliki tombol ciut/buka (*collapse/expand*) mandiri untuk menyembunyikan atau menampilkan seluruh bagian menu di bawahnya.',
        'preview_title' => 'Pengelompokan Navigasi dengan Section Label',
        'main_section' => 'APLIKASI UTAMA',
        'system_section' => 'PENGATURAN SISTEM',
        'users' => 'Pengguna & Hak Akses',
        'security' => 'Keamanan Akun',
        'audit' => 'Log Audit Aktivitas',
    ],

    // Section 4: Pinning
    'pinning' => [
        'title' => 'Sistem Pin Menu Favorit (vibe:nav.pinned)',
        'desc' => 'Aktifkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">pinnable</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:nav&gt;</code> untuk memunculkan ikon pin interaktif pada setiap menu. Tempatkan kontainer <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.pinned&gt;</code> di posisi mana pun yang diinginkan untuk menampung pintasan menu yang disematkan oleh pengguna, tersimpan otomatis di localStorage tanpa FOUC.',
        'pinned_desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.pinned&gt;</code> adalah kontainer accordion khusus yang otomatis tersembunyi jika belum ada item yang disematkan. Begitu pengguna mengklik pin pada menu apa pun, klon pintasannya langsung muncul di dalam kontainer ini lengkap dengan counter kapasitas (<code class="font-mono text-xs text-foreground">maxpin</code>) dan tombol lepas pin.',
        'preview_title' => 'Demonstrasi Pinning Menu Interaktif',
        'hint' => 'Arahkan kursor ke menu di bawah dan klik ikon Pin di sebelah kanan untuk menyematkannya ke bagian atas!',
        'pinned_title' => 'Menu Tersemat',
    ],

    // Section 5: History
    'history' => [
        'title' => 'Riwayat Navigasi Terkini (vibe:nav.history)',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:nav.history&gt;</code> untuk secara otomatis mencatat dan menampilkan daftar halaman terakhir yang dikunjungi pengguna. Sangat praktis diletakkan di footer sidebar untuk akses cepat bolak-balik antar fitur.',
        'preview_title' => 'Kontainer Riwayat Halaman',
        'history_title' => 'Riwayat Terkini',
    ],

    // Section 6: Minified Integration
    'minified' => [
        'title' => 'Integrasi Mode Ciut / Minified Sheet',
        'desc' => 'Komponen Nav dirancang kompatibel dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:sheet behavior="minify"&gt;</code>. Saat sidebar diciutkan, teks label otomatis disembunyikan secara mulus, ikon ditengahkan secara presisi, dan kursor yang melayang (*hover*) di atas item atau kelompok menu akan memunculkan flyout popover mengambang (*floating tooltip*) tanpa terpotong batas overflow container.',
        'preview_title' => 'Perilaku Navigasi pada Lebar Ramping',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Referensi Props & Subkomponen',
        'desc' => 'Daftar atribut dan konfigurasi yang disediakan oleh seluruh ekosistem <code class="font-mono text-xs text-foreground">&lt;vibe:nav&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'subcomponents' => [
        'title' => 'Daftar Subkomponen Nav',
        'columns' => [
            'component' => 'Komponen',
            'desc' => 'Peran & Fungsi Utama',
        ],
    ],
];
