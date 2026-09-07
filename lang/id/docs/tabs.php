<?php

return [
    'title' => 'Tabs',
    'badge' => 'Komponen',
    'group' => 'Navigasi & Tata Letak',
    'description' => 'Komponen navigasi tab modern dan modular untuk mengelompokkan konten multi-tampilan dengan 2 desain tata letak utama (2 Baris horizontal & 2 Kolom vertikal), dibangun di atas komponen <vibe:button>, mendukung slot ikon SVG murni, badge penghitung, varian visual (pill, underline, button), persistensi localStorage bebas kedip (anti-FOUC), dan aksesibilitas keyboard WAI-ARIA.',

    // Section 1: 2-Row Design (Horizontal)
    'rows' => [
        'title' => 'Desain 2 Baris (Horizontal Tabs)',
        'desc' => 'Secara default (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">layout="rows"</code>), bilah tab diletakkan pada baris atas secara horizontal dan konten panel berada di baris bawah. Tata letak ini sangat cocok untuk navigasi antar bagian konten yang padat atau formulir bertahap.',
        'preview_title' => 'Tabs 2 Baris (Default)',
        'tab_profile' => 'Profil Pengguna',
        'tab_account' => 'Akun & Keamanan',
        'tab_billing' => 'Langganan',
        'profile_title' => 'Informasi Profil',
        'profile_desc' => 'Perbarui data diri, foto avatar, dan alamat email Anda di sini.',
        'account_title' => 'Keamanan Akun',
        'account_desc' => 'Kelola kata sandi, otentikasi dua faktor (2FA), dan riwayat sesi masuk.',
        'billing_title' => 'Paket Langganan',
        'billing_desc' => 'Kelola paket langganan aktif, metode pembayaran, dan riwayat faktur tagihan.',
    ],

    // Section 2: 2-Column Design (Vertical Side-by-Side)
    'cols' => [
        'title' => 'Desain 2 Kolom (Vertical Side-by-Side Tabs)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">layout="cols"</code> (atau <code class="font-mono text-xs text-foreground">orientation="vertical"</code>) untuk menyusun bilah tab di kolom sisi kiri dan konten panel di kolom sisi kanan. Desain 2 kolom ini sangat ideal untuk halaman Pengaturan Sistem, Profil Akun Dasbor, atau dokumentasi multi-kategori.',
        'preview_title' => 'Tabs 2 Kolom (Sidebar Layout)',
        'tab_general' => 'Pengaturan Umum',
        'tab_security' => 'Keamanan & Akses',
        'tab_notifications' => 'Preferensi Notifikasi',
        'tab_integrations' => 'Integrasi API',
        'general_title' => 'Preferensi Umum Aplikasi',
        'general_desc' => 'Konfigurasikan nama organisasi, zona waktu standar, dan bahasa antarmuka.',
        'security_title' => 'Pengaturan Keamanan Tingkat Lanjut',
        'security_desc' => 'Tentukan batas waktu sesi otomatis, pembatasan IP address, dan enkripsi data.',
        'notif_title' => 'Saluran Notifikasi',
        'notif_desc' => 'Pilih jenis pemberitahuan yang dikirim melalui email, SMS, atau webhook webhook.',
        'integrations_title' => 'Koneksi Layanan Pihak Ketiga',
        'integrations_desc' => 'Kelola kunci token API dan webhook eksternal untuk sinkronisasi otomatis.',
    ],

    // Section 3: Visual Variants
    'variants' => [
        'title' => 'Varian Gaya (Pill, Underline, Button)',
        'desc' => 'Pilih gaya visual yang serasi dengan desain aplikasi melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code>: <code class="font-mono text-xs text-foreground">pill</code> (kartu halus bergaya macOS/Shadcn), <code class="font-mono text-xs text-foreground">underline</code> (garis bawah bergaya GitHub/Flux UI), atau <code class="font-mono text-xs text-foreground">button</code> (tombol berbingkai independen).',
        'preview_title' => 'Perbandingan Varian Visual',
        'pill_label' => 'Varian Pill (Default)',
        'underline_label' => 'Varian Underline',
        'button_label' => 'Varian Button / Outline',
    ],

    // Section 4: Icons & Badges
    'icons' => [
        'title' => 'Tab dengan Ikon SVG & Badge Notifikasi',
        'desc' => 'Tambahkan slot ikon menggunakan SVG murni melalui <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:icon&gt;&lt;svg...&gt;&lt;/x-slot:icon&gt;</code> dan sertakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">badge="..."</code> untuk menampilkan angka counter atau label status.',
        'preview_title' => 'Tabs dengan Ikon SVG dan Badge',
        'tab_inbox' => 'Pesan Masuk',
        'tab_sent' => 'Terkirim',
        'tab_archive' => 'Arsip',
        'tab_spam' => 'Spam',
        'inbox_content' => 'Ada 12 pesan belum dibaca di kotak masuk utama Anda.',
        'sent_content' => 'Seluruh riwayat pesan keluar tercatat dengan aman.',
        'archive_content' => 'Pesan lama tersimpan dalam arsip terenkripsi.',
        'spam_content' => 'Folder spam dibersihkan secara berkala setiap 30 hari.',
    ],

    // Section 5: Fitted / Full-Width
    'fitted' => [
        'title' => 'Tab Lebar Penuh (Fitted / Equal Width)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">fitted="true"</code> pada <code class="font-mono text-xs text-foreground">&lt;vibe:tabs.list&gt;</code> agar setiap tab membagi lebar wadah secara merata 100%.',
        'preview_title' => 'Tab Fitted 100% Lebar',
        'tab_daily' => 'Harian',
        'tab_weekly' => 'Mingguan',
        'tab_monthly' => 'Bulanan',
        'tab_yearly' => 'Tahunan',
    ],

    // Section 6: Persistence
    'persist' => [
        'title' => 'Persistensi LocalStorage (persist)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code> untuk mengingat tab pilihan pengguna di <code class="font-mono text-xs text-foreground">localStorage</code>. Saat halaman dimuat ulang (refresh), tab yang sebelumnya aktif akan langsung terbuka kembali tanpa kedip.',
        'preview_title' => 'Demo Tab Persisten',
        'tab_step1' => 'Langkah 1: Identitas',
        'tab_step2' => 'Langkah 2: Verifikasi',
        'tab_step3' => 'Langkah 3: Konfirmasi',
        'reset_btn' => 'Reset LocalStorage Tab',
        'reset_toast' => 'Riwayat persistensi tab berhasil direset ke tab awal!',
        'reload_tip' => '💡 <strong>Uji Coba:</strong> Pilih salah satu tab (misal Langkah 2 atau Langkah 3), lalu coba <strong>refresh browser Anda (F5 / Ctrl+R)</strong>. Tab aktif akan otomatis dipertahankan!',
    ],

    // Section 7: Livewire Integration
    'livewire' => [
        'title' => 'Integrasi Livewire & URL Sync',
        'desc' => 'Komponen tab dapat dikontrol dari backend Livewire menggunakan event dispatch atau disinkronkan dengan URL parameter menggunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sync-url="tab"</code>.',
        'preview_title' => 'Kode Integrasi Livewire & Sinkronisasi URL',
    ],

    // Section 8: Custom Designs & Styling
    'custom' => [
        'title' => 'Inspirasi Desain Kustom (Custom Class)',
        'desc' => 'Komponen Tabs dirancang fleksibel tanpa membatasi kreativitas Anda. Tanpa memodifikasi kode inti komponen, Anda dapat memanfaatkan utilitas Tailwind CSS pada atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="..."</code> untuk menciptakan beragam desain antarmuka modern yang unik.',
        
        // 1. Floating Glassmorphism Pill
        'floating_title' => '1. Floating Glassmorphism Pill',
        'floating_desc' => 'Desain kapsul melayang dengan efek kaca transparan (<code class="font-mono text-xs text-foreground">backdrop-blur-xl</code>), bayangan halus, dan sudut membulat penuh (<code class="font-mono text-xs text-foreground">rounded-full</code>). Sangat pas untuk menu navigasi hero beranda, etalase portofolio, atau filter kategori.',
        'floating_preview_title' => 'Tabs Floating Glassmorphism',
        'floating_tab_overview' => 'Ringkasan',
        'floating_tab_analytics' => 'Analitik',
        'floating_tab_reports' => 'Laporan & Ekspor',
        'floating_overview_title' => 'Performa Penjualan & Konversi',
        'floating_overview_desc' => 'Total pendapatan kotor meningkat +24.8% pada kuartal ini dengan tingkat retensi pelanggan mencapai 94.2%.',
        'floating_analytics_title' => 'Metrik Lalu Lintas Real-Time',
        'floating_analytics_desc' => '82,450 pengunjung aktif harian dengan rata-rata waktu interaksi 4 menit 12 detik.',
        'floating_reports_title' => 'Laporan Keuangan Terakhir',
        'floating_reports_desc' => 'Unduh laporan audit kuartalan (Q3) dan rekap transaksi pajak berformat PDF atau spreadsheet.',

        // 2. Card Header Segmented
        'card_header_title' => '2. Card Header Segmented (Linear / GitHub Style)',
        'card_header_desc' => 'Menyematkan tab langsung di dalam header <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> dengan pembatas garis bawah terpadu. Sangat rapi untuk halaman konfigurasi proyek, administrasi repositori, atau dasbor SaaS.',
        'card_header_preview_title' => 'Tabs Card Header Segmented',
        'card_header_tab_general' => 'Pengaturan Umum',
        'card_header_tab_collaborators' => 'Kolaborator Tim',
        'card_header_tab_webhooks' => 'Webhooks',
        'card_header_general_title' => 'Konfigurasi Proyek Utama',
        'card_header_general_desc' => 'Ubah nama proyek, visibilitas repositori, dan cabang utama (default branch).',
        'card_header_collab_title' => 'Hak Akses & Anggota Tim',
        'card_header_collab_desc' => 'Kelola izin akses kontributor, pengembang, dan manajer rilis.',
        'card_header_webhooks_title' => 'Endpoint Webhooks Eksternal',
        'card_header_webhooks_desc' => 'Kirim muatan event otomatis ke server CI/CD atau bot Discord/Slack Anda.',

        // 3. Sidebar Settings Navigation (2 Kolom)
        'sidebar_title' => '3. Sidebar Navigasi Dasbor Pengaturan (2 Kolom)',
        'sidebar_desc' => 'Menggunakan tata letak vertikal <code class="font-mono text-xs text-foreground">layout="cols"</code> dengan daftar tab berwadah kartu samping (sidebar), ikon SVG terarah, badge status, dan panel formulir yang leluasa.',
        'sidebar_preview_title' => 'Tabs Sidebar Dasbor (2 Kolom)',
        'sidebar_tab_profile' => 'Profil Pengguna',
        'sidebar_tab_billing' => 'Langganan & Paket',
        'sidebar_tab_api' => 'Kunci Token API',
        'sidebar_tab_security' => 'Keamanan Akun',
        'sidebar_profile_title' => 'Informasi Akun Pribadi',
        'sidebar_profile_desc' => 'Perbarui data identitas, bio singkat, dan avatar pengguna Anda.',
        'sidebar_billing_title' => 'Paket Langganan Enterprise',
        'sidebar_billing_desc' => 'Paket Anda aktif hingga 31 Desember 2026 dengan kuota unlimited API calls.',
        'sidebar_api_title' => 'Manajemen Kunci API Pengembang',
        'sidebar_api_desc' => 'Kunci API memberikan akses langsung ke endpoint GraphQL dan REST Vibe UI.',
        'sidebar_security_title' => 'Keamanan & Autentikasi Dua Faktor (2FA)',
        'sidebar_security_desc' => 'Amankan login Anda menggunakan aplikasi autentikator atau kunci fisik FIDO2.',

        // 4. Dark Dev Console / Terminal Code Tabs
        'terminal_title' => '4. Dark Dev Terminal / Code Snippet Switcher',
        'terminal_desc' => 'Desain gelap bergaya konsol pengembang (developer terminal) dengan font monospaced, tombol jendela macOS, dan tab ringkas untuk beralih antar bahasa pemrograman (cURL, PHP SDK, Node.js, Python).',
        'terminal_preview_title' => 'Tabs Terminal Konsol Pengembang',
        'terminal_tab_curl' => 'cURL',
        'terminal_tab_php' => 'PHP (SDK)',
        'terminal_tab_node' => 'Node.js',
        'terminal_tab_python' => 'Python',

        // 5. Segmented Filter Bar
        'filter_title' => '5. Segmented Filter Bar dengan Badge Counter',
        'filter_desc' => 'Bilah penyaring data yang ringkas menggunakan prop <code class="font-mono text-xs text-foreground">fitted="true"</code>, sudut membulat penuh, dan badge counter untuk menyaring tugas berdasarkan status (Semua, Sedang Berjalan, Selesai).',
        'filter_preview_title' => 'Tabs Filter Bar dengan Badge Counter',
        'filter_tab_all' => 'Semua Tugas',
        'filter_tab_active' => 'Sedang Berjalan',
        'filter_tab_completed' => 'Selesai',
        'filter_all_content' => 'Menampilkan seluruh 38 tugas yang terdaftar di proyek ini.',
        'filter_active_content' => '14 tugas saat ini sedang dikerjakan oleh tim pengembang.',
        'filter_completed_content' => '24 tugas telah diverifikasi dan diselesaikan dengan sukses.',
    ],

    // Props Table
    'props' => [
        'title' => 'Referensi Properti & API',
        'desc' => 'Daftar atribut dan konfigurasi yang tersedia untuk seluruh keluarga komponen tab.',
        'tabs_title' => 'Properti <vibe:tabs>',
        'list_title' => 'Properti <vibe:tabs.list>',
        'tab_title' => 'Properti <vibe:tabs.tab>',
        'panel_title' => 'Properti <vibe:tabs.panel>',
        'th_prop' => 'Properti',
        'th_type' => 'Tipe',
        'th_default' => 'Default',
        'th_desc' => 'Keterangan',
        'tabs_items' => [
            [
                'name' => 'layout',
                'type' => 'string',
                'default' => '\'rows\'',
                'desc' => 'Tata letak tab: \'rows\' (2 baris: list di atas, panel di bawah) atau \'cols\' (2 kolom: list di kiri, panel di kanan).',
            ],
            [
                'name' => 'variant',
                'type' => 'string',
                'default' => '\'pill\'',
                'desc' => 'Varian gaya tab: \'pill\', \'underline\', atau \'button\'.',
            ],
            [
                'name' => 'size',
                'type' => 'string',
                'default' => '\'md\'',
                'desc' => 'Ukuran tab: \'sm\', \'md\', atau \'lg\'.',
            ],
            [
                'name' => 'default / selected',
                'type' => 'string|null',
                'default' => 'null',
                'desc' => 'Nama tab (name) yang otomatis aktif saat pertama kali dimuat.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menyimpan pilihan tab aktif ke browser LocalStorage.',
            ],
            [
                'name' => 'id',
                'type' => 'string|null',
                'default' => 'uniqid()',
                'desc' => 'ID unik tabs container untuk pemetaan persistensi dan aksesibilitas ARIA.',
            ],
            [
                'name' => 'syncUrl',
                'type' => 'bool|string',
                'default' => 'false',
                'desc' => 'Sinkronisasi tab aktif ke query parameter URL (misal ?tab=security).',
            ],
        ],
        'tab_items' => [
            [
                'name' => 'name',
                'type' => 'string',
                'default' => '— (Wajib)',
                'desc' => 'Identifier unik tab yang menghubungkannya dengan panel konten.',
            ],
            [
                'name' => 'icon',
                'type' => 'slot (SVG)',
                'default' => 'null',
                'desc' => 'Slot ikon SVG murni yang diletakkan di sisi kiri teks tab.',
            ],
            [
                'name' => 'badge',
                'type' => 'string|int|null',
                'default' => 'null',
                'desc' => 'Teks counter atau label pill notifikasi di sisi kanan teks tab.',
            ],
            [
                'name' => 'badgeVariant',
                'type' => 'string',
                'default' => '\'secondary\'',
                'desc' => 'Varian badge: secondary, primary, outline, success, destructive, dll.',
            ],
            [
                'name' => 'disabled',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menonaktifkan interaksi klik dan navigasi keyboard pada tab.',
            ],
            [
                'name' => 'href',
                'type' => 'string|null',
                'default' => 'null',
                'desc' => 'Mengubah tab menjadi tautan navigasi halaman penuh dengan wire:navigate.',
            ],
        ],
        'list_items' => [
            [
                'name' => 'fitted',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Membagi lebar setiap tab secara merata memenuhi 100% lebar kontainer.',
            ],
        ],
        'panel_items' => [
            [
                'name' => 'name',
                'type' => 'string',
                'default' => '— (Wajib)',
                'desc' => 'Identifier yang cocok dengan name tab pemicunya.',
            ],
            [
                'name' => 'lazy',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menunda rendering konten HTML panel hingga tab tersebut diaktifkan.',
            ],
        ],
    ],
];
