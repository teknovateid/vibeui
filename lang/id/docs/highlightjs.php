<?php

return [
    'title' => 'Highlight.js',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen penyorot sintaks kode (code syntax highlighter) berkinerja tinggi berbasis Highlight.js. Mendukung deteksi bahasa cerdas (otomatis mendeteksi perintah terminal Bash dan sintaks Blade), penomoran baris, tombol salin ke clipboard interaktif, judul file atau terminal, pembatasan tinggi scrollable, dan perapian indentasi otomatis.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:highlightjs&gt;</code> dengan menentukan atribut <code class="font-mono text-xs text-foreground">language</code> (misalnya <code class="font-mono text-xs text-foreground">php</code>, <code class="font-mono text-xs text-foreground">javascript</code>, <code class="font-mono text-xs text-foreground">blade</code>, <code class="font-mono text-xs text-foreground">css</code>). Kode dapat dituliskan langsung di dalam slot komponen atau melalui prop <code class="font-mono text-xs text-foreground">code</code>.',
        'preview_title' => 'Contoh Penyorotan Sintaks PHP & JavaScript',
    ],

    // Section 2: Titles & Terminal Commands
    'titles_terminal' => [
        'title' => 'Nama File & Deteksi Otomatis Terminal (Bash)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">title</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">filename</code> untuk menampilkan path file di header. Jika kode diawali perintah CLI seperti <code class="font-mono text-xs text-foreground">php artisan</code>, <code class="font-mono text-xs text-foreground">npm</code>, <code class="font-mono text-xs text-foreground">composer</code>, atau <code class="font-mono text-xs text-foreground">git</code>, komponen secara cerdas mengenali bahasa sebagai <strong>Bash</strong>, memasang ikon terminal, dan memberi judul <strong>Terminal</strong> secara otomatis.',
        'preview_title' => 'Blok File Kode & Perintah Terminal Otomatis',
    ],

    // Section 3: Line Numbers
    'line_numbers' => [
        'title' => 'Penomoran Baris (line-numbers)',
        'desc' => 'Tambahkan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">line-numbers</code> (atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lines</code>) untuk menampilkan kolom nomor baris di sisi kiri. Nomor baris dibuat tidak dapat diseleksi (*unselectable*) agar tidak ikut terarsir saat pengguna menyalin teks secara manual.',
        'preview_title' => 'Blok Kode dengan Nomor Baris',
    ],

    // Section 4: Copy Button & Badges
    'copy_and_badges' => [
        'title' => 'Tombol Salin & Kustomisasi Badge',
        'desc' => 'Tombol salin ke clipboard aktif secara default (<code class="font-mono text-xs text-foreground">:copyable="true"</code>) dengan umpan balik animasi centang sukses. Jika header dinonaktifkan dengan <code class="font-mono text-xs text-foreground">:header="false"</code>, tombol salin akan tampil melayang (*floating*) di pojok kanan atas. Anda juga dapat mengganti teks badge bahasa dengan teks kustom melalui prop <code class="font-mono text-xs text-foreground">badge</code>.',
        'preview_title' => 'Tombol Salin Melayang & Badge Kustom',
    ],

    // Section 5: Height & Wrapping
    'height_wrap' => [
        'title' => 'Batasan Tinggi (max-height) & Word Wrap',
        'desc' => 'Untuk kode atau log yang sangat panjang, atur batas tinggi menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-height="220"</code> sehingga kontainer memiliki scroll vertikal mandiri. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wrap</code> jika Anda ingin baris panjang berpindah ke baris baru (*word-wrap*) alih-alih memunculkan scroll horizontal.',
        'preview_title' => 'Kode Scrollable dengan Batas Maksimal Tinggi',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Referensi Props & Parameter',
        'desc' => 'Daftar atribut dan konfigurasi yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:highlightjs&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'features' => [
        'title' => 'Fitur Otomatisasi Cerdas',
        'columns' => [
            'feature' => 'Fitur Otomatis',
            'desc' => 'Perilaku & Mekanisme',
        ],
    ],

    'props_items' => [
        'code' => 'String kode yang ingin disorot. Jika tidak diisi, komponen akan menggunakan isi `$slot`.',
        'language' => 'Bahasa pemrograman (e.g. `php`, `javascript`, `blade`, `bash`, `html`, `css`, `json`, `sql`).',
        'title' => 'Judul atau nama file yang ditampilkan di bilah header atas.',
        'copyable' => 'Menampilkan tombol interaktif salin kode ke clipboard dengan umpan balik visual.',
        'lineNumbers' => 'Menampilkan penomoran baris unselectable di sisi kiri blok kode.',
        'badge' => 'Menampilkan badge bahasa di header. Dapat diisi string kustom untuk teks label badge khusus.',
        'header' => 'Menampilkan bilah header atas. Jika `false`, tombol salin akan tampil melayang di pojok kanan.',
        'maxHeight' => 'Batasan tinggi vertikal maksimal (misal `220` atau `"300px"`).',
        'wrap' => 'Jika `true`, menerapkan word-wrap pada baris kode panjang alih-alih scroll horizontal.',
        'theme' => 'Skema tema warna Highlight.js (default: `vibe`).',
    ],
];
