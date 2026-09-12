<?php

return [
    'title' => 'Dynamic Form',
    'badge' => 'Form Repeater',
    'group' => 'Komponen Form',
    'description' => 'Komponen input form dinamis (repeater) untuk menambah, menghapus, menyalin, dan mengurutkan baris input secara interaktif. Mendukung integrasi mulus dengan input, select, date-time, textarea, dan mode Blade @foreach.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar (Card Variant)',
        'desc' => 'Gunakan tag <code>&lt;vibe:dynamic-form&gt;</code> dengan komponen <code>&lt;vibe:input&gt;</code>, <code>&lt;vibe:select&gt;</code>, <code>&lt;vibe:date-time&gt;</code>, dan <code>&lt;vibe:textarea&gt;</code> di dalamnya. Komponen otomatis menangani auto-namespacing array.',
        'preview_title' => 'Contoh Riwayat Pengalaman',
    ],

    'foreach_mode' => [
        'title' => 'Mode Edit dengan PHP @foreach',
        'desc' => 'Untuk memuat data existing dari database dengan kontrol Blade 100%, gunakan loop <code>@foreach</code> di dalam slot dan sertakan <code>&lt;x-slot:template&gt;</code> sebagai cetak biru baris baru.',
        'preview_title' => 'Contoh Edit Data dengan @foreach dan x-slot:template',
    ],

    'table_variant' => [
        'title' => 'Varian Tabel (Line Items / Transaksi)',
        'desc' => 'Gunakan prop <code>variant="table"</code> untuk format baris ringkas yang cocok untuk item faktur, pesanan, atau inventaris.',
        'preview_title' => 'Contoh Baris Pesanan Produk',
    ],

    'schema_mode' => [
        'title' => 'Mode Skema (Declarative)',
        'desc' => 'Definisikan field langsung via array <code>:schema="[...]"</code> tanpa perlu menulis markup HTML per baris.',
        'preview_title' => 'Contoh Form Riwayat Pendidikan via Skema',
    ],

    'test_submit' => [
        'title' => 'Pengujian Form Submit & AJAX Payload Lengkap',
        'desc' => 'Uji integrasi menyeluruh repeater dengan berbagai kontrol input Vibe UI: <code>&lt;vibe:input&gt;</code>, <code>&lt;vibe:select&gt;</code>, <code>&lt;vibe:date-time&gt;</code>, <code>&lt;vibe:textarea&gt;</code>, <code>&lt;vibe:range&gt;</code>, <code>&lt;vibe:switch&gt;</code>, <code>&lt;vibe:radio&gt;</code>, <code>&lt;vibe:checkbox&gt;</code>, dan <code>&lt;vibe:filepond&gt;</code>. Klik <b>Simpan Form & Uji Payload</b> untuk melihat representasi array payload PHP di backend secara real-time via AJAX.',
        'preview_title' => 'Live Demo Form Submission Lengkap',
    ],

    'order_demo' => [
        'label' => 'Daftar Barang Pesanan',
        'add_text' => 'Tambah Barang',
    ],

    'test_form' => [
        'label' => 'Daftar Anggota Tim Proyek (Uji Lengkap)',
        'desc' => 'Pengujian menyeluruh repeater dengan berbagai komponen input Vibe UI.',
        'add_member' => 'Tambah Anggota',
        'member_name' => 'Nama Lengkap',
        'name_placeholder' => 'Contoh: Budi Santoso',
        'role' => 'Peran',
        'role_placeholder' => 'Pilih Peran',
        'role_lead' => 'Project Lead',
        'role_dev' => 'Developer',
        'role_design' => 'UI/UX Designer',
        'role_qa' => 'QA Engineer',
        'join_date' => 'Tanggal Bergabung',
        'join_placeholder' => 'Pilih tanggal',
        'notes' => 'Catatan / Bio Singkat',
        'notes_placeholder' => 'Tuliskan catatan keahlian...',
        'skill_score' => 'Skor Keahlian',
        'is_remote' => 'Bekerja Jarak Jauh (Remote)',
        'remote_desc' => 'Bekerja penuh secara remote / WFA',
        'contract_type' => 'Tipe Kontrak',
        'fulltime' => 'Full-Time',
        'contract' => 'Kontrak (PKWT)',
        'freelance' => 'Freelance',
        'facilities' => 'Fasilitas & Akses',
        'laptop' => 'Laptop Perusahaan',
        'server_access' => 'Akses Server Produksi',
        'signed_nda' => 'Persetujuan NDA',
        'avatar' => 'Foto Profil / Berkas',
        'card_title' => 'Form Anggota Tim Proyek (Pengujian Lengkap)',
        'card_desc' => 'Termasuk input, select, select remote, date-time, textarea, range, switch, radio, checkbox, dan filepond. Coba tambah baris, duplikasi, ubah nilai, lalu submit untuk menguji payload array PHP di backend via AJAX.',
        'ajax_hint' => 'Payload dikirim via AJAX ke FormController::store()',
        'submit_btn' => 'Simpan Form & Uji Payload',
        'submit_btn_code' => 'Simpan Form & Lihat $request->all()',
        'supervisor' => 'Supervisor / Lead (API)',
        'supervisor_placeholder' => 'Cari supervisor dari API...',
    ],

    'select_remote' => [
        'title' => 'Integrasi Select Berbasis API (<vibe:select.remote>)',
        'desc' => 'Komponen <code>&lt;vibe:select.remote&gt;</code> dapat digunakan secara langsung di dalam baris repeater. Setiap baris baru yang ditambahkan secara otomatis menghasilkan instance select independen dengan endpoint asinkron, pencarian debounced, dan auto-namespacing array yang aman.',
        'preview_title' => 'Contoh Penugasan Tim Proyek (Select Remote)',
        'form_label' => 'Daftar Penugasan Tugas Proyek',
        'form_desc' => 'Setiap baris tugas dapat ditugaskan ke pengguna yang diambil langsung dari endpoint API.',
        'add_task' => 'Tambah Tugas Baru',
        'task_title' => 'Judul Tugas / Fitur',
        'task_placeholder' => 'Contoh: Integrasi Payment Gateway',
        'assignee' => 'Penanggung Jawab (API Pengguna)',
        'assignee_placeholder' => 'Cari pengguna dari database...',
        'priority' => 'Prioritas',
        'priority_placeholder' => 'Pilih prioritas',
        'due_date' => 'Tenggat Waktu',
        'due_placeholder' => 'Pilih batas waktu...',
    ],
];
