<?php

return [
    'confirm_title' => 'Konfirmasi',
    'confirm_btn' => 'Konfirmasi',
    'error_title' => 'Terjadi Kesalahan',
    'notice_title' => 'Pemberitahuan',
    'passkey' => [
        'default_device' => 'Perangkat Saya',
        'ip_address_notice' => 'WebAuthn (Passkey) mewajibkan nama domain. Saat masih dalam tahap pengembangan (development), silakan gunakan localhost alih-alih alamat IP 127.0.0.1 (misal: :url).',
        'invalid_domain' => 'Domain tidak valid untuk Passkey. Silakan gunakan :url',
        'auth_cancelled' => 'Belum ada Passkey yang terdaftar di perangkat ini untuk aplikasi ini, atau dialog autentikasi dibatalkan. Silakan masuk dengan kata sandi terlebih dahulu, lalu daftarkan Passkey perangkat Anda.',
        'verify_failed' => 'Gagal memverifikasi passkey.',
        'register_cancelled' => 'Pendaftaran passkey dibatalkan oleh pengguna.',
        'sudo_required' => 'Konfirmasi kata sandi (sudo mode) diperlukan sebelum mendaftarkan Passkey baru.',
        'register_failed' => 'Gagal mendaftarkan passkey.',
        'verify_error' => 'Terjadi kesalahan saat memverifikasi passkey.',
        'not_loaded' => 'Modul Passkey belum dimuat.',
        'confirm_failed' => 'Gagal mengkonfirmasi dengan passkey.',
    ],
];
