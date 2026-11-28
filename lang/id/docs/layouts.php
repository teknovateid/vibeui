<?php

return [
    'badge' => 'Arsitektur Layout',
    'subtitle' => 'Asset Per-Layout & Kustomisasi Lengkap',
    'title' => 'Layouts & Asset Terisolasi',
    'description' => 'Setiap panel maupun auth layout di Vibe UI memiliki file CSS & JS sendiri yang di-scope pada [data-vibe-layout], lengkap dengan Props, Named Slots, dan variabel CSS tanpa konfigurasi terpusat.',

    'sections' => [
        'architecture' => [
            'title' => '1. Pilihan Panel & Auth Layout Bawaan',
            'desc' => 'Setiap layout memiliki arsitektur desain dan bundling CSS/JS terisolasi sehingga tidak pernah bertabrakan saat berpindah halaman via Livewire wire:navigate.',
            'preview_demo' => 'Buka Demo Live',
            'cards' => [
                'sidebar' => [
                    'title' => 'Modern Sidebar (sidebar)',
                    'tag' => 'Inset / Floating',
                    'desc' => 'Kanvas inset membulat di layar md+, sticky header kaca buram, nav pill modern, dan icon-rail minify.',
                ],
                'sidebar_classic' => [
                    'title' => 'Classic Sidebar (sidebar-classic)',
                    'tag' => 'Flush Admin',
                    'desc' => 'Grid admin klasik datar penuh tanpa inset, batas border tegas, densitas kompak, dan indikator garis kiri.',
                ],
                'topbar' => [
                    'title' => 'Horizontal Topbar (topbar)',
                    'tag' => 'Responsive Navbar',
                    'desc' => 'Header navigasi horizontal satu struktur DOM yang otomatis beralih ke menu popover saat layar menyempit.',
                ],
            ],
        ],
        'props_slots' => [
            'title' => '2. Kustomisasi via Props, CSS Variables & Slots',
            'desc' => 'Sesuaikan tipe shell, ukuran sidebar, varian nav, file CSS/JS tambahan, atau ganti blok slot (brand, sidebarMenu, headerActions, footer) langsung dari halaman.',
        ],
        'custom_panel' => [
            'title' => '3. Membuat Panel & Asset Override Sendiri',
            'desc' => 'Gunakan perintah Artisan vibe:layout dengan opsi --style dan --with-assets untuk menghasilkan panel route, view, dan CSS/JS terpisah.',
        ],
    ],

    'demo' => [
        'title' => 'Demo Live Switcher Layout',
        'subtitle' => 'Menampilkan gaya layout: :style',
        'back_to_docs' => 'Kembali ke Dokumentasi',
        'switch_hint' => 'Pilih style layout di bawah ini untuk melihat perbedaan CSS, JS, dan tata letak shell secara langsung:',
        'sample_card_title' => 'Inspeksi Shell Terisolasi',
        'sample_card_desc' => 'Perhatikan bagaimana radius kanvas, header, navigasi, dan tata letak utama berubah total per layout tanpa kebocoran style saat wire:navigate.',
    ],
];
