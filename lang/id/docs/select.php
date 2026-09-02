<?php

return [
    'title' => 'Select',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen pilihan interaktif (combobox) yang elegan dan kaya fitur. Dilengkapi pencarian instan, pengelompokan opsi, avatar gambar, ikon kustom, deskripsi subteks, serta paritas penuh ukuran dan varian dengan komponen Input.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select&gt;</code> bersama <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.option&gt;</code> untuk membuat menu pilihan interaktif.',
        'preview_title' => 'Select Dasar',
        'label' => 'Peran Akun',
        'placeholder' => 'Pilih peran akun...',
    ],

    // Section 2: Searchable
    'searchable' => [
        'title' => 'Pencarian Real-Time (Searchable)',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">searchable</code> untuk memunculkan kotak pencarian instan di bagian atas popover dropdown.',
        'preview_title' => 'Select dengan Fitur Pencarian',
        'label' => 'Negara Domisili',
        'placeholder' => 'Cari dan pilih negara...',
        'search_placeholder' => 'Ketik nama negara...',
    ],

    // Section 3: Option Groups
    'groups' => [
        'title' => 'Pengelompokan Opsi (Option Groups)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.group label="..."&gt;</code> untuk memisahkan opsi ke dalam beberapa kategori. Header grup otomatis tersembunyi jika hasil pencarian tidak mencocokkan kategori tersebut.',
        'preview_title' => 'Select dengan Pengelompokan Kategori',
        'label' => 'Keahlian Utama',
        'placeholder' => 'Pilih keahlian...',
    ],

    // Section 4: Avatars & Icons
    'avatars_icons' => [
        'title' => 'Opsi Kaya (Avatar & Ikon)',
        'desc' => 'Setiap opsi dapat diperkaya dengan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar="url"</code> untuk foto profil/gambar, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon="svg"</code> untuk ikon, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description="..."</code> untuk subteks penjelasan.',
        'preview_title' => 'Select dengan Avatar & Deskripsi',
        'label' => 'Pilih Penanggung Jawab',
        'placeholder' => 'Pilih staf penanggung jawab...',
    ],

    // Section 5: Variants
    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Memiliki 5 varian tampilan yang persis sama dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code>.',
        'preview_title' => 'Varian Tampilan Select',
    ],

    // Section 6: Sizes
    'sizes' => [
        'title' => 'Skala Ukuran',
        'desc' => 'Tersedia 4 pilihan ukuran: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, bawaan), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Skala Ukuran Select',
    ],

    // Section 7: States
    'states' => [
        'title' => 'Status & Validasi',
        'desc' => 'Dukungan status <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> pada seluruh select maupun pada opsi tertentu, serta penanda <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">required</code> dan pesan validasi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Status dan Validasi',
        'disabled_label' => 'Wilayah Server (Terkunci)',
        'disabled_placeholder' => 'Pilihan dinonaktifkan...',
        'error_label' => 'Kategori Layanan',
        'error_msg' => 'Kategori layanan wajib dipilih.',
    ],

    // Section 8: Keyboard Navigation
    'keyboard' => [
        'title' => 'Navigasi Keyboard',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keyboard</code> (atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:keyboard="true"</code>) untuk mengaktifkan navigasi menggunakan tombol panah atas/bawah, Enter, Space, dan Escape seperti pada komponen dropdown.',
        'preview_title' => 'Select dengan Navigasi Keyboard',
        'label' => 'Navigasi Keyboard',
        'placeholder' => 'Gunakan tombol panah keyboard...',
    ],

    // Props table
    'props' => [
        'title' => 'Properti Komponen',
        'select_title' => 'Props <vibe:select>',
        'group_title' => 'Props <vibe:select.group>',
        'option_title' => 'Props <vibe:select.option>',
        'col_prop' => 'Properti',
        'col_type' => 'Tipe Data',
        'col_default' => 'Nilai Default',
        'col_desc' => 'Deskripsi',
    ],
];
