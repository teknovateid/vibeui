<?php

return [
    'title' => 'Switch',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen toggle switch modern dengan animasi geser yang halus. Cocok untuk pengaturan preferensi, fitur aktif/nonaktif, serta mendukung berbagai varian warna, penempatan label, ikon thumb, dan ukuran.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:switch&gt;</code> untuk membuat kontrol toggle.',
        'preview_title' => 'Switch Standar',
        'airplane_label' => 'Mode Pesawat',
        'airplane_desc' => 'Matikan semua koneksi nirkabel dan bluetooth saat berada di pesawat.',
    ],

    'variants' => [
        'title' => 'Varian Warna',
        'desc' => 'Tersedia dalam berbagai varian warna semantik: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">primary</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">secondary</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">success</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">warning</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">danger</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">accent</code>.',
        'preview_title' => 'Semua Varian Warna Switch',
        'primary_label' => 'Primary (Default Kontras Tinggi)',
        'secondary_label' => 'Secondary (Netral Lembut)',
        'success_label' => 'Success (Autentikasi 2FA Aktif)',
        'warning_label' => 'Warning (Peringatan Kuota Data)',
        'danger_label' => 'Danger / Destructive (Hapus Akun Otomatis)',
        'info_label' => 'Info (Sinkronisasi Cloud)',
        'accent_label' => 'Accent (Fitur Eksperimental)',
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
        'title' => 'Penempatan Label (Right, Left & Justify)',
        'desc' => 'Atur posisi label menggunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">labelPlacement</code> dengan opsi: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">right</code> (default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">left</code>, atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">justify</code> (gaya pengaturan iOS/macOS).',
        'preview_title' => 'Penempatan Label & Settings Row',
        'right_label' => 'Label di Kanan (Default)',
        'left_label' => 'Label di Kiri',
        'notif_title' => 'Notifikasi Push',
        'notif_desc' => 'Dapatkan pemberitahuan seketika saat ada pesan baru.',
        'dark_title' => 'Mode Gelap Otomatis',
        'dark_desc' => 'Sesuaikan tema secara otomatis mengikuti preferensi sistem perangkat Anda.',
    ],

    'icons' => [
        'title' => 'Ikon di Dalam Thumb (Slot)',
        'desc' => 'Anda dapat menyisipkan SVG atau ikon ke dalam slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:switch&gt;</code> untuk ditampilkan langsung di dalam bulatan geser thumb.',
        'preview_title' => 'Switch dengan Ikon Thumb',
        'theme_label' => 'Mode Gelap',
        'theme_desc' => 'Alihkan mode tampilan antara terang dan gelap.',
        'security_label' => 'Kunci Keamanan',
        'security_desc' => 'Wajibkan PIN atau biometrik setiap membuka aplikasi.',
    ],

    'states' => [
        'title' => 'Status Komponen (Disabled & Error)',
        'desc' => 'Komponen switch mendukung status nonaktif (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code>) baik saat OFF maupun ON, serta status validasi error (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>).',
        'preview_title' => 'Status Disabled & Error',
        'disabled_off_label' => 'Fitur Terkunci (Disabled OFF)',
        'disabled_off_desc' => 'Memerlukan langganan paket Pro untuk mengaktifkan.',
        'disabled_on_label' => 'Fitur Wajib (Disabled ON)',
        'disabled_on_desc' => 'Pengaturan ini dikelola oleh kebijakan sistem organisasi.',
        'error_label' => 'Syarat & Ketentuan Layanan',
        'error_desc' => 'Persetujuan kebijakan privasi pengguna.',
        'error_message' => 'Anda wajib menyetujui syarat & ketentuan layanan untuk melanjutkan.',
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
            'variant' => 'Warna latar track saat aktif: <code>\'primary\'</code>, <code>\'secondary\'</code>, <code>\'success\'</code>, <code>\'warning\'</code>, <code>\'danger\'</code>/<code>\'destructive\'</code>, <code>\'info\'</code>, atau <code>\'accent\'</code>.',
            'labelPlacement' => 'Penempatan label terhadap switch: <code>\'right\'</code>, <code>\'left\'</code>, atau <code>\'justify\'</code>.',
            'error' => 'Pesan error kustom atau flag boolean untuk memicu styling merah destructive.',
            'errorName' => 'Kunci error Laravel validation dalam <code>$errors</code> untuk deteksi error otomatis.',
            'disabled' => 'Atribut atau prop boolean untuk menonaktifkan interaksi dan memudarkan komponen.',
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
            'default' => 'Slot default yang dirender tepat di dalam bulatan thumb geser (misal: ikon matahari/bulan, gembok, ceklis).',
        ],
    ],
];
