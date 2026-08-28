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
];
