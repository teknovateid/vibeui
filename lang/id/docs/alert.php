<?php

return [
    'title' => 'Alert',
    'badge' => 'Komponen',
    'group' => 'Feedback & Notifikasi',
    'description' => 'Komponen modal dialog dan notifikasi umpan balik penting dengan animasi halus, backdrop blur, dukungan audio sintesis Web Audio API, dialog konfirmasi interaktif, serta integrasi fleksibel via JavaScript vibeAlert, direktif Blade @vibeAlert, dan Livewire event dispatch.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Penggunaan Dasar',
    'basic_usage_desc' => 'Pastikan tag penampung <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:alert /&gt;</code> sudah terpasang di layout utama (seperti <code class="font-mono text-xs text-foreground">base.blade.php</code>). Alert dapat dipicu secara instan melalui fungsi JavaScript <code class="font-mono text-xs text-foreground">vibeAlert(...)</code> atau Alpine event <code class="font-mono text-xs text-foreground">$dispatch(\'alert\', ...)</code>.',

    // Section 2: Confirmation Dialog
    'confirm_title' => 'Dialog Konfirmasi (Confirm Modal)',
    'confirm_desc' => 'Gunakan tipe <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">confirm</code> untuk meminta verifikasi sebelum tindakan penting atau destruktif dieksekusi. Dialog ini otomatis menampilkan backdrop overlay (<code class="font-mono text-xs text-foreground">blocking: true</code>) dan mematikan auto-dismiss (<code class="font-mono text-xs text-foreground">timeout: false</code>).',

    // Section 3: Positions
    'positions_title' => 'Pilihan Posisi (Positions)',
    'positions_desc' => 'Alert mendukung 7 pilihan posisi penempatan: <code class="font-mono text-xs text-foreground">center</code> (default tengah layar), <code class="font-mono text-xs text-foreground">top-right</code>, <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">bottom-right</code>, <code class="font-mono text-xs text-foreground">bottom-left</code>, <code class="font-mono text-xs text-foreground">top-center</code>, dan <code class="font-mono text-xs text-foreground">bottom-center</code>.',

    // Section 4: Custom Buttons & Layout
    'buttons_title' => 'Kustomisasi Tombol & Tata Letak',
    'buttons_desc' => 'Sesuaikan label teks tombol, kelas Tailwind (<code class="font-mono text-xs text-foreground">class</code>), callback aksi saat diklik, serta orientasi tata letak tombol menggunakan <code class="font-mono text-xs text-foreground">buttonLayout: \'row\'|\'col\'</code>.',

    // Section 5: Sound & Timeout
    'sound_title' => 'Efek Suara Audio & Durasi',
    'sound_desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: true</code> untuk membunyikan nada sintesis jernih via Web Audio API tanpa perlu file eksternal, atau berikan URL file audio kustom. Saat kursor mouse berada di atas alert, penghitung waktu auto-dismiss otomatis dihentikan sementara (pause on hover).',

    // Section 6: Background Blur
    'blur_title' => 'Efek Background Blur',
    'blur_desc' => 'Tingkatkan fokus visual pengguna pada alert dengan memberikan efek blur pada latar belakang backdrop. Mendukung opsi <code class="font-mono text-xs text-foreground">blur: true</code>, serta berbagai tingkat intensitas seperti <code class="font-mono text-xs text-foreground">\'xs\'</code>, <code class="font-mono text-xs text-foreground">\'sm\'</code>, <code class="font-mono text-xs text-foreground">\'md\'</code>, <code class="font-mono text-xs text-foreground">\'lg\'</code>, <code class="font-mono text-xs text-foreground">\'xl\'</code>, atau <code class="font-mono text-xs text-foreground">false / \'none\'</code> untuk mematikan blur.',

    // Section 6: Methods
    'integration_title' => 'Metode Pemanggilan Alert',
    'integration_desc' => 'Terdapat beberapa metode untuk memicu alert: fungsi JavaScript <code class="font-mono text-xs text-foreground">vibeAlert(...)</code>, direktif Blade <code class="font-mono text-xs text-foreground">@vibeAlert(...)</code>, dan event dispatch dari komponen Livewire.',

    // Section 7: Props Reference
    'props_title' => 'Referensi Props & Payload',
    'props_desc' => 'Daftar lengkap atribut kontainer dan struktur parameter objek payload yang didukung oleh Alert.',
    'table_prop' => 'Prop / Parameter',
    'table_type' => 'Tipe',
    'table_default' => 'Default',
    'table_desc' => 'Deskripsi',
];
