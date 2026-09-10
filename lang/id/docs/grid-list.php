<?php

return [
    'title' => 'Grid List',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen layout switcher interaktif yang memungkinkan pengguna beralih tampilan data antara mode Grid (3 kolom responsif) dan mode List (vertikal memanjang) secara instan. Dilengkapi penyimpanan preferensi otomatis ke localStorage, mekanisme anti-kedip (zero-FOUC) sebelum hidrasi, serta slot header fleksibel untuk filter dan pencarian.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Bungkus kumpulan elemen atau kartu di dalam komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:grid-list&gt;</code>. Tombol kontrol switcher layout di pojok kanan atas akan dirender secara otomatis.',
        'preview_title' => 'Katalog Item Sederhana',
        'item_title' => 'Item Proyek',
        'item_desc' => 'Deskripsi ringkas proyek untuk demonstrasi tata letak grid dan list.',
    ],

    // Section 2: Default Layout
    'default_layout' => [
        'title' => 'Pengaturan Layout Default (defaultLayout)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default-layout="grid"</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default-layout="list"</code> untuk menentukan tampilan awal saat pengguna pertama kali membuka halaman (default adalah <code class="font-mono text-xs text-foreground">\'list\'</code>).',
        'preview_title' => 'Tampilan Awal List (default-layout="list")',
    ],

    // Section 3: Header Slot
    'header_slot' => [
        'title' => 'Slot Header Kustom ($header)',
        'desc' => 'Sematkan slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:header&gt;</code> untuk menyisipkan judul, kotak pencarian, filter kategori, atau badge jumlah data sejajar dengan tombol toggle grid-list.',
        'preview_title' => 'Katalog dengan Filter & Pencarian di Header',
        'search_placeholder' => 'Cari repositori proyek...',
        'count_badge' => '6 Proyek Aktif',
        'header_title' => 'Repositori Proyek Tim',
    ],

    // Section 4: Rich Catalog Cards
    'rich_cards' => [
        'title' => 'Desain Kartu Katalog Responsif',
        'desc' => 'Tata letak kartu yang dirancang fleksibel dapat beradaptasi indah baik pada mode Grid maupun mode List. Pada mode List, kartu akan melebar penuh dengan informasi yang tersusun rapi.',
        'preview_title' => 'Katalog Layanan Cloud & Server',
        'status_active' => 'Berjalan',
        'status_maintenance' => 'Pemeliharaan',
        'view_details' => 'Lihat Detail',
        'cpu' => 'vCPU',
        'ram' => 'RAM',
        'storage' => 'SSD',
    ],

    // Section 5: Persistence & Anti-Flicker
    'persistence' => [
        'title' => 'Penyimpanan Preferensi & Pencegahan FOUC',
        'desc' => 'Komponen ini secara otomatis mengingat preferensi layout terakhir pengguna di <code class="font-mono text-xs text-foreground">localStorage</code> berdasarkan atribut <code class="font-mono text-xs text-foreground">id</code> yang unik. Skrip IIFE bawaan dijalankan sebelum render DOM utama untuk memastikan tidak ada efek kedip (*Flash of Unstyled Content*) saat halaman dimuat ulang.',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Referensi Props & Parameter',
        'desc' => 'Daftar atribut dan konfigurasi yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:grid-list&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'classes' => [
        'title' => 'Kelas Tata Letak Bawaan',
        'columns' => [
            'mode' => 'Mode Tampilan',
            'classes' => 'Kelas Tailwind yang Diterapkan',
            'desc' => 'Perilaku Tata Letak',
        ],
    ],

    'props_items' => [
        'grid_list' => [
            'id' => 'ID unik untuk membedakan penyimpanan preferensi layout di localStorage.',
            'defaultLayout' => "Pilihan tampilan awal jika belum ada preferensi tersimpan: `'list'` atau `'grid'`.",
            'title' => 'Judul daftar yang otomatis ditampilkan di header sebelah kiri.',
            'description' => 'Deskripsi ringkas di bawah judul header.',
            'badge' => 'Teks lencana (menggunakan `<vibe:badge>`) di samping judul.',
            'badgeVariant' => 'Varian lencana badge (misal: `secondary`, `outline`, `primary`, dll).',
            'header' => 'Slot kustom untuk header di sisi kiri atas sejajar dengan switcher.',
            'actions' => 'Slot tombol aksi tambahan yang diletakkan di sebelah tombol switcher.',
            'showSwitcher' => 'Tampilkan tombol toggle Grid / List switcher (menggunakan `<vibe:button>`).',
        ],
        'card' => [
            'variant' => 'Varian kartu dari `<vibe:card>` (`default`, `outline`, `elevated`, `ghost`, `flat`).',
            'padding' => 'Ukuran padding kartu (`none`, `sm`, `lg`, `xl`, default `sm`).',
            'hover' => 'Menambahkan efek transisi dan elevasi hover pada kartu.',
            'title' => 'Judul kartu otomatis di header kartu.',
            'description' => 'Deskripsi kartu otomatis di bawah judul.',
            'header' => 'Slot kustom untuk bagian atas kartu.',
            'actions' => 'Slot aksi di sudut kanan atas kartu.',
            'footer' => 'Slot footer kartu dengan garis pemisah.',
        ],
    ],
];
