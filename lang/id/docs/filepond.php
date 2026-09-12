<?php

return [
    'title' => 'FilePond',
    'badge' => 'Komponen',
    'group' => 'Form & Upload',
    'description' => 'Komponen pengunggah berkas drag & drop modern dan kaya fitur. Mendukung pratinjau gambar, crop & resize, upload foto profil melingkar (avatar), validasi ukuran dan format berkas, integrasi Livewire v3, serta Presigned URL untuk pengunggahan langsung ke cloud storage (S3/R2) tanpa membebani server PHP.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:filepond&gt;</code> untuk membuat dropzone upload berkas. Asset CSS akan otomatis di-push ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;head&gt;</code> dan JS ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;body&gt;</code>.',
        'preview_title' => 'Upload Berkas Dasar',
        'label' => 'Unggah Dokumen',
        'description' => 'Pilih berkas dokumen atau tarik ke area ini.',
        'submit_btn' => 'Kirim Berkas (Test Request)',
    ],

    // Section 2: Multiple & Image Preview
    'multiple_preview' => [
        'title' => 'Multiple Files & Image Preview',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">multiple</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-files="5"</code> untuk mengizinkan upload banyak berkas sekaligus lengkap dengan galeri pratinjau instan.',
        'preview_title' => 'Upload Banyak Berkas & Pratinjau',
        'label' => 'Galeri Foto Produk',
        'description' => 'Maksimal hingga 5 foto sekaligus.',
        'submit_btn' => 'Kirim Galeri (Test Request)',
    ],

    // Section 3: Avatar / Circular
    'avatar_mode' => [
        'title' => 'Mode Avatar (Foto Profil Bulat)',
        'desc' => 'Aktifkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar</code> untuk mengubah drop area menjadi bentuk lingkaran 1:1, sangat cocok untuk halaman pengaturan profil pengguna.',
        'preview_title' => 'Upload Avatar Profil',
        'label' => 'Foto Profil Pengguna',
        'description' => 'Format JPG atau PNG, rasio otomatis 1:1.',
        'submit_btn' => 'Simpan Foto Profil',
    ],

    // Section 4: Validation
    'validation' => [
        'title' => 'Validasi Berkas (Ukuran & Format)',
        'desc' => 'Tentukan batas ukuran dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max-file-size="2MB"</code> dan format yang diizinkan dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">accepted-file-types="image/*, application/pdf"</code>.',
        'preview_title' => 'Validasi Berkas',
        'label' => 'Dokumen Terverifikasi (Maks 2MB, PDF/Gambar)',
        'submit_btn' => 'Kirim CV (Test Request)',
    ],

    // Section: Compact Variant
    'compact' => [
        'preview_title' => 'Varian Compact (Tampilan Ringkas Horizontal)',
        'label' => 'Lampiran Singkat',
        'title' => 'Lampirkan Dokumen Pendukung',
        'subtitle' => 'Semua format dokumen diizinkan (maks. 10MB)',
        'browse_label' => 'Jelajahi',
        'submit_btn' => 'Kirim Lampiran (Test Request)',
    ],

    // Section 5: Programmatic Control
    'programmatic' => [
        'title' => 'Kontrol Programatis & Ukuran Dropzone',
        'desc' => 'FilePond menyediakan opsi ukuran <code class="text-xs font-mono text-primary font-semibold">size="sm" | "md" | "lg"</code> serta metode Alpine seperti <code class="text-xs font-mono text-primary font-semibold">browse()</code> dan <code class="text-xs font-mono text-primary font-semibold">clear()</code>.',
        'preview_title' => 'Kontrol Programatis Eksternal',
        'label_sm' => 'Dropzone Ukuran Small (size=\'sm\')',
        'btn_browse' => 'Buka Pemilih Berkas (browse)',
        'btn_clear' => 'Bersihkan (clear)',
    ],

    // Section 6: Presigned URL Direct S3
    'presigned' => [
        'title' => 'Presigned URL Direct-to-Cloud Upload (S3/R2)',
        'desc' => 'Untuk menangani berkas berukuran besar (ratusan MB hingga GB) tanpa membebani memori PHP dan batas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">upload_max_filesize</code>, gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">presign-url</code>. Berkas akan diunggah langsung ke bucket cloud storage Anda via XHR PUT/POST dengan progress bar real-time.',
        'preview_title' => 'Direct Cloud Upload via Presigned URL',
        'label' => 'Video / Berkas Arsip Berukuran Besar',
        'description' => 'Berkas diunggah langsung ke bucket cloud penyimpanan (AWS S3, Cloudflare R2, MinIO).',
        'submit_btn' => 'Kirim Kunci S3 ke Controller (Test Request)',
        'submit_btn_code' => 'Kirim Kunci S3 ke Controller',
        'pill_title' => 'Direct Cloud Upload (Presigned URL)',
        'pill_desc' => 'Berkas dikirim langsung ke object storage tanpa membebani server backend aplikasi.',
        'backend_title' => 'Implementasi di FilepondController@presigned',
        'backend_desc' => 'Endpoint ini menerima request metadata berkas, lalu menghasilkan URL presigned upload sementara menggunakan driver S3 / Cloudflare R2:',
    ],

    // Section 7: Form Controller Test
    'form_controller' => [
        'title' => 'Form Submission & Controller ($request->all())',
        'desc' => 'Komponen &lt;vibe:filepond&gt; dapat digunakan di dalam formulir dan diposting langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FilepondController@requestTest</code>. Saat form dikirim, modal pengujian otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> dan kunci berkas secara real-time.',
        'protect_title' => 'Proteksi Submit Saat Upload Berlangsung',
        'protect_desc' => 'Jika pengguna menekan tombol submit atau mencoba berpindah halaman sementara berkas masih dalam proses upload, Vibe UI akan secara otomatis mencegat aksi tersebut dan menampilkan dialog proteksi penutupan tab peramban.',
        'preview_title' => 'Pengujian Form Submission Sederhana',
        'doc_label' => 'Dokumen Uji Coba',
        'submit_btn' => 'Simpan & Uji Request',
    ],

    // Section: Berkas yang Sudah Ada / Form Edit (File Exist)
    'existing_files_section' => [
        'title' => 'Berkas Tersimpan & Form Edit (File Exist)',
        'desc' => 'Saat membuat halaman <strong>Edit Data</strong> (misal Edit Profil, Edit Dokumen, atau Edit Produk), Anda dapat menampilkan berkas yang sudah ada sebelumnya di server atau Cloud Storage (S3) menggunakan prop <code class="text-xs font-mono text-primary font-semibold">:files="..."</code> atau <code class="text-xs font-mono text-primary font-semibold">:existing-files="..."</code>. Setiap berkas yang dimuat juga dilengkapi tombol <strong>Unduh (Download)</strong> sehingga pengguna dapat mengunduh berkas aslinya secara langsung.',
        'preview_multiple_title' => 'Form Edit Lampiran (Dokumen PDF & Foto dari S3)',
        'preview_avatar_title' => 'Form Edit Foto Profil (Avatar Mode dari S3)',
        'btn_submit' => 'Simpan Perubahan (Test Request)',
        'info_keys' => 'Berkas yang telah tersimpan otomatis disinkronkan ke dalam hidden input form, sehingga saat form disubmit data berkas lama tetap terkirim secara aman tanpa perlu diunggah ulang.',
    ],

    // Section: Reorder Berkas
    'reorder_section' => [
        'title' => 'Reorder Berkas (Mode Edit & Galeri)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">reorder</code> untuk mengaktifkan fitur pengurutan ulang berkas secara drag & drop. Urutan visual di UI akan langsung tersinkronkan ke input form saat disubmit, sehingga posisi berkas yang sudah ada maupun yang baru diunggah akan selalu sesuai tampilan.',
        'preview_title' => 'Galeri Reorder Berkas (Drag & Drop)',
        'label' => 'Galeri Produk (Bisa Diurutkan Ulang)',
        'description' => 'Tahan dan seret ikon enam titik atau klik panah ↑↓ untuk mengubah urutan berkas.',
        'submit_btn' => 'Simpan Urutan Galeri (Test Request)',
        'doc_title' => 'Cara Kerja di Controller',
        'doc_desc' => 'Saat form disubmit, <code class="font-mono text-xs text-primary">syncFormInputsOrder()</code> otomatis menyesuaikan indeks numerik tiap input (<code class="font-mono text-xs text-primary">gallery[0]</code>, <code class="font-mono text-xs text-primary">gallery[1]</code>, dst.) sesuai urutan visual di UI. <code class="font-mono text-xs text-primary">mergeInputsAndFiles()</code> di controller kemudian menggabungkan URL lama dan file baru menggunakan union array berindeks numerik sehingga urutan posisi selalu dipertahankan.',
    ],

    // Section 8: Livewire
    'livewire' => [
        'title' => 'Integrasi Native Livewire v3',
        'desc' => 'Komponen ini mendeteksi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code> secara otomatis dan menghubungkannya dengan trait <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">WithFileUploads</code> Livewire.',
        'btn_save' => 'Simpan Galeri',
    ],

    // Section 9: Events
    'events' => [
        'title' => 'Event & Pelacakan Aksi',
        'desc' => 'Komponen <code class="text-xs font-mono text-primary font-semibold">&lt;vibe:filepond&gt;</code> memancarkan event terpadu <code class="text-xs font-mono text-primary font-semibold">vibe-filepond</code> ke level window dan elemen. Anda dapat membedakan instans FilePond dengan memeriksa <code class="text-xs font-mono text-primary font-semibold">if ($event.detail.id === \'...\')</code>.',
        'table' => [
            'columns' => [
                'event' => 'Nilai $event.detail.event',
                'target' => 'Target',
                'desc' => 'Keterangan & Waktu Dipicu',
            ],
            'items' => [
                'add' => 'Dipicu saat berkas baru dipilih dari perangkat dan masuk ke antrean FilePond.',
                'start' => 'Dipicu ketika proses transfer/pengunggahan berkas mulai berjalan.',
                'progress' => 'Dipicu real-time membawa persentase pengunggahan (<code class="font-mono text-[11px]">$event.detail.progress</code> dari 0 - 100%).',
                'success' => 'Dipicu ketika berkas tuntas terunggah dan kunci penyimpanan (<code class="font-mono text-[11px]">$event.detail.key</code>) telah diterima.',
                'revert' => 'Dipicu ketika berkas yang <strong>sudah selesai diunggah dibatalkan/dihapus</strong> oleh pengguna (tombol undo).',
                'abort' => 'Dipicu ketika proses upload yang <strong>sedang berlangsung</strong> dihentikan sebelum tuntas.',
                'remove' => 'Dipicu ketika item berkas dikeluarkan dari antrean pond.',
                'error' => 'Dipicu jika berkas tidak lolos validasi ukuran/format atau server gagal menerima berkas.',
            ],
        ],
        'payload_title' => '1. Struktur Payload Objek',
        'payload_desc' => 'Setiap event membawa detail payload yang seragam dan kaya informasi:',
        'cookbook_title' => '3. Contoh Kasus Penggunaan Riil (Cookbook Recipes)',
        'recipe_1_title' => 'Resep 1: Menangani Pembatalan Berkas yang Sudah Diunggah (Revert / Delete from S3)',
        'recipe_1_desc' => 'Ketika pengguna menekan tombol silang / <em>undo</em> pada berkas yang sudah berhasil tersimpan di cloud storage, Anda wajib memanggil endpoint backend untuk menghapus berkas yatim (orphan file) tersebut agar storage tidak bocor atau membengkak tanpa kepemilikan:',
        'recipe_2_title' => 'Resep 2: Menonaktifkan Tombol Submit Selama Berkas Sedang Diunggah',
        'recipe_2_desc' => 'Kunci tombol simpan saat proses transfer dimulai (<code class="font-mono text-xs text-primary">start</code>) dan buka kembali saat selesai (<code class="font-mono text-xs text-primary">success</code> / <code class="font-mono text-xs text-primary">revert</code> / <code class="font-mono text-xs text-primary">error</code>) untuk mencegah user mengirim form setengah jadi:',
        'recipe_3_title' => 'Resep 3: Progress Bar Custom',
        'recipe_3_desc' => 'Memonitor persentase pengiriman data ke server/storage secara real-time untuk membuat visual progress bar terpisah di luar dropzone:',
        'sandbox_title' => 'Live Event Sandbox & Inspector',
        'sandbox_desc' => 'Coba pilih berkas apa saja di bawah ini untuk melihat seluruh rentetan event yang dipancarkan secara real-time:',
        'drop_label' => 'Pilih Berkas untuk Menguji Event',
        'empty_events' => 'Belum ada event yang tertangkap. Silakan pilih atau drop berkas di atas.',
        'tip' => '💡 Tip: Klik tombol silang (x) pada berkas yang telah sukses diunggah untuk memicu event <code class="font-mono text-rose-500 font-bold">revert</code>.',
    ],

    // Section 10: Props Reference
    'props' => [
        'title' => 'Referensi Props',
        'desc' => 'Daftar lengkap opsi konfigurasi untuk komponen &lt;vibe:filepond&gt;.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Keterangan',
        ],
        'items' => [
            'name' => 'Nama field input (otomatis diambil dari `wire:model` jika ada).',
            'size' => 'Pilihan ukuran ketinggian dropzone: `"sm"`, `"md"`, atau `"lg"`.',
            'title' => 'Kustomisasi judul dropzone (default: "Choose a file or drag & drop it here").',
            'subtitle' => 'Kustomisasi keterangan format dan ukuran (otomatis dihitung jika kosong).',
            'browse_label' => 'Teks tombol pemilih berkas (default: "Browse File").',
            'icon' => 'Pilihan ikon dropzone (`cloud`, `upload`, `folder`, atau SVG string).',
            'variant' => 'Varian layout: `"default"` (lengkap), `"compact"` (horizontal), atau `"avatar"`.',
            'dashed' => 'Garis batas putus-putus (`true`) atau garis padat (`false`).',
            'drop_height' => 'Tinggi minimal kustom dropzone, contoh: `"16rem"`, `"250px"`.',
            'multiple' => 'Mengizinkan pemilihan dan pengunggahan banyak berkas sekaligus.',
            'max_files' => 'Batas maksimal jumlah berkas yang dapat diunggah bersamaan.',
            'max_file_size' => 'Batas ukuran per berkas, contoh: `"2MB"`, `"500KB"`.',
            'accepted_file_types' => 'Filter format mime berkas, contoh: `"image/*, application/pdf"`.',
            'avatar' => 'Mengaktifkan mode lingkaran compact 1:1 untuk foto profil.',
            'image_crop' => 'Mengaktifkan fitur pemotongan gambar otomatis/manual.',
            'image_crop_aspect_ratio' => 'Rasio aspek pemotongan gambar, contoh: `"1:1"`, `"16:9"`.',
            'presign_url' => 'Endpoint backend untuk mendapatkan URL presigned cloud storage.',
            'presign_method' => 'HTTP method pengunggahan langsung ke cloud storage.',
            'encode' => 'Mengonversi berkas ke base64 string untuk form submission standar.',
            'existing_files' => 'Daftar URL berkas awal yang sudah ada (misal untuk form edit).',
            'protect_upload' => 'Mencegah submit form dan navigasi saat berkas masih diunggah dengan konfirmasi &lt;vibe:alert&gt; serta peringatan penutupan tab (`beforeunload`).',
            'protect_title' => 'Kustomisasi judul alert proteksi unggah (default: "Unggahan Belum Selesai").',
            'protect_message' => 'Kustomisasi pesan konfirmasi/peringatan ketika user mencoba mengirim form atau berpindah halaman saat upload berlangsung.',
            'reorder' => 'Aktifkan fitur reorder drag & drop. Urutan visual di UI langsung tersinkronkan ke input form saat submit (bekerja untuk berkas lama maupun baru diunggah).',
        ],
    ],

    // Card Preview & Custom Header
    'card_preview' => [
        'title' => 'Tampilan Berkas Terunggah (Card Preview)',
        'desc' => 'Ketika berkas dipilih atau diunggah pengguna, berkas ditampilkan dalam bentuk kartu modern terpisah lengkap dengan ikon ekstensi, progres persentase, status upload, dan tombol aksi hapus/batal.',
        'preview_title' => 'Pratinjau Kartu Berkas',
    ],
    'buttons' => [
        'submit_form' => 'Kirim Form (Test Request)',
        'submit_multiple' => 'Kirim Multiple Foto (Test Request)',
        'submit_avatar' => 'Simpan Avatar (Test Request)',
    ],
    'custom_header' => [
        'desc' => 'Anda dapat menyesuaikan judul dropzone (<code class="text-xs font-mono text-primary font-semibold">title</code>), sub-judul (<code class="text-xs font-mono text-primary font-semibold">subtitle</code>), dan label tombol telusuri (<code class="text-xs font-mono text-primary font-semibold">browse-label</code>) sesuai kebutuhan konteks halaman.',
        'preview_title' => 'Dropzone dengan Judul & Tombol Kustom',
        'label' => 'Unggah Berkas Lamaran',
        'title' => 'Tarik & Letakkan Berkas Lamaran (CV/Resume)',
        'subtitle' => 'Format PDF atau Word (maks. 5MB)',
        'browse_label' => 'Pilih CV',
    ],
    'patterns' => [
        'pattern_a_title' => 'Pola A: Event Terpadu dengan Filter ID (Rekomendasi)',
        'pattern_a_desc' => 'Satu listener global menangkap semua aksi dan memfilter berdasarkan instans FilePond:',
        'pattern_b_title' => 'Pola B: Event Spesifik dengan Suffix Aksi',
        'pattern_b_desc' => 'Dengarkan hanya jenis event tertentu dengan akhiran nama aksi:',
        'pattern_c_title' => 'Pola C: Event Lokal pada Tag Komponen',
        'pattern_c_desc' => 'Langsung pasang listener shorthand pada tag komponen:',
        'pattern_d_title' => 'Pola D: Vanilla JavaScript Murni',
        'pattern_d_desc' => 'Gunakan <code class="font-mono text-accent font-semibold">window.addEventListener</code> di file script JavaScript eksternal:',
    ],
];
