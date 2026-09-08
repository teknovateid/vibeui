<?php

return [
    'title' => 'Date & Time Picker',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen pemilih tanggal dan waktu serbaguna dengan dukungan pemilihan tanggal tunggal, rentang tanggal (range), jam & menit (time), pemilihan banyak tanggal (multiple), shortcut preset cepat, fast-jump navigasi tahun/bulan, dan integrasi form Laravel.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar (Single Date)',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:date-time&gt;</code> untuk memilih satu tanggal. Dilengkapi ikon kalender, popover cerdas, dan tombol bersihkan (clearable).',
        'preview_title' => 'Pemilih Tanggal Dasar',
        'birth_label' => 'Tanggal Lahir',
        'birth_placeholder' => 'Pilih tanggal...',
    ],

    'fast_jump' => [
        'title' => 'Navigasi Cepat (Fast-Jump Bulan & Tahun)',
        'desc' => 'Klik pada nama bulan atau angka tahun di header kalender untuk membuka grid pemilihan cepat bulan (Jan–Des) atau dekade tahun. Sangat memudahkan pengisian tanggal lahir atau arsip lampau tanpa harus menekan tombol navigasi berulang kali.',
        'preview_title' => 'Fast-Jump Selector Demo',
    ],

    'range_presets' => [
        'title' => 'Rentang Tanggal (Date Range) & Presets',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="range"</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:presets="true"</code> untuk memilih tanggal mulai dan tanggal selesai dengan tombol pintas lengkap (*Hari Ini, Kemarin, Minggu Ini, Minggu Lalu, 7 & 14 Hari Terakhir, 30 Hari Terakhir, Bulan Ini, Bulan Lalu, 3 Bulan Terakhir, Kuartal Ini & Lalu, Tahun Ini, Tahun Lalu, YTD*), atau cantumkan array preset kustom seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:presets="[\'today\', \'last7Days\', \'thisMonth\']"</code>.',
        'preview_title' => 'Rentang Tanggal dengan Presets',
        'period_label' => 'Periode Laporan Transaksi',
    ],

    'datetime' => [
        'title' => 'Tanggal & Waktu (DateTime)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="datetime"</code> untuk memilih tanggal beserta jam dan menit dalam satu tampilan.',
        'preview_title' => 'Pemilih Tanggal & Waktu',
        'schedule_label' => 'Jadwal Publikasi Konten',
    ],

    'datetime_range' => [
        'title' => 'Rentang Tanggal & Waktu (DateTime Range)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="datetime-range"</code> untuk memilih rentang tanggal lengkap beserta waktu mulai (start time) dan waktu selesai (end time). Sangat ideal untuk reservasi sewa, booking hotel/villa, jadwal event, atau tiket perjalanan.',
        'preview_title' => 'Rentang Tanggal & Jam dengan Dual Time',
        'event_period_label' => 'Periode Pelaksanaan Acara & Sewa',
    ],

    'time_only' => [
        'title' => 'Waktu Saja (Time Picker)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="time"</code> untuk memilih jam dan menit. Mendukung format 24 jam (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:time24="true"</code>) atau format 12 jam dengan switch AM/PM.',
        'preview_title' => 'Pemilih Waktu (24 Jam & 12 Jam)',
        'opening_label' => 'Jam Buka Toko (24h)',
        'closing_label' => 'Jam Tutup Toko (12h AM/PM)',
    ],

    'time_range' => [
        'title' => 'Rentang Waktu (Time Range)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="time-range"</code> untuk memilih rentang jam (waktu mulai dan selesai) tanpa kalender tanggal. Sangat praktis untuk jam operasional toko, shift kerja karyawan, atau durasi konsultasi.',
        'preview_title' => 'Rentang Waktu / Jam Kerja',
        'shift_label' => 'Shift Kerja Kantor',
    ],

    'multiple' => [
        'title' => 'Banyak Tanggal (Multiple Dates)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type="multiple"</code> untuk memilih beberapa tanggal acak yang tidak berurutan, cocok untuk pemilihan hari libur atau jadwal piket.',
        'preview_title' => 'Pemilih Banyak Tanggal',
        'holidays_label' => 'Pilih Tanggal Cuti Bersama',
    ],

    'inline' => [
        'title' => 'Kalender Tertanam (Inline Mode) & Event Markers',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:inline="true"</code> untuk menampilkan kalender langsung pada halaman tanpa popover. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:markers="[...]"</code> untuk menampilkan titik indikator acara pada tanggal tertentu.',
        'preview_title' => 'Kalender Inline dengan Penanda Event',
    ],

    'props' => [
        'title' => 'Referensi Props',
        'desc' => 'Daftar konfigurasi atribut yang didukung oleh komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:date-time&gt;</code>.',
        'columns' => [
            'prop' => 'Prop / Atribut',
            'type' => 'Tipe Data',
            'default' => 'Default',
            'desc' => 'Keterangan',
        ],
    ],
];
