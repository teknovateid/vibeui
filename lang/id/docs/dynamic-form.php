<?php

return [
    'title' => 'Dynamic Form',
    'badge' => 'Form Repeater',
    'group' => 'Komponen Form',
    'description' => 'Komponen input form dinamis (repeater) untuk menambah, menghapus, menyalin, dan mengurutkan baris input secara interaktif. Mendukung integrasi mulus dengan input, select, date-time, textarea, dan mode Blade @foreach.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar (Card Variant)',
        'desc' => 'Gunakan tag <code>&lt;vibe:dynamic-form&gt;</code> dengan komponen <code>&lt;vibe:input&gt;</code>, <code>&lt;vibe:select&gt;</code>, <code>&lt;vibe:date-time&gt;</code>, dan <code>&lt;vibe:textarea&gt;</code> di dalamnya. Komponen otomatis menangani auto-namespacing array.',
        'preview_title' => 'Contoh Riwayat Pengalaman',
    ],

    'foreach_mode' => [
        'title' => 'Mode Edit dengan PHP @foreach',
        'desc' => 'Untuk memuat data existing dari database dengan kontrol Blade 100%, gunakan loop <code>@foreach</code> di dalam slot dan sertakan <code>&lt;x-slot:template&gt;</code> sebagai cetak biru baris baru.',
        'preview_title' => 'Contoh Edit Data dengan @foreach dan x-slot:template',
    ],

    'table_variant' => [
        'title' => 'Varian Tabel (Line Items / Transaksi)',
        'desc' => 'Gunakan prop <code>variant="table"</code> untuk format baris ringkas yang cocok untuk item faktur, pesanan, atau inventaris.',
        'preview_title' => 'Contoh Baris Pesanan Produk',
    ],

    'schema_mode' => [
        'title' => 'Mode Skema (Declarative)',
        'desc' => 'Definisikan field langsung via array <code>:schema="[...]"</code> tanpa perlu menulis markup HTML per baris.',
        'preview_title' => 'Contoh Form Riwayat Pendidikan via Skema',
    ],

    'test_submit' => [
        'title' => 'Pengujian Form Submit & AJAX Payload',
        'desc' => 'Coba tambahkan beberapa baris lalu klik <b>Simpan Form</b> untuk melihat payload array yang terkirim ke server secara real-time via AJAX.',
        'preview_title' => 'Live Demo Form Submission',
    ],
];
