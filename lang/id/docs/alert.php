<?php

return [
    'title' => 'Alert Dialog',
    'badge' => 'Komponen',
    'group' => 'Feedback & Notifikasi',
    'description' => 'Komponen dialog peringatan modal/popup modern dengan animasi transisi halus, tata letak fleksibel, dialog konfirmasi interaktif, efek backdrop blur, audio feedback, dan persistensi state.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar & Tipe',
        'desc' => 'Gunakan fungsi global <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibeAlert()</code> untuk memunculkan modal peringatan. Tersedia 4 tipe semantik: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">success</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">warning</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Tipe Alert Dialog',
        'types' => [
            'info' => [
                'btn' => 'Info Alert',
                'title' => 'Pembaruan Sistem',
                'msg' => 'Fitur pembaruan versi 2.4 telah berhasil diaplikasikan ke sistem Anda.',
            ],
            'success' => [
                'btn' => 'Success Alert',
                'title' => 'Transaksi Berhasil',
                'msg' => 'Pembayaran pesanan Anda telah diverifikasi oleh bank mitra.',
            ],
            'warning' => [
                'btn' => 'Warning Alert',
                'title' => 'Peringatan Akun',
                'msg' => 'Masa aktif langganan Anda akan berakhir dalam 3 hari ke depan.',
            ],
            'error' => [
                'btn' => 'Error Alert',
                'title' => 'Autentikasi Gagal',
                'msg' => 'Kombinasi email dan kata sandi yang Anda masukkan tidak cocok.',
            ],
        ],
    ],

    // Section 2: Confirm Dialog
    'confirm' => [
        'title' => 'Dialog Konfirmasi Interaktif',
        'desc' => 'Opsi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">buttons</code> memungkinkan Anda mendefinisikan tombol aksi konfirmasi dengan callback handler.',
        'preview_title' => 'Dialog Konfirmasi Tindakan Penting',
        'open_btn' => 'Hapus Berkas (Konfirmasi)',
        'dialog_title' => 'Konfirmasi Penghapusan',
        'dialog_msg' => 'Apakah Anda yakin ingin menghapus dokumen ini secara permanen?',
        'yes_btn' => 'Ya, Hapus Sekarang',
        'cancel_btn' => 'Batalkan',
        'confirmed_title' => 'Dihapus',
        'confirmed_msg' => 'Dokumen berhasil dihapus dari sistem.',
        'cancelled_title' => 'Dibatalkan',
        'cancelled_msg' => 'Tindakan penghapusan dibatalkan.',
    ],

    // Section 3: Positions
    'positions' => [
        'title' => 'Posisi Dialog Layar',
        'desc' => 'Tersedia 7 pilihan posisi penempatan via prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code>: <code class="font-mono text-xs text-foreground">center</code> (default), <code class="font-mono text-xs text-foreground">top-center</code>, <code class="font-mono text-xs text-foreground">bottom-center</code>, <code class="font-mono text-xs text-foreground">top-right</code>, <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">bottom-right</code>, dan <code class="font-mono text-xs text-foreground">bottom-left</code>.',
        'preview_title' => 'Pilihan Posisi Alert',
        'demo_title' => 'Posisi Dialog',
        'demo_msg' => 'Dialog alert diposisikan pada :position.',
        'items' => [
            'center' => 'Tengah (Default)',
            'top_center' => 'Atas Tengah',
            'bottom_center' => 'Bawah Tengah',
            'top_right' => 'Kanan Atas',
            'top_left' => 'Kiri Atas',
            'bottom_right' => 'Kanan Bawah',
            'bottom_left' => 'Kiri Bawah',
        ],
    ],

    // Section 4: Buttons Layout
    'buttons' => [
        'title' => 'Tata Letak Tombol (Row vs Col)',
        'desc' => 'Gunakan opsi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">buttonLayout: "row" | "col"</code> untuk mengatur orientasi susunan tombol aksi.',
        'preview_title' => 'Orientasi Tombol Aksi',
        'row_btn' => 'Susunan Sejajar (Row)',
        'col_btn' => 'Susunan Bertumpuk (Col)',
        'row_title' => 'Simpan Perubahan?',
        'row_msg' => 'Tombol aksi diatur berdampingan horizontal.',
        'col_title' => 'Opsi Tindakan Lanjutan',
        'col_msg' => 'Tombol aksi diatur bertumpuk vertikal.',
    ],

    // Section 5: Sound & Timeout
    'sound_timeout' => [
        'title' => 'Efek Audio & Durasi Auto-Dismiss',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: "chime" | "pop"</code> untuk efek suara Web Audio API, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">timeout</code> untuk auto-close otomatis.',
        'preview_title' => 'Uji Suara & Waktu Tunda',
        'sound_btn' => 'Alert dengan Suara Chime',
        'timeout_fast_btn' => 'Auto-Close 3 Detik',
        'timeout_sticky_btn' => 'Tanpa Auto-Close (Sticky)',
    ],

    // Section 6: Backdrop Blur
    'blur' => [
        'title' => 'Backdrop Blur Kustom',
        'desc' => 'Gunakan opsi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">blur: "sm" | "md" | "lg" | "none"</code> untuk efek blur latar belakang.',
        'preview_title' => 'Efek Glassmorphism Backdrop Blur',
        'open_btn' => 'Buka Alert dengan Blur Kuat (lg)',
        'dialog_title' => 'Fokus Eksklusif',
        'dialog_msg' => 'Latar belakang di-blur secara intens untuk fokus visual penuh.',
    ],

    // Section 7: Persist State
    'persist' => [
        'title' => 'Persistensi Dialog (LocalStorage)',
        'desc' => 'Fitur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">persist: true</code> menyimpan status dialog di LocalStorage agar tidak muncul kembali setelah ditutup pengguna.',
        'preview_title' => 'Peringatan Sekali Tampil (Persist)',
        'open_btn' => 'Buka Alert Persisten',
        'reset_btn' => 'Reset Status LocalStorage',
        'dialog_title' => 'Kebijakan Cookie & Privasi',
        'dialog_msg' => 'Dialog ini hanya akan muncul satu kali. Jika Anda mengklik OK, dialog tidak akan muncul lagi.',
    ],

    // Section 8: Integration Methods
    'integration' => [
        'title' => 'Metode Pemanggilan',
        'desc' => 'Komponen alert dapat dipicu melalui berbagai metode fleksibel: helper JavaScript global, direktif Blade, atau event browser dari Livewire.',
    ],

    // Section 9: Programmatic Control
    'programmatic' => [
        'title' => 'Kontrol Programatik ($vibe.alert & $vibe.alerts)',
        'desc' => 'Dialog alert dapat dipicu secara deklaratif dari template Alpine.js menggunakan magic helper <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.alert</code> maupun dari vanilla JavaScript dengan <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">window.$vibe.alert</code>. Untuk menutup seluruh alert aktif, gunakan <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.alerts.close()</code>.',
        'preview_title' => 'Demo Kontrol Programatik Alert',
        'success_btn' => 'Success Alert',
        'error_btn' => 'Error Alert',
        'warning_btn' => 'Warning Alert',
        'info_btn' => 'Info Alert',
        'confirm_btn' => 'Dialog Konfirmasi',
        'close_all_btn' => 'Tutup Semua Alert ($vibe.alerts.close)',
        'success_title' => 'Operasi Berhasil',
        'success_msg' => 'Data Anda telah tersimpan dengan aman di cloud.',
        'error_title' => 'Kesalahan Terjadi',
        'error_msg' => 'Gagal memproses transaksi. Silakan coba kembali.',
        'warning_title' => 'Peringatan Keamanan',
        'warning_msg' => 'Sesi Anda akan segera berakhir dalam hitungan menit.',
        'info_title' => 'Informasi Penting',
        'info_msg' => 'Pemeliharaan server dijadwalkan malam ini pukul 00:00.',
        'confirm_title' => 'Konfirmasi Lanjutkan Tindakan',
        'confirm_msg' => 'Apakah Anda ingin melanjutkan tindakan ini?',
        'confirm_yes' => 'Ya, Lanjutkan',
        'confirm_toast' => 'Tindakan berhasil dikonfirmasi!',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Referensi Opsi (Payload API)',
        'desc' => 'Daftar lengkap konfigurasi yang diterima oleh pemanggilan fungsi <code class="font-mono text-xs text-foreground">vibeAlert(options)</code> atau helper <code class="font-mono text-xs text-foreground">$vibe.alert</code>.',
        'columns' => [
            'prop' => 'Opsi',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'events_title' => 'Referensi Event Window & Helper $vibe',
        'events_desc' => 'Event browser global dan helper Alpine.js $vibe untuk memicu atau menutup dialog alert.',
        'th_event' => 'Nama Event / Helper',
        'th_payload' => 'Payload Data',
        'th_event_desc' => 'Keterangan',
        'events' => [
            [
                'name' => "alert / \$vibe.alert(payload)",
                'payload' => 'object|string',
                'desc' => 'Memunculkan dialog alert baru dengan pesan dan opsi yang ditentukan.',
            ],
            [
                'name' => "\$vibe.alert.success(pesan, judul?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand untuk memunculkan notifikasi alert sukses.',
            ],
            [
                'name' => "\$vibe.alert.error(pesan, judul?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand untuk memunculkan notifikasi alert error.',
            ],
            [
                'name' => "\$vibe.alert.warning(pesan, judul?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand untuk memunculkan notifikasi alert peringatan.',
            ],
            [
                'name' => "\$vibe.alert.info(pesan, judul?)",
                'payload' => 'string, string?',
                'desc' => 'Shorthand untuk memunculkan notifikasi alert info.',
            ],
            [
                'name' => "\$vibe.alert.confirm(opsi)",
                'payload' => 'object',
                'desc' => 'Memunculkan dialog konfirmasi tindakan dengan tombol aksi primer dan sekunder.',
            ],
            [
                'name' => "close-alert / \$vibe.alert.close(id)",
                'payload' => 'string (alertId)',
                'desc' => 'Menutup alert spesifik berdasarkan ID.',
            ],
            [
                'name' => "\$vibe.alerts.close()",
                'payload' => "'*'",
                'desc' => 'Menutup seluruh dialog alert yang sedang aktif di layar.',
            ],
        ],
    ],

    'props_items' => [
        'container' => [
            'position' => 'Posisi penempatan default container notifikasi alert pada layar.',
            'align' => 'Perataan konten teks dan ikon di dalam bodi alert.',
            'timeout' => 'Waktu tunda auto-dismiss dalam milidetik (atau false untuk alert persisten).',
            'sound' => 'Memutar nada audio sintesis Web Audio API (true) atau file audio eksternal (string URL).',
            'blur' => 'Efek blur backdrop latar belakang bawaan container (misal: "md", "lg", atau true).',
            'closeOnOutside' => 'Menutup alert saat menekan area di luar alert (default: true untuk alert biasa, false untuk confirm).',
        ],
        'payload' => [
            'type' => 'Jenis status alert yang menentukan palet warna latar, border aksen, dan ikon otomatis.',
            'title' => 'Judul utama notifikasi alert.',
            'message' => 'Pesan deskripsi lengkap yang ingin disampaikan kepada pengguna.',
            'icon' => 'Kustomisasi elemen SVG ikon untuk menggantikan ikon default status.',
            'position' => 'Menimpa posisi penempatan container khusus untuk alert ini.',
            'align' => 'Menimpa perataan horizontal konten teks dan ikon khusus alert ini.',
            'timeout' => 'Menimpa durasi auto-dismiss (false agar alert tetap terbuka hingga tombol ditekan).',
            'blocking' => 'Menampilkan backdrop gelap (overlay) dengan efek blur di belakang alert.',
            'blur' => 'Menampilkan backdrop dengan intensitas blur latar belakang tertentu ("sm", "md", "lg", "xl", true, false).',
            'sound' => 'Menimpa preferensi efek suara saat alert muncul.',
            'confirmButton' => 'Konfigurasi tombol konfirmasi: teks string atau objek { text, action, class }.',
            'closeButton' => 'Konfigurasi tombol penutup/batal: teks string atau objek { text, action, class }.',
            'buttonLayout' => 'Tata letak susunan tombol: "col" untuk bertumpuk vertikal atau "row" berdampingan.',
            'closeOnOutside' => 'Menentukan apakah alert dapat ditutup saat pengguna menekan area di luar alert.',
            'id' => 'ID unik alert. Wajib disertakan jika menggunakan opsi persist: true.',
            'persist' => 'Menyimpan status penutupan alert agar tidak muncul lagi: true, key string, atau "session".',
        ],
    ],
];
