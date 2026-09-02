<?php

return [
    'title' => 'DataTable',
    'badge' => 'Komponen Enterprise',
    'group' => 'Komponen UI',
    'description' => 'Tabel data server-side berperforma tinggi bertenaga Rappasoft yang didesain ulang sepenuhnya menggunakan token tema Vibe UI. Dilengkapi pencarian debounced, sorting multi-kolom, seleksi visibilitas kolom, bulk action, filter per-kolom, baris footer agregasi, dan navigasi paginasi elegan.',

    'features' => [
        'title' => 'Kemampuan Utama',
        'server_side' => 'Pemrosesan sisi server dengan optimasi query Eloquent',
        'sorting' => 'Pengurutan interaktif dengan indikator visual modern',
        'searching' => 'Pencarian langsung (debounced) di berbagai kolom',
        'column_select' => 'Tampilkan atau sembunyikan kolom secara dinamis',
        'bulk_actions' => 'Seleksi baris massal dengan eksekusi aksi instan',
        'footer' => 'Baris ringkasan footer untuk total dan kalkulasi',
        'pagination' => 'Navigasi paginasi khas Vibe UI yang intuitif',
    ],

    'installation' => [
        'title' => 'Instalasi & Generator',
        'desc' => 'Vibe UI telah dikonfigurasi untuk bekerja dengan engine tabel Rappasoft resmi. Anda dapat membuat komponen DataTable baru secara instan menggunakan perintah artisan:',
    ],

    'generator' => [
        'title' => 'Artisan Generator',
        'desc' => 'Buat komponen DataTable siap pakai dalam hitungan detik menggunakan perintah generator artisan bawaan Vibe UI:',
    ],

    'tag_helper' => [
        'title' => 'Penggunaan Tag <vibe:datatable>',
        'desc' => 'Selain menggunakan sintaks bawaan Livewire, Vibe UI menyediakan tag kustom <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:datatable&gt;</code> yang lebih deklaratif dan terintegrasi dengan ekosistem Vibe UI.',
        'preview_title' => 'DataTable via <vibe:datatable>',
    ],

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Cukup buat class turunan dari <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">VibeDataTableComponent</code> lalu definisikan query Eloquent dan kolomnya. Komponen secara otomatis mewarisi token desain, debounce pencarian, dan layout Vibe UI.',
        'preview_title' => 'Pratinjau Tabel Dasar (Basic Table)',
    ],

    'bulk_actions' => [
        'title' => 'Aksi Massal (Bulk Actions)',
        'desc' => 'Aktifkan seleksi checkbox untuk menjalankan aksi terhadap banyak baris data sekaligus, seperti ekspor laporan atau penghapusan data massal.',
        'preview_title' => 'Pratinjau Aksi Massal (Bulk Actions)',
    ],

    'column_search' => [
        'title' => 'Pencarian di Setiap Kolom (Per-Column Search)',
        'desc' => 'Sematkan input pencarian langsung di bawah judul setiap kolom menggunakan secondary header, sehingga pengguna dapat memfilter baris berdasarkan kolom ID, nama, atau email secara independen.',
        'preview_title' => 'Pratinjau Pencarian di Setiap Kolom',
    ],

    'filters_section' => [
        'title' => 'Filter Popover Kustom',
        'desc' => 'Tambahkan komponen filter popover dropdown status, domain email, pencarian tanggal, atau kriteria khusus lainnya.',
        'preview_title' => 'Pratinjau Filter Popover',
    ],

    'footer_section' => [
        'title' => 'Footer Kolom & Ringkasan (Aggregations)',
        'desc' => 'Tampilkan baris footer di bagian bawah tabel untuk menyajikan kalkulasi seperti total record, jumlah nominal (sum), atau rata-rata (average).',
        'preview_title' => 'Pratinjau Footer Kolom & Ringkasan',
    ],

    'secondary_header_section' => [
        'title' => 'Header Tambahan (Secondary Header)',
        'desc' => 'Gunakan header sekunder untuk meletakkan input pencarian atau filter tepat di bawah judul masing-masing kolom.',
    ],

    'blade_usage' => [
        'title' => 'Pilihan Integrasi Blade',
        'desc' => 'Anda memiliki dua opsi cara render DataTable di view Blade:',
    ],

    'columns' => [
        'title' => 'Kustomisasi Kolom & Tombol Aksi',
        'desc' => 'Definisikan kolom menggunakan class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">Column</code> yang mendukung pengurutan (sorting), format status badge, hingga tombol aksi ikon via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.group variant="ghost"&gt;</code>:',
        'preview_title' => 'Pratinjau Kolom Kustom & Aksi Ikon',
    ],

    'props' => [
        'title' => 'Properti <vibe:datatable>',
        'desc' => 'Daftar atribut yang didukung oleh komponen tag helper <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:datatable&gt;</code>:',
        'columns' => [
            'prop' => 'Properti',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'component' => 'Nama class FQCN (misal App\Livewire\UsersTable::class) atau nama alias Livewire (kebab-case).',
            'attributes' => 'Atribut atau parameter tambahan lainnya akan otomatis diteruskan (forwarded) ke komponen Livewire.',
            'slot' => 'Konten slot alternatif jika komponen digunakan sebagai pembungkus layout tabel kustom.',
        ],
    ],

    'configuration' => [
        'title' => 'Metode Konfigurasi Populer',
        'desc' => 'Metode bawaan di dalam fungsi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">configure()</code> untuk mengatur perilaku tabel:',
        'columns' => [
            'method' => 'Metode',
            'desc' => 'Fungsi & Kegunaan',
        ],
    ],

    'features_section' => [
        'title' => 'Fitur Unggulan',
        'desc' => 'Kelebihan dan arsitektur unggulan Vibe DataTable:',
        'items' => [
            'server_perf' => [
                'title' => 'Performa Server-Side Tinggi',
                'desc' => 'Data ditarik secara efisien dengan klausa SQL Limit dan Offset, menjamin kecepatan rendering meski mengelola jutaan data.',
            ],
            'theme_native' => [
                'title' => '100% Token Desain Vibe UI',
                'desc' => 'Input pencarian, ikon pengurutan chevron, checkbox seleksi, dan tombol paginasi otomatis mengikuti palet tema dan mode gelap.',
            ],
            'livewire_reactive' => [
                'title' => 'Livewire v3 Reactive',
                'desc' => 'Pencarian dengan debounce otomatis 350ms, respons sorting kilat, dan update DOM instan tanpa refresh halaman.',
            ],
            'column_visibility' => [
                'title' => 'Selektor Kolom Dinamis',
                'desc' => 'Memberikan kebebasan bagi pengguna untuk memilih kolom apa saja yang ingin ditampilkan atau disembunyikan.',
            ],
        ],
    ],
];
