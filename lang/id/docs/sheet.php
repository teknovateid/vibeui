<?php

return [
    'title' => 'Sheet / Drawer',
    'badge' => 'Komponen',
    'group' => 'Overlay & Navigasi',
    'description' => 'Komponen panel samping fleksibel (sheet/drawer) yang dapat dibuka dari 4 sisi layar, mendukung resize interaktif dengan drag handle, mode collapsible dan minify, tombol toggle bawaan, serta persistensi ukuran di LocalStorage.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:sheet&gt;</code> dilengkapi dengan subkomponen semantik: <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.header&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.body&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.footer&gt;</code>, dan <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.close&gt;</code>. Untuk mengendalikannya, cukup kirimkan event Alpine: <code class="font-mono text-xs text-foreground">$dispatch(\'toggle-sheet\', \'sheet-id\')</code>.',
        'preview_title' => 'Sheet Sisi Kanan (Drawer)',
        'btn_toggle' => 'Toggle Panel Sheet',
        'btn_open' => 'Buka Sheet',
        'header_title' => 'Detail Informasi',
        'body_text' => 'Ini adalah konten di dalam subkomponen <code class="font-mono text-xs text-foreground">&lt;vibe:sheet.body&gt;</code>. Area ini otomatis memiliki scroll vertikal (<code class="font-mono text-xs text-foreground">overflow-y-auto</code>) dan fleksibel mengisi ruang yang tersisa.',
        'footer_cancel' => 'Tutup',
        'footer_save' => 'Simpan Data',
    ],

    // Section 2: Positions
    'positions' => [
        'title' => 'Pilihan Posisi (4 Sisi)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code> untuk menentukan arah munculnya panel: <code class="font-mono text-xs text-foreground">left</code> (kiri), <code class="font-mono text-xs text-foreground">right</code> (kanan), <code class="font-mono text-xs text-foreground">top</code> (atas), atau <code class="font-mono text-xs text-foreground">bottom</code> (bawah).',
        'preview_title' => 'Variasi 4 Posisi Sheet',
        'btn_right' => 'Kanan (Right)',
        'btn_left' => 'Kiri (Left)',
        'btn_top' => 'Atas (Top)',
        'btn_bottom' => 'Bawah (Bottom)',
        'sheet_title' => 'Sheet Posisi: :pos',
        'sheet_desc' => 'Sheet ini menggunakan konfigurasi prop <code class="font-mono text-xs">position=":pos"</code>.',
    ],

    // Section 3: Resizable
    'resizable' => [
        'title' => 'Resize Interaktif (Drag Handle)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:resizable="true"</code> untuk memberikan handle pemisah yang dapat ditarik (drag) oleh pengguna secara langsung. Anda dapat membatasi rentang ukuran dengan <code class="font-mono text-xs text-foreground">:minSize="200"</code> dan <code class="font-mono text-xs text-foreground">:maxSize="500"</code>.',
        'preview_title' => 'Panel yang Dapat Diubah Ukuran',
        'hint' => 'Arahkan kursor ke garis tepi panel untuk mulai menarik (drag & resize).',
        'sheet_title' => 'Panel Resizable',
        'sheet_desc' => 'Tarik tepi panel ini ke kiri atau ke kanan untuk mengubah lebarnya secara interaktif.',
    ],

    // Section: Mobile Bottom Sheet (Resizable & Rounded Top)
    'bottom_sheet' => [
        'title' => 'Bottom Sheet Mobile (Resizable & Rounded-T)',
        'desc' => 'Untuk antarmuka mobile atau aplikasi responsif, sheet posisi bawah (<code class="font-mono text-xs text-foreground">position="bottom"</code>) dengan sudut membulat atas (<code class="font-mono text-xs text-foreground">class="rounded-t-2xl"</code> atau <code class="font-mono text-xs text-foreground">rounded-t-3xl</code>) dan fitur <code class="font-mono text-xs text-foreground">:resizable="true"</code> memberikan pengalaman <em>mobile action sheet</em> yang sangat interaktif dan fleksibel. Pengguna dapat menarik (drag) handle bar ke atas/bawah untuk memperluas atau memperkecil tinggi sheet.',
        'preview_title' => 'Simulasi Mobile Bottom Sheet',
        'btn_toggle' => 'Buka / Tutup Bottom Sheet',
        'sheet_title' => 'Menu Pilihan & Aksi',
        'sheet_desc' => 'Tarik handle bar di atas untuk mengubah tinggi sheet (resizable).',
        'item_share' => 'Bagikan Tautan Dokumen',
        'item_download' => 'Unduh Lampiran Berkas',
        'item_bookmark' => 'Simpan ke Daftar Favorit',
        'item_delete' => 'Hapus Item Permanen',
        'btn_cancel' => 'Tutup Menu',
    ],

    // Section 4: Behaviors
    'behaviors' => [
        'title' => 'Mode Perilaku: Collapsible & Minify',
        'desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">behavior</code> mengontrol cara panel dilipat: <code class="font-mono text-xs text-foreground">collapsible</code> melipat panel hingga hilang sepenuhnya (0px), sedangkan <code class="font-mono text-xs text-foreground">minify</code> menyusutkan panel menjadi ukuran ikon ramping (<code class="font-mono text-xs text-foreground">:minifiedSize="70"</code>), sangat ideal untuk navigasi sidebar admin.',
        'preview_title' => 'Mode Minify & Collapsible',
        'btn_minify' => 'Toggle Minify Sheet',
        'sheet_title' => 'Sidebar Minify',
        'nav_dashboard' => 'Dashboard',
        'nav_users' => 'Pengguna',
        'nav_settings' => 'Pengaturan',
    ],

    // Section 5: Built-in Toggle Button
    'toggle' => [
        'title' => 'Tombol Toggle Bawaan (showToggle)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:showToggle="true"</code> untuk memunculkan tombol panah bulat otomatis di tepi sheet yang berotasi mulus mengikuti status terbuka atau tertutupnya panel.',
        'preview_title' => 'Sheet dengan Tombol Toggle Otomatis',
        'sheet_title' => 'Panel dengan Tombol Toggle',
        'sheet_desc' => 'Klik tombol panah bulat di sisi kiri/kanan panel ini untuk melipat atau memperluas konten.',
    ],

    // Section 6: Layout Overlay vs Relative
    'layouts' => [
        'title' => 'Mode Layout: Overlay vs Inline Relative',
        'desc' => 'Secara default sheet menggunakan <code class="font-mono text-xs text-foreground">layout="relative"</code> (mendorong konten di sampingnya). Jika Anda ingin sheet melayang di atas konten utama sebagai drawer modal, gunakan <code class="font-mono text-xs text-foreground">layout="absolute"</code> atau <code class="font-mono text-xs text-foreground">layout="fixed"</code> bersama prop <code class="font-mono text-xs text-foreground">:closeOnOutsideClick="true"</code>.',
        'preview_title' => 'Drawer Overlay Melayang',
        'btn_open' => 'Buka Drawer Overlay',
        'drawer_title' => 'Drawer Melayang (Overlay)',
        'drawer_desc' => 'Drawer ini muncul di atas konten utama tanpa menggeser elemen di bawahnya. Klik di luar area drawer untuk menutupnya.',
    ],

    // Section 7: Close on Outside Click & Backdrop
    'outside_click' => [
        'title' => 'Tutup Otomatis Saat Klik di Luar (closeOnOutsideClick & Backdrop)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:closeOnOutsideClick="true"</code> agar sheet otomatis menutup saat pengguna mengklik area mana pun di luar batas panel sheet. Fitur ini sangat ideal untuk panel filter, panel opsi cepat, maupun modal drawer.<br><br>💡 <strong>Tips Penting:</strong> Pada tombol pembuka (*trigger button*), gunakan modifier Alpine <code class="font-mono text-xs text-foreground">@click.stop="$dispatch(\'open-sheet\', \'...\')"</code> agar klik pembuka tidak langsung dianggap sebagai klik luar pada saat bersamaan.',
        'preview_title' => 'Demo Klik di Luar Panel & Backdrop',
        'btn_open_clean' => 'Buka Panel (Klik Luar Tanpa Backdrop)',
        'btn_open_backdrop' => 'Buka Drawer (Dengan Backdrop Blur)',
        'panel_title' => 'Panel Auto-Close',
        'panel_desc' => 'Panel ini dikonfigurasi dengan prop <code class="font-mono text-xs">:closeOnOutsideClick="true"</code>.',
        'outside_instruction' => '👉 Klik di area ini (di luar panel) untuk otomatis menutup sheet.',
        'backdrop_instruction' => '👉 Klik pada backdrop gelap blur di luar drawer ini untuk menutupnya.',
        'drawer_title' => 'Drawer dengan Backdrop',
        'drawer_desc' => 'Kombinasi layout overlay dengan backdrop transparan.',
        'btn_close' => 'Tutup Panel',
    ],

    // Section 7: LocalStorage Persistence
    'persist' => [
        'title' => 'Persistensi Status & Ukuran (persist)',
        'desc' => 'Dengan menambahkan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code>, ukuran lebar/tinggi serta status buka-tutup sheet akan otomatis disimpan di <code class="font-mono text-xs text-foreground">LocalStorage</code> browser. Dilengkapi dengan skrip anti-FOUC bawaan agar tampilan tidak berkedip (*zero layout shift*) saat halaman di-refresh.',
        'preview_title' => 'Sheet dengan State Tersimpan',
        'btn_toggle' => 'Toggle Persist Sheet',
        'reset_btn' => 'Hapus Data LocalStorage',
        'reset_toast' => 'Penyimpanan state sheet telah direset!',
        'sheet_title' => 'Ukuran & State Disimpan',
        'sheet_desc' => 'Ubah ukuran panel ini atau tutup, lalu coba segarkan (refresh) halaman browser Anda. Ukuran dan posisi akan tetap sama!',
    ],

    // Section 8: API Reference
    'api' => [
        'title' => 'Referensi Properti & API',
        'desc' => 'Daftar atribut dan konfigurasi yang tersedia untuk komponen <code class="font-mono text-xs text-foreground">&lt;vibe:sheet&gt;</code>.',
        'th_prop' => 'Properti',
        'th_type' => 'Tipe',
        'th_default' => 'Default',
        'th_desc' => 'Keterangan',
        'props' => [
            [
                'name' => 'id',
                'type' => 'string',
                'default' => 'uniqid(\'sheet-\')',
                'desc' => 'ID unik sheet untuk pemicu event window open, close, dan toggle.',
            ],
            [
                'name' => 'position',
                'type' => 'string',
                'default' => '\'left\'',
                'desc' => 'Sisi penempatan panel: \'left\', \'right\', \'top\', atau \'bottom\'.',
            ],
            [
                'name' => 'layout',
                'type' => 'string',
                'default' => '\'relative\'',
                'desc' => 'Model tata letak: \'relative\' (inline flex), \'fixed\' (viewport fixed), \'absolute\' (container overlay), atau \'sticky\'.',
            ],
            [
                'name' => 'variant',
                'type' => 'string',
                'default' => '\'default\'',
                'desc' => 'Tema latar belakang: \'default\' (card), \'accent\', atau \'muted\'.',
            ],
            [
                'name' => 'behavior',
                'type' => 'string',
                'default' => '\'static\'',
                'desc' => 'Perilaku lipatan: \'static\' (tetap), \'collapsible\' (dapat ditutup hingga 0px), atau \'minify\' (dapat diperkecil ke mode ikon).',
            ],
            [
                'name' => 'defaultState',
                'type' => 'string',
                'default' => '\'expanded\'',
                'desc' => 'Status awal saat render: \'expanded\', \'collapsed\', atau \'minified\'.',
            ],
            [
                'name' => 'resizable',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Mengaktifkan drag handle interaktif untuk mengubah ukuran panel secara langsung.',
            ],
            [
                'name' => 'defaultSize',
                'type' => 'int',
                'default' => '350',
                'desc' => 'Ukuran lebar atau tinggi awal panel dalam satuan piksel (px).',
            ],
            [
                'name' => 'minSize',
                'type' => 'int',
                'default' => '0',
                'desc' => 'Batas ukuran minimum saat di-resize.',
            ],
            [
                'name' => 'maxSize',
                'type' => 'int',
                'default' => '600',
                'desc' => 'Batas ukuran maksimum saat di-resize.',
            ],
            [
                'name' => 'minifiedSize',
                'type' => 'int',
                'default' => '80',
                'desc' => 'Ukuran panel saat berada dalam status \'minified\' (piksel).',
            ],
            [
                'name' => 'showToggle',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menampilkan tombol panah toggle bulat otomatis di tepi sheet.',
            ],
            [
                'name' => 'closeOnOutsideClick',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menutup panel secara otomatis saat area luar sheet diklik.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menyimpan ukuran dan status sheet ke LocalStorage browser.',
            ],
        ],

        'events_title' => 'Referensi Event Window',
        'events_desc' => 'Event browser global untuk mengendalikan sheet dari Alpine.js atau Livewire.',
        'th_event' => 'Nama Event',
        'th_payload' => 'Payload Data',
        'th_event_desc' => 'Keterangan',
        'events' => [
            [
                'name' => 'open-sheet',
                'payload' => 'string (sheetId)',
                'desc' => 'Membuka sheet dengan ID yang sesuai ke status \'expanded\'.',
            ],
            [
                'name' => 'close-sheet',
                'payload' => 'string (sheetId)',
                'desc' => 'Menutup sheet dengan ID yang sesuai ke status \'collapsed\'.',
            ],
            [
                'name' => 'toggle-sheet',
                'payload' => 'string (sheetId)',
                'desc' => 'Mengalihkan status sheet antara terbuka dan tertutup/minified.',
            ],
        ],

        'subcomponents_title' => 'Anatomi Subkomponen',
        'subcomponents_desc' => 'Subkomponen pendukung untuk menstrukturkan tata letak bagian dalam sheet.',
        'th_sub' => 'Tag Komponen',
        'th_sub_desc' => 'Fungsi & Penjelasan',
        'subcomponents' => [
            [
                'name' => '<vibe:sheet>',
                'desc' => 'Kontainer utama sheet pembungkus seluruh konten.',
            ],
            [
                'name' => '<vibe:sheet.header>',
                'desc' => 'Bagian atas sheet yang memuat judul, deskripsi, atau aksi.',
            ],
            [
                'name' => '<vibe:sheet.body>',
                'desc' => 'Area konten utama dengan scroll vertikal otomatis (overflow-y-auto).',
            ],
            [
                'name' => '<vibe:sheet.footer>',
                'desc' => 'Bagian bawah sheet yang menempel di dasar untuk tombol simpan/batal.',
            ],
            [
                'name' => '<vibe:sheet.close>',
                'desc' => 'Tombol ikon silang (x) siap pakai untuk menutup sheet.',
            ],
        ],
    ],
];
