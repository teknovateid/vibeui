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

    'pinning_items' => [
        'available_features' => 'FITUR TERSEDIA',
        'perf_analytics' => 'Analitik Performa',
        'incoming_orders' => 'Pesanan Masuk',
    ],

    'subcomponents_items' => [
        'root' => 'Kontainer induk navigasi yang mengelola state pinning, floating popover, dan integrasi sheet minified.',
        'group' => 'Kelompok menu bertingkat (accordion collapsible) yang menampung daftar sub-item navigasi.',
        'label' => 'Header pemisah kategori bagian dengan kemampuan ciut/buka (*collapse/expand*) mandiri.',
        'pinned' => 'Wadah dinamis yang menampilkan klon pintasan menu yang telah di-pin oleh pengguna.',
        'history' => 'Wadah dinamis yang mencatat riwayat rute halaman terakhir yang diakses pengguna.',
    ],

    'props_items' => [
        'root' => [
            'id' => 'ID unik elemen nav untuk menyimpan preferensi di localStorage.',
            'pinnable' => 'Mengaktifkan tombol sematkan (pin) pada seluruh item navigasi di dalamnya.',
            'maxpin' => 'Batas maksimal jumlah menu yang dapat disematkan bersamaan.',
            'collapsed' => 'Menyetel navigasi ke mode ringkas (icon-only).',
        ],
        'item' => [
            'href' => 'Target URL tujuan link tautan.',
            'active' => 'Menandai status menu saat ini aktif dengan styling latar highlight tegas.',
            'badge' => 'Teks label badge indikator di sebelah kanan (misal counter angka atau status).',
            'badgeColor' => 'Warna badge: `"success"`, `"info"`, `"destructive"`, `"warning"`, `"accent"`, atau default.',
            'pinnable' => 'Menampilkan tombol pin secara spesifik pada item ini.',
            'id' => 'ID unik item untuk keperluan persistensi pintasan pin.',
        ],
        'pinned' => [
            'title' => 'Teks judul header accordion wadah pintasan tersemat (default: "Pinned" atau terjemahan).',
            'open' => 'Status awal apakah wadah daftar pin terbuka atau terlipat.',
            'persist' => 'Menyimpan status buka/tutup accordion wadah pin ke `localStorage`.',
            'id' => 'Identifier unik untuk pemetaan persistensi state accordion ke browser.',
        ],
        'group' => [
            'title' => 'Judul kelompok menu accordion.',
            'open' => 'Status awal apakah kelompok menu dalam posisi terbuka.',
            'active' => 'Menandai kelompok aktif dan otomatis membukanya saat halaman dimuat.',
            'persist' => 'Menyimpan preferensi status buka/tutup kelompok ke `localStorage`.',
            'pinnable' => 'Mengizinkan seluruh kelompok menu disematkan sebagai pin shortcut.',
            'id' => 'ID unik kelompok untuk pemetaan persistensi status buka/tutup.',
        ],
        'label' => [
            'title' => 'Teks judul header pemisah kategori bagian.',
            'open' => 'Status awal apakah daftar item di bawah label ditampilkan.',
            'persist' => 'Menyimpan preferensi status buka/tutup bagian ke `localStorage`.',
            'id' => 'ID unik label untuk pemetaan persistensi state.',
        ],
        'history' => [
            'title' => 'Teks judul header wadah riwayat navigasi (default: "History").',
            'open' => 'Status awal apakah accordion riwayat terbuka atau terlipat.',
            'persist' => 'Menyimpan preferensi status buka/tutup riwayat ke `localStorage`.',
        ],
    ],
];
