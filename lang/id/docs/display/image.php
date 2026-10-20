<?php

return [
    'seo_title' => 'Komponen Display Image Lightbox — Vibe UI',
    'seo_description' => 'Komponen preview gambar interaktif dengan modal fullscreen lightbox, navigasi gambar sebelumnya/selanjutnya berbasis grup, kontrol zoom responsif, serta gestur sentuh dan keyboard shortcut di Vibe UI.',
    'badge_component' => 'Komponen Display',
    'badge_tag' => 'vibe:display.image',
    'header_features' => 'Fullscreen Lightbox • Navigasi Berkelompok • Sentuh & Zoom',
    'title' => 'Display Image Lightbox',
    'description' => 'Komponen pratinjau gambar modern yang menampilkan thumbnail interaktif. Saat gambar diklik, modal <em>fullscreen lightbox</em> elegan akan terbuka dengan dukungan navigasi panah kiri/kanan (berdasarkan grup), kontrol zoom bertahap, drag saat diperbesar, gestur swipe di perangkat mobile, dan pintasan keyboard lengkap.',

    'breadcrumbs' => [
        'home' => 'Home',
        'docs' => 'Docs',
        'display' => 'Display',
        'image' => 'Image (Lightbox)',
    ],

    // Section 1: Linked Gallery
    'grouped' => [
        'title' => '1. Galeri Gambar Terhubung (Next / Prev)',
        'desc' => 'Gunakan atribut <code class="text-primary font-mono font-semibold">group="nama-grup"</code> untuk menghubungkan beberapa gambar. Saat dibuka, pengguna dapat berpindah antar gambar menggunakan tombol panah layar atau tombol keyboard <kbd class="px-1.5 py-0.5 rounded bg-muted border border-border text-[11px] font-mono">←</kbd> dan <kbd class="px-1.5 py-0.5 rounded bg-muted border border-border text-[11px] font-mono">→</kbd>.',
        'preview_title' => 'Galeri Pemandangan Alam',
        'yosemite' => [
            'alt' => 'Lembah Yosemite',
            'caption' => 'Panorama Lembah Yosemite saat Matahari Terbit',
        ],
        'meadow' => [
            'alt' => 'Padang Rumput Hijau',
            'caption' => 'Padang Rumput Menghijau di Perbukitan',
        ],
        'lake' => [
            'alt' => 'Danau Biru Bersih',
            'caption' => 'Danau Biru Bersih Dikelilingi Pegunungan',
        ],
    ],

    // Section 2: Standalone Image
    'standalone' => [
        'title' => '2. Gambar Tunggal (Standalone)',
        'desc' => 'Jika hanya ingin gambar individual dibuka dalam fullscreen tanpa tombol navigasi panah kiri/kanan, gunakan prop <code class="text-primary font-mono font-semibold">standalone</code>.',
        'preview_title' => 'Pratinjau Gambar Tunggal',
        'alt' => 'Bintang di Langit Malam Pegunungan',
        'caption' => 'Galaksi Bima Sakti di Puncak Alpen (Klik untuk Zoom)',
    ],

    // Section 3: Sizing & Aspect Ratio
    'sizing' => [
        'title' => '3. Fleksibilitas Ukuran & Rasio Aspek via Class',
        'desc' => 'Ukuran lebar, tinggi, dan rasio aspek ditentukan bebas menggunakan class utility Tailwind (<code class="text-primary font-mono">aspect-square</code>, <code class="text-primary font-mono">aspect-[21/9]</code>, <code class="text-primary font-mono">size-36</code>, dll.) tanpa dibatasi oleh konfigurasi bawaan.',
        'preview_title' => 'Variasi Bentuk & Rasio',
        'square' => [
            'alt' => 'Foto Kotak',
            'caption' => 'Rasio Kotak 1:1',
        ],
        'portrait' => [
            'alt' => 'Kucing Lucu',
            'caption' => 'Format Portret 3:4',
        ],
        'avatar' => [
            'alt' => 'Foto Profil',
            'caption' => 'Avatar Pengguna — Dapat Diperbesar',
        ],
    ],

    // Section 4: Automatic Gallery Container
    'container' => [
        'title' => '4. Kontainer Galeri Otomatis (vibe:display.image-gallery)',
        'desc' => 'Sangat cocok untuk artikel blog atau konten teks yang merender tag <code class="text-primary font-mono">&lt;img&gt;</code> HTML biasa. Bungkus dengan <code class="text-primary font-mono">&lt;vibe:display.image-gallery&gt;</code>, maka semua gambar di dalamnya otomatis dapat diklik dan terhubung dalam satu navigasi.',
        'preview_title' => 'Pembungkus Gambar Otomatis',
        'bedroom' => [
            'alt' => 'Kamar Tidur Utama',
        ],
        'bathroom' => [
            'alt' => 'Kamar Mandi Minimalis',
        ],
    ],

    // Section 5: Keyboard Shortcuts & Gestures
    'shortcuts' => [
        'title' => '5. Interaksi Pintasan Keyboard & Gestur Layar Sentuh',
        'desc' => 'Modal lightbox dilengkapi dengan navigasi aksesibel yang memanjakan pengguna desktop maupun mobile:',
        'desktop_title' => 'Pintasan Keyboard (Desktop)',
        'desktop_prev' => 'Pindah gambar sebelumnya',
        'desktop_next' => 'Pindah gambar selanjutnya',
        'desktop_close' => 'Tutup modal lightbox',
        'desktop_zoom' => 'Perbesar & Perkecil Zoom',
        'desktop_double_click' => 'Toggle Zoom Cepat',
        'desktop_double_click_key' => 'Double Click',
        'mobile_title' => 'Gestur Layar Sentuh (Mobile)',
        'mobile_swipe_left_label' => 'Geser ke Kiri (Swipe Left)',
        'mobile_swipe_left_val' => 'Gambar Selanjutnya',
        'mobile_swipe_right_label' => 'Geser ke Kanan (Swipe Right)',
        'mobile_swipe_right_val' => 'Gambar Sebelumnya',
        'mobile_swipe_down_label' => 'Tarik ke Bawah (Swipe Down)',
        'mobile_swipe_down_val' => 'Tutup Lightbox',
        'mobile_drag_label' => 'Drag saat diperbesar',
        'mobile_drag_val' => 'Geser posisi detail gambar',
    ],

    // Section 6: Props Table
    'props' => [
        'title' => '6. Referensi Props & Atribut',
        'desc' => 'Parameter atribut yang tersedia pada komponen <code>&lt;vibe:display.image&gt;</code>:',
        'gallery_title' => 'Parameter Kontainer <code>&lt;vibe:display.image-gallery&gt;</code>:',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Bawaan',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'src' => 'Tautan URL atau path gambar yang akan ditampilkan.',
            'alt' => 'Teks alternatif untuk aksesibilitas dan teks caption bawaan pada lightbox.',
            'group' => 'Nama grup galeri untuk merangkai navigasi sebelumnya/selanjutnya (Prev / Next).',
            'caption' => 'Keterangan deskripsi gambar yang ditampilkan di bagian bawah modal lightbox.',
            'standalone' => 'Jika <code>true</code>, gambar dibuka tersendiri tanpa tombol navigasi panah kiri/kanan.',
            'class' => 'Class Tailwind untuk mengatur ukuran (<code>w-*</code>, <code>h-*</code>), rasio aspek (<code>aspect-*</code>), border radius, dan bayangan.',
            'imgClass' => 'Class Tailwind khusus yang diterapkan langsung pada elemen tag <code>&lt;img&gt;</code>.',
            'loading' => 'Mode pemuatan gambar native browser (<code>\'lazy\'</code> atau <code>\'eager\'</code>).',
            'showCaption' => 'Jika <code>true</code>, caption juga akan dirender di bawah thumbnail pada tata letak halaman.',
            'gallery_group' => 'Nama grup galeri untuk semua tag <code>&lt;img&gt;</code> yang dibungkus di dalam kontainer.',
        ],
    ],
];
