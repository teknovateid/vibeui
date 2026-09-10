<?php

return [
    'filepond_pill' => 'Lihat Payload FilePond',
    'controller_pill' => 'Lihat Payload Controller',
    'filepond_success_title' => 'Berkas & Form Berhasil Diposting',
    'filepond_success_desc' => 'Data formulir berhasil diterima oleh <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">FilepondController::requestTest()</code> via <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">$request->all()</code> tanpa refresh halaman.',
    'form_success_title' => 'Form Berhasil Diposting (Controller Test)',
    'form_success_desc' => 'Data formulir berhasil diterima oleh <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">FormController::store()</code> via <code class="px-1.5 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground font-semibold">$request->all()</code> tanpa refresh halaman.',
    'empty_title' => 'Belum ada data formulir yang dikirim.',
    'filepond_empty_desc' => 'Silakan unggah berkas pada formulir pengujian di dokumentasi dan klik tombol kirim form untuk melihat data <code class="font-mono text-xs">$request->all()</code> secara langsung.',
    'form_empty_desc' => 'Silakan isi formulir pengujian pada halaman dokumentasi dan klik tombol submit untuk melihat data <code class="font-mono text-xs">$request->all()</code> secara real-time.',
    'tabs' => [
        'summary' => 'Ringkasan Berkas',
        'json' => 'JSON Payload',
        'table' => 'Tabel Key-Value',
    ],
    'copy_json' => 'Salin JSON',
    'copied' => 'Tersalin!',
    'copy' => 'Salin',
    'filepond_flow_success_title' => 'FilePond Client-to-Controller Flow Sukses',
    'filepond_flow_success_desc' => 'FilePond menyuntikkan kunci penyimpanan (S3 / Cloud Object Key) atau server ID ke dalam input tersembunyi form. Saat disubmit, controller menerima kunci ini langsung di <code class="font-mono text-[10px] bg-background/50 px-1 py-0.5 rounded">$request->all()</code> untuk disimpan ke basis data.',
    'table_columns' => [
        'field' => 'Field (Key)',
        'value' => 'Nilai (Value)',
        'type' => 'Tipe Data',
    ],
    'csrf_valid' => '(CSRF Token Valid)',
    'null_empty' => 'null / kosong',
    'response_time' => 'Waktu respons:',
    'close_modal' => 'Tutup Modal',
];
