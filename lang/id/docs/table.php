<?php

return [
    'title' => 'Table',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen tabel data yang responsif, modular, dan elegan. Mendukung 4 varian tampilan (default, striped, bordered, flush), ukuran dense, baris yang dapat disorot, pengurutan kolom (sortable), state baris terpilih, hingga tampilan kosong (empty state).',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Penggunaan Dasar',
    'basic_usage_desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table&gt;</code> bersama subkomponen header, column, rows, row, dan cell untuk menyusun struktur tabel yang rapi dan terstandar.',

    // Section 2: Variants
    'variants_title' => 'Varian Tampilan',
    'variants_desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> menyediakan 4 pilihan gaya visual: <code class="font-mono text-xs text-foreground">default</code> (divider horizontal bersih), <code class="font-mono text-xs text-foreground">striped</code> (zebra rows), <code class="font-mono text-xs text-foreground">bordered</code> (grid dengan garis tepi penuh), dan <code class="font-mono text-xs text-foreground">flush</code> (tanpa border luar/card).',

    // Section 3: Dense
    'dense_title' => 'Tabel Kompak (Dense)',
    'dense_desc' => 'Tambahkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dense</code> untuk mengurangi padding vertikal dan horizontal pada setiap baris, sangat cocok untuk menampilkan dataset dalam jumlah besar pada layar terbatas.',

    // Section 4: Sortable Columns
    'sortable_title' => 'Kolom Pengurutan (Sortable)',
    'sortable_desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sortable</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.column&gt;</code>. Padukan dengan <code class="font-mono text-xs text-foreground">:sorted</code> dan <code class="font-mono text-xs text-foreground">direction="asc|desc"</code> untuk menampilkan indikator panah arah pengurutan otomatis.',

    // Section 5: Row Selection & Actions
    'selection_title' => 'Baris Terpilih & Aksi',
    'selection_desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:table.row&gt;</code> untuk memberi aksen warna latar pada baris yang aktif atau dicentang.',

    // Section 6: Empty State
    'empty_title' => 'Tampilan Data Kosong (Empty State)',
    'empty_desc' => 'Gunakan subkomponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:table.empty&gt;</code> ketika query pencarian atau koleksi data tidak memuat hasil.',

    // Section 7: Props Reference
    'props_title' => 'Referensi Props',
    'props_desc' => 'Daftar lengkap atribut dan properti yang didukung oleh rangkaian komponen Table.',
    'table_prop' => 'Prop',
    'table_type' => 'Tipe',
    'table_default' => 'Default',
    'table_desc' => 'Deskripsi',

    // Section 8: Subcomponents
    'subcomponents_title' => 'Subkomponen Table',
    'subcomponents_desc' => 'Rangkaian komponen compound yang dapat digunakan bersama <code class="font-mono text-xs text-foreground">&lt;vibe:table&gt;</code>.',
    'table_component' => 'Komponen',
];
