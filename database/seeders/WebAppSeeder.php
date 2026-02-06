<?php

namespace Database\Seeders;

use App\Models\WebApp;
use App\Models\User;
use Illuminate\Database\Seeder;

class WebAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user with an OPD
        $user = User::whereNotNull('opd_id')->first();

        if (!$user) {
            $this->command->warn('No user with OPD found. Please create a user first.');
            return;
        }

        // Sample Web App 1: SIMPEG
        WebApp::create([
            'user_id' => $user->id,
            'opd_id' => $user->opd_id,
            'nama_web_app' => 'SIMPEG - Sistem Informasi Manajemen Pegawai',
            'deskripsi_singkat' => 'Aplikasi untuk mengelola data kepegawaian, absensi, dan cuti pegawai di lingkungan pemerintah daerah.',
            'domain' => 'https://simpeg.pekanbaru.go.id',
            'data_tim_programmer' => "1. Ahmad Fauzi - Backend Developer\n2. Siti Rahayu - Frontend Developer\n3. Budi Santoso - Database Admin",
            'email_narahubung' => 'simpeg@pekanbaru.go.id',
            'bahasa_pemrograman' => "Backend: PHP 8.2\nFrontend: JavaScript ES6, TypeScript 5.0",
            'arsitektur_sistem' => 'be-fe',
            'framework' => 'Laravel, Vue.js',
            'versi_framework' => 'Laravel 11.x, Vue 3.4',
            'daftar_library_package' => "- Laravel Breeze v2.0\n- Tailwind CSS v3.4\n- Axios v1.6\n- Inertia.js v1.0\n- Chart.js v4.4",
            'has_repository' => 'ya',
            'git_repository' => 'private',
            'metode_backup_source_code' => 'Git push ke GitLab internal setiap hari, backup manual ke Google Drive setiap minggu.',
            'metode_backup_asset' => 'Backup ke NAS lokal setiap hari, sync ke Google Cloud Storage setiap minggu.',
            'nama_database' => 'simpeg_db',
            'versi_database' => '8.0',
            'dbms' => 'MySQL',
            'versi_dbms' => '8.0.35',
            'lokasi_database' => 'server',
            'akses_database' => 'private',
            'metode_backup_database' => 'Backup otomatis menggunakan cron job setiap hari pukul 00:00, disimpan di server backup terpisah.',
            'integrasi_sistem_keluar' => 'API Dukcapil untuk verifikasi NIK, SSO Kemendagri untuk login terpusat.',
            'metode_monitoring_evaluasi' => 'Google Analytics untuk tracking pengunjung, UptimeRobot untuk monitoring uptime, Sentry untuk error tracking.',
        ]);

        // Sample Web App 2: E-Arsip
        WebApp::create([
            'user_id' => $user->id,
            'opd_id' => $user->opd_id,
            'nama_web_app' => 'E-Arsip - Sistem Pengarsipan Digital',
            'deskripsi_singkat' => 'Aplikasi mobile dan web untuk mengelola arsip dokumen digital dengan fitur OCR dan pencarian.',
            'domain' => 'https://play.google.com/store/apps/details?id=com.pekanbaru.earsip',
            'data_tim_programmer' => "1. Rudi Hartono - Mobile Developer\n2. Dewi Lestari - Backend Developer",
            'email_narahubung' => '081234567890',
            'bahasa_pemrograman' => "Backend: PHP 8.1, Python 3.11\nMobile: Dart (Flutter)",
            'arsitektur_sistem' => 'be-fe',
            'framework' => 'Laravel, Flutter',
            'versi_framework' => 'Laravel 10.x, Flutter 3.16',
            'daftar_library_package' => "- Laravel Sanctum v3.3\n- Flutter Bloc v8.1\n- Tesseract OCR\n- Elasticsearch v8.0",
            'has_repository' => 'ya',
            'git_repository' => 'private',
            'metode_backup_source_code' => 'Git push ke GitHub Private repository.',
            'metode_backup_asset' => 'Backup ke S3 bucket AWS setiap hari.',
            'nama_database' => 'earsip_db',
            'versi_database' => '15',
            'dbms' => 'PostgreSQL',
            'versi_dbms' => '15.4',
            'lokasi_database' => 'server',
            'akses_database' => 'private',
            'metode_backup_database' => 'pg_dump otomatis setiap 6 jam, replication ke server standby.',
            'integrasi_sistem_keluar' => null,
            'metode_monitoring_evaluasi' => 'Firebase Analytics, Crashlytics untuk mobile, review berkala setiap bulan.',
        ]);

        $this->command->info('2 sample web apps created successfully!');
    }
}
