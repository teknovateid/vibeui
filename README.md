# 🎨 Vibe UI

> [!WARNING]
> **🚧 WORK IN PROGRESS**  
> Repositori ini adalah **lingkungan pengembangan aktif dan dokumentasi** untuk **Vibe UI**. Saat ini, core package Vibe UI masih dalam tahap pengembangan dan belum siap untuk digunakan pada *production*.

---

## 📖 Tentang Project Ini

Project ini merupakan aplikasi Laravel yang bertindak sebagai *host* (tuan rumah) untuk mengembangkan, menguji, dan mendokumentasikan package **Vibe UI**. 

**Vibe UI** sendiri adalah sekumpulan komponen antarmuka (*UI Components*) yang dibangun menggunakan **Laravel Livewire** dan **Tailwind CSS**. **Package ini diciptakan dengan mengambil banyak inspirasi dari Flux UI**, dirancang secara khusus untuk membuat proses pengembangan *frontend* pada aplikasi **Laravel** menjadi sangat cepat, modern, dan interaktif (khususnya untuk aplikasi admin/dashboard di ekosistem Teknovate).

### 🎯 Tujuan Utama Vibe UI Diciptakan

Vibe UI dibangun dengan beberapa visi dan tujuan strategis berikut:

1. **Konsistensi Desain (*Design Consistency*)**
   Menyediakan satu sumber pedoman (*single source of truth*) untuk elemen-elemen UI. Hal ini memastikan setiap aplikasi dashboard atau produk internal yang dibangun oleh tim Teknovate memiliki identitas visual dan *User Experience* (UX) yang seragam.
2. **Kecepatan Pengembangan (*Development Velocity*)**
   Penggunaan Vibe UI membuat pembuatan UI di **Laravel menjadi sangat cepat**. Developer tidak perlu lagi menulis kode *styling* yang berulang-ulang (*reinventing the wheel*), melainkan bisa langsung menyusun halaman kompleks dalam hitungan menit menggunakan blok-blok komponen yang sudah terkonfigurasi dengan baik.
3. **Kode yang Bersih & Rapi (*Clean Code*)**
   Membungkus *class* utilitas Tailwind CSS yang panjang dan logika Livewire yang kompleks ke dalam tag yang sangat ringkas (seperti `<vibe:button>`). Akibatnya, file Blade pada aplikasi utama menjadi jauh lebih bersih dan mudah dikelola.
4. **Sentralisasi Pembaruan (*Centralized Updates*)**
   Ketika ada perbaikan *bug* desain atau perubahan tema, perbaikan cukup dilakukan di dalam package Vibe UI saja. Seluruh aplikasi (atau halaman) yang menggunakannya akan secara otomatis mewarisi pembaruan tersebut tanpa perlu mengubah kode satu per satu di berbagai tempat.

---

## 📂 Struktur Direktori

Pengembangan komponen dipisahkan dari aplikasi utama agar bersifat **modular** dan mandiri. Hal ini dikelola melalui direktori `packages`.

### Mengapa ada folder `packages`?

Folder `packages/` digunakan sebagai tempat penyimpanan *internal/local package* (dalam hal ini `vibe`). Dengan pendekatan ini, kita dapat mengembangkan package persis seperti layaknya package yang diunduh dari Composer, tanpa harus terus-menerus melakukan proses rilis ke repositori eksternal selama masa pengembangan.



### Anatomi `packages/vibe`

Direktori `packages/vibe/` adalah *core package* dari Vibe UI (`teknovate/vibe-ui`). Berikut adalah penjelasan struktur di dalamnya:

```text
packages/vibe/
├── config/           # Konfigurasi bawaan Vibe UI yang bisa di-publish ke aplikasi utama.
├── public/           # Aset statis (CSS, JS, gambar, dll) khusus untuk package.
├── resources/        # Berisi file Blade templates (views) untuk tiap komponen UI.
├── routes/           # (Opsional) Rute khusus jika komponen membutuhkan endpoint tersendiri.
├── src/              # Source code utama PHP (Livewire Components, Service Providers).
├── composer.json     # File manifest package, mendefinisikan dependensi & namespace PSR-4.
└── package.json      # Konfigurasi dependencies NPM (Tailwind CSS, dll) khusus package.
```

### Detail Folder `resources/` (di dalam `packages/vibe`)

Folder `resources` sangat krusial dalam package UI ini karena di sinilah seluruh aset *frontend* dan tampilan (Blade) berada. Berikut adalah anatominya:

```text
packages/vibe/resources/
├── css/              # Berisi source file CSS (Tailwind base, components, utilities).
├── js/               # Berisi file JavaScript pendukung untuk komponen (jika diperlukan).
└── views/            # Berisi semua file tampilan (.blade.php).
    ├── components/   # Direktori utama untuk Blade Components.
    │   ├── layouts/  # Template dasar struktur halaman (misal: sidebar layout, topbar layout).
    │   └── partials/ # Potongan-potongan UI yang dapat digunakan kembali (menu, header, footer).
    ├── templates/    # Berisi kerangka utuh sebuah halaman untuk mempercepat pembuatan fitur baru.
    │   ├── resource/ # Template standar untuk halaman CRUD (berisi create.blade, edit.blade, index.blade).
    │   ├── blank.blade.php # Template halaman kosong.
    │   └── index.blade.php # Template halaman indeks utama.
    └── vibe/         # untuk kumpulan komponen Vibe UI.
```

---

## ⚡ Fitur & Shortcut

Package Vibe UI dilengkapi dengan beberapa utilitas bawaan (*built-in*) untuk mempercepat pengembangan aplikasi:

### 1. Sintaks Blade Pendek (*Shortcut Tag*)

Dalam standar Laravel, pemanggilan komponen dari sebuah package biasanya menggunakan *prefix* `x-namapackage::`, sehingga kita harus menuliskan `<x-vibe::nama-komponen>`. 

Untuk mempercepat penulisan kode dan membuatnya lebih bersih, Vibe UI mengimplementasikan kompilator kustom. Anda dapat memanggil semua komponen Vibe menggunakan tag HTML kustom **`<vibe:...>`**:

```html
<!-- ❌ Penulisan Standar Laravel -->
<x-vibe::button variant="primary">Simpan</x-vibe::button>

<!-- ✅ Menggunakan Shortcut Vibe UI -->
<vibe:button variant="primary">Simpan</vibe:button>
```

> **💡 Dukungan VSCode Snippets:**
> Project ini sudah saya lengkapi dengan *VSCode Snippets* bawaan di dalam direktori `.vscode/vibe.code-snippets`.
> Cukup ketik `vibe:button`, `vibe:input`, dll di file editor Anda, lalu tekan `Tab` atau `Enter` untuk langsung *generate* tag beserta atribut (*props*) standar-nya secara otomatis!
>
> **✨ Autocomplete Atribut (IntelliSense):**
> Project ini juga telah dilengkapi dengan `html.customData` di VSCode. Artinya, jika Anda mengetik spasi di dalam tag komponen (misal: `<vibe:button |>`), VSCode akan otomatis menampilkan saran atribut khusus milik komponen tersebut (seperti `variant`, `size`, `type`) beserta nilai (*values*) yang diperbolehkan!

### 2. Artisan Commands (*Scaffolding*)

Vibe UI menyediakan beberapa perintah konsol khusus untuk mengotomatisasi pembuatan file dan struktur:

- `php artisan vibe:install` — Mempublikasikan seluruh *asset* (CSS/JS) dan konfigurasi awal Vibe UI.
- `php artisan vibe:layout` — Meng-*generate* struktur file *layout* dasar.
- `php artisan vibe:page` — Meng-*generate* template halaman baru.
- `php artisan vibe:component` — Membuat kerangka (*stub*) untuk Blade component baru.
- `php artisan vibe:clean` — Membersihkan/me-reset cache spesifik milik Vibe UI.

---

## 🤖 Panduan AI (AI Knowledge)

Untuk memastikan konsistensi kode dan pemahaman konteks bagi *contributor* yang menggunakan AI Code Assistant (seperti Cursor, GitHub Copilot, Windsurf, dll), project ini telah dilengkapi dengan aturan khusus untuk AI.

Pengetahuan (*knowledge*) untuk AI ini disimpan di dalam file **`.cursorrules`** di *root* direktori. 
File ini memberitahu AI tentang:
- Arsitektur folder (fokus pada `packages/vibe`).
- Aturan wajib menggunakan sintaks `<vibe:component>` alih-alih `x-vibe::`.
- Filosofi desain yang terinspirasi dari Flux UI.
- Penggunaan Artisan commands bawaan.

Dengan adanya file ini, AI Anda tidak akan "meleset jauh" dan akan selalu memberikan saran kode yang relevan dengan standar Vibe UI!

---

## 🛠️ Panduan Pengembangan

Karena ini adalah repositori monorepo-style untuk pengembangan package lokal, perubahan yang dilakukan di dalam `packages/vibe` akan langsung tercermin pada aplikasi *host* ini berkat autoloading lokal.

1. **Jalankan Aplikasi:** Gunakan `php artisan serve` seperti biasa untuk melihat dokumentasi / preview komponen.
2. **Kompilasi Aset:** Jalankan `npm run dev` di root project untuk mengkompilasi *Tailwind CSS*.
3. **Modifikasi Komponen:** Lakukan perubahan kode secara eksklusif di dalam folder `packages/vibe/`.