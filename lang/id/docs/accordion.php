<?php

return [
    'title' => 'Accordion',
    'description' => 'Komponen disclosure interaktif untuk menampilkan dan melipat bagian konten informasi secara terstruktur. Sangat cocok untuk daftar FAQ, panel navigasi, ringkasan fitur, atau formulir bertahap.',
    'badge' => 'Disclosure & Collapse',
    'group' => 'Komponen / Interaktif',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion&gt;</code> dengan pembungkus <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion.item&gt;</code>. Anda dapat menggunakan prop ringkas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">title="..."</code> untuk kemudahan dan kecepatan penulisan, atau menyusun elemen kustom menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion.heading&gt;</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion.content&gt;</code>.',
        'preview_title' => 'Accordion Dasar (FAQ)',
        'q1_title' => 'Apa itu Vibe UI?',
        'q1_desc' => 'Vibe UI adalah library antarmuka modern untuk ekosistem Laravel dan Tailwind CSS v4 yang terinspirasi dari Flux UI dan Shadcn UI. Menyediakan pengalaman pengembangan yang elegan, cepat, dan sepenuhnya reaktif.',
        'q2_title' => 'Apakah mendukung mode gelap (Dark Mode)?',
        'q2_desc' => 'Tentu saja! Seluruh komponen Vibe UI dibangun dengan dukungan mode gelap kelas satu secara otomatis mengikuti preferensi sistem atau tema yang dipilih pengguna.',
        'q3_title' => 'Bagaimana cara instalasi dan dependensinya?',
        'q3_desc' => 'Vibe UI mengandalkan Tailwind CSS v4 dan Alpine.js untuk interaktivitas animasi lipat (x-collapse), tanpa memerlukan bundle runtime JavaScript yang berat.',
    ],

    'types' => [
        'title' => 'Mode Buka: Single vs Multiple',
        'desc' => 'Secara bawaan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="single"</code> hanya memperbolehkan satu panel yang terbuka dalam satu waktu (panel lain otomatis tertutup saat panel baru dibuka). Atur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="multiple"</code> jika ingin pengguna dapat membuka beberapa panel sekaligus.',
        'preview_title' => 'Multiple Panels Expansion',
        'multi_q1' => 'Pengaturan Keamanan Akun',
        'multi_q1_desc' => 'Kelola autentikasi dua faktor (2FA), log sesi aktif, dan pemulihan kunci cadangan untuk menjaga keamanan akun Anda.',
        'multi_q2' => 'Preferensi Notifikasi & Email',
        'multi_q2_desc' => 'Pilih jenis pembaruan yang ingin Anda terima melalui email harian, notifikasi push web, atau ringkasan mingguan.',
        'multi_q3' => 'Integrasi API & Webhook',
        'multi_q3_desc' => 'Hubungkan aplikasi Anda ke endpoint webhook kustom dan integrasi layanan pihak ketiga seperti Slack dan GitHub.',
    ],

    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Pilih varian tampilan yang paling cocok dengan gaya antarmuka Anda: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> (border pembatas standar), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">separated</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">card</code> (tiap item adalah kartu terpisah dengan elevasi halus), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">flush</code> (garis pembatas minimalis tanpa border container luar), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">filled</code> / <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">muted</code> (latar belakang lembut).',
        'preview_title' => 'Varian Kartu Terpisah (Separated / Card)',
        'card_q1' => 'Dukungan Pelanggan Prioritas 24/7',
        'card_q1_desc' => 'Dapatkan akses langsung ke tim teknis senior kami melalui obrolan langsung dan saluran telepon prioritas kapan saja.',
        'card_q2' => 'Jaminan Ketersediaan Layanan (99.9% SLA)',
        'card_q2_desc' => 'Infrastruktur cloud berstandar tinggi yang didukung redundansi multi-region untuk memastikan aplikasi Anda selalu online.',
        'card_q3' => 'Pencadangan Otomatis Real-time',
        'card_q3_desc' => 'Seluruh data dan aset aplikasi Anda dicadangkan secara berkala setiap jam dengan retensi arsip hingga 90 hari.',
    ],

    'flush' => [
        'title' => 'Varian Flush (Minimalis)',
        'desc' => 'Varian <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="flush"</code> meniadakan border luar dan bayangan, hanya mempertahankan garis tipis pembatas antar item. Sangat serasi saat disematkan di dalam card, modal, atau layout dokumen bersih.',
        'preview_title' => 'Varian Flush Borderless',
    ],

    'sizes' => [
        'title' => 'Pilihan Ukuran (Sizes)',
        'desc' => 'Tersedia ukuran <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (default), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> yang menyesuaikan ukuran teks, padding tombol, dan proporsi panah chevron.',
        'preview_title' => 'Perbandingan Ukuran',
        'size_sm' => 'Ukuran Small (sm)',
        'size_md' => 'Ukuran Medium (md - default)',
        'size_lg' => 'Ukuran Large (lg)',
        'sample_content' => 'Konten penjelasan singkat dengan tipografi yang telah disesuaikan secara proporsional.',
    ],

    'icons_badges' => [
        'title' => 'Icon, Badge & Subtitle',
        'desc' => 'Perkaya setiap judul accordion dengan leading icon, badge status, dan subtitle penjelas untuk memberikan konteks visual yang lebih kaya kepada pengguna.',
        'preview_title' => 'Accordion dengan Icon & Badge',
        'billing_title' => 'Metode Pembayaran & Faktur',
        'billing_sub' => 'Kelola kartu kredit dan riwayat invoice',
        'billing_desc' => 'Anda dapat memperbarui rincian kartu kredit, mengunduh salinan faktur pajak PDF, dan mengatur alamat penagihan perusahaan.',
        'team_title' => 'Manajemen Anggota Tim',
        'team_sub' => 'Hak akses dan peran kolaborator',
        'team_desc' => 'Undang rekan kerja ke workspace Anda dan tetapkan peran granular seperti Administrator, Editor, atau Viewer.',
        'api_title' => 'Kunci API Produksi',
        'api_sub' => 'Kunci otorisasi webhook & integrasi',
        'api_desc' => 'Gunakan API key ini untuk mengautentikasi setiap permintaan HTTP ke endpoint REST API Vibe UI.',
    ],

    'chevron' => [
        'title' => 'Kustomisasi Chevron',
        'desc' => 'Atur posisi panah chevron menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">chevronPosition="left"</code> atau sembunyikan sepenuhnya menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:chevron="false"</code>.',
        'preview_title' => 'Chevron di Sisi Kiri',
        'q1' => 'Chevron di sebelah kiri judul',
        'q1_desc' => 'Tata letak panah di sisi kiri memberikan nuansa navigasi direktori pohon (tree navigation) yang rapi.',
    ],

    'collapsible' => [
        'title' => 'Batas Selalu Terbuka (collapsible="false")',
        'desc' => 'Pada mode single, secara bawaan pengguna dapat mengklik item yang sedang aktif untuk menutupnya. Jika Anda mengatur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:collapsible="false"</code>, maka setidaknya satu item akan selalu tetap terbuka.',
        'preview_title' => 'Selalu Ada Satu Item Terbuka',
    ],

    'disabled' => [
        'title' => 'Status Nonaktif (Disabled)',
        'desc' => 'Nonaktifkan interaksi pada satu item tertentu dengan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:disabled="true"</code> pada item, atau kunci seluruh accordion secara global pada root <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion :disabled="true"&gt;</code>.',
        'preview_title' => 'Item Accordion Nonaktif',
        'active_item' => 'Item Aktif yang Dapat Dibuka',
        'active_desc' => 'Item ini normal dan dapat diklik secara leluasa.',
        'disabled_item' => 'Item Terkunci (Fitur Paket Enterprise)',
        'disabled_desc' => 'Item ini tidak dapat dibuka karena memerlukan izin akses lebih lanjut.',
    ],

    'props' => [
        'title' => 'Referensi Props Lengkap',
        'desc' => 'Daftar konfigurasi atribut dan prop yang didukung oleh komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:accordion&gt;</code> dan sub-komponennya.',
        'columns' => [
            'prop' => 'Prop / Atribut',
            'type' => 'Tipe Data',
            'default' => 'Default',
            'desc' => 'Keterangan',
        ],
        'items' => [
            'type' => 'Mode ekspansi panel: `"single"` (satu item terbuka) atau `"multiple"` (banyak item terbuka sekaligus).',
            'collapsible' => 'Pada mode single, menentukan apakah item yang aktif dapat ditutup kembali (default `true`).',
            'selected' => 'Nilai `value` item yang terbuka di awal (string untuk single, array untuk multiple).',
            'value' => 'Alias untuk `selected`.',
            'default' => 'Alias untuk `selected`.',
            'variant' => 'Varian visual: `"default"`, `"separated"` / `"card"`, `"flush"`, `"filled"` / `"muted"`.',
            'size' => 'Ukuran komponen: `"sm"`, `"md"` (default), atau `"lg"`.',
            'chevron' => 'Menampilkan animasi panah chevron (default `true`).',
            'chevronPosition' => 'Posisi chevron: `"right"` (default) atau `"left"`.',
            'disabled' => 'Menonaktifkan interaksi pada seluruh accordion atau item individu.',
            'item_value' => 'Identifikator unik untuk setiap item accordion (otomatis di-generate jika kosong).',
            'item_title' => 'Sintaks ringkas judul heading item accordion.',
            'item_subtitle' => 'Teks keterangan tambahan kecil di bawah judul heading.',
            'item_icon' => 'Icon di sisi kiri heading (mendukung string SVG atau slot `#icon`).',
            'item_badge' => 'Teks badge label status di samping judul heading.',
            'item_open' => 'Menandai item ini langsung terbuka saat render awal (boolean).',
        ],
    ],
];
