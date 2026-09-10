<?php

return [
    'title' => 'Form',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen form wrapper cerdas yang dirancang untuk mengelola tata letak formulir, penyimpanan draf otomatis (auto-save draft) ke sessionStorage atau localStorage dengan jeda debounce, pemulihan data otomatis saat halaman dimuat ulang atau modal/sheet dibuka, serta pembersihan draf secara otomatis saat form disubmit.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> untuk membungkus elemen input dan tombol. Komponen ini menerima atribut HTML form standar seperti <code class="font-mono text-xs text-foreground">action</code>, <code class="font-mono text-xs text-foreground">method</code>, dan atribut Alpine/Livewire.',
        'preview_title' => 'Formulir Kontak Sederhana',
        'name_label' => 'Nama Lengkap',
        'name_placeholder' => 'Masukkan nama lengkap...',
        'email_label' => 'Alamat Email',
        'email_placeholder' => 'nama@contoh.com',
        'message_label' => 'Pesan / Pertanyaan',
        'message_placeholder' => 'Tuliskan pesan Anda di sini...',
        'submit_btn' => 'Kirim Pesan',
    ],

    // Section 2: Session Storage (storageType="session")
    'session_storage' => [
        'title' => 'Penyimpanan Draf di Session Storage (storageType="session")',
        'desc' => 'Untuk formulir dengan data sementara atau sensitif, gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">storage-type="session"</code> bersama <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:save-to-storage="true"</code>. Data akan disimpan di dalam <code class="font-mono text-xs text-foreground">window.sessionStorage</code> browser. Data draf tetap terjaga jika halaman di-*refresh*, namun akan langsung terhapus secara aman begitu tab browser ditutup oleh pengguna.',
        'preview_title' => 'Formulir dengan Penyimpanan Session Storage',
        'checkout_title' => 'Data Pembayaran & Transaksi Sementara',
        'card_holder' => 'Nama Pemegang Rekening / Kartu',
        'card_number' => 'Nomor Identitas Transaksi / Akun',
        'notes' => 'Instruksi Khusus Transaksi',
        'notes_placeholder' => 'Masukkan catatan khusus...',
        'submit_btn' => 'Proses Transaksi',
        'clear_btn' => 'Hapus Draf Session',
        'badge' => 'Session Storage Aktif',
        'hint' => 'Data tersimpan di sessionStorage tab ini. Coba refresh halaman untuk melihat draf tetap ada, atau tutup tab untuk memastikan data terhapus otomatis.',
    ],

    // Section 3: Local Storage (storageType="local")
    'local_storage' => [
        'title' => 'Penyimpanan Draf di Local Storage (storageType="local")',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">storage-type="local"</code> untuk formulir panjang seperti artikel blog, pendaftaran multi-langkah, atau dokumen penting. Data disimpan ke <code class="font-mono text-xs text-foreground">window.localStorage</code> dan tetap bertahan meskipun browser ditutup dan dibuka kembali, dengan batas kedaluwarsa otomatis via prop <code class="font-mono text-xs text-foreground">expire-hours</code>.',
        'preview_title' => 'Formulir Draf Artikel (Local Storage)',
        'article_title' => 'Judul Artikel / Catatan Panjang',
        'article_placeholder' => 'Ketik draf artikel Anda...',
        'content_label' => 'Konten Lengkap',
        'content_placeholder' => 'Ketik draf isi artikel yang ingin disimpan jangka panjang...',
        'submit_btn' => 'Publikasikan',
        'reset_btn' => 'Kosongkan Form',
        'hint' => 'Data disimpan di localStorage. Data draf tetap aman meskipun Anda menutup browser sepenuhnya!',
        'security_title' => 'Peringatan Keamanan: Jangan Menyimpan Data Rahasia / Sensitif di Local Storage',
        'security_desc' => '<code>window.localStorage</code> menyimpan data dalam format teks terbuka tanpa enkripsi dan dapat diakses oleh skrip JavaScript apapun yang berjalan pada origin domain yang sama (berisiko jika terjadi celah Cross-Site Scripting / XSS).',
        'security_points' => [
            'sensitive' => '<strong>Hindari Data Rahasia:</strong> Jangan pernah menyimpan kata sandi (password), nomor kartu kredit, kode CVV, nomor PIN, token akses otentikasi rahasia, atau data pribadi yang sangat sensitif (PII).',
            'shared_device' => '<strong>Perangkat Bersama (Shared Devices):</strong> Data di localStorage tidak terhapus saat jendela browser ditutup, sehingga pengguna berikutnya di perangkat yang sama dapat melihat isi draf jika belum disubmit.',
            'alternative' => '<strong>Gunakan Session Storage:</strong> Untuk formulir transaksi, pembayaran, atau data sementara, gunakan <code class="font-mono text-xs text-foreground">storage-type="session"</code> agar draf otomatis terhapus saat tab ditutup.',
        ],
    ],

    // Section 4: Multi-Column Grid Layout
    'grid_layout' => [
        'title' => 'Tata Letak Multi-Kolom (Grid Layout)',
        'desc' => 'Kelompokkan bidang isian secara responsif menggunakan sistem grid Tailwind pada kelas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form class="grid grid-cols-1 md:grid-cols-2 gap-4"&gt;</code>.',
        'preview_title' => 'Formulir Pendaftaran Multi-Kolom',
        'first_name' => 'Nama Depan',
        'last_name' => 'Nama Belakang',
        'phone' => 'Nomor WhatsApp / Telepon',
        'role' => 'Peran Pekerjaan',
        'address' => 'Alamat Lengkap Kantor / Rumah',
        'address_placeholder' => 'Alamat jalan, nomor gedung, kelurahan...',
        'save_btn' => 'Daftarkan Akun',
        'cancel_btn' => 'Batal',
    ],

    // Section 5: Card Form Layout
    'card_form' => [
        'title' => 'Integrasi Form di Dalam Card',
        'desc' => 'Gabungkan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:card&gt;</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> untuk tata letak halaman pengaturan atau formulir input yang elegan dan terstruktur rapi.',
        'preview_title' => 'Pengaturan Profil Akun',
        'card_title' => 'Informasi Profil Akun',
        'card_desc' => 'Perbarui data pribadi Anda dan preferensi akun yang digunakan di platform.',
        'username' => 'Nama Pengguna (Username)',
        'bio' => 'Bio Singkat',
        'bio_placeholder' => 'Ceritakan sedikit tentang keahlian atau pekerjaan Anda...',
        'save_changes' => 'Simpan Perubahan',
    ],

    // Section 6: Modal & Sheet Awareness
    'modal_sheet' => [
        'title' => 'Integrasi dengan Modal & Sheet',
        'desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:form&gt;</code> secara otomatis mendengarkan event <code class="font-mono text-xs text-foreground">open-modal</code> dan <code class="font-mono text-xs text-foreground">open-sheet</code>, sehingga saat formulir dibuka di dalam dialog atau drawer geser, nilai draf otomatis terisi tanpa terhapus oleh inisialisasi Livewire/Alpine.',
    ],

    // Section 7: Props Reference
    'props' => [
        'title' => 'Referensi Props & Fitur',
        'desc' => 'Daftar atribut dan parameter yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:form&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'features' => [
        'title' => 'Mekanisme & Fitur Otomatis',
        'columns' => [
            'feature' => 'Fitur / Event',
            'desc' => 'Mekanisme Kerja',
        ],
    ],

    'ajax_alert' => [
        'success_title' => 'Pengujian Form (AJAX / Fetch) Berhasil Diposting ke FormController!',
        'time_prefix' => 'Waktu:',
        'fields_suffix' => 'fields diterima via JSON (tanpa refresh)',
        'view_payload_btn' => 'Lihat Payload JSON',
    ],

    'props_items' => [
        'id' => 'ID unik formulir. Wajib diisi jika `saveToStorage` diaktifkan sebagai kunci pembeda draf di storage.',
        'saveToStorage' => 'Jika `true`, secara otomatis menyimpan draf isian formulir ke browser storage setiap ada ketikan.',
        'storageType' => "Jenis penyimpanan browser: `'session'` (sessionStorage, aman & terhapus saat tab ditutup) atau `'local'` (localStorage, permanen).",
        'expireHours' => 'Masa berlaku draf dalam hitungan jam sebelum otomatis dibersihkan saat kedaluwarsa.',
    ],

    'storage_comparison' => [
        'title' => 'Perbandingan sessionStorage vs localStorage',
        'columns' => [
            'mechanism' => 'Mekanisme',
            'location' => 'Lokasi',
            'lifetime' => 'Masa Hidup Data',
            'best_for' => 'Kasus Penggunaan Terbaik',
        ],
        'session_location' => 'Browser (sessionStorage)',
        'session_lifetime' => 'Selama tab aktif (terhapus saat tab ditutup)',
        'session_best_for' => 'Formulir checkout, transaksi pembayaran, form multi-langkah (wizard), data sensitif.',
        'local_location' => 'Browser (localStorage)',
        'local_lifetime' => 'Tetap ada meski browser ditutup (hingga expireHours)',
        'local_best_for' => 'Draf artikel panjang, formulir profil besar, draf dokumen kerja berulang.',
        'local_warning' => '⚠️ Hindari menyimpan kata sandi, token, atau data keuangan.',
    ],

    'features_items' => [
        'debounce' => 'Mendeteksi ketikan dan perubahan input dengan jeda 500 milidetik sebelum menulis ke storage agar tidak membebani performa browser.',
        'clear' => 'Menghapus draf form dari storage secara otomatis ketika form berhasil dikirimkan.',
        'modal_sheet' => 'Memulihkan draf form secara otomatis saat modal atau slide-out drawer dibuka.',
        'sanitize' => 'Secara otomatis menyaring dan mengabaikan file biner, token CSRF (<code class="font-mono text-xs text-foreground">_token</code>), dan state internal Livewire.',
    ],
];
