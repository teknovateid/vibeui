<?php

return [
    'title' => 'Image',
    'badge' => 'Komponen',
    'group' => 'Komponen Media & Tampilan',
    'description' => 'Komponen gambar semantik berbasis figure dan img yang dioptimalkan untuk performa web modern. Dilengkapi efek animasi shimmer skeleton pemuat awal untuk mencegah pergeseran tata letak (Cumulative Layout Shift / CLS), dukungan lazy loading native, optimasi LCP hero image via rel="preload", penanganan gambar rusak (fallback inisial, placeholder bawaan, dan URL cadangan), keterangan caption otomatis, rasio aspek fleksibel via utility class Tailwind, serta fitur detail modal zoom/lightbox dan navigasi galeri grup terintegrasi.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:image&gt;</code> dengan memberikan prop <code class="font-mono text-xs text-foreground">src</code> dan <code class="font-mono text-xs text-foreground">alt</code>. Komponen secara otomatis membungkus gambar dengan tag semantik <code class="font-mono text-xs text-foreground">&lt;figure&gt;</code> serta menerapkan transisi fade-in halus saat gambar selesai dimuat.',
        'preview_title' => 'Contoh Tampilan Gambar Standar',
        'alt_text' => 'Pemandangan alam pegunungan berkabut',
    ],

    // Section 2: Shimmer Skeleton
    'skeleton' => [
        'title' => 'Animasi Shimmer Skeleton (Pencegahan CLS)',
        'desc' => 'Secara default, prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">skeleton="true"</code> aktif. Komponen menampilkan placeholder berdenyut (*shimmer pulse*) seukuran kontainer selama gambar diunduh oleh browser, sehingga mencegah pergeseran layout mendadak (*Cumulative Layout Shift*). Anda dapat menonaktifkannya dengan <code class="font-mono text-xs text-foreground">:skeleton="false"</code>.',
        'preview_title' => 'Gambar dengan Shimmer Skeleton Aktif',
        'alt_text' => 'Arsitektur modern minimalis',
    ],

    // Section 3: LCP & Priority
    'priority' => [
        'title' => 'Optimasi LCP & Prioritas Tinggi (priority)',
        'desc' => 'Untuk gambar utama di atas lipatan layar (*above-the-fold*) seperti banner hero landing page, gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">priority="true"</code>. Komponen akan otomatis menyisipkan tag <code class="font-mono text-xs text-foreground">&lt;link rel="preload" as="image"&gt;</code> ke dalam tag <code class="font-mono text-xs text-foreground">&lt;head&gt;</code>, menonaktifkan lazy loading, dan mengatur <code class="font-mono text-xs text-foreground">fetchpriority="high"</code> untuk skor Web Vitals (LCP) terbaik.',
        'preview_title' => 'Banner Utama dengan Prioritas Preload Tinggi',
        'alt_text' => 'Hero banner workstation kerja produktif',
        'caption' => 'Hero Banner: Dimuat seketika dengan fetchpriority="high" dan preload head otomatis.',
    ],

    // Section 4: Fallback & Broken Image
    'fallback' => [
        'title' => 'Penanganan Gambar Rusak & Fallback Otomatis',
        'desc' => 'Jika URL gambar mengalami galat (404 atau jaringan terputus), komponen otomatis menangani event error tanpa merusak layout. Anda dapat menentukan fallback otomatis menggunakan inisial dengan atribut <code class="font-mono text-xs text-foreground">initials</code> atau <code class="font-mono text-xs text-foreground">name</code> (mirip komponen <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code>) dengan kustomisasi warna latar via class Tailwind, URL gambar cadangan via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">fallback</code>, atau membiarkannya menampilkan UI placeholder SVG bawaan.',
        'preview_title' => 'Status Gambar Gagal Dimuat & Ragam Fallback',
        'broken_label' => 'Placeholder SVG Bawaan (Otomatis)',
        'initials_label' => 'Fallback Inisial (Warna via Class)',
        'name_label' => 'Inisial Otomatis dari Prop name',
        'fallback_label' => 'Gambar Cadangan Pengganti (URL)',
        'broken_alt' => 'Gambar produk tidak ditemukan',
        'custom_url_alt' => 'Gambar fallback karya seni abstrak',
    ],

    // Section 5: Detail & Zoom Lightbox
    'lightbox' => [
        'title' => 'Detail Gambar & Modal Zoom (Lightbox)',
        'desc' => 'Cukup tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">zoom</code> atau <code class="font-mono text-xs text-foreground">preview</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code> untuk mengubah gambar menjadi pemicu modal pratinjau interaktif. Pengguna dapat memperbesar/memperkecil gambar (hingga 300%), menggeser (pan & drag), mengunduh gambar asli, dan menutup menggunakan tombol <kbd class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono border border-border">Esc</kbd>. Anda juga dapat memberikan resolusi gambar lebih tinggi untuk modal via <code class="font-mono text-xs text-foreground">previewSrc="..."</code>.',
        'preview_title' => 'Gambar Interaktif dengan Fitur Zoom & Modal Detail',
        'single_label' => 'Klik untuk Membuka Detail Gambar (Zoom)',
        'hd_label' => 'Thumbnail Cepat + Preview Resolusi Tinggi (previewSrc)',
        'standalone_label' => 'Pratinjau Mandiri (standalone)',
    ],

    // Section 6: Image Gallery & Groups
    'gallery' => [
        'title' => 'Galeri Gambar & Navigasi Grup (group & gallery)',
        'desc' => 'Hubungkan beberapa gambar ke dalam satu navigasi galeri interaktif dengan menyematkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">group="nama-grup"</code> langsung pada masing-masing <code class="font-mono text-xs text-foreground">&lt;vibe:image zoom&gt;</code>, atau bungkus kumpulan gambar dengan kontainer helper <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:image.gallery&gt;</code>. Modal lightbox otomatis menyediakan tombol Sebelumnya/Selanjutnya, navigasi keyboard panah kiri/kanan, dan gestur swipe pada perangkat layar sentuh.',
        'preview_title' => 'Galeri Terhubung dengan Kontrol Navigasi & Counter',
        'room_1' => 'Interior Ruang Tamu Modern',
        'room_2' => 'Kamar Tidur Minimalis Skandinavia',
        'room_3' => 'Dapur Bersih & Area Makan',
        'room_4' => 'Balkon Santai dengan Tanaman Hias',
    ],

    // Section 7: Aspect Ratios
    'aspect_ratios' => [
        'title' => 'Rasio Aspek Fleksibel via Utility Class',
        'desc' => 'Terapkan rasio aspek langsung menggunakan utility class Tailwind pada atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="..."</code> (seperti <code class="font-mono text-xs text-foreground">class="aspect-video"</code>, <code class="font-mono text-xs text-foreground">class="aspect-square"</code>, <code class="font-mono text-xs text-foreground">class="aspect-[4/3]"</code>, <code class="font-mono text-xs text-foreground">class="aspect-[21/9]"</code>, hingga breakpoint responsif seperti <code class="font-mono text-xs text-foreground">sm:aspect-video</code>). Komponen secara cerdas mengekstrak rasio aspek ke kontainer gambar internal sehingga rasio tetap presisi dan teks <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code> tidak terdistorsi.',
        'preview_title' => 'Variasi Rasio Aspek Bebas via Class Utility',
        'ratio_16_9' => 'Rasio 16:9 (class="aspect-video")',
        'ratio_1_1' => 'Rasio 1:1 (class="aspect-square")',
        'ratio_4_3' => 'Rasio 4:3 (class="aspect-4/3")',
        'ratio_21_9' => 'Rasio 21:9 Ultrawide (class="aspect-21/9")',
    ],

    // Section 8: Caption
    'caption' => [
        'title' => 'Keterangan Gambar (caption / figcaption)',
        'desc' => 'Tambahkan teks penjelasan di bawah gambar menggunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">caption="..."</code> atau sematkan konten bebas di dalam <code class="font-mono text-xs text-foreground">$slot</code> komponen. Teks akan dirender secara semantik di dalam tag <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code>.',
        'preview_title' => 'Gambar dengan Figcaption Semantik',
        'caption_text' => 'Foto dokumentasi peluncuran sistem Vibe UI generasi terbaru oleh tim Teknovate.',
        'slot_title' => 'Dokumentasi Tim Desain',
        'slot_tag' => 'Resolusi Tinggi',
        'slot_link' => 'Unduh Gambar Asli &rarr;',
    ],

    // Section 9: Image Styling & Object Fit
    'styling' => [
        'title' => 'Kustomisasi Tampilan & Object Fit (imgClass)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">imgClass="..."</code> untuk mengontrol elemen <code class="font-mono text-xs text-foreground">&lt;img&gt;</code> internal, seperti <code class="font-mono text-xs text-foreground">object-contain</code>, efek perbesaran saat hover (*hover zoom*), atau filter visual lainnya.',
        'preview_title' => 'Object Fit & Efek Interaktif Gambar',
        'cover_label' => 'Object Cover (Default)',
        'contain_label' => 'Object Contain dengan Background',
        'zoom_label' => 'Efek Hover Zoom Interaktif',
        'filter_label' => 'Filter Monokrom (Grayscale Hover)',
    ],

    // Section 10: Compositions
    'compositions' => [
        'title' => 'Pola Integrasi & Komposisi Nyata',
        'desc' => 'Komponen <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code> sangat mudah dipadukan dengan komponen Vibe UI lainnya seperti Card, Badge, dan Button untuk membuat kartu artikel blog, kartu katalog produk, maupun profil pengguna.',
        'preview_title' => 'Komposisi Kartu Artikel & Kartu Profil Pengguna',
        'blog_card_category' => 'Pengembangan Web',
        'blog_card_date' => '26 Okt 2026',
        'blog_card_title' => 'Membangun Antarmuka Modern & Cepat dengan Vibe UI',
        'blog_card_desc' => 'Panduan komprehensif mengoptimalkan Core Web Vitals dan kecepatan rendering gambar dengan Laravel Blade.',
        'blog_card_btn' => 'Baca Selengkapnya',
        'profile_card_name' => 'Dr. Jessica Melinda',
        'profile_card_role' => 'Principal Product Designer',
        'profile_card_btn' => 'Lihat Profil',
    ],

    // Section 11: Best Practices
    'best_practices' => [
        'title' => 'Panduan Kinerja Web Vitals & Aksesibilitas',
        'desc' => 'Tips penting untuk memaksimalkan performa dan standar aksesibilitas gambar pada aplikasi web Anda:',
        'lcp_title' => '1. Kapan Harus Menggunakan priority="true"?',
        'lcp_desc' => 'Gunakan <code class="font-mono text-xs text-foreground">priority="true"</code> hanya pada 1 gambar terbesar yang langsung terlihat saat halaman dimuat (hero banner / LCP element). Jangan gunakan pada semua gambar karena akan membebani bandwidth jaringan awal.',
        'cls_title' => '2. Selalu Berikan Rasio Aspek atau Ukuran Pasti',
        'cls_desc' => 'Gunakan class seperti <code class="font-mono text-xs text-foreground">aspect-video</code>, <code class="font-mono text-xs text-foreground">aspect-square</code>, atau <code class="font-mono text-xs text-foreground">size-16</code> agar browser dapat memesan ruang layout sebelum gambar selesai diunduh.',
        'a11y_title' => '3. Teks Alternatif (alt) yang Deskriptif',
        'a11y_desc' => 'Selalu isi atribut <code class="font-mono text-xs text-foreground">alt</code> dengan deskripsi informatif untuk pembaca layar (*screen readers*) tuna netra dan SEO mesin pencari.',
    ],

    // Section 12: Props & Slots Reference
    'props' => [
        'title' => 'Referensi Props & Parameter',
        'desc' => 'Daftar atribut dan konfigurasi lengkap yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code> dan <code class="font-mono text-xs text-foreground">&lt;vibe:image.gallery&gt;</code>.',
        'gallery_title' => 'Props <vibe:image.gallery>',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'slots' => [
        'title' => 'Referensi Slot',
        'desc' => 'Slot konten yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:image&gt;</code>.',
        'columns' => [
            'slot' => 'Slot',
            'desc' => 'Deskripsi & Kegunaan',
        ],
        'default_desc' => 'Slot konten utama yang dirender sebagai keterangan semantik di dalam elemen <code class="font-mono text-xs text-foreground">&lt;figcaption&gt;</code> di bawah gambar. Berguna saat membutuhkan format HTML kustom (tautan, ikon, badge).',
    ],

    'props_items' => [
        'src' => 'URL sumber file gambar yang ingin ditampilkan. Opsional jika menggunakan inisial atau placeholder bawaan.',
        'alt' => 'Teks alternatif gambar untuk aksesibilitas pembaca layar dan fallback SEO.',
        'name' => 'Nama lengkap untuk mengekstrak inisial secara otomatis jika atribut `initials` tidak didefinisikan (mirip `<vibe:avatar>`).',
        'initials' => 'Teks inisial (misal: `"JD"`) yang otomatis ditampilkan sebagai fallback saat gambar galat atau saat tidak ada atribut `src`.',
        'fallback' => 'Gambar pengganti jika gambar utama gagal dimuat (bawaan: `asset("vibe/images/not-found.png")`). Dapat diisi URL gambar kustom, `"placeholder"` (SVG), `"initials"`, atau `:fallback="false"` untuk menonaktifkannya.',
        'lazy' => 'Mengaktifkan pemuatan tunda native browser (`loading="lazy"` dan `fetchpriority="low"`).',
        'priority' => 'Jika `true`, menonaktifkan lazy loading, menyetel `fetchpriority="high"`, dan menginjeksi tag `&lt;link rel="preload"&gt;` ke `&lt;head&gt;`.',
        'skeleton' => 'Menampilkan animasi placeholder shimmer pulse saat gambar sedang diunduh untuk mencegah pergeseran layout (CLS).',
        'caption' => 'Teks keterangan gambar yang dirender di dalam tag semantik `&lt;figcaption&gt;`.',
        'zoom' => 'Jika `true`, mengaktifkan fitur modal detail gambar (zoom lightbox) saat gambar diklik.',
        'preview' => 'Alias alternatif untuk prop `zoom`.',
        'previewSrc' => 'URL gambar resolusi tinggi opsional yang dibuka di modal detail lightbox (jika thumbnail menggunakan versi kompresi).',
        'group' => 'Nama pengenal grup galeri untuk menghubungkan navigasi Sebelumnya/Selanjutnya antar gambar.',
        'standalone' => 'Jika `true`, memaksa gambar berdiri sendiri tanpa navigasi grup meskipun memiliki atribut group atau berada di dalam galeri.',
        'zoomIcon' => 'Jika `true`, menampilkan overlay ikon kaca pembesar lembut (*zoom badge*) saat kursor diarahkan ke gambar.',
        'initialsClass' => 'Kelas Tailwind khusus untuk mengontrol tipografi teks inisial pada fallback.',
        'imgClass' => 'Kelas Tailwind yang diterapkan langsung pada elemen `&lt;img&gt;` internal (misal: `object-contain`, `scale-105`, `grayscale`).',
        'class' => 'Kelas Tailwind umum pada tag `<figure>` pembungkus (misal ukuran, margin, border, rounded, rasio aspek `aspect-*`, serta warna latar `bg-*` dan teks `text-*`).',
        'gallery_group' => 'Nama pengenal grup default untuk semua gambar yang berada di dalam kontainer galeri.',
    ],
];
