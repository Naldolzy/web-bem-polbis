# 🎓 BEM Polbis — Website Resmi Badan Eksekutif Mahasiswa

Website resmi untuk Badan Eksekutif Mahasiswa (BEM) Politeknik Bisnis Digital Indonesia (Polbis). Website ini dibangun untuk menjadi pusat informasi profil organisasi, pengumuman kegiatan mahasiswa, struktur kepengurusan, informasi himpunan mahasiswa (Ormawa), dan kontak resmi. 

Sistem ini dilengkapi dengan Panel Admin yang *fully-dynamic* sehingga pengurus BEM dapat mengubah konten website tanpa perlu menyentuh kode.

![BEM Polbis](public/favicon.ico)

---

## 🌟 Fitur Utama

### 🖥️ Halaman Publik (Frontend)
- **Desain Premium:** Menggunakan skema warna resmi BEM Polbis (Navy Blue & BEM Gold) dipadukan dengan desain *Glassmorphism*.
- **Beranda:** Menampilkan ucapan selamat datang dan ringkasan singkat dari BEM.
- **Tentang BEM:** Visi, Misi (dinamis), Sejarah lengkap, dan Sambutan Ketua.
- **Struktur Organisasi:** Menampilkan daftar anggota BEM beserta jabatannya per divisi secara rapi.
- **Ormawa & HIMA:** Katalog Organisasi Mahasiswa dan Himpunan Mahasiswa lengkap dengan logonya.
- **Kegiatan & Proker:** Publikasi berita, program kerja, dan galeri kegiatan BEM.
- **Kontak:** Alamat terintegrasi Google Maps, Email, dan link ke Sosial Media BEM.

### ⚙️ Panel Admin (Backend)
- **Dashboard:** Menampilkan statistik singkat kegiatan, struktur, dan ormawa.
- **Kelola Profil BEM:** Merubah nama kampus, logo kampus, logo BEM, visi, misi, sejarah, alamat, kontak, hingga foto ketua secara instan.
- **Kelola Struktur:** Tambah/Edit/Hapus anggota kepengurusan BEM (support upload foto).
- **Kelola Ormawa:** Tambah/Edit/Hapus daftar Ormawa/HIMA.
- **Kelola Kegiatan:** Publikasi artikel kegiatan dengan fitur upload *thumbnail* resolusi tinggi (maks 10MB).
- **Security:** Login system terenkripsi, proteksi *middleware* di seluruh panel admin.

### 🚀 Optimasi SEO & Performa
- **Sitemap XML Otomatis:** (`/sitemap.xml`) yang selalu ter-update setiap ada artikel baru.
- **Open Graph & Twitter Cards:** Thumbnail otomatis muncul saat link website di-share di WhatsApp, Twitter, FB, dll.
- **JSON-LD Schema:** Bantuan tambahan untuk mempermudah Google mendeteksi BEM Polbis sebagai Organisasi Resmi.
- **Preloader Custom & Caching:** Load halaman lebih *smooth* dengan aset CSS yang di-bundle menggunakan Vite.

---

## 🛠️ Tech Stack

- **Framework Backend:** Laravel 11 (PHP 8.2+)
- **Database:** MySQL
- **Framework CSS:** Tailwind CSS v4
- **Asset Bundler:** Vite
- **Font:** Plus Jakarta Sans & Inter (Google Fonts)

---

## 💻 Tata Cara Pakai & Instalasi (Lokal)

Buat lu yang pengen ngejalanin project ini di laptop sendiri, ikutin langkah ini:

1. **Clone Repository**
   ```bash
   git clone https://github.com/Naldolzy/web-bem-polbis.git
   cd web-bem-polbis
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   - Copy file `.env.example` lalu ubah namanya jadi `.env`.
   - Buka file `.env`, lalu buat database di MySQL (misal: `bem_polbis`) dan sesuaikan config DB di dalam file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bem_polbis
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Key & Link Storage**
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

5. **Migrasi Database & Seeding (Penting!)**
   Jalankan command ini agar tabel database terbentuk dan otomatis terisi dengan data *default* BEM Polbis dan akun Admin:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build Asset CSS/JS**
   ```bash
   npm run build
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Buka browser dan akses: `http://localhost:8000`

---

## 🔐 Akses Panel Admin

Secara *default* (setelah menjalankan seeding), sistem sudah membuat 1 akun admin agar kamu bisa langsung mengelola website:

- **URL Login:** `http://localhost:8000/bem-admin/login`
- **Email:** `admin@bem-polbis.ac.id`
- **Password:** `bempolbis2025`

*(Sangat disarankan untuk segera mengubah password jika sudah naik ke production!)*

---

## 📝 Catatan Tambahan Project

1. **Upload Maksimal 10MB**
   Jika nanti di hosting ternyata gagal upload gambar berukuran besar, pastikan konfigurasi `upload_max_filesize` dan `post_max_size` pada PHP server (atau `php.ini`) minimal **10MB**. Pada project ini, limit sudah diatur di file `.htaccess` dan `ProfilController`.

2. **Hosting Recommendations**
   - **TIDAK DISARANKAN** menggunakan **Vercel**. Vercel didesain untuk Next.js/React, sehingga memaksa Laravel jalan di Vercel butuh workaround *serverless* yang rumit dan tidak support MySQL bawaan.
   - **SANGAT DISARANKAN** deploy ke **Railway.app**, **Hostinger**, atau **VPS** biasa. Project ini sudah dilengkapi dengan file `nixpacks.toml` khusus agar *seamless deployment* ke Railway!

3. **Symlink Storage pada Hosting/Cpanel**
   Kalau deploy di shared hosting (seperti cPanel), jangan lupa jalankan `php artisan storage:link` atau buat symlink manual agar foto-foto yang diupload di admin bisa muncul di halaman publik.

---

> Dibuat dengan 💻 dan ☕ untuk **Politeknik Bisnis Digital Indonesia**.
