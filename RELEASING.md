# 🚀 Panduan Versioning & Rilis Vibe UI

Dokumen ini menjelaskan alur kerja rilis dan *versioning* untuk package **Vibe UI** (`teknovate/vibeui`) menggunakan **1 Repositori Tunggal** (`teknovateid/vibeui`).

---

## 🏗️ 1. Arsitektur Repositori (Monorepo Docs & Package)

```text
[Repositori: https://github.com/teknovateid/vibeui]
 ├── development        --> Branch koding harian seluruh tim (docs + package)
 ├── production         --> Branch rilis stabil dokumentasi web
 ├── composer.json      --> Aplikasi Dokumentasi (name: "laravel/laravel", type: "project")
 │                          menggunakan path repository: "./packages/*" (@dev symlink)
 └── packages/vibe/     --> Core Package Library (name: "teknovate/vibeui", type: "library")
           │
           │  (Otomatis di-split via git subtree pada Git Tag rilis)
           ▼
       [Git Tag vX.Y.Z] (Hanya berisi isi subfolder packages/vibe/)
           │
           ▼
     [Packagist.org]
           │
           ▼
  composer require teknovate/vibeui
```

Di repositori ini, root bertindak sebagai aplikasi dokumentasi & playground (`laravel/laravel`). Core package sesungguhnya berada di subfolder `packages/vibe/`. Ketika rilis dilakukan (`php artisan vibe:release`), sistem otomatis melakukan *subtree split* pada Git Tag rilis sehingga pengguna akhir yang mengunduh melalui Composer hanya menerima isi dari package murni tanpa file boilerplate dokumentasi (`app/`, `artisan`, `database/`, dll).

---

## ⚙️ 2. Registrasi Packagist (Sekali Saja)

1. Buka [packagist.org/packages/submit](https://packagist.org/packages/submit).
2. Masukkan URL:
   ```text
   https://github.com/teknovateid/vibeui
   ```
3. Klik **Check** lalu **Submit**. Packagist akan langsung mengenali nama package **`teknovate/vibeui`**.
4. Aktifkan **GitHub Service Hook** di pengaturan Packagist agar setiap tag baru otomatis tersinkronisasi.

---

## 📝 3. Standar Commit (Conventional Commits)

Automasi rilis membaca riwayat commit untuk menentukan kenaikan versi (SemVer) dan menyusun `CHANGELOG.md` secara otomatis. Selalu gunakan format commit konvensional:

| Awalan Commit | Kategori | Kenaikan Versi Otomatis |
| :--- | :--- | :--- |
| `feat:` | Fitur Baru | **MINOR** (misal: `0.1.0` $\rightarrow$ `0.2.0`) |
| `fix:` | Perbaikan Bug | **PATCH** (misal: `0.1.0` $\rightarrow$ `0.1.1`) |
| `refactor:` / `perf:` | Refaktorisasi / Optimasi | **PATCH** |
| `BREAKING CHANGE:` / `feat!:` | Perubahan yang merusak kompatibilitas | **MAJOR** (misal: `0.9.0` $\rightarrow$ `1.0.0`) |
| `docs:` / `chore:` / `style:` | Dokumentasi & Maintenance | Disertakan di kategori Chores |

---

## 🎯 4. Alur Rilis Versi Baru (Step-by-Step)

Untuk merilis versi baru, Anda cukup menjalankan perintah CLI interaktif:

### Langkah 1: Jalankan Release Assistant
```bash
php artisan vibe:release
```
*(Atau melalui konsol interaktif `php artisan vibe` lalu pilih opsi Release).*

### Langkah 2: Yang Dilakukan Sistem Secara Otomatis
1. **Validasi Status**: Memeriksa branch dan memastikan tidak ada perubahan lokal yang belum di-commit.
2. **Auto-Sync**: Memastikan aset di `packages/vibe/` identik 100% dengan `resources/`.
3. **Analisis Commit**: Membaca commit sejak tag terakhir dan mengelompokkannya (Features, Fixes, Improvements, Chores).
4. **Saran Versi SemVer**: Sistem menyarankan versi berikutnya (misal `0.1.1`). Anda bisa memilih:
   - `recommended` (sesuai kalkulasi commit)
   - `patch`
   - `minor`
   - `major`
   - `custom` (masukkan versi sendiri)
5. **Update Changelog**: Menulis entri rilis berformat markdown ke `CHANGELOG.md` dan `packages/vibe/CHANGELOG.md`.
6. **Update Version**: Mengupdate konstanta `Vibe::VERSION` di `packages/vibe/src/Vibe.php`.
7. **Commit & Tag**: Membuat commit `chore(release): vX.Y.Z` dan git tag beranotasi `vX.Y.Z`.

### Langkah 3: Push ke GitHub
Setelah tag terbuat, dorong branch dan tag ke repositori:
```bash
git push origin production --tags
```
*(CLI akan menawarkan konfirmasi untuk langsung melakukan push otomatis jika Anda mau).*

Begitu tag tiba di GitHub, Packagist otomatis mendeteksi rilis baru sehingga pengguna dapat langsung menjalankan:
```bash
composer require teknovate/vibeui
```

---

## 🛠️ 5. Perintah Utilitas Terkait

### Mengecek Sinkronisasi Aset Saja
```bash
php artisan vibe:sync --check
```
Memverifikasi apakah `packages/vibe/` sinkron 100% tanpa mengubah file apa pun (berguna untuk validasi CI).

### Menjalankan Sinkronisasi Manual
```bash
php artisan vibe:sync
```
Menyalin seluruh views, css, js, lang, dan layout stubs ke `packages/vibe/`.

### Simulasi Rilis (Dry-Run)
```bash
php artisan vibe:release --dry-run
```
Melihat simulasi pembacaan commit, saran versi, dan preview teks changelog tanpa membuat commit atau tag git nyata.
