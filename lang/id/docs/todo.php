<?php

return [
    'title' => 'Todo',
    'badge' => 'Komponen',
    'group' => 'Interaktif & Formulir',
    'description' => 'Komponen Todo & Kanban Board canggih dengan drag-and-drop mulus, arsitektur anti-FOUC (Flash of Unstyled Content), tombol navigasi kolom, serta dukungan Tri-Mode: Realtime Livewire 3, asynchronous REST API, atau Form batch submit.',

    'livewire' => [
        'title' => '1. Realtime Livewire 3 Kanban Board',
        'desc' => 'Gunakan prop <code>mode="livewire"</code> dan <code>layout="board"</code> untuk menghubungkan papan Kanban langsung ke komponen Livewire Anda. Urutan tugas antar kolom disinkronkan secara realtime dengan server tanpa memicu page reload.',
        'preview_title' => 'Livewire Realtime Kanban Board',
        'tip' => '💡 Tip: Tarik kartu atau ikon ⠿ antar kolom untuk memperbarui status secara realtime. Coba refresh halaman (F5) untuk melihat performa <strong>Anti-FOUC</strong> tanpa kedip tampilan!',
    ],

    'api' => [
        'title' => '2. REST API Mode Kanban Board (Asynchronous Sync)',
        'desc' => 'Gunakan prop <code>mode="api"</code> dengan atribut <code>reorder-url</code> atau <code>endpoint</code> untuk berinteraksi dengan API backend JSON. Pemindahan kartu antar kolom mengirim request AJAX otomatis di latar belakang dengan CSRF token bawaan Laravel.',
        'preview_title' => 'Sinkronisasi REST API Kanban dengan Optimistic UI',
    ],

    'kanban' => [
        'title' => '3. Interactive Kanban Board & Navigasi Kolom',
        'desc' => 'Kombinasikan dengan subkomponen <code>&lt;vibe:todo.group&gt;</code> untuk menyusun workflow papan tugas multi-kolom. Aktifkan tombol panah kolom dengan <code>:nav-buttons="true"</code> untuk memungkinkan perpindahan tugas cepat tanpa harus drag-and-drop.',
        'preview_title' => 'Papan Kanban Multi-Kolom Interaktif',
        'hint' => 'Tarik kartu antar-kolom atau klik tombol navigasi (← / →) untuk memindahkan tugas ke kolom sebelumnya atau berikutnya.',
        'reset_btn' => 'Reset Layout Board',
    ],

    'form' => [
        'title' => '4. Mode Form Submit (Single Non-Kanban / Batch Save)',
        'desc' => 'Pada skenario formulir konvensional atau multi-step wizard, gunakan <code>mode="form"</code> dalam format daftar linear (list). Komponen secara otomatis mengelola input tersembunyi (hidden inputs) yang di-reindex setiap kali item digeser, lalu dikirimkan sekaligus saat form di-submit.',
        'preview_title' => 'Formulir Batch Save Daftar Tugas dengan Hidden Inputs',
        'hint' => 'Hidden inputs <code>batch_tasks[i][id]</code>, <code>[order]</code>, dan <code>[group]</code> di-reindex secara otomatis saat item dipindahkan.',
        'submit_btn' => 'Simpan Perubahan Batch',
        'alert_submitted' => 'Formulir disubmit dengan susunan data terkini!',
    ],

    'persist' => [
        'title' => '5. Papan Kanban dengan LocalStorage Persistence',
        'desc' => 'Tambahkan prop <code>:persist="true"</code> untuk menyimpan susunan kartu dan kolom ke dalam browser <code>localStorage</code> secara otomatis. Saat halaman ditutup atau dimuat ulang, urutan dan status kartu tetap bertahan.',
        'preview_title' => 'Papan Kanban dengan Penyimpanan State Lokal',
        'hint' => 'Pindahkan tugas antar-kolom lalu muat ulang halaman (F5). Posisi kartu akan tetap terjaga di browser Anda.',
        'reset_btn' => 'Bersihkan Penyimpanan Lokal',
    ],

    'nav_buttons' => [
        'title' => '6. Kontrol Tombol Navigasi Kolom (nav-buttons)',
        'desc' => 'Secara default, tombol panah navigasi kolom disembunyikan (<code>:nav-buttons="false"</code>). Anda dapat mengaktifkannya secara global pada container <code>&lt;vibe:todo :nav-buttons="true"&gt;</code> atau per-item kartu menggunakan prop <code>:nav-buttons="true"</code>.',
        'preview_title' => 'Perbandingan Tombol Navigasi: Aktif vs Nonaktif',
        'enabled_hint' => 'Kolom ini memiliki tombol panah navigasi kolom (nav-buttons aktif).',
        'disabled_hint' => 'Kolom ini menyembunyikan tombol navigasi (default).',
    ],

    'anti_fouc' => [
        'title' => '7. Garansi Bebas Kedip (Anti-FOUC Architecture)',
        'desc' => 'Seluruh kartu dan kolom dicetak 100% dari server menggunakan Blade (SSR) sehingga saat halaman dimuat atau direfresh, tidak ada jeda blank screen atau layout shift (CLS = 0). Alpine.js menghidrasi event handler di background secara progresif.',
        'card1_title' => '100% Server Rendered (SSR)',
        'card1_desc' => 'Item dicetak langsung oleh Laravel Blade lengkap dengan kelas Tailwind v4 terkompilasi. Browser merender tampilan dalam 0 milidetik tanpa jeda blank putih.',
        'card2_title' => 'Progressive Hydration',
        'card2_desc' => 'Alpine.js membaca atribut data-id yang telah ada di HTML tanpa menghancurkan (destroy) atau membuat ulang elemen DOM, menjaga fluiditas animasi.',
        'card3_title' => 'Stable Morphing Keys',
        'card3_desc' => 'Penggunaan wire:key mengunci identitas node DOM saat terjadi background sync, mencegah flicker pada Livewire morphing saat state diperbarui.',
    ],

    'events' => [
        'title' => '8. Event JavaScript & Ekosistem Custom Events',
        'desc' => 'Komponen mengekspos event kustom standar DOM yang dapat didengarkan oleh Alpine.js, Vanilla JavaScript, atau framework lain.',
        'table_event' => 'Nama Event',
        'table_detail' => 'Properti detail ($event.detail)',
        'table_desc' => 'Waktu Pemicuan',
        'reordered_desc' => 'Dipicu setelah kartu selesai dipindahkan atau ditata ulang susunannya.',
        'toggled_desc' => 'Dipicu saat status centang atau status kartu diubah.',
        'deleted_desc' => 'Dipicu sesaat sebelum atau ketika item dihapus.',
        'added_desc' => 'Dipicu saat item tugas baru ditambahkan melalui input cepat.',
    ],

    'props' => [
        'title' => '9. Referensi Props & Subkomponen Lengkap',
        'desc' => 'Daftar atribut dan konfigurasi yang tersedia pada &lt;vibe:todo&gt; dan seluruh subkomponennya.',
        'table_prop' => 'Prop',
        'table_type' => 'Tipe Data',
        'table_default' => 'Nilai Default',
        'table_desc' => 'Deskripsi',

        // vibe:todo
        'todo_mode' => "Mode sinkronisasi: 'livewire', 'api', 'form', atau 'local'",
        'todo_layout' => "Tata letak tampilan: 'board' (kanban multi-kolom) atau 'list' (vertikal linear)",
        'todo_nav_buttons' => "Menampilkan atau menyembunyikan tombol panah navigasi kolom pada kartu (default false / tersembunyi)",
        'todo_checkbox' => "Kontrol visibilitas checkbox secara global (default false untuk layout board, true untuk list)",
        'todo_reorderable' => "Mengaktifkan atau menonaktifkan fitur drag-and-drop antar kartu dan kolom",
        'todo_drag_handle' => "Mode tampilan indikator titik drag 3x2: 'visible' (selalu tampil), 'hover' (tampil saat dihover), atau 'hidden' / false (sembunyikan)",
        'todo_persist' => "Menyimpan susunan kartu ke browser localStorage secara otomatis (khusus mode local)",
        'todo_storage_key' => "Pengenal unik data todo di dalam penyimpanan 'vibe-todo' di localStorage (default: ID komponen)",
        'todo_gap' => "Jarak antar kolom/item: '1', '2', '3', '4', '6' (default: '3')",
        'todo_wire_reorder' => "Nama metode Livewire untuk menangani event reorder dan perpindahan kolom",
        'todo_wire_toggle' => "Nama metode Livewire untuk menangani perubahan centang",
        'todo_wire_delete' => "Nama metode Livewire untuk menangani penghapusan item",
        'todo_wire_add' => "Nama metode Livewire untuk menangani penambahan tugas baru",
        'todo_endpoint' => "URL REST API basis untuk operasi CRUD data todo",
        'todo_name' => "Prefix nama array input tersembunyi untuk mode formulir (mode='form')",

        // vibe:todo.group
        'group_name' => "Pengenal unik untuk kolom status (misalnya 'todo', 'progress', 'done')",
        'group_title' => "Judul teks kolom status yang ditampilkan di header kolom",
        'group_count' => "Angka counter jumlah kartu di kolom (opsional)",
        'group_color' => "Varian warna accent header kolom: 'default', 'blue', 'amber', 'emerald', 'purple'",
        'group_empty_text' => "Teks placeholder saat kolom tidak memiliki kartu tugas",

        // vibe:todo.item
        'item_id' => "ID unik untuk kartu tugas (string atau integer)",
        'item_title' => "Judul teks kartu tugas (dapat juga disisipkan melalui default slot)",
        'item_description' => "Deskripsi penjelasan tambahan di bawah judul kartu",
        'item_group' => "Nama grup/kolom tempat kartu ini berada (untuk layout board/kanban)",
        'item_nav_buttons' => "Override opsi tombol panah navigasi kolom per kartu (true/false/null)",
        'item_checkbox' => "Menampilkan atau menyembunyikan kotak centang checkbox pada kartu ini",
        'item_completed' => "Status selesai tugas (menampilkan garis coret dan visual pudar)",
        'item_badge' => "Teks label badge prioritas atau kategori pada kartu",
        'item_badge_variant' => "Varian visual badge: 'default', 'primary', 'warning', 'destructive', 'outline'",
        'item_due_date' => "Teks label tanggal jatuh tempo tugas",
        'item_variant' => "Varian tampilan kartu: 'default' (card bayangan halus), 'flat', atau 'outline'",
        'item_reorderable' => "Menentukan apakah kartu ini dapat digeser atau ditarik",
        'item_drag_handle' => "Override mode tampilan titik drag 3x2 per kartu: 'visible', 'hover', atau 'hidden' / false",
        'item_deletable' => "Menampilkan tombol hapus saat kartu di-hover",

        // vibe:todo.input
        'input_placeholder' => "Teks placeholder pada kolom isian tugas baru",
        'input_button_text' => "Teks tombol aksi tambah tugas",
        'input_group' => "Nama grup/kolom default untuk tugas baru yang ditambahkan",
    ],
];
