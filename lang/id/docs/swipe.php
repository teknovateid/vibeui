<?php

return [
    'title'       => 'Swipe Button',
    'badge'       => 'Baru',
    'group'       => 'Actions & Buttons',
    'description' => 'Komponen Slide-to-Action / Swipe Button interaktif yang mengirim event tombol lengkap seperti button click, form submit, Livewire action, dan custom Alpine.js events.',

    // Seksi 1: Penggunaan Dasar
    'basic_usage' => [
        'title'         => 'Penggunaan Dasar',
        'desc'          => 'Geser tuas handle dari kiri ke kanan. Begitu tuas mencapai ambang batas (default 88%), aksi akan terpicu secara otomatis dengan haptic feedback dan mengunci posisi sukses.',
        'preview_title' => 'Dasar Swipe Button',
        'card_title'    => 'Konfirmasi Pesanan',
        'card_desc'     => 'Geser tombol di bawah untuk memproses',
        'card_badge'    => 'Siap',
        'label'         => 'Geser untuk konfirmasi',
        'confirmed'     => 'Berhasil Dikonfirmasi!',
        'alert'         => 'Aksi swipe berhasil dieksekusi!',
    ],

    // Seksi 2: Interoperabilitas Event Click
    'event_click' => [
        'title'         => 'Interoperabilitas Event Click',
        'desc'          => 'Komponen memiliki tombol tersembunyi yang otomatis memicu event <code class="font-mono text-xs">@click</code> atau <code class="font-mono text-xs">onclick</code> native saat swipe selesai. Kode backend Anda dapat memperlakukannya persis seperti tombol biasa.',
        'preview_title' => 'Simulasi Button Click',
        'card_title'    => 'Counter Handler Native',
        'card_desc'     => 'Memicu event native @click secara otomatis',
        'label'         => 'Geser untuk menambah hitungan',
        'confirmed'     => 'Event @click Dipicu!',
        'counter'       => 'Total Klik:',
    ],

    // Seksi 3: Form Submission
    'form_submit' => [
        'title'         => 'Pengiriman Formulir (Form Submit)',
        'desc'          => 'Gunakan <code class="font-mono text-xs">type="submit"</code> dan berikan atribut <code class="font-mono text-xs">name</code>. Komponen akan otomatis menyertakan input tersembunyi dan memanggil <code class="font-mono text-xs">form.requestSubmit()</code> untuk mengecek validasi HTML5 sebelum form dikirim.',
        'preview_title' => 'Slide to Submit Formulir',
        'card_title'    => 'Pembayaran Checkout',
        'card_desc'     => 'Validasi otomatis & form.requestSubmit()',
        'card_amount'   => 'Rp 250.000',
        'input_label'   => 'Nomor Rekening Tujuan',
        'input_ph'      => 'Contoh: 8219-3910-2910',
        'label'         => 'Geser untuk Membayar',
        'confirmed'     => 'Pembayaran Terkirim!',
        'alert'         => 'Formulir berhasil dikirim dengan data swipe!',
    ],

    // Seksi 4: Ukuran
    'sizes' => [
        'title'         => 'Skala Ukuran (5-Tier Ergonomic Scale)',
        'desc'          => 'Tersedia dalam 5 skala ergonomis yang dirancang khusus untuk kenyamanan interaksi sentuhan dan gestur swipe: <code class="font-mono text-xs">xs (32px)</code>, <code class="font-mono text-xs">sm (36px)</code>, <code class="font-mono text-xs">md (44px - default)</code>, <code class="font-mono text-xs">lg (48px)</code>, dan <code class="font-mono text-xs">xl (56px)</code>.',
        'preview_title' => 'Variasi Ukuran Tinggi',
        'xs_use'        => 'Modal / Compact Action',
        'sm_use'        => 'Dense Form / Toolbar',
        'md_use'        => 'Standar Ergonomis Mobile',
        'lg_use'        => 'Prominent Checkout Button',
        'xl_use'        => 'Hero / High-Impact Slider',
        'label'         => 'Geser untuk konfirmasi',
    ],

    // Seksi 5: Bentuk Sudut
    'corner_shape' => [
        'title'         => 'Bentuk Sudut (Standard vs Pill)',
        'desc'          => 'Secara default, Swipe Button mengikuti desain sistem tombol Vibe UI dengan sudut membulat standar (<code class="font-mono text-xs">rounded-lg</code> untuk md/lg, <code class="font-mono text-xs">rounded-md</code> untuk sm/xs, <code class="font-mono text-xs">rounded-xl</code> untuk xl). Jika menginginkan gaya kapsul/pill penuh, tambahkan class utility Tailwind <code class="font-mono text-xs">class="rounded-full"</code>.',
        'preview_title' => 'Standard Rounded vs Pill (rounded-full)',
        'standard_label'   => 'Standard Rounded (Default — Selaras dengan Button & Input)',
        'pill_label'       => 'Pill Style',
        'label_standard'   => 'Geser untuk konfirmasi (Standard)',
        'label_pill'       => 'Geser untuk konfirmasi (Pill)',
    ],

    // Seksi 6: Varian Warna
    'variants' => [
        'title'         => 'Varian Warna Semantik',
        'desc'          => 'Pilihan tema warna kontekstual untuk berbagai skenario seperti transaksi pembayaran (<code class="font-mono text-xs">success</code>), konfirmasi hapus data (<code class="font-mono text-xs">destructive</code>), atau status umum.',
        'preview_title' => 'Pilihan Varian Warna',
        'primary_label'     => 'Primary (Default)',
        'success_label'     => 'Success (Pembayaran / Konfirmasi Aman)',
        'destructive_label' => 'Destructive (Hapus Akun / Tindakan Kritis)',
        'warning_label'     => 'Warning (Peringatan Penting)',
        'info_label'        => 'Info (Sinkronisasi / Unduh Berkas)',
        'secondary_label'   => 'Secondary (Arsip / Simpan Draf)',
        'slide_continue'    => 'Geser untuk Melanjutkan',
        'slide_pay'         => 'Geser untuk Membayar',
        'slide_delete'      => 'Geser untuk Menghapus Data',
        'slide_cancel'      => 'Geser untuk Batalkan Pesanan',
        'slide_sync'        => 'Geser untuk Sinkronisasi Cloud',
        'slide_archive'     => 'Geser untuk Simpan ke Arsip',
        'done_payment'      => 'Pembayaran Berhasil!',
        'done_delete'       => 'Data Berhasil Dihapus!',
        'done_delete_acct'  => 'Akun Dihapus',
    ],

    // Seksi 7: Livewire & Loading
    'livewire' => [
        'title'         => 'Integrasi Livewire & Loading State',
        'desc'          => 'Dapat disambungkan langsung dengan method Livewire menggunakan <code class="font-mono text-xs">wire:click</code>. Tuas handle otomatis menampilkan spinner animasi selama request jaringan berlangsung.',
        'preview_title' => 'Async Loading & Livewire',
        'card_title'    => 'Simulasi Async Worker',
        'card_desc'     => 'Spinner aktif saat memproses request',
        'idle'          => 'Idle',
        'processing'    => 'Memproses...',
        'label_checkout'    => 'Geser untuk Checkout',
        'label_loading'     => 'Memproses transaksi...',
        'label_confirmed'   => 'Transaksi Sukses!',
        'label_send'        => 'Geser untuk Kirim Pesanan',
        'label_done'        => 'Pesanan Selesai!',
        'status_waiting'    => 'Menunggu konfirmasi swipe...',
        'status_processing' => 'Sedang memproses pesanan ke server...',
        'status_label'      => 'Status Server:',
    ],

    // Seksi 8: Reset
    'reset' => [
        'title'         => 'Reset Otomatis & Eksternal',
        'desc'          => 'Gunakan <code class="font-mono text-xs">:autoReset="true"</code> (2000ms) atau tentukan durasi dalam milidetik (misal <code class="font-mono text-xs">:autoReset="1500"</code>). Anda juga dapat mereset tombol swipe dari komponen luar menggunakan event <code class="font-mono text-xs">$dispatch(\'reset-swipe\', id)</code>.',
        'preview_title' => 'Reset Eksternal via Alpine Event',
        'card_title'    => 'Reset Eksternal',
        'card_desc'     => 'Trigger reset posisi dari tombol luar',
        'btn_reset'     => 'Reset Posisi Tuas',
        'label'         => 'Geser tuas ini',
        'confirmed'     => 'Terkonfirmasi!',
    ],

    // Seksi 9: Disabled
    'disabled' => [
        'title'         => 'Status Disabled',
        'desc'          => 'Mencegah pengguna menggeser tuas saat kondisi formulir belum valid atau otorisasi belum terpenuhi.',
        'preview_title' => 'Disabled Swipe Button',
        'label'         => 'Geser untuk konfirmasi (Nonaktif)',
    ],

    // Seksi 10: Referensi Props
    'props_ref' => [
        'title'     => 'Referensi Props & Atribut',
        'desc'      => 'Daftar lengkap konfigurasi prop komponen <code class="font-mono text-xs">&lt;vibe:swipe&gt;</code>.',
        'col_prop'  => 'Prop',
        'col_type'  => 'Tipe Data',
        'col_default' => 'Bawaan',
        'col_desc'  => 'Keterangan',
        'prop_type_desc'           => "Tipe tombol aksi. Saat 'submit', otomatis memanggil <code>form.requestSubmit()</code>",
        'prop_size_desc'           => 'Skala tinggi dan ukuran tuas (32px, 36px, 44px, 48px, 56px)',
        'prop_variant_desc'        => 'Tema warna visual track, fill, dan tuas handle',
        'prop_name_desc'           => 'Nama field hidden input saat swipe terkonfirmasi di form',
        'prop_value_desc'          => 'Nilai value yang dikirimkan saat swipe terkonfirmasi',
        'prop_label_desc'          => 'Teks panduan pada lintasan track',
        'prop_confirmed_label_desc'=> 'Teks yang ditampilkan setelah tuas mencapai 100%',
        'prop_threshold_desc'      => 'Persentase batas geser untuk memicu aksi sukses (default 88%)',
        'prop_auto_reset_desc'     => 'Reset otomatis tuas ke awal (true = 2000ms, atau tentukan milidetik)',
        'prop_loading_desc'        => 'Menampilkan status loading spinner pada tuas',
        'prop_haptic_desc'         => 'Memberikan getaran haptic feedback pada smartphone modern',
        'prop_disabled_desc'       => 'Menonaktifkan interaksi swipe dan klik',

        'events_title'   => 'Event DOM & Alpine.js:',
        'event_click'    => 'Dipicu secara native saat handle mencapai 100%.',
        'event_confirmed'=> 'Dipancarkan dengan detail <code class="font-mono">{ id, value }</code>.',
        'event_start'    => 'Dipancarkan saat pengguna mulai menyentuh/menggeser tuas.',
        'event_swiping'  => 'Dipancarkan secara kontinu saat bergeser memuat <code class="font-mono">{ progress, currentX, maxX }</code>.',
        'event_reset'    => 'Dipancarkan saat posisi tuas kembali ke awal.',
        'event_dispatch' => 'Event global window untuk mereset swipe secara eksternal.',
    ],
];
