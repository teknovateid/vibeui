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
            'developer' => 'Pengembang',
            'designer' => 'Desainer UI',
            'manager' => 'Manajer Produk',
            'viewer' => 'Pengamat',
        ],
        'statuses' => [
            'active' => 'Aktif',
            'inactive' => 'Nonaktif',
            'pending' => 'Tertunda',
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
    ],

    // Section 3: Dense
    'dense' => [
        'title' => 'Tabel Kompak (Dense)',
        'desc' => 'Tambahkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> untuk mengurangi padding vertikal dan horizontal pada setiap baris, sangat cocok untuk menampilkan dataset dalam jumlah besar pada layar terbatas.',
        'preview_title' => 'Tabel Ukuran Padat (Dense)',
    ],

    // Section 4: Sortable Columns
    'sortable' => [
        'title' => 'Kolom Pengurutan (Sortable)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Padukan dengan <code class="font-mono text-xs text-foreground">:sorted</code> dan <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> untuk menampilkan indikator panah arah pengurutan otomatis.',
        'preview_title' => 'Header Kolom yang Dapat Diurutkan',
    ],

    // Section 5: Row Selection & Actions
    'selection' => [
        'title' => 'Baris Terpilih & Aksi',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> untuk memberi aksen warna latar pada baris yang aktif atau dicentang.',
        'preview_title' => 'Seleksi Baris & Tombol Aksi',
    ],

    // Section 6: Empty State
    'empty_state' => [
        'title' => 'Tampilan Data Kosong (Empty State)',
        'desc' => 'Gunakan subkomponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> ketika query pencarian atau koleksi data tidak memuat hasil.',
        'preview_title' => 'Tampilan Data Kosong',
        'empty_title' => 'Tidak Ada Data Ditemukan',
        'empty_desc' => 'Belum ada data yang terdaftar dalam tabel ini atau filter pencarian tidak membuahkan hasil.',
        'empty_btn' => 'Tambah Data Baru',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Referensi Props',
        'desc' => 'Daftar lengkap atribut dan properti yang didukung oleh rangkaian komponen Table.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    // Section 8: Subcomponents
    'subcomponents' => [
        'title' => 'Subkomponen Table',
        'desc' => 'Rangkaian komponen compound yang dapat digunakan bersama <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
        'columns' => [
            'component' => 'Komponen',
            'desc' => 'Deskripsi',
        ],
    ],
];
