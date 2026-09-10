<?php

return [
    'title' => 'Grid',
    'badge' => 'Komponen',
    'group' => 'Layout & Kontainer',
    'description' => 'Komponen grid dashboard interaktif berbasis kartu (card / widget). Mendukung pengubahan ukuran kartu (resize) secara langsung via drag handle di sudut kanan bawah kartu, penataan ulang urutan kartu via drag & drop, serta opsi penyimpanan layout otomatis ke browser (Alpine Store / localStorage) agar susunan kartu tidak berubah saat halaman direfresh.',

    // Section 1: Interactive Showcase
    'showcase' => [
        'title' => 'Demo Interaktif Card Grid',
        'desc' => 'Coba langsung fitur interaktif pada dashboard grid di bawah: <strong>geser handel di sudut kanan-bawah kartu</strong> untuk mengubah ukuran kolom secara visual, atau <strong>tarik ikon pegangan (drag handle) di header kartu</strong> untuk memindahkan susunan urutan. Seluruh perubahan akan otomatis tersimpan di localStorage!',
        'preview_title' => 'Dashboard Widget Grid (Resize, Reorder, & LocalStorage)',
        'hint' => '💡 Tip: Hover kartu untuk menampilkan ikon. Tarik ⠿ di header untuk menukar posisi kartu, atau tarik ikon resize di sudut kanan bawah untuk memperbesar/memperkecil lebar kartu!',
        'toolbar_title' => 'Ringkasan Dashboard',
        'toolbar_desc' => 'Atur posisi dan ukuran widget sesuai kenyamanan tata letak Anda.',
    ],

    // Section 2: Card Resize
    'resize' => [
        'title' => 'Pengubahan Ukuran Kartu (Resize)',
        'desc' => 'Setiap kartu dapat diubah lebarnya secara fleksibel dalam sistem grid 12 kolom dengan menarik handel di sudut kanan bawah kartu. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:colSpan="4"</code> untuk ukuran awal, <code class="font-mono text-xs text-foreground">:minColSpan="2"</code> untuk batas minimum, serta <code class="font-mono text-xs text-foreground">:maxColSpan="12"</code> untuk batas maksimum.',
        'preview_title' => 'Pengaturan Lebar & Batas Ukuran Kartu',
    ],

    // Section 3: Card Reorder (Drag & Drop)
    'reorder' => [
        'title' => 'Penataan Ulang Kartu (Drag & Drop)',
        'desc' => 'Kartu dapat dipindahkan dan ditukar posisinya secara bebas menggunakan drag-and-drop. Ikon drag handle bawaan pada header memudahkan pengguna memindahkan kartu dengan indikator area peletakan visual. Untuk mengunci kartu tertentu agar posisinya tetap, tetapkan <code class="font-mono text-xs text-foreground">:reorderable="false"</code>.',
        'preview_title' => 'Drag and Drop Reordering Antar Kartu',
    ],

    // Section 4: Lock Modes
    'lock' => [
        'title' => 'Mode Penguncian Kartu (3 Metode)',
        'desc' => 'Setiap kartu mendukung tiga metode penguncian berbeda melalui kombinasi prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:resizable</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:reorderable</code>. Ikon gembok pada header dan ikon resize di sudut kanan bawah <strong>hanya tampil saat kartu di-hover</strong>, menjaga tampilan tetap bersih saat idle. Tooltip pada ikon gembok menjelaskan secara tepat apa yang dikunci.',
        'preview_title' => 'Tiga Mode Penguncian: Posisi, Ukuran, dan Keduanya',
        'hint' => '💡 Hover tiap kartu untuk melihat ikon gembok yang berbeda sesuai mode kuncinya.',
    ],

    // Section 5: Persistence
    'persistence' => [
        'title' => 'Penyimpanan Layout (Alpine Store)',
        'desc' => 'Dengan menyetel prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id="dashboard-grid"</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code>, seluruh penataan urutan dan ukuran kartu yang diubah pengguna akan otomatis disimpan ke <strong>Alpine Store <code class="font-mono text-xs">vibeGrids</code></strong> yang dipersist ke localStorage browser dengan expiry 90 hari. Tombol "Reset Layout" pada toolbar memungkinkan pengguna mengembalikan susunan ke posisi semula kapan saja.',
        'preview_title' => 'Layout Tersimpan Otomatis Tanpa Hilang Saat Refresh',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Referensi Props & Subkomponen',
        'desc' => 'Daftar atribut konfigurasi yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:grid&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:grid.card&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:grid.item&gt;</code>, dan <code class="font-mono text-xs text-foreground">&lt;vibe:grid.toolbar&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'subcomponents' => [
        'title' => 'Daftar Subkomponen Grid',
        'columns' => [
            'component' => 'Komponen',
            'desc' => 'Peran & Fungsi Utama',
        ],
    ],

    'cards' => [
        'user_stats' => 'Statistik Pengguna',
        'user_stats_desc' => '1.240 pengguna baru mendaftar pekan ini',
        'recent_orders' => 'Pesanan Terbaru',
        'recent_orders_desc' => 'Pesanan Baru #8912 diverifikasi',
        'activity_log' => 'Aktivitas Log',
        'resize_drag_instruction' => 'Tarik handel di sudut kanan bawah kartu ini untuk mengubah lebarnya.',
        'resize_flexible_instruction' => 'Setiap kartu dapat diperlebar atau diperkecil dengan menyeret handel resize di sudut kanan-bawah.',
        'reorder_drag_instruction' => 'Gunakan tombol pegangan di kiri header untuk menyeret kartu ini.',
        'reorder_swap_instruction' => 'Tukar posisi kartu ini dengan Kartu A. Kartu C di sebelahnya bersifat statis.',
        'reorder_locked_instruction' => 'Kartu ini memiliki :reorderable="false" sehingga posisinya tidak dapat digeser.',
        'lock_pos_desc' => 'Posisi kartu ini dikunci. Tidak bisa dipindahkan ke posisi lain, namun masih bisa di-resize lebarnya.',
        'lock_size_desc' => 'Ukuran kartu ini dikunci. Tidak bisa di-resize, namun masih bisa dipindahkan urutannya.',
        'lock_both_desc' => 'Posisi dan ukuran kartu ini dikunci sepenuhnya.',
        'card_a' => 'Kartu A',
        'card_b' => 'Kartu B',
        'card_c' => 'Kartu C',
        'card_fixed' => 'Kartu Tetap (Locked)',
        'card_lock_pos' => 'Kartu: Kunci Posisi',
        'card_lock_size' => 'Kartu: Kunci Ukuran',
        'card_lock_both' => 'Kartu: Kunci Penuh',
        'metric_revenue' => 'Total Pendapatan',
        'metric_growth' => '+14.2% dari bulan lalu',
    ],

    'props_items' => [
        'root' => [
            'id' => 'Identifier unik untuk menyimpan konfigurasi susunan kartu di browser localStorage.',
            'cols' => 'Jumlah kolom sistem grid desktop (default: 12 kolom).',
            'gap' => 'Spasi jarak antar kartu grid (pilihan: 2, 3, 4, 5, 6).',
            'persist' => 'Otomatis menyimpan urutan dan ukuran kartu ke Alpine Store dan browser localStorage.',
            'reorderable' => 'Mengaktifkan atau menonaktifkan fitur drag-and-drop antar kartu secara global.',
            'resizable' => 'Mengaktifkan atau menonaktifkan fitur resize kolom kartu secara global.',
        ],
        'card' => [
            'id' => 'Kunci identifikasi unik kartu yang digunakan untuk persistensi susunan.',
            'colSpan' => 'Lebar kolom awal kartu dalam skala 12 kolom (default: 4).',
            'minColSpan' => 'Batas minimum lebar kartu saat ditarik/dikecilkan (default: 2).',
            'maxColSpan' => 'Batas maksimum lebar kartu saat ditarik/diperbesar (default: 12).',
            'reorderable' => 'Mengontrol apakah kartu ini dapat dipindahkan urutannya via drag-and-drop.',
            'resizable' => 'Mengontrol apakah kartu ini dapat diubah ukuran lebarnya via drag handle.',
            'title' => 'Judul teks header kartu (dapat juga menggunakan slot title).',
            'description' => 'Teks keterangan ringkas di bawah judul pada header kartu.',
        ],
        'toolbar' => [
            'title' => 'Judul dashboard atau nama bagian grid.',
            'description' => 'Teks keterangan pelengkap di bawah judul toolbar.',
            'resetLabel' => 'Kustomisasi teks pada tombol pemulih susunan layout default.',
        ],
        'subcomponents' => [
            'grid' => 'Komponen induk pembungkus grid yang mengatur CSS grid dan Alpine.js state.',
            'card' => 'Komponen widget kartu individual yang dilengkapi handel drag dan tombol resize interaktif.',
            'toolbar' => 'Toolbar atas opsional yang memuat judul dashboard dan tombol Reset Layout bawaan.',
            'item' => 'Alias atau pembungkus item generik di dalam grid container.',
        ],
    ],
];
