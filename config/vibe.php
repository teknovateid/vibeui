<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Vibe LocalStorage Prefix
    |--------------------------------------------------------------------------
    |
    | String ini akan digunakan sebagai awalan (prefix) untuk semua key
    | penyimpanan di LocalStorage seperti pengaturan tema, draft form,
    | dan state modal. Mengubah nilai ini akan me-reset preferensi user.
    |
    */
    'prefix' => 'vibe',

    /*
    |--------------------------------------------------------------------------
    | Vibe SEO & Social Media Configuration
    |--------------------------------------------------------------------------
    |
    | Pengaturan global untuk komponen <vibe:seo>. Seluruh props di komponen
    | <vibe:seo> akan mengambil nilai default dari konfigurasi di bawah ini
    | jika tidak di-override secara spesifik di halaman view.
    |
    */
    'seo' => [
        'enabled' => env('VIBE_SEO_ENABLED', true),
        'site_name' => env('APP_NAME', 'Vibe UI'),
        'title_template' => '%s — ' . env('APP_NAME', 'Laravel'),
        'description' => 'Modern Blade & Tailwind CSS UI Components for Laravel.',
        'keywords' => 'laravel, blade components, tailwind css, ui library, vibe ui',
        'image' => '/vibe/favicon/og-image.png',
        'image_alt' => 'Vibe UI Component Library',
        'type' => 'website',
        'robots' => 'index, follow',
        'twitter_card' => 'summary_large_image',
        'twitter_site' => null,
        'twitter_creator' => null,
        'schema' => 'website',
        'author' => env('APP_NAME', 'Teknovate'),
        'publisher' => env('APP_NAME', 'Teknovate'),
        'currency' => 'USD',
        'price' => '0',
        'logo' => null,
        'socials' => [],

        // Konfigurasi Suite Favicon
        'favicon' => [
            'enabled' => env('VIBE_FAVICON_ENABLED', true),
            'dir' => '/vibe/favicon',
            'theme_color' => '#0a0b0a',
            'ms_tile_color' => '#0a0b0a',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Vibe Page History Configuration
    |--------------------------------------------------------------------------
    |
    | Pengaturan untuk pencatatan riwayat halaman yang diakses (Local Storage).
    | Riwayat disimpan secara penuh di LocalStorage, dan `display_limit`
    | digunakan sebagai batas default saat ditampilkan ke komponen UI.
    |
    */
    'history' => [
        'enabled' => env('VIBE_HISTORY_ENABLED', true),
        'auto_track' => true,
        'display_limit' => 10,
        
        /*
        | Metode / Strategi saat halaman yang sama dikunjungi kembali:
        | - 'update_timestamp' : Update waktu akses & geser ke posisi paling atas (LIFO / MRU).
        | - 'keep_position'    : Update waktu akses di tempat tanpa mengubah urutan list.
        | - 'record_all'       : Selalu catat sebagai entri baru (full activity stream).
        */
        // 'method' => env('VIBE_HISTORY_METHOD', 'update_timestamp'),
        'method' => env('VIBE_HISTORY_METHOD', 'record_all'),

        'ignore_paths' => [
            '/login',
            '/logout',
            '/register',
            '/password/*',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Vibe Authentication System Configuration
    |--------------------------------------------------------------------------
    |
    | Pengaturan untuk sistem otentikasi Vibe UI (Starter Kit & Auth).
    | Anda dapat menentukan strategi kredensial login default dan varian
    | layout bawaan yang digunakan oleh modul otentikasi.
    |
    */
    'auth' => [
        /*
        | Kredensial Login yang Diizinkan:
        | Anda dapat menentukan array kredensial yang diizinkan untuk login:
        | - ['email']                        : Login hanya menggunakan email (Default).
        | - ['email', 'username']            : Login menggunakan email atau username.
        | - ['email', 'username', 'phone']   : Login menggunakan email, username, atau no. hp.
        | - ['username']                     : Login khusus username.
        | - ['phone']                        : Login khusus nomor handphone.
        */
        'login_by' => ['email'],

        /*
        | Layout Otentikasi Default:
        | - 'card'              : Tampilan kartu berelevasi di tengah (Default).
        | - 'simple'            : Tampilan minimalis bersih rata tengah.
        | - 'split'             : Tampilan split screen 2-kolom (branding + form).
        */
        'default_layout' => 'card',

        /*
        | Pengalihan Setelah Login / Registrasi Berhasil:
        | Gunakan path seperti '/docs' atau URL tujuan setelah otentikasi.
        */
        'redirect_after_login' => '/docs',

        /*
        | Konfirmasi Kata Sandi untuk Aksi Sensitif 2FA (Livewire - Cara A):
        | - true  : (Default) Mewajibkan konfirmasi kata sandi sebelum memulai setup 2FA,
        |           melihat recovery codes, membuat ulang kode, atau menonaktifkan 2FA.
        | - false : Aksi 2FA dapat langsung dijalankan tanpa meminta konfirmasi kata sandi.
        |
        | Developer juga dapat menonaktifkannya via .env: VIBE_CONFIRM_PASSWORD_FOR_2FA=false
        */
        'confirm_password_for_2fa' => env('VIBE_CONFIRM_PASSWORD_FOR_2FA', true),

        /*
        | Dukungan Autentikasi Biometrik Passkey (WebAuthn):
        | - true  : (Default) Mengaktifkan login & konfirmasi password biometrik passkey.
        | - false : Menonaktifkan seluruh rute WebAuthn, tombol passkey, dan kartu manajemen.
        */
        // 'passkeys_enabled' => env('PASSKEYS_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Vibe Custom Models Configuration
    |--------------------------------------------------------------------------
    |
    | Jika developer ingin meng-extend atau me-rewrite model internal Vibe UI,
    | daftarkan class model kustom Anda di sini.
    |
    */
    'models' => [
        'two_factor' => \Teknovate\VibeUi\Models\TwoFactorAuthenticator::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Vibe Notifications Configuration
    |--------------------------------------------------------------------------
    |
    | Class notifikasi bawaan yang digunakan untuk pengiriman kode verifikasi 2FA.
    | Developer dapat me-rewrite atau meng-extend notifikasi kustom mereka di sini.
    |
    */
    'notifications' => [
        'two_factor_code' => \Teknovate\VibeUi\Notifications\TwoFactorCodeNotification::class,
    ],
];

