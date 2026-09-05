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
];
