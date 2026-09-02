<?php

return [
    'title' => 'Toast',
    'badge' => 'Komponen',
    'group' => 'Feedback & Notifikasi',
    'description' => 'Komponen notifikasi toast mengambang yang modern dan kaya fitur. Mendukung penumpukan dinamis (stacked cards), audio chime, 6 posisi layar, integrasi Laravel flash message, dan pemanggilan via fungsi global JavaScript.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar & Tipe',
        'desc' => 'Panggil fungsi global JavaScript <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibeToast()</code> dari mana saja untuk memunculkan notifikasi instan. Tersedia 4 tipe semantik: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">success</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">warning</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Pemicu Tipe Toast Dasar',
        'types' => [
            'info' => [
                'btn' => 'Info Toast',
                'title' => 'Pemberitahuan Sistem',
                'msg' => 'Sinkronisasi data cloud sedang berjalan di latar belakang.',
            ],
            'success' => [
                'btn' => 'Success Toast',
                'title' => 'Berhasil Disimpan',
                'msg' => 'Profil dan preferensi pengguna telah berhasil diperbarui.',
            ],
            'warning' => [
                'btn' => 'Warning Toast',
                'title' => 'Peringatan Kuota',
                'msg' => 'Penyimpanan server Anda telah mencapai 85% kapasitas.',
            ],
            'error' => [
                'btn' => 'Error Toast',
                'title' => 'Gagal Memproses',
                'msg' => 'Terjadi kesalahan saat mengunggah berkas ke server.',
            ],
        ],
    ],

    // Section 2: Stacked Toasts
    'stacked' => [
        'title' => 'Penumpukan Kartu (Stacked Cards)',
        'desc' => 'Ketika beberapa toast aktif bersamaan di posisi yang sama, kartu akan otomatis tertumpuk rapi dengan efek kedalaman (scale & translateY). Arahkan kursor (*hover*) ke tumpukan kartu untuk membukanya secara berjarak dinamis.',
        'preview_title' => 'Demonstrasi Penumpukan Toast',
        'trigger_btn' => 'Munculkan 3 Toast Berurutan',
        'toast_1' => [
            'title' => 'Pesanan Baru Masuk',
            'msg' => 'Invoice #INV-2025-001 senilai Rp 750.000 telah diterima.',
        ],
        'toast_2' => [
            'title' => 'Pesan dari Dukungan',
            'msg' => 'Tiket kendala #TK-4821 telah dijawab oleh tim teknis.',
        ],
        'toast_3' => [
            'title' => 'Pembaruan Siap Dipasang',
            'msg' => 'Versi 2.4.0 siap diperbarui pada sistem produksi.',
        ],
    ],

    // Section 3: Positions
    'positions' => [
        'title' => 'Posisi Layar',
        'desc' => 'Toast dapat ditempatkan di 6 titik sudut layar berbeda via opsi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code>: <code class="font-mono text-xs text-foreground">top-right</code> (default), <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">top-center</code>, <code class="font-mono text-xs text-foreground">bottom-right</code>, <code class="font-mono text-xs text-foreground">bottom-left</code>, dan <code class="font-mono text-xs text-foreground">bottom-center</code>.',
        'preview_title' => '6 Titik Posisi Layar',
        'demo_title' => 'Toast Posisi',
        'demo_msg' => 'Ini adalah contoh toast di posisi :position.',
        'items' => [
            'top_right' => 'Top Right (Bawaan)',
            'top_left' => 'Top Left',
            'top_center' => 'Top Center',
            'bottom_right' => 'Bottom Right',
            'bottom_left' => 'Bottom Left',
            'bottom_center' => 'Bottom Center',
        ],
    ],

    // Section 4: Sound & Timeout
    'sound_timeout' => [
        'title' => 'Durasi & Efek Suara (Audio)',
        'desc' => 'Atur durasi tampil melalui properti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">timeout</code> (dalam milidetik). Gunakan nilai <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">0</code> untuk membuat toast tetap terbuka (*sticky*) sampai tombol close diklik. Efek audio dapat ditentukan via <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: "chime" | "pop" | false</code>.',
        'timeout_preview' => 'Pilihan Durasi Waktu',
        'sound_preview' => 'Efek Audio Notifikasi',
        'fast_btn' => 'Cepat (2 Detik)',
        'sticky_btn' => 'Sticky (Tanpa Batas)',
        'chime_btn' => 'Suara Chime',
        'pop_btn' => 'Suara Pop',
        'silent_btn' => 'Tanpa Suara (Mute)',
    ],

    // Section 5: Integration
    'integration' => [
        'title' => 'Integrasi Laravel Flash Session & Event',
        'desc' => 'Komponen Toast otomatis mendengarkan session flash dari Controller Laravel serta Event Browser Livewire <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">window.dispatchEvent(new CustomEvent("vibe-toast", ...))</code>.',
        'preview_title' => 'Simulasi Laravel Flash Session',
        'success_btn' => 'Flash Session Berhasil',
        'error_btn' => 'Flash Session Gagal',
    ],

    // Section 6: Props Reference
    'props' => [
        'title' => 'Referensi Opsi (Payload API)',
        'desc' => 'Daftar parameter konfigurasi yang diterima oleh pemanggilan fungsi <code class="font-mono text-xs text-foreground">vibeToast(options)</code>.',
        'columns' => [
            'prop' => 'Opsi',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],
];
