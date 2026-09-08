<?php

return [
    'title' => 'FilePond',
    'badge' => 'Komponen',
    'group' => 'Form & Upload',
    'description' => 'Komponen pengunggah berkas drag & drop modern dan kaya fitur. Mendukung pratinjau gambar, crop & resize, upload foto profil melingkar (avatar), validasi ukuran dan format berkas, integrasi Livewire v3, serta Presigned URL untuk pengunggahan langsung ke cloud storage (S3/R2) tanpa membebani server PHP.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:filepond&gt;</code> untuk membuat dropzone upload berkas. Asset CSS akan otomatis di-push ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;head&gt;</code> dan JS ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;body&gt;</code>.',
        'preview_title' => 'Upload Berkas Dasar',
        'label' => 'Unggah Dokumen',
        'description' => 'Pilih berkas dokumen atau tarik ke area ini.',
    ],

    // Section 2: Multiple & Image Preview
    'multiple_preview' => [
        'title' => 'Multiple Files & Image Preview',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">multiple</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-files="5"</code> untuk mengizinkan upload banyak berkas sekaligus lengkap dengan galeri pratinjau instan.',
        'preview_title' => 'Upload Banyak Berkas & Pratinjau',
        'label' => 'Galeri Foto Produk',
        'description' => 'Maksimal hingga 5 foto sekaligus.',
    ],

    // Section 3: Avatar / Circular
    'avatar_mode' => [
        'title' => 'Mode Avatar (Foto Profil Bulat)',
        'desc' => 'Aktifkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar</code> untuk mengubah drop area menjadi bentuk lingkaran 1:1, sangat cocok untuk halaman pengaturan profil pengguna.',
        'preview_title' => 'Upload Avatar Profil',
        'label' => 'Foto Profil Pengguna',
        'description' => 'Format JPG atau PNG, rasio otomatis 1:1.',
    ],

    // Section 4: Validation
    'validation' => [
        'title' => 'Validasi Berkas (Ukuran & Format)',
        'desc' => 'Tentukan batas ukuran dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-file-size="2MB"</code> dan format yang diizinkan dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">accepted-file-types="image/*, application/pdf"</code>.',
        'preview_title' => 'Validasi Berkas',
        'label' => 'Dokumen Terverifikasi (Maks 2MB, PDF/Gambar)',
    ],

    // Section 5: Presigned URL Direct S3
    'presigned' => [
        'title' => 'Presigned URL Direct-to-Cloud Upload (S3/R2)',
        'desc' => 'Untuk menangani berkas berukuran besar (ratusan MB hingga GB) tanpa membebani memori PHP dan batas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">upload_max_filesize</code>, gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">presign-url</code>. Berkas akan diunggah langsung ke bucket cloud storage Anda via XHR PUT/POST dengan progress bar real-time.',
        'preview_title' => 'Direct Cloud Upload via Presigned URL',
        'label' => 'Video / Berkas Arsip Berukuran Besar',
        'description' => 'Berkas diunggah langsung ke bucket cloud penyimpanan (AWS S3, Cloudflare R2, MinIO).',
    ],

    // Section 6: Livewire
    'livewire' => [
        'title' => 'Integrasi Native Livewire v3',
        'desc' => 'Komponen ini mendeteksi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code> secara otomatis dan menghubungkannya dengan trait <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">WithFileUploads</code> Livewire.',
    ],
];
