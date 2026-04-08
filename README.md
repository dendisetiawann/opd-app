# SIDATA PKU — Sistem Manajemen Data Aplikasi OPD

**Sistem Informasi Data Terpadu** untuk inventarisasi, pengelolaan, monitoring, dan standardisasi data aplikasi web di seluruh Organisasi Perangkat Daerah (OPD) Kota Pekanbaru. Mendukung tata kelola SPBE yang terintegrasi dan akuntabel.

> 🌐 Demo: `https://dendisetiawan44.my.id/'

---

## Daftar Isi

1. [Fitur Utama](#fitur-utama)
2. [Tech Stack](#tech-stack)
3. [Persyaratan Sistem](#persyaratan-sistem)
4. [Instalasi Lokal](#instalasi-lokal)
5. [Konfigurasi Environment](#konfigurasi-environment)
6. [Menjalankan Aplikasi](#menjalankan-aplikasi)
7. [Struktur Database](#struktur-database)
8. [Arsitektur Modul](#arsitektur-modul)
9. [Testing](#testing)
10. [Pengiriman Email & OTP](#pengiriman-email--otp)
11. [Lisensi](#lisensi)

---

## Fitur Utama

### 🔐 Autentikasi & Keamanan
- Login dengan validasi kredensial dan role-based redirect (Admin / User OPD)
- Registrasi pengguna baru dengan **verifikasi OTP** via email
- Lupa password & reset password via email token
- **Role-Based Access Control (RBAC)** — dua peran: `admin` dan `user`
- Session berbasis database, hashing bcrypt (12 rounds), CAPTCHA
- Pencatatan aktivitas login (waktu, IP address, perangkat)

### 📋 Inventarisasi Aplikasi Web (User OPD)
- CRUD lengkap data aplikasi web milik OPD
- Data mencakup: informasi umum, tim & kontak, stack teknologi, repository & backup, database, integrasi & monitoring
- Autocomplete teknologi (framework, bahasa, DBMS) dengan sinkronisasi otomatis
- Dukungan arsitektur monolith dan backend-frontend terpisah

### 👑 Panel Admin (DISKOMINFO)
- **Dashboard** — statistik total aplikasi, total OPD, aplikasi bulan ini
- **Kelola Pengguna** — tambah, lihat detail, reset password, ubah email, soft delete + ekspor kredensial ke PDF
- **Lihat Semua Aplikasi** — filter multi-kriteria, pencarian, sorting
- **Monitoring & Analitik** — 7 sub-modul: Overview, Teknologi, Repository, Database, OPD, Backup, Health Check
- **Site Editor** — kelola konten dinamis landing page (hero, info cards, footer, login, register, dashboard) dengan preview real-time
- **Audit Log** — log lengkap seluruh aktivitas sistem dengan filter aksi, tanggal, dan pencarian

### 📊 Monitoring & Analitik
- Dashboard statistik dengan **drill-down interaktif** (klik kartu → modal detail)
- Breakdown versi framework, DBMS, dan library via AJAX
- Statistik distribusi: teknologi, repository, database, OPD, backup
- **Ekspor data ke Excel (.xlsx)** — seluruh OPD, per OPD, hasil health check

### 🏥 Health Check Website
- Pengecekan URL tunggal secara real-time (AJAX)
- **Pengecekan massal (bulk check)** via Laravel Queue Jobs dengan progress bar polling
- Hasil: HTTP code, status (online/slow/offline/error), response time
- Deskripsi HTTP code dalam Bahasa Indonesia
- Ekspor hasil ke Excel per batch dan per OPD

### 👤 Manajemen Profil (Semua Pengguna)
- Edit nama,ubah email
- Upload, ubah, hapus foto profil (jpeg/png/jpg/gif/webp, max 2MB)
- Ubah password
- Semua perubahan tercatat di audit log

---

## Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Frontend** | Blade, Tailwind CSS 3.x, Alpine.js 3.x |
| **Build Tool** | Vite 7.x |
| **Database** | MySQL / MariaDB |
| **Autentikasi** | Laravel Breeze 2.x |
| **Ekspor Excel** | PhpSpreadsheet 5.x |
| **Ekspor PDF** | Laravel DomPDF 3.x |
| **HTTP Client** | Axios 1.x |
| **Queue** | Laravel Queue (sync/database) |
| **Server Lokal** | Laragon 6.0 |
| **Tools** | Composer, npm, Git |

---

## Persyaratan Sistem

- PHP 8.2 atau lebih baru
- Composer 2.x
- Node.js 18+ & npm
- MySQL / MariaDB
- Ekstensi PHP wajib: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `gd`/`imagick`

---

## Instalasi Lokal

```bash
# Clone repository
git clone https://github.com/dendisetiawann/opd-app.git
cd opd-app

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

Atau gunakan script setup otomatis:
```bash
composer run setup
```

---

## Konfigurasi Environment

Edit `.env` sesuai kebutuhan:

```env
# Aplikasi
APP_NAME="Sistem Manajemen Data Aplikasi OPD"
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=opd_app
DB_USERNAME=root
DB_PASSWORD=

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database

# Mail (SMTP Gmail untuk OTP & Reset Password)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=<APP_PASSWORD_GMAIL>
MAIL_FROM_ADDRESS=admin@pekanbaru.go.id
MAIL_FROM_NAME="${APP_NAME}"

# Queue (gunakan 'database' untuk health check async)
QUEUE_CONNECTION=sync
```

---

## Menjalankan Aplikasi

### Mode Development (Rekomendasi)
Jalankan semua service sekaligus (server, queue, logs, vite):
```bash
composer run dev
```
Ini akan menjalankan:
- `php artisan serve` — Server Laravel
- `php artisan queue:listen` — Queue worker (untuk health check)
- `php artisan pail` — Log viewer
- `npm run dev` — Vite dev server

### Mode Manual
```bash
# Migrasi database
php artisan migrate

# Jalankan server
php artisan serve

# Build assets (terminal terpisah)
npm run dev          # development
npm run build        # production
```

---

## Struktur Database

Sistem menggunakan **12 tabel** dengan penamaan dalam Bahasa Indonesia:

| Tabel | Deskripsi |
|-------|-----------|
| `opd` | Data Organisasi Perangkat Daerah |
| `pengguna` | Data pengguna sistem (admin/user) |
| `aplikasi_web` | Data aplikasi web yang didaftarkan OPD |
| `log_aktivitas` | Audit trail / catatan aktivitas |
| `pengaturan_situs` | Pengaturan konten dinamis website |
| `otp_pendaftaran` | OTP untuk verifikasi registrasi |
| `opsi_teknologi` | Referensi opsi teknologi (framework, DBMS, dll.) |
| `health_check_batches` | Metadata batch health check |
| `health_check_results` | Hasil health check per URL |
| `sesi` | Data sesi pengguna aktif |
| `token_reset_sandi` | Token reset password |
| `cache` / `cache_locks` | Cache framework Laravel |

---

## Arsitektur Modul

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php            # Dashboard & data aplikasi admin
│   │   ├── AdminMonitoringController.php   # Monitoring & analitik (seluruh OPD)
│   │   ├── AdminUserController.php         # Manajemen pengguna
│   │   ├── AdminSiteEditorController.php   # Site editor landing page
│   │   ├── AdminAuditLogController.php     # Audit log
│   │   ├── UserMonitoringController.php    # Monitoring (scope OPD sendiri)
│   │   ├── WebAppController.php            # CRUD aplikasi web (user)
│   │   ├── ProfileController.php           # Kelola profil
│   │   ├── TechOptionController.php        # API opsi teknologi
│   │   └── Auth/                           # Login, register, OTP, reset password
│   └── Middleware/
│       └── RoleMiddleware.php              # RBAC middleware
├── Models/
│   ├── User.php                # Pengguna (tabel: pengguna)
│   ├── Opd.php                 # OPD
│   ├── WebApp.php              # Aplikasi web (tabel: aplikasi_web)
│   ├── ActivityLog.php         # Log aktivitas
│   ├── SiteSetting.php         # Pengaturan situs
│   ├── HealthCheckBatch.php    # Batch health check
│   ├── HealthCheckResult.php   # Hasil health check
│   ├── TechOption.php          # Opsi teknologi
│   └── RegistrationOtp.php     # OTP pendaftaran
└── Jobs/
    ├── CheckAllWebsitesJob.php   # Job health check massal
    └── ProcessHealthCheckJob.php # Job pengecekan per URL
```

---

## Testing

```bash
php artisan test
```

---

## Pengiriman Email & OTP

Sistem menggunakan email SMTP untuk:
- **OTP Registrasi** — Kode 6 digit dikirim saat registrasi untuk verifikasi
- **Reset Password** — Link reset dikirim ke email terdaftar

### Setup Gmail SMTP:
1. Aktifkan **2-Step Verification** di akun Google
2. Buat **App Password** di [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords)
3. Isi `MAIL_PASSWORD` di `.env` dengan App Password yang dibuat
4. Jika menggunakan queue, jalankan worker:
   ```bash
   php artisan queue:work --sleep=3 --tries=3
   ```

---

## Lisensi

Proyek ini dirilis dengan lisensi [MIT](https://opensource.org/licenses/MIT).

Dikembangkan oleh **DISKOMINFO Kota Pekanbaru** untuk mendukung tata kelola SPBE.
