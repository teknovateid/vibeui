<?php

return [
    'title' => 'Switch',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen toggle switch modern dengan animasi geser yang halus. Cocok untuk pengaturan preferensi, fitur aktif/nonaktif, serta mendukung berbagai penempatan label dan ukuran.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:switch&gt;</code> untuk membuat kontrol toggle.',
        'preview_title' => 'Switch Standar',
        'airplane_label' => 'Mode Pesawat',
        'airplane_desc' => 'Matikan semua koneksi nirkabel dan bluetooth saat berada di pesawat.',
    ],

    'sizes' => [
        'title' => 'Ukuran',
        'desc' => 'Tersedia dalam 3 ukuran: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>.',
        'preview_title' => 'Ukuran Switch',
        'sm' => 'Ukuran Kecil (sm)',
        'md' => 'Ukuran Sedang (md - Default)',
        'lg' => 'Ukuran Besar (lg)',
    ],

    'placement' => [
        'title' => 'Penempatan Label (Justify & Left)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">labelPlacement="justify"</code> untuk membuat baris pengaturan gaya iOS/macOS di mana switch berada di ujung kanan.',
        'preview_title' => 'Switch Gaya Pengaturan (Settings Row)',
        'notif_title' => 'Notifikasi Push',
        'notif_desc' => 'Dapatkan pemberitahuan seketika saat ada pesan baru.',
        'dark_title' => 'Mode Gelap Otomatis',
        'dark_desc' => 'Sesuaikan tema secara otomatis mengikuti preferensi sistem perangkat Anda.',
    ],

    'props' => [
        'title' => 'Referensi Props & Atribut',
        'desc' => 'Daftar lengkap properti dan atribut konfigurasi untuk komponen <code class="font-mono text-xs text-foreground">&lt;vibe:switch&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'name' => 'Nama form input. Otomatis terikat jika menggunakan <code>wire:model</code>.',
            'id' => 'ID unik elemen HTML input checkbox untuk menghubungkan <code>label</code>.',
            'value' => 'Nilai yang dikirimkan form saat switch dalam kondisi aktif (ON).',
            'label' => 'Teks label utama di samping atau di atas tombol switch.',
            'description' => 'Teks panduan / keterangan tambahan di bawah label utama.',
            'checked' => 'Status awal apakah switch dalam kondisi aktif (ON) atau nonaktif (OFF).',
            'size' => 'Ukuran track dan bulatan geser thumb: <code>\'sm\'</code>, <code>\'md\'</code>, atau <code>\'lg\'</code>.',
            'variant' => 'Warna latar track saat aktif: <code>\'primary\'</code>, <code>\'success\'</code> (hijau), atau <code>\'accent\'</code>.',
            'labelPlacement' => 'Penempatan label terhadap switch: <code>\'right\'</code>, <code>\'left\'</code>, atau <code>\'justify\'</code>.',
            'error' => 'Pesan error kustom atau flag boolean untuk memicu styling merah destructive.',
            'errorName' => 'Kunci error Laravel validation dalam <code>$errors</code> untuk deteksi error otomatis.',
            'disabled' => 'Atribut HTML standar untuk menonaktifkan interaksi dan memudarkan komponen.',
            'wrapperClass' => 'Kelas CSS tambahan untuk elemen kontainer pembungkus terluar.',
        ],
    ],

    'slots' => [
        'title' => 'Slots',
        'desc' => 'Slot kustom yang tersedia untuk tombol switch.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'default' => 'Slot default yang dirender tepat di dalam bulatan thumb geser (misal: ikon matahari/bulan).',
        ],
    ],
];
