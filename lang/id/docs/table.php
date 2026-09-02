<?php

return [
    'title' => 'Table',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen tabel data yang responsif, modular, dan elegan. Mendukung 4 varian tampilan (default, striped, bordered, flush), ukuran dense, baris yang dapat disorot, pengurutan kolom (sortable), state baris terpilih, hingga tampilan kosong (empty state).',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table&gt;</code> bersama subkomponen header, column, rows, row, dan cell untuk menyusun struktur tabel yang rapi dan terstandar.',
        'preview_title' => 'Tabel Dasar',
    ],

    // Columns & Sample Data
    'columns' => [
        'name' => 'Nama',
        'email' => 'Email',
        'role' => 'Peran',
        'status' => 'Status',
        'actions' => 'Aksi',
    ],

    'sample_data' => [
        'roles' => [
            'admin' => 'Administrator',
            'editor' => 'Editor',
            'member' => 'Anggota',
            'developer' => 'Pengembang',
            'designer' => 'Desainer UI',
            'manager' => 'Manajer Produk',
            'viewer' => 'Pengamat',
        ],
        'statuses' => [
            'active' => 'Aktif',
            'inactive' => 'Nonaktif',
            'pending' => 'Tertunda',
            'offline' => 'Luring',
        ],
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> menyediakan 4 pilihan gaya visual: <code class="font-mono text-xs text-foreground">default</code> (divider horizontal bersih), <code class="font-mono text-xs text-foreground">striped</code> (zebra rows), <code class="font-mono text-xs text-foreground">bordered</code> (grid dengan garis tepi penuh), dan <code class="font-mono text-xs text-foreground">flush</code> (tanpa border luar/card).',
        'preview_title' => 'Varian Gaya Tabel',
        'items' => [
            'default' => 'Default (Divider Bersih)',
            'striped' => 'Striped (Baris Zebra)',
            'bordered' => 'Bordered (Garis Penuh)',
            'flush' => 'Flush (Tanpa Frame)',
        ],
        'product' => 'Produk',
        'category' => 'Kategori',
        'price' => 'Harga',
        'keyboard' => 'Keyboard Mekanikal',
        'mouse' => 'Mouse Nirkabel',
        'monitor' => 'Monitor 4K 27"',
        'cat_accessories' => 'Aksesoris',
        'cat_display' => 'Layar',
        'feature' => 'Fitur',
        'starter' => 'Pemula',
        'pro' => 'Pro',
        'unlimited_projects' => 'Proyek Tanpa Batas',
        'custom_domain' => 'Domain Kustom',
        'unlimited' => 'Tanpa Batas',
    ],

    // Section 3: Dense
    'dense' => [
        'title' => 'Tabel Kompak (Dense)',
        'desc' => 'Tambahkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> untuk mengurangi padding vertikal dan horizontal pada setiap baris, sangat cocok untuk menampilkan dataset dalam jumlah besar pada layar terbatas.',
        'preview_title' => 'Tabel Ukuran Padat (Dense)',
        'invoice' => 'No. Faktur',
        'date' => 'Tanggal',
        'client' => 'Klien',
        'amount' => 'Jumlah',
        'total' => 'Total',
    ],

    // Section 4: Sortable Columns
    'sortable' => [
        'title' => 'Kolom Pengurutan (Sortable)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Padukan dengan <code class="font-mono text-xs text-foreground">:sorted</code> dan <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> untuk menampilkan indikator panah arah pengurutan otomatis.',
        'preview_title' => 'Header Kolom yang Dapat Diurutkan',
        'department' => 'Departemen',
        'performance' => 'Performa',
        'dept_engineering' => 'Teknik (Engineering)',
        'dept_product' => 'Produk',
        'dept_design' => 'Desain',
    ],

    // Section 5: Row Selection & Actions
    'selection' => [
        'title' => 'Baris Terpilih & Aksi',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> untuk memberi aksen warna latar pada baris yang aktif atau dicentang.',
        'preview_title' => 'Seleksi Baris & Tombol Aksi',
        'user' => 'Pengguna',
        'plan' => 'Paket',
        'action' => 'Aksi',
        'selected_badge' => '(Terpilih)',
        'edit' => 'Ubah',
    ],

    // Section 6: Empty State
    'empty_state' => [
        'title' => 'Tampilan Data Kosong (Empty State)',
        'desc' => 'Gunakan subkomponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> ketika query pencarian atau koleksi data tidak memuat hasil.',
        'preview_title' => 'Tampilan Data Kosong',
        'stock' => 'Stok',
        'empty_title' => 'Tidak Ada Data Ditemukan',
        'empty_desc' => 'Belum ada data yang terdaftar dalam tabel ini atau filter pencarian tidak membuahkan hasil.',
        'empty_btn' => 'Tambah Data Baru',
        'clear_filters' => 'Hapus Filter',
    ],

    // Section 7: Subcomponents Reference
    'subcomponents' => [
        'title' => 'Subkomponen Table',
        'desc' => 'Rangkaian komponen compound yang dapat digunakan bersama <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
        'columns' => [
            'component' => 'Komponen',
            'tag' => 'Tag HTML',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'table' => 'Kontainer tabel utama dengan pembungkus overflow responsif dan bayangan lembut.',
            'header' => 'Bagian kepala tabel. Mendukung posisi sticky melalui prop <code class="font-mono text-foreground">sticky</code>.',
            'column' => 'Kolom judul tabel. Mendukung perataan teks dan fitur sortir (<code class="font-mono text-foreground">sortable</code>).',
            'rows' => 'Badan tabel yang mengelompokkan baris-baris data dengan pemisah horizontal.',
            'row' => 'Baris tunggal. Mendukung status baris terpilih (<code class="font-mono text-foreground">selected</code>) dan clickable.',
            'cell' => 'Sel data tabel dengan kontrol perataan teks (<code class="font-mono text-foreground">align</code>) dan varian tipografi.',
            'footer' => 'Bagian kaki tabel untuk baris ringkasan, total, atau kontrol paginasi.',
            'empty' => 'Tampilan state kosong ketika tidak ada catatan data untuk ditampilkan.',
        ],
    ],

    // Section 8: Props Reference
    'props' => [
        'title' => 'Referensi Props',
        'desc' => 'Daftar lengkap atribut dan properti yang didukung oleh rangkaian komponen Table.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'table' => [
            'variant' => 'Gaya visual tabel.',
            'dense' => 'Mode kompak dengan tinggi baris dan padding lebih ramping.',
            'hoverable' => 'Efek sorot (highlight) saat kursor berada di atas baris.',
            'caption' => 'Keterangan teks kecil di bawah tabel.',
            'containerClass' => 'Kelas Tailwind tambahan untuk div wrapper pembungkus luar tabel.',
        ],
        'column' => [
            'align' => 'Perataan horizontal isi kolom.',
            'sortable' => 'Menandai kolom dapat diurutkan (menampilkan indikator sort).',
            'sorted' => 'Status apakah kolom sedang aktif menjadi acuan pengurutan.',
            'direction' => 'Arah panah pengurutan saat kolom berstatus sorted ("asc" atau "desc").',
        ],
        'row' => [
            'selected' => 'Menandai baris terpilih dengan aksen visual khusus.',
            'clickable' => 'Menerapkan kursor pointer dan efek hover untuk interaksi klik.',
        ],
        'cell' => [
            'align' => 'Perataan horizontal isi sel.',
            'variant' => 'Varian gaya tipografi ("default", "strong", "muted").',
            'colspan' => 'Jumlah kolom yang direntangkan oleh sel.',
        ],
    ],

    // Backward-compatibility aliases
    'basic_usage_title' => 'Penggunaan Dasar',
    'basic_usage_desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table&gt;</code> bersama subkomponen header, column, rows, row, dan cell untuk menyusun struktur tabel yang rapi dan terstandar.',
    'variants_title' => 'Varian Tampilan',
    'variants_desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> menyediakan 4 pilihan gaya visual: <code class="font-mono text-xs text-foreground">default</code> (divider horizontal bersih), <code class="font-mono text-xs text-foreground">striped</code> (zebra rows), <code class="font-mono text-xs text-foreground">bordered</code> (grid dengan garis tepi penuh), dan <code class="font-mono text-xs text-foreground">flush</code> (tanpa border luar/card).',
    'dense_title' => 'Tabel Kompak (Dense)',
    'dense_desc' => 'Tambahkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> untuk mengurangi padding vertikal dan horizontal pada setiap baris, sangat cocok untuk menampilkan dataset dalam jumlah besar pada layar terbatas.',
    'sortable_title' => 'Kolom Pengurutan (Sortable)',
    'sortable_desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Padukan dengan <code class="font-mono text-xs text-foreground">:sorted</code> dan <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> untuk menampilkan indikator panah arah pengurutan otomatis.',
    'selection_title' => 'Baris Terpilih & Aksi',
    'selection_desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> untuk memberi aksen warna latar pada baris yang aktif atau dicentang.',
    'empty_title' => 'Tampilan Data Kosong (Empty State)',
    'empty_desc' => 'Gunakan subkomponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> ketika query pencarian atau koleksi data tidak memuat hasil.',
    'subcomponents_title' => 'Subkomponen Table',
    'subcomponents_desc' => 'Rangkaian komponen compound yang dapat digunakan bersama <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
    'props_title' => 'Referensi Props',
    'props_desc' => 'Daftar lengkap atribut dan properti yang didukung oleh rangkaian komponen Table.',
    'table_component' => 'Komponen',
    'table_desc' => 'Deskripsi',
    'table_prop' => 'Prop',
    'table_type' => 'Tipe',
    'table_default' => 'Default',
];
