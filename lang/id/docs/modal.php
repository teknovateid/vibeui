<?php

return [
    'title' => 'Modal Dialog',
    'badge' => 'Komponen',
    'group' => 'Overlay & Dialog',
    'description' => 'Komponen dialog modal modern yang fleksibel dengan animasi transisi halus, backdrop blur, pemfokusan input otomatis, kontrol ukuran (maxWidth), posisi layar, mode statis non-dismissible, dan integrasi event Alpine.js serta Livewire 3.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:modal&gt;</code> yang dilengkapi dengan subkomponen semantik: <code class="font-mono text-xs text-foreground">&lt;vibe:modal.header&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:modal.content&gt;</code>, <code class="font-mono text-xs text-foreground">&lt;vibe:modal.footer&gt;</code>, dan <code class="font-mono text-xs text-foreground">&lt;vibe:modal.close&gt;</code>. Untuk membukanya dari tombol mana pun, picu event Alpine <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$dispatch(\'open-modal\', \'id-modal\')</code>.',
        'preview_title' => 'Modal Sederhana',
        'btn' => 'Buka Modal Sederhana',
        'modal_title' => 'Selamat Datang di Vibe UI',
        'modal_desc' => 'Ini adalah dialog modal berbasis compound components dengan animasi halus, backdrop blur elegan, dan struktur header/footer terpisah.',
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

    // Section 5: Form Inside Modal
    'form_modal' => [
        'title' => 'Modal dengan Formulir',
        'desc' => 'Letakkan komponen form (<code class="font-mono text-xs">&lt;vibe:input&gt;</code>, <code class="font-mono text-xs">&lt;vibe:select&gt;</code>) di dalam <code class="font-mono text-xs">&lt;vibe:modal.content&gt;</code>. Modal otomatis memfokuskan kursor pada elemen input pertama saat dialog dibuka.',
        'preview_title' => 'Modal Tambah Pengguna',
        'btn' => 'Buka Formulir Modal',
        'modal_title' => 'Tambah Anggota Tim Baru',
        'modal_desc' => 'Lengkapi rincian profil anggota baru di bawah ini.',
        'field_name' => 'Nama Lengkap',
        'field_name_placeholder' => 'Misal: Budi Pratama',
        'field_email' => 'Alamat Email',
        'field_email_placeholder' => 'budi@teknovate.id',
        'field_role' => 'Peran Akun',
        'role_admin' => 'Administrator',
        'role_editor' => 'Editor Konten',
        'role_viewer' => 'Viewer (Hanya Lihat)',
        'btn_cancel' => 'Batal',
        'btn_submit' => 'Simpan Pengguna',
    ],

    // Section 6: LocalStorage Persistence
    'persist' => [
        'title' => 'Penyimpanan Status (Persistence)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:persist="true"</code> untuk mengingat status modal di LocalStorage browser. Cocok untuk pengumuman atau alur verifikasi penting.',
        'preview_title' => 'Modal dengan State Persistence',
        'btn' => 'Buka Modal Persist',
        'modal_title' => 'Pembaruan Sistem v2.4',
        'modal_desc' => 'Status keterbukaan modal ini disimpan di LocalStorage. Jika Anda merefresh halaman saat modal ini sedang terbuka, modal akan otomatis kembali terbuka.',
        'feature_title' => 'Apa yang Baru?',
        'feature_1' => 'Peningkatan performa Vite sync plugin hingga 40%.',
        'feature_2' => 'Penambahan varian tombol soft dan glassmorphism.',
        'feature_3' => 'Dukungan dark mode adaptif berbasis sistem operasi.',
        'btn_dismiss' => 'Saya Sudah Paham (Tutup Permanen)',
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
        'subcomponents_title' => 'Anatomi Subkomponen Modal',
        'subcomponents_desc' => 'Daftar subkomponen modular untuk menyusun layout modal yang fleksibel dan terstruktur rapi.',
        'th_sub' => 'Subkomponen',
        'th_sub_desc' => 'Peran & Keterangan',
        'subcomponents' => [
            [
                'name' => '<vibe:modal.header>',
                'desc' => 'Bagian header atas modal dengan layout vertikal bawaan (flex-col), ukuran teks text-lg, dan garis batas pemisah opsional (border-b).',
            ],
            [
                'name' => '<vibe:modal.content>',
                'desc' => 'Wadah isi konten utama dengan padding standar dan kemampuan scroll vertikal otomatis (overflow-y-auto).',
            ],
            [
                'name' => '<vibe:modal.footer>',
                'desc' => 'Area aksi tombol di bagian bawah dengan garis batas atas (border-t) dan latar tipis halus.',
            ],
            [
                'name' => '<vibe:modal.close>',
                'desc' => 'Tombol silang penutup modal yang siap pakai dengan aksi Alpine close().',
            ],
        ],
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
                'desc' => 'Mengizinkan penutupan modal via klik pada backdrop latar belakang dan tombol escape.',
            ],
            [
                'name' => 'show',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menentukan apakah modal langsung terbuka saat halaman pertama kali dirender.',
            ],
            [
                'name' => 'persist',
                'type' => 'bool',
                'default' => 'false',
                'desc' => 'Menyimpan status buka/tutup modal ke LocalStorage browser sehingga modal otomatis tetap terbuka saat halaman direfresh jika belum ditutup.',
            ],
            [
                'name' => 'variant',
                'type' => 'string',
                'default' => '\'default\'',
                'desc' => 'Varian tampilan visual kartu modal (\'default\', \'elevated\', \'outline\', \'container\').',
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
