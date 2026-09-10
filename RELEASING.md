# 🚀 Panduan Versioning & Rilis Vibe UI

Dokumen ini menjelaskan alur kerja rilis dan *versioning* untuk package **Vibe UI** (`teknovate/vibe-ui`) menggunakan pola **Monorepo + Git Subtree Split** (standar industri yang digunakan oleh Laravel Framework dan Filament).

---

## 🏗️ 1. Arsitektur Repositori

```text
[Monorepo: teknovateid/vibeui]
 ├── development  --> Branch koding harian seluruh tim (docs + package)
 ├── production   --> Branch rilis stabil dokumentasi web
 └── packages/vibe/ (Core Package)
           │
           │ (Otomatis via GitHub Action saat push tag v*)
           ▼
[Distribution Repo: teknovateid/vibe-ui]
 └── main (Hanya berisi isi packages/vibe + composer.json di root)
           │
           ▼
     [Packagist.org]
           │
           ▼
  composer require teknovate/vibe-ui
```

---

## ⚙️ 2. Persiapan Awal (One-Time Setup)

Langkah ini hanya perlu dilakukan **satu kali**:

1. **Buat Repositori Distribusi di GitHub**:
   - Nama repositori: `teknovateid/vibe-ui`
   - Visibilitas: Public (atau Private jika khusus internal Teknovate).

2. **Buat GitHub Personal Access Token (PAT)**:
   - Masuk ke GitHub Profile $\rightarrow$ **Settings** $\rightarrow$ **Developer settings** $\rightarrow$ **Personal access tokens** $\rightarrow$ **Fine-grained tokens** (atau *Tokens (classic)*).
   - Berikan hak akses **Repo** (Read and Write).

3. **Simpan ke GitHub Secrets di Monorepo**:
   - Buka repositori `teknovateid/vibeui` $\rightarrow$ **Settings** $\rightarrow$ **Secrets and variables** $\rightarrow$ **Actions**.
   - Tambahkan Secret baru bernama:
     ```text
     SPLIT_ACCESS_TOKEN
     ```
   - Masukkan nilai PAT yang tadi dibuat.

4. **Kaitkan ke Packagist**:
   - Daftarkan repositori `https://github.com/teknovateid/vibe-ui` ke [packagist.org](https://packagist.org/packages/submit).
   - Aktifkan GitHub Webhook otomatis di Packagist agar setiap rilis tag baru langsung terupdate di Composer.

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

Untuk merilis versi baru, Anda cukup menjalankan perintah CLI interaktif yang telah disediakan:

### Langkah 1: Jalankan Release Assistant
```bash
php artisan vibe:release
```
*(Atau melalui konsol interaktif `php artisan vibe` lalu pilih opsi Release).*

### Langkah 2: Yang Dilakukan Sistem Secara Otomatis
1. **Validasi Status**: Memeriksa branch dan memastikan tidak ada perubahan lokal yang belum di-commit.
2. **Auto-Sync**: Memastikan aset di `packages/vibe/` identik 100% dengan `resources/`.
3. **Analisis Commit**: Membaca commit sejak tag terakhir dan mengelompokkannya (Features, Fixes, Improvements, Chores).
4. **Saran Versi SemVer**: Sistem menyarankan versi berikutnya (misal `0.2.0`). Anda bisa memilih:
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
git push origin <branch>
git push origin vX.Y.Z
```
*(CLI akan menawarkan konfirmasi untuk langsung melakukan push otomatis jika Anda mau).*

### Langkah 4: Otomatisasi GitHub Actions
Begitu tag `vX.Y.Z` tiba di GitHub:
- Workflow `.github/workflows/split-package.yml` otomatis aktif.
- Mengekstrak subfolder `packages/vibe/` dan mem-push commit serta tag `vX.Y.Z` ke repositori `teknovateid/vibe-ui`.
- Membuat rilis GitHub beserta catatan rilisnya.
- Packagist otomatis memperbarui package sehingga user dapat langsung menjalankan `composer require teknovate/vibe-ui:^X.Y`.

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
