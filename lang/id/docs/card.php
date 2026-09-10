<?php

return [
    'title' => 'Card',
    'badge' => 'Komponen',
    'group' => 'Layout & Container',
    'description' => 'Komponen kartu serbaguna untuk mengelompokkan konten terkait, metrik analitik, formulir, atau aksi dengan tampilan konsisten, dukungan varian visual (default, outline, flat, elevated, ghost), fleksibilitas padding, dan subkomponen modular (header, title, description, content, footer).',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> sebagai pembungkus kontainer utama. Secara default, kartu memiliki sudut membulat (<code class="font-mono text-xs text-foreground">rounded-xl</code>), border halus, bayangan 2xs, dan padding interior standar.',
        'preview_title' => 'Kartu Dasar',
        'sample_title' => 'Ringkasan Akun',
        'sample_desc' => 'Informasi umum mengenai status keanggotaan dan preferensi akun Anda saat ini.',
        'sample_body' => 'Paket Anda saat ini adalah Pro Plan dengan masa aktif hingga Desember 2026. Semua fitur unggulan telah diaktifkan.',
    ],

    // Section 2: Structured Card (Header, Content, Footer)
    'structured' => [
        'title' => 'Struktur Modular (Header, Content & Footer)',
        'desc' => 'Untuk tata letak yang rapi dan semantik, manfaatkan subkomponen modular: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.header&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.title&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.description&gt;</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.content&gt;</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card.footer&gt;</code>.',
        'preview_title' => 'Kartu dengan Subkomponen Lengkap',
        'title_text' => 'Notifikasi Keamanan',
        'desc_text' => 'Kelola preferensi autentikasi dua faktor dan peringatan aktivitas masuk.',
        'content_text' => 'Autentikasi dua faktor (2FA) saat ini telah aktif menggunakan aplikasi authenticator. Sesi masuk baru dari perangkat yang belum dikenali akan membutuhkan verifikasi kode OTP 6 digit.',
        'footer_action' => 'Kelola 2FA',
        'footer_cancel' => 'Pelajari Selengkapnya',
    ],

    // Section 3: Variants
    'variants' => [
        'title' => 'Varian Visual (Variants)',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol gaya tampilan kartu: <code class="font-mono text-xs text-foreground">default</code>, <code class="font-mono text-xs text-foreground">outline</code>, <code class="font-mono text-xs text-foreground">flat</code>, <code class="font-mono text-xs text-foreground">elevated</code>, dan <code class="font-mono text-xs text-foreground">ghost</code>.',
        'preview_title' => 'Pilihan Varian Kartu',
        'default' => 'Default (Border & Bayangan Halus)',
        'outline' => 'Outline (Border Bersih & Transparan)',
        'flat' => 'Flat (Background Muted Tanpa Border)',
        'elevated' => 'Elevated (Bayangan Lebih Tegas)',
        'ghost' => 'Ghost (Transparan Sepenuhnya)',
    ],

    // Section 4: Padding
    'padding' => [
        'title' => 'Pengaturan Padding (padding)',
        'desc' => 'Secara default kartu memiliki padding <code class="font-mono text-xs text-foreground">p-6</code>. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">padding="none"</code> (atau <code class="font-mono text-xs text-foreground">"sm"</code>, <code class="font-mono text-xs text-foreground">"lg"</code>, <code class="font-mono text-xs text-foreground">"xl"</code>) saat membuat tata letak tabel penuh atau gambar banner tanpa jarak tepi.',
        'preview_title' => 'Kartu Tanpa Padding (Edge-to-Edge)',
        'banner_title' => 'Pembaruan Sistem v2.4 Rilis',
        'banner_desc' => 'Fitur dashboard analitik real-time dan peningkatan performa query telah tersedia.',
        'read_more' => 'Baca Catatan Rilis',
    ],

    // Section 5: Stat & Metric Cards
    'metrics' => [
        'title' => 'Kartu Metrik & Statistik',
        'desc' => 'Kombinasikan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> dengan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:badge&gt;</code> untuk menyusun kartu dashboard analitik yang informatif dan modern.',
        'preview_title' => 'Kartu Dashboard & KPI',
        'total_revenue' => 'Total Pendapatan',
        'revenue_val' => 'Rp 148.520.000',
        'active_users' => 'Pengguna Aktif',
        'users_val' => '24.890',
        'conversion_rate' => 'Tingkat Konversi',
        'conversion_val' => '4.85%',
        'growth_revenue' => '+18.2% bln ini',
        'growth_users' => '+8.4% bln ini',
        'growth_conversion' => '+1.2% bln ini',
    ],

    // Section 6: Props & Slots
    'props' => [
        'title' => 'Referensi Props & Subkomponen',
        'desc' => 'Daftar lengkap atribut prop dan subkomponen yang dapat digunakan pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'slots' => [
        'title' => 'Slot yang Tersedia',
        'columns' => [
            'slot' => 'Slot / Komponen',
            'desc' => 'Deskripsi & Kegunaan',
        ],
    ],

    'variants_items' => [
        'flat_desc' => 'Latar belakang lembut tanpa garis tepi.',
        'elevated_desc' => 'Bayangan medium untuk kartu fokus.',
        'ghost_desc' => 'Transparan sepenuhnya tanpa garis.',
    ],

    'props_items' => [
        'variant' => "Gaya visual kartu: `'default'`, `'outline'`, `'flat'`, `'elevated'`, atau `'ghost'`.",
        'padding' => "Ukuran padding internal: `'none'` (p-0), `'sm'` (p-4), `'lg'` (p-8), `'xl'` (p-10), atau angka kustom. Default: `p-6`.",
    ],

    'slots_items' => [
        'header' => 'Kontainer header kartu dengan tata letak flex vertikal dan jarak bottom bawaan.',
        'title' => 'Elemen judul semantik kartu (<code class="font-mono text-xs text-foreground">&lt;h3&gt;</code>) dengan typography tebal dan rapat.',
        'description' => 'Elemen deskripsi pendukung judul kartu dengan teks muted.',
        'content' => 'Kontainer pembungkus isi konten utama kartu.',
        'footer' => 'Bagian footer kartu yang dilengkapi garis pemisah atas dan penyusunan tombol aksi.',
    ],
];
