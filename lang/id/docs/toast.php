<?php

return [
    'title' => 'Toast',
    'badge' => 'Komponen',
    'group' => 'Feedback & Notifikasi',
    'description' => 'Komponen notifikasi toast mengambang yang ringan, modern, dan interaktif. Mendukung penumpukan berlapis (stacked cards), auto-expand saat dihover, pause timer on hover, efek audio sintesis Web Audio API, serta integrasi mudah via JavaScript vibeToast, Alpine event, Laravel session flash, dan Livewire.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Penggunaan Dasar',
    'basic_usage_desc' => 'Pastikan tag penampung <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:toast /&gt;</code> sudah terpasang di layout utama Anda (seperti <code class="font-mono text-xs text-foreground">base.blade.php</code>). Notifikasi toast dapat dimunculkan melalui fungsi JavaScript <code class="font-mono text-xs text-foreground">vibeToast(...)</code> atau Alpine event <code class="font-mono text-xs text-foreground">$dispatch(\'toast\', ...)</code>.',

    // Section 2: Stacked & Hover
    'stacked_title' => 'Penumpukan Berlapis & Interaksi Hover',
    'stacked_desc' => 'Beberapa toast yang muncul bersamaan akan ditumpuk secara rapi di sudut layar (stacked effect). Saat pengguna mengarahkan kursor mouse ke atas tumpukan toast (<code class="font-mono text-xs text-foreground">hover</code>), seluruh toast akan memuai secara otomatis (expand) dan penghitung waktu auto-dismiss akan dijeda sementara (pause timer).',

    // Section 3: Positions
    'positions_title' => 'Pilihan Posisi (Positions)',
    'positions_desc' => 'Toast mendukung 6 pilihan posisi penempatan melalui prop <code class="font-mono text-xs text-foreground">position</code> pada tag kontainer: <code class="font-mono text-xs text-foreground">bottom-right</code> (default), <code class="font-mono text-xs text-foreground">bottom-left</code>, <code class="font-mono text-xs text-foreground">top-right</code>, <code class="font-mono text-xs text-foreground">top-left</code>, <code class="font-mono text-xs text-foreground">top-center</code>, dan <code class="font-mono text-xs text-foreground">bottom-center</code>.',

    // Section 4: Sound & Timeout
    'sound_title' => 'Efek Suara Audio & Durasi',
    'sound_desc' => 'Aktifkan efek audio bawaan dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sound: true</code> (menggunakan sintesis Web Audio API tanpa aset tambahan) atau teruskan URL file audio kustom. Durasi tampil dapat diatur dalam milidetik via <code class="font-mono text-xs text-foreground">timeout</code> (default: 3000ms), atau <code class="font-mono text-xs text-foreground">timeout: false</code> untuk toast persisten.',

    // Section 5: Trigger Methods
    'integration_title' => 'Metode Pemanggilan Toast',
    'integration_desc' => 'Vibe UI menyediakan integrasi lengkap pemanggilan toast untuk berbagai ekosistem Laravel: JavaScript helper, Alpine.js event dispatch, Laravel controller flash session, dan Livewire component.',

    // Section 6: Props Reference
    'props_title' => 'Referensi Props & Payload',
    'props_desc' => 'Daftar atribut tag kontainer <code class="font-mono text-xs text-foreground">&lt;vibe:toast&gt;</code> dan parameter objek payload yang didukung.',
    'table_prop' => 'Prop / Parameter',
    'table_type' => 'Tipe',
    'table_default' => 'Default',
    'table_desc' => 'Deskripsi',
];
