<div align="center">

<img src="public/logo-bem.png" alt="Logo BEM Polbis" width="160">

# Website Resmi BEM Polbis

**Badan Eksekutif Mahasiswa — Politeknik Bisnis Digital Indonesia**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vitejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

</div>

---

Website resmi untuk **Badan Eksekutif Mahasiswa (BEM) Politeknik Bisnis Digital Indonesia**. Dibangun sebagai pusat informasi kegiatan mahasiswa, struktur kepengurusan, himpunan mahasiswa (HIMA/Ormawa), dan kontak resmi BEM.

Sistem dilengkapi **Panel Admin yang fully-dynamic** — pengurus BEM bisa mengubah seluruh konten website tanpa perlu menyentuh kode sama sekali.

---

## ✨ Fitur Utama

### 🖥️ Halaman Publik (Frontend)

| Halaman | Deskripsi |
|---------|-----------|
| **Beranda** | Hero section, sambutan, dan highlight kegiatan terbaru |
| **Tentang BEM** | Visi, Misi (dinamis), Sejarah, Sambutan Ketua |
| **Kegiatan & Proker** | Publikasi artikel dengan filter kategori & pagination |
| **Struktur Organisasi** | Daftar anggota per divisi dengan foto |
| **Ormawa & HIMA** | Katalog himpunan mahasiswa lengkap dengan logo |
| **Kontak** | Alamat, Email, WhatsApp, dan link Sosial Media |

> Desain menggunakan tema **Navy Blue & BEM Gold** dengan efek Glassmorphism. Responsif penuh di mobile & desktop.

### ⚙️ Panel Admin (Backend)

- 📊 **Dashboard** — Statistik ringkas kegiatan & anggota
- 🎨 **Kelola Profil BEM** — Logo, Visi/Misi dinamis, foto Ketua, kontak, sejarah
- 👥 **Kelola Struktur** — CRUD anggota kepengurusan + upload foto
- 🏛️ **Kelola Ormawa** — CRUD daftar HIMA/Ormawa + upload logo
- 📰 **Kelola Kegiatan** — Publikasi artikel + thumbnail (support hingga 10MB)
- 🔐 **Security** — Login sistem, proteksi middleware di seluruh admin panel

### 🚀 SEO & Performa

- 🗺️ **Sitemap XML Otomatis** di `/sitemap.xml` — selalu update tiap ada artikel baru
- 📱 **Open Graph & Twitter Cards** — thumbnail muncul saat link di-share di WhatsApp/IG/Twitter
- 🔎 **JSON-LD Schema** — Google mendeteksi BEM Polbis sebagai Organisasi Resmi
- ⚡ **GZIP Compression** — bandwidth hemat ~70%
- 🗃️ **Browser Caching Agresif** — CSS/JS di-cache 1 tahun, gambar 6 bulan
- 🔒 **Security Headers** — X-Frame-Options, X-Content-Type-Options, Referrer-Policy

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel **13.x** (PHP 8.3+) |
| Database | MySQL 8.x |
| Frontend Bundler | Vite 6.x |
| CSS | Tailwind CSS v4 + Custom CSS |
| Font | Plus Jakarta Sans & Inter (Google Fonts) |
| Deployment | Nixpacks (Railway.app ready) |

---

## 💻 Instalasi Lokal

### Prasyarat
- PHP 8.3+
- Composer
- Node.js 20+ & NPM
- MySQL 8.x
- (Opsional) Laragon / XAMPP / Herd

### Langkah-langkah

**1. Clone Repository**
```bash
git clone https://github.com/Naldolzy/web-bem-polbis.git
cd web-bem-polbis
```

**2. Install Dependencies**
```bash
composer install
npm install
```

**3. Konfigurasi Environment**

Copy `.env.example` → `.env`, lalu sesuaikan:
```env
APP_NAME="BEM Polbis"
APP_ENV=local
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bem_polbis
DB_USERNAME=root
DB_PASSWORD=
```

**4. Generate Key & Storage Link**
```bash
php artisan key:generate
php artisan storage:link
```

**5. Migrasi Database & Seeding**
```bash
php artisan migrate:fresh --seed
```
> Ini akan membuat semua tabel + data profil BEM default + akun admin otomatis.

**6. Build Asset**
```bash
npm run build
```

**7. Jalankan Server**
```bash
php artisan serve
```
Akses di: `http://localhost:8000`

---

## 🔐 Akses Panel Admin & Panduan Pemula

Setelah aplikasi berhasil berjalan, Anda bisa login ke Panel Admin melalui URL: `http://localhost:8000/bem-admin/login` (Ganti localhost dengan domain Anda jika sudah online). 

Terdapat dua tingkat hak akses yang tersedia secara default:

### 1. Akun Default

| Role | Email Login | Password | Hak Akses |
|------|-------------|----------|-----------|
| **👤 Admin Biasa** | `admin@bem-polbis.ac.id` | `bempolbis2025` | Terbatas (Hanya kelola konten website: artikel, kegiatan, ormawa, dll) |

> ⚠️ **PENTING:** Segera ganti password dari akun default ini setelah website Anda berhasil online (deploy) demi keamanan!

### 2. Cara Menggunakan Fitur-fitur Admin
- **Cara Ganti Password:** Login ke panel admin, klik nama/profil Anda di pojok kanan atas layar, lalu pilih menu **"Ganti Password"**. Masukkan password baru dan simpan.
- **Menambahkan Admin Baru:** Fitur ini **hanya bisa diakses oleh Super Admin**. Di menu sebelah kiri, klik **"Kelola Admin"**. Klik tombol "+ Tambah Admin", isi nama, email, role, dan password sementara untuk admin baru tersebut.
- **Melihat Password Admin Lain:** Jika ada admin yang lupa password, **Super Admin** bisa masuk ke menu "Kelola Admin", lalu klik tombol ikon **Mata (👁️)** di baris nama admin tersebut untuk mengintip password aslinya.
- **Mengunci Website (Mode Perbaikan/Maintenance):** Fitur khusus Super Admin. Jika website sedang diperbaiki, masuk ke menu **"Pengaturan Website"**. Ketik alasan perbaikannya, lalu klik "Kunci Website". Pengunjung umum hanya akan melihat layar perbaikan, tetapi semua admin tetap bisa login dan mengedit website seperti biasa!

---

## 🚢 Deployment (Hosting)

### ✅ Rekomendasi Platform

| Platform | Status | Catatan |
|----------|--------|---------|
| **Railway.app** | ✅ Sangat Disarankan | Sudah tersedia `nixpacks.toml`, deploy otomatis |
| **Hostinger** (VPS/Shared) | ✅ Bisa | Jalankan `php artisan storage:link` setelah deploy |
| **VPS** (Ubuntu/Debian) | ✅ Bisa | Full control, paling stabil |
| **Vercel** | ❌ Tidak Disarankan | Tidak support MySQL + arsitektur serverless tidak cocok |

### Checklist Deploy

```bash
# 1. Set environment production
APP_ENV=production
APP_DEBUG=false

# 2. Optimize untuk production (WAJIB)
php artisan optimize
php artisan storage:link

# 3. Jika pakai shared hosting, tambahkan di .env:
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

---

## 📝 Catatan Teknis

### Upload Gambar
- Default limit: **10MB** per file
- Format yang didukung: `jpg`, `jpeg`, `png`, `webp`, `svg`
- Jika di hosting gagal upload, cek `upload_max_filesize` dan `post_max_size` di `php.ini` atau `.htaccess`

### Optimasi Server Kecil
Project ini sudah dioptimasi untuk VPS/shared hosting spesifikasi rendah:
- ✅ **GZIP compression** aktif via `.htaccess`
- ✅ **Browser caching** agresif (CSS/JS 1 tahun, gambar 6 bulan)
- ✅ **Slow query logging** aktif di local environment
- ✅ **Memory limit** 128MB (cukup untuk server entry-level)
- ✅ `php artisan optimize` menggabungkan semua config/route/view cache

### Storage & File Upload
Semua file upload disimpan di `storage/app/public/` dan diakses via symlink `public/storage/`.
Jika symlink belum ada, jalankan:
```bash
php artisan storage:link
```

---

## 📁 Struktur Folder Penting

```
web-bem-polbis/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          ← Controller panel admin
│   │   ├── PublicController.php  ← Controller halaman publik
│   │   └── SitemapController.php
│   ├── Models/             ← Kegiatan, Struktur, Ormawa, ProfilBem, dll
│   └── Providers/
│       └── AppServiceProvider.php  ← Optimasi & HTTPS enforcement
├── database/
│   ├── migrations/         ← Skema tabel database
│   └── seeders/            ← Data awal (profil BEM & akun admin)
├── public/
│   ├── favicon.png         ← Logo BEM sebagai favicon
│   ├── logo-bem.png        ← Logo BEM full
│   └── .htaccess           ← Rewrite rules + GZIP + Caching
├── resources/views/
│   ├── layouts/            ← Template utama (public & admin)
│   ├── public/             ← Halaman-halaman frontend
│   ├── admin/              ← Halaman-halaman panel admin
│   ├── sitemap/            ← Template sitemap XML
│   └── errors/             ← Halaman error custom (404, dll)
├── routes/web.php          ← Definisi semua URL/route
├── nixpacks.toml           ← Konfigurasi deploy Railway.app
└── .env.example            ← Template konfigurasi environment
```

---

## 🤝 Kontribusi

Project ini open-source untuk keperluan internal BEM Polbis. Jika ada bug atau saran:
1. Fork repository ini
2. Buat branch baru: `git checkout -b fix/nama-bug`
3. Commit perubahan: `git commit -m "fix: deskripsi perubahan"`
4. Push & buat Pull Request

---

<div align="center">

Dibuat dengan 💻 dan ☕ untuk **Politeknik Bisnis Digital Indonesia**

**BEM Polbis** &bull; Badan Eksekutif Mahasiswa &bull; 2025

</div>
