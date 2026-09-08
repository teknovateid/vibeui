<?php

return [
    'title' => 'Input',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen input teks yang modern dan fleksibel. Mendukung 5 varian tampilan, 4 ukuran, ikon leading/trailing, prefix/suffix teks, state error & disabled, serta integrasi penuh dengan Livewire wire:model.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> untuk membuat input dengan label bawaan. Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> otomatis tersinkron dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code> dan validasi Laravel.',
        'preview_title' => 'Input Dasar',
        'label' => 'Nama Lengkap',
        'placeholder' => 'Masukkan nama lengkap Anda...',
    ],

    // Section 2: Variants
    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol gaya visual input. Tersedia 5 pilihan untuk berbagai konteks desain.',
        'preview_title' => 'Varian Tampilan Input',
        'primary' => [
            'label' => 'Primary (Bawaan)',
            'placeholder' => 'Varian default dengan ring fokus utama...',
        ],
        'outline' => [
            'label' => 'Outline',
            'placeholder' => 'Varian garis batas netral...',
        ],
        'filled' => [
            'label' => 'Filled (Terisi)',
            'placeholder' => 'Tampilan latar solid...',
        ],
        'flush' => [
            'label' => 'Flush (Garis Bawah)',
            'placeholder' => 'Hanya garis batas bawah...',
        ],
        'ghost' => [
            'label' => 'Ghost (Transparan)',
            'placeholder' => 'Transparan tanpa border...',
        ],
    ],

    // Section 3: Sizes
    'sizes' => [
        'title' => 'Ukuran',
        'desc' => 'Tersedia 4 pilihan ukuran: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Ukuran Input',
        'sm' => [
            'label' => 'Kecil (sm)',
            'placeholder' => 'Tinggi 32px, teks xs...',
        ],
        'md' => [
            'label' => 'Sedang (md)',
            'placeholder' => 'Tinggi 36px, teks sm...',
        ],
        'lg' => [
            'label' => 'Besar (lg)',
            'placeholder' => 'Tinggi 40px, teks sm...',
        ],
        'xl' => [
            'label' => 'Ekstra Besar (xl)',
            'placeholder' => 'Tinggi 44px, teks base...',
        ],
    ],

    // Section 4: Icons & Addons
    'icons_addons' => [
        'title' => 'Ikon & Addon',
        'desc' => 'Gunakan slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:icon&gt;</code> untuk sisi kiri dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code> untuk sisi kanan. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">prefix</code> / <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code> untuk teks statis.',
        'preview_title' => 'Ikon & Teks Addon',
        'search' => [
            'label' => 'Pencarian Cepat',
            'placeholder' => 'Cari produk, artikel, atau pengguna...',
        ],
        'price' => [
            'label' => 'Nominal Harga',
            'placeholder' => '0',
        ],
        'website' => [
            'label' => 'Subdomain Toko',
            'placeholder' => 'nama-toko',
        ],
    ],

    // Section 5: Pill
    'pill' => [
        'title' => 'Pill Style',
        'desc' => 'Gunakan class Tailwind <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> untuk membuat input dengan sudut membulat penuh, sangat cocok untuk field pencarian.',
        'preview_title' => 'Input Gaya Membulat Penuh (Pill)',
        'placeholder' => 'Ketik kata kunci pencarian...',
    ],

    // Section 6: Helper & Description
    'helper' => [
        'title' => 'Deskripsi & Teks Bantuan',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> untuk teks penjelasan di bawah label, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> untuk catatan pembantu di bawah field input.',
        'preview_title' => 'Deskripsi Label & Teks Bantuan',
        'label' => 'Alamat Surel Resmi',
        'placeholder' => 'nama@perusahaan.com',
        'description' => 'Surel ini akan digunakan untuk konfirmasi transaksi dan aktivasi akun.',
        'info' => 'Pastikan domain email Anda aktif dan dapat menerima pesan.',
    ],

    // Section 7: Error & Validation
    'error' => [
        'title' => 'Error & Validasi',
        'desc' => 'Secara otomatis menampilkan error dari <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$errors</code> Laravel sesuai <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> input, atau teruskan pesan string kustom via prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Status Kesalahan (Error Validation)',
        'label' => 'Email Pengguna',
        'placeholder' => 'email-salah@',
        'message' => 'Format alamat email yang Anda masukkan tidak valid.',
    ],

    // Section 8: Status
    'status' => [
        'title' => 'Status: Disabled & Readonly',
        'desc' => 'Mendukung attribute native HTML seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">readonly</code> dengan gaya visual otomatis.',
        'preview_title' => 'Status Disabled & Readonly',
        'disabled_label' => 'Kode Lisensi (Disabled)',
        'readonly_label' => 'Nomor Resi (Readonly)',
    ],

    // Section 9: Livewire
    'livewire' => [
        'title' => 'Integrasi Livewire',
        'desc' => 'Mendukung directive Livewire seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.live</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.blur</code> secara transparan.',
        'preview_title' => 'Integrasi Livewire Model Binding',
        'label' => 'Filter Data Live',
        'placeholder' => 'Ketik langsung untuk memperbarui...',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Referensi Props',
        'desc' => 'Daftar lengkap properti yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:input&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    // Section 11: Slots
    'slots' => [
        'title' => 'Slots',
        'desc' => 'Daftar slot kustom yang tersedia.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Deskripsi',
        ],
    ],
];
