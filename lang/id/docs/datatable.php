<?php

return [
    'title' => 'DataTable',
    'badge' => 'Komponen Enterprise',
    'group' => 'Komponen UI',
    'description' => 'Tabel data server-side berperforma tinggi bertenaga Rappasoft yang didesain ulang sepenuhnya menggunakan token tema Vibe UI. Dilengkapi pencarian debounced, sorting multi-kolom, seleksi visibilitas kolom, bulk action, dan navigasi paginasi elegan.',

    'features' => [
        'title' => 'Kemampuan Utama',
        'server_side' => 'Pemrosesan sisi server dengan optimasi query Eloquent',
        'sorting' => 'Pengurutan interaktif dengan indikator visual modern',
        'searching' => 'Pencarian langsung (debounced) di berbagai kolom',
        'column_select' => 'Tampilkan atau sembunyikan kolom secara dinamis',
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
        'preview_title' => 'DataTable Live Interaktif',
    ],

    'blade_usage' => [
        'title' => 'Pilihan Integrasi Blade',
        'desc' => 'Anda memiliki dua opsi cara render DataTable di view Blade:',
    ],

    'columns' => [
        'title' => 'Konfigurasi Kolom',
        'desc' => 'Definisikan kolom menggunakan class <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">Column</code> yang mendukung pengurutan (sorting), pencarian (searchable), dan kustomisasi tampilan:',
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
