<?php

return [
    'title' => 'Textarea',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen textarea multi-baris modern dengan dukungan auto-resize cerdas, penghitung karakter otomatis, 5 varian tampilan, dan integrasi Livewire wire:model.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:textarea&gt;</code> untuk menerima input teks multi-baris.',
        'preview_title' => 'Textarea Dasar',
        'bio_label' => 'Biografi Singkat',
        'bio_placeholder' => 'Ceritakan sedikit tentang latar belakang dan minat Anda...',
    ],

    'autoresize' => [
        'title' => 'Fitur Auto-Resize',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:autoResize="true"</code> agar tinggi textarea otomatis menyesuaikan dengan panjang teks tanpa memunculkan scrollbar yang mengganggu.',
        'preview_title' => 'Textarea Auto-Resize',
        'feedback_label' => 'Catatan Tambahan',
        'feedback_placeholder' => 'Ketik pesan Anda di sini, tinggi kotak akan bertambah secara otomatis...',
    ],

    'counter' => [
        'title' => 'Penghitung Karakter (Character Counter)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:showCount="true"</code> bersama dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:maxlength="200"</code> untuk menampilkan indikator karakter realtime.',
        'preview_title' => 'Textarea dengan Character Counter',
        'tweet_label' => 'Pesan Singkat',
        'tweet_placeholder' => 'Tuliskan deskripsi singkat (maksimal 150 karakter)...',
    ],

    'props' => [
        'title' => 'Referensi Props & Atribut',
        'desc' => 'Daftar lengkap properti dan atribut yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:textarea&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'name' => 'Nama atribut input form. Otomatis terambil dari <code>wire:model</code> jika tidak diisi.',
            'id' => 'ID unik elemen HTML textarea untuk menghubungkan elemen <code>label</code>.',
            'label' => 'Teks label utama yang tampil di atas textarea.',
            'description' => 'Teks penjelasan / panduan tambahan di bawah label.',
            'placeholder' => 'Teks petunjuk yang tampil saat textarea masih kosong.',
            'rows' => 'Jumlah baris tinggi default textarea.',
            'size' => 'Ukuran teks dan ruang padding: <code>\'sm\'</code>, <code>\'md\'</code>, <code>\'lg\'</code>, atau <code>\'xl\'</code>.',
            'variant' => 'Varian tampilan visual: <code>\'primary\'</code>, <code>\'outline\'</code>, <code>\'filled\'</code>, <code>\'flush\'</code>, atau <code>\'ghost\'</code>.',
            'autoResize' => 'Menyesuaikan tinggi textarea secara otomatis mengikuti panjang baris yang diketik.',
            'showCount' => 'Menampilkan badge penghitung jumlah karakter realtime di pojok kanan atas.',
            'maxlength' => 'Batas jumlah karakter maksimal yang diperbolehkan (misal: 0/150).',
            'info' => 'Teks informasi bantuan kecil yang tampil di bawah textarea.',
            'error' => 'Pesan error kustom atau flag boolean untuk memicu styling merah destructive.',
            'errorName' => 'Kunci error Laravel validation dalam <code>$errors</code> untuk deteksi error otomatis.',
            'disabled' => 'Atribut HTML standar untuk menonaktifkan interaksi dan memudarkan komponen.',
            'readonly' => 'Atribut HTML standar untuk menjadikan textarea hanya bisa dibaca (read-only).',
            'wrapperClass' => 'Kelas CSS tambahan untuk elemen kontainer pembungkus terluar.',
        ],
    ],
];
