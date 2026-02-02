# OPD App

Aplikasi manajemen OPD berbasis Laravel untuk mengelola data instansi, pengguna, dan web app internal. Proyek ini sudah dilengkapi autentikasi modern (email verification/magic link) dan workflow manajemen OPD yang siap dikembangkan.

## Daftar Isi
1. [Fitur Utama](#fitur-utama)
2. [Tech Stack](#tech-stack)
3. [Persyaratan Sistem](#persyaratan-sistem)
4. [Instalasi Lokal](#instalasi-lokal)
5. [Konfigurasi Environment](#konfigurasi-environment)
6. [Menjalankan Aplikasi](#menjalankan-aplikasi)
7. [Testing](#testing)
8. [Pengiriman Email & Magic Link Gmail](#pengiriman-email--magic-link-gmail)
9. [Lisensi](#lisensi)

---

## Fitur Utama
- Manajemen pengguna berbasis role (admin & user) dengan relasi ke OPD.
- Registrasi mendukung pemilihan OPD existing maupun pembuatan OPD baru.
- Autentikasi Laravel Breeze/Fortify: login, registrasi, reset password, verifikasi email.
- Sistem magic link verifikasi via email (SMTP Gmail).
- UI Blade + Tailwind + Vite, siap dikustomisasi.

## Tech Stack
- **Backend**: PHP 8.2+, Laravel 10
- **Frontend**: Blade, TailwindCSS, Vite
- **Database**: MySQL / MariaDB
- **Server**: Nginx + PHP-FPM
- **Tools**: Composer, npm

## Persyaratan Sistem
- PHP 8.2 atau lebih baru
- Composer 2.x
- Node.js 18+ & npm
- MySQL / MariaDB
- Ekstensi PHP wajib: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`

## Instalasi Lokal
```bash
git clone https://github.com/<org>/opd-app.git
cd opd-app
composer install
npm install
cp .env.example .env
php artisan key:generate
```

## Konfigurasi Environment
Edit `.env` sesuai kebutuhan:
- **APP_URL**: `http://localhost` untuk lokal, `http://IP_VPS` atau URL Ngrok di server.
- **Database**: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
- **Mail**: lihat [bagian mail](#pengiriman-email--magic-link-gmail) untuk setup SMTP Gmail.

## Menjalankan Aplikasi
```bash
php artisan migrate --seed   # jika butuh data awal
php artisan serve            # http://127.0.0.1:8000
npm run dev                  # asset dev server
npm run build                # build production asset
```

## Testing
```bash
php artisan test
```

## Pengiriman Email & Magic Link Gmail
Laravel otomatis mengirim email verifikasi ketika user registrasi (`event(new Registered($user))`). Pastikan `.env` terisi:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=akun@gmail.com
MAIL_PASSWORD=<APP_PASSWORD_GMAIL>
MAIL_FROM_ADDRESS=akun@gmail.com
MAIL_FROM_NAME="OPD App"
```
- Aktifkan 2FA Gmail dan buat **App Password** khusus.
- User dapat meminta link verifikasi ulang melalui endpoint `verification.send`.
- Jika mail menggunakan queue, jalankan `php artisan queue:work --sleep=3 --tries=3` (bisa via systemd/supervisor).

## Lisensi
Proyek ini dirilis dengan lisensi [MIT](https://opensource.org/licenses/MIT). Mohon sertakan atribusi ke Laravel sesuai ketentuan.
