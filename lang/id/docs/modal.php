<?php

return [
    'title' => 'Modal Dialog',
    'badge' => 'Komponen',
    'group' => 'Overlay & Dialog',
    'description' => 'Komponen dialog modal modern yang fleksibel dengan animasi transisi halus, backdrop blur, pemfokusan input otomatis, kontrol ukuran (maxWidth), posisi layar, mode statis non-dismissible, dan integrasi event Alpine.js serta Livewire 3.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:modal&gt;</code> dengan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code> unik. Untuk membukanya dari tombol mana pun, picu event Alpine <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$dispatch(\'open-modal\', \'id-modal\')</code>.',
        'preview_title' => 'Modal Sederhana',
        'btn' => 'Buka Modal Sederhana',
        'modal_title' => 'Selamat Datang di Vibe UI',
        'modal_desc' => 'Ini adalah dialog modal standar dengan animasi transisi masuk yang mulus, backdrop blur elegan, dan tombol close di sudut kanan atas.',
        'btn_cancel' => 'Tutup',
        'btn_confirm' => 'Saya Mengerti',
    ],

    // Section 2: Sizes
    'sizes' => [
        'title' => 'Pilihan Ukuran (maxWidth)',
        'desc' => 'Atur lebar maksimum modal melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">maxWidth</code>. Pilihan yang didukung: <code class="font-mono text-xs text-foreground">sm</code>, <code class="font-mono text-xs text-foreground">md</code>, <code class="font-mono text-xs text-foreground">lg</code>, <code class="font-mono text-xs text-foreground">xl</code>, <code class="font-mono text-xs text-foreground">2xl</code> (default), <code class="font-mono text-xs text-foreground">3xl</code>, <code class="font-mono text-xs text-foreground">4xl</code>, <code class="font-mono text-xs text-foreground">5xl</code>, <code class="font-mono text-xs text-foreground">6xl</code>, <code class="font-mono text-xs text-foreground">7xl</code>, dan <code class="font-mono text-xs text-foreground">full</code>.',
        'preview_title' => 'Variasi Ukuran Modal',
        'sm_btn' => 'Small (sm)',
        'md_btn' => 'Medium (md)',
        'lg_btn' => 'Large (lg)',
        'xl2_btn' => 'Standard (2xl - Default)',
        'xl4_btn' => 'Extra Large (4xl)',
        'full_btn' => 'Full Width (full)',
        'modal_title' => 'Ukuran Modal: :size',
        'modal_desc' => 'Modal ini ditampilkan dengan prop <code class="font-mono text-xs">maxWidth=":size"</code>. Sesuaikan ukuran modal dengan kebutuhan kerapatan konten Anda.',
        'btn_close' => 'Tutup Modal',
    ],

    // Section 3: Positions
    'positions' => [
        'title' => 'Posisi Vertikal di Layar',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">position</code> untuk menentukan perataan vertikal modal: <code class="font-mono text-xs text-foreground">center</code> (default tengah), <code class="font-mono text-xs text-foreground">top</code> (bagian atas layar, cocok untuk search/command palette), dan <code class="font-mono text-xs text-foreground">bottom</code> (bagian bawah layar).',
        'preview_title' => 'Variasi Posisi Modal',
        'top_btn' => 'Posisi Atas (top)',
        'center_btn' => 'Posisi Tengah (center)',
        'bottom_btn' => 'Posisi Bawah (bottom)',
        'modal_title' => 'Posisi: :position',
        'modal_desc' => 'Modal ini diatur dengan prop <code class="font-mono text-xs">position=":position"</code>.',
        'btn_close' => 'Tutup Modal',
    ],

    // Section 4: Non-Dismissible / Static Modal
    'non_dismissible' => [
        'title' => 'Modal Statis (Non-Dismissible)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dismissible="false"</code> (atau <code class="font-mono text-xs text-foreground">:dismissible="false"</code>) untuk mencegah modal ditutup secara tidak sengaja melalui klik backdrop latar belakang atau tombol close silang. Pengguna diwajibkan memilih salah satu tombol aksi di dalam modal.',
        'preview_title' => 'Modal Konfirmasi Wajib',
        'btn' => 'Buka Modal Statis',
        'modal_title' => 'Konfirmasi Penghapusan Data',
        'modal_desc' => 'Tindakan ini permanen dan tidak dapat dibatalkan. Klik di luar backdrop atau tombol Escape tidak akan menutup dialog ini.',
        'btn_cancel' => 'Batalkan',
        'btn_confirm' => 'Ya, Hapus Sekarang',
    ],

    // Section 5: Form with Auto-focus
    'form_modal' => [
        'title' => 'Formulir & Autofokus Otomatis',
        'desc' => 'Komponen modal Vibe UI secara cerdas memfokuskan kursor pada elemen form pertama (<code class="font-mono text-xs text-foreground">input</code>, <code class="font-mono text-xs text-foreground">select</code>, atau <code class="font-mono text-xs text-foreground">textarea</code>) segera setelah animasi pembukaan modal selesai.',
        'preview_title' => 'Modal Formulir Interaktif',
        'btn' => 'Buka Modal Formulir',
        'modal_title' => 'Tambah Data Pengguna Baru',
        'modal_desc' => 'Kursor akan otomatis aktif di kolom Nama Lengkap saat modal ini terbuka.',
        'name_label' => 'Nama Lengkap',
        'name_placeholder' => 'Contoh: Budi Santoso',
        'email_label' => 'Alamat Email',
        'email_placeholder' => 'budi@example.com',
        'role_label' => 'Peran Akun',
        'role_placeholder' => 'Pilih peran...',
        'role_admin' => 'Administrator',
        'role_editor' => 'Editor',
        'role_user' => 'Pengguna Biasa',
        'btn_cancel' => 'Batal',
        'btn_submit' => 'Simpan Pengguna',
    ],

    // Section 6: Remember / Dismiss Persistence
    'remember' => [
        'title' => 'Modal Sekali Tampil / Pengumuman (remember)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:remember="true"</code> untuk modal pengumuman (*announcement*) atau tips *onboarding*. Sekali pengguna menutup modal, ID modal dicatat secara persisten ke dalam <code class="font-mono text-xs text-foreground">Alpine.store(\'vibeModals\')</code> (disimpan di LocalStorage browser) dan tidak akan muncul kembali saat halaman dimuat ulang.',
        'preview_title' => 'Modal Pengumuman Persisten',
        'btn' => 'Buka Modal Pengumuman',
        'reset_btn' => 'Reset LocalStorage Modal',
        'reset_toast' => 'Riwayat modal remember telah direset! Anda dapat membukanya kembali.',
        'modal_title' => 'Pemberitahuan Sistem Versi 2.0',
        'modal_desc' => 'Fitur-fitur terbaru Vibe UI telah aktif. Setelah Anda menutup pengumuman ini dengan tombol di bawah, modal tidak akan muncul lagi secara otomatis.',
        'btn_understand' => 'Saya Mengerti, Jangan Tampilkan Lagi',
    ],

    // Section 7: Livewire Integration
    'livewire' => [
        'title' => 'Integrasi dengan Livewire 3',
        'desc' => 'Buka dan tutup modal secara terprogram dari backend component Livewire menggunakan event dispatch <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$this-&gt;dispatch()</code>.',
        'preview_title' => 'Kode Integrasi Livewire',
        'backend_title' => 'Komponen Backend (PHP)',
        'frontend_title' => 'Blade View (Frontend)',
    ],

    // Section 8: Props Table
    'props' => [
        'title' => 'Referensi Properti & API',
        'desc' => 'Daftar atribut dan properti yang tersedia untuk komponen <code class="font-mono text-xs text-foreground">&lt;vibe:modal&gt;</code>.',
        'th_prop' => 'Properti',
        'th_type' => 'Tipe',
        'th_default' => 'Default',
        'th_desc' => 'Keterangan',
        'items' => [
            [
                'name' => 'id',
                'type' => 'string',
                'default' => 'uniqid()',
                'desc' => 'ID unik modal untuk pemicu event open-modal dan close-modal.',
            ],
            [
                'name' => 'show',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menentukan apakah modal langsung terbuka saat halaman pertama kali dirender.',
            ],
            [
                'name' => 'maxWidth',
                'type' => 'string',
                'default' => '\'2xl\'',
                'desc' => 'Lebar maksimum kontainer modal: sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl, atau full.',
            ],
            [
                'name' => 'position',
                'type' => 'string',
                'default' => '\'center\'',
                'desc' => 'Posisi vertikal modal: \'top\', \'center\', atau \'bottom\'.',
            ],
            [
                'name' => 'dismissible',
                'type' => 'bool',
                'default' => 'true',
                'desc' => 'Mengizinkan penutupan modal via tombol silang (x) dan klik pada backdrop latar belakang.',
            ],
            [
                'name' => 'remember',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menyimpan status penutupan di LocalStorage browser agar modal tidak muncul kembali setelah ditutup.',
            ],
        ],
        'events_title' => 'Referensi Event Window (Alpine.js & Livewire)',
        'events_desc' => 'Event global yang didengarkan oleh komponen modal pada objek window browser.',
        'th_event' => 'Nama Event',
        'th_payload' => 'Payload Data',
        'th_event_desc' => 'Keterangan',
        'events' => [
            [
                'name' => 'open-modal',
                'payload' => 'string (modalId)',
                'desc' => 'Membuka modal dengan ID yang sesuai.',
            ],
            [
                'name' => 'close-modal',
                'payload' => 'string (modalId)',
                'desc' => 'Menutup modal dengan ID yang sesuai.',
            ],
        ],
    ],
];
